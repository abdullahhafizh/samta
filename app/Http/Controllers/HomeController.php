<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Word;
use Action;
use Virtual;
use Carbon\Carbon;
use Illuminate\Support\Str;
use HTMLDomParser;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
    	Carbon::setLocale('id');
    	$data['age'] = Carbon::createFromFormat('Y-m-d','2019-03-11')->diffForHumans();
    	Virtual::truncate();
    	return view('test')->with($data);
    }

    public function seo()
    {
    	$html = file_get_contents('https://trends.google.com/trends/trendingsearches/daily?geo=ID');
    	$token = HTMLDomParser::str_get_html($html)->find('span');
    	dd($token);
    }

    public function donation()
    {
        return view('donation');
    }

    public function app()
    {
        return response()->download(storage_path("../public/samta.apk"));
    }

    public function test(Request $request)
    {
    	$ch = curl_init ("https://kbbi.kemdikbud.go.id/Account/Login");
    	curl_setopt ($ch, CURLOPT_COOKIEJAR, @tempnam("/tmp", "CURLCOOKIE")); 
    	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
    	$output = curl_exec ($ch);
    	dd($output);
    	$html = file_get_contents('https://kbbi.kemdikbud.go.id/Account/Login');
        // $data['token'] = HTMLDomParser::str_get_html($html)->find('input');
    	$token = HTMLDomParser::str_get_html($html)->find('input[name="__RequestVerificationToken"]')[0]->attr['value'];
    	$client = new Client();
    	$result = $client->request('POST','https://kbbi.kemdikbud.go.id/Account/Login',[
    		'headers' => [
    			'Host' => 'kbbi.kemdikbud.go.id',
    			'User-Agent' => $request->header('user-agent'),
    			'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
    			'Accept-Language' => 'en-US,en;q=0.9',
    			'Referer' => 'https://kbbi.kemdikbud.go.id/Account/Login',
    			'Content-Type' => 'application/x-www-form-urlencoded',
    			'Connection' => 'keep-alive',
    			'Cookie' => '_ga=GA1.3.1882503044.1560091172; __RequestVerificationToken='.$token.'; _gid=GA1.3.1486676393.1563376878; _gat_gtag_UA_128199158_1=1',
    			'Upgrade-Insecure-Requests' => '1',
    			'origin' => 'https://kbbi.kemdikbud.go.id',
    			'TE' => 'Trailers'
    		],
    		'form-params' => [
    			'__RequestVerificationToken' => $token,
    			'Posel' => 'abdllhhafizh@gmail.com',
    			'KataSandi' => 'soccer163',
    			'IngatSaya' => 'false'
    		]
    	]);
    	dd($result);
    }

    public function kbbi($id)
    {
    	if(!cek($id))
    	{
    		return 'wow';
    	}
    }

    public function recheck()
    {
    	$output = new \Symfony\Component\Console\Output\ConsoleOutput();
    	$words = Word::all();
    	foreach ($words as $word) {
    		$second = date('s');
    		if ($word->valid == 2) {
    			$update = str_replace(' ', '%20', $word->kata);
    			if(!cek($update)) {
    				$kata = Word::find($word->id);
    				$kata->valid = 1;
    				$kata->save();
    				$talk = "<info>'".$update."' [200]</info>";
    			}
    			else {
    				$kata = Word::find($word->id);
    				$kata->valid = 0;
    				$kata->save();
    				$talk = "<info>'".$update."' [400]</info>";
    			}
    			$list = Word::where('valid', 1)->count();
    			$all = Word::count();
    			$precen = ($list/$all)*100;
    			$second = date('s') - $second;
    			$output->writeln($talk." - ".$list." (".$precen."%) ".$second." second");
    		}
    	}
    	$output->writeln("<info>[DONE]</info> - ".$list."(".$precen."%)");
    	return 'done';
    }    

    public function log($id)
    {
    	$output = new \Symfony\Component\Console\Output\ConsoleOutput();
    	$output->writeln($id);
    }

    public function val()
    {
    	$words = Word::where('point', '>=', '2')->where('valid', 1)->get();
    	$wow = [];
    	foreach ($words as $key => $value) {
    		$wow[] = $value->kata.' : '.split($value->kata);
    	}
    	dd($wow);
    }

    public function report()
    {
    	$data['satu'] = data_satu();
    	$data['dua'] = data_dua();
        $data['tiga'] = data_tiga();
        $data['empat'] = data_empat();
        $data['lima'] = data_lima();
        $data['enam'] = data_enam();
        $data['tujuh'] = data_tujuh();
        $data['delapan'] = data_delapan();
        $data['sembilan'] = data_sembilan();
        $data['sepuluh'] = data_sepuluh();
        $data['sebelas'] = data_sebelas();
        $data['duabelas'] = data_duabelas();
        $data['tigabelas'] = data_tigabelas();
        $data['empatbelas'] = data_empatbelas();
        $data['limabelas'] = data_limabelas();

        return view('report', $data);
    }

    public function search(Request $request)
    {
    	if(Virtual::count() <= 0)
    	{
    		if ($request->filled('input')) {

                $cek = cek($request->input);
                if($cek == '2') {
                    if (!Word::where('kata', $request->input)->exists()) {
                        $baru = new Word;
                        $baru->kata = $request->input;
                        $baru->point = 1;
                        $baru->tipe_kata = "Lain-lain";
                        $baru->valid = 2;
                        $baru->save();
                    }
                }

                $data['words'] = Word::where('kata', 'like', $request->input.'%')->where('valid', 1)->orderBy('point', 'desc')->orderBy('kata', 'asc')->paginate(20);
                $data['words']->appends($request->only('input'));
                $data['search'] = $request->input;
                $aksi = new Action;
                $aksi->kata = $request->input;
                $aksi->flag = '1';
                $aksi->search = '1';
                if (count($data['words']) <= 0) {
                    $aksi->valid = '0';
                }
                else {
                    $aksi->valid = '1';
                }
                $aksi->save();
                return view('search', $data);
            }
            return view('search');
        }
        return 'Tidak dapat melakukan pencarian selama bermain';
    }

    public function answer(Request $request)
    {
    	$aksi = new Action;
    	$aksi->kata = $request->answer;
    	$aksi->flag = '1';
    	$aksi->search = '0';
    	$split = split($request->answer);
        $cek = cek($request->answer);

        $this->log($request->answer);
        $this->log($split);
        if($cek == '0')
        {
            $this->log("session");
            $response = array(
                'status' => 'session',
                'request' => $request->answer,
                'awal' => $split,
                'answer' => null,
                'akhir' => null,
                'point' => null,
            );
            $this->log(response()->json($response));
            return response()->json($response);
        }
        $id = 0;
        if($cek == '2') {
            $this->log("lolos kbbi");
            if (!Word::where('kata', $request->answer)->exists()) {
                $baru = new Word;
                $baru->kata = $request->answer;
                $baru->point = 1;
                $baru->tipe_kata = "Lain-lain";
                $baru->valid = 2;
                $baru->save();
            }
            $kalimat = Word::where('kata', $request->answer)->first();
            if (Virtual::where('word_id', $kalimat->id)->exists()) {
                $this->log("duplikat");
                $response = array(
                    'status' => 'duplicate',
                    'request' => $request->answer,
                    'awal' => $split,
                    'answer' => null,
                    'akhir' => null,
                    'point' => null,
                );
                $this->log(response()->json($response));
                return response()->json($response);
            }
            else {
                $this->log("baru");
                $kalimat->point = $kalimat->point + 1;
                $kalimat->valid = 1;
                $kalimat->save();

                $virtual = new Virtual;
                $virtual->word_id = $kalimat->id;
                $virtual->save();

                $all = Virtual::select('word_id')->get();

                $word = search($all, $request->answer);

                if ($word == null) {
                    $this->log("menang");
                    $response = array(
                        'status' => 'win',
                        'request' => $request->answer,
                        'awal' => $split,
                        'answer' => null,
                        'akhir' => null,
                        'point' => null,
                    );
                    $this->log(response()->json($response));
                    $aksi->valid = '1';
                    $aksi->save();
                    return response()->json($response);
                }

                $split2 = split($word->kata);
                $this->log(response()->json($word));

                if (Word::where('kata', 'like', $split2.'%')->exists()) {
                    $virtual = new Virtual;
                    $virtual->word_id = $word->id;
                    $virtual->save();

                    $response = array(
                        'status' => 'success',
                        'request' => $request->answer,
                        'awal' => $split,
                        'answer' => $word->kata,
                        'akhir' => $split2,
                        'point' => $word->point,
                    );
                    $aksi->valid = '1';
                    $aksi->save();
                    $aksi = new Action;
                    $aksi->kata = $word->kata;
                    $aksi->flag = '0';
                    $aksi->search = '0';
                    $aksi->valid = '1';
                    $aksi->save();
                    $this->log(response()->json($response));
                    return response()->json($response);
                }
                else {
                    $this->log("menang");
                    $response = array(
                        'status' => 'win',
                        'request' => $request->answer,
                        'awal' => $split,
                        'answer' => null,
                        'akhir' => null,
                        'point' => null,
                    );
                    $aksi->valid = '1';
                    $aksi->save();
                    $this->log(response()->json($response));
                    return response()->json($response);
                }
            }
        }
        else {
            if (Word::where('kata', $request->answer)->exists()) {
                $aidi = Word::where('kata', $request->answer)->value('id');
                $kuba = Word::find($aidi);
                $kuba->valid = 1;
                $kuba->save();
            }
        }
        $this->log("tidak lolos kbbi");
        $response = array(
            'status' => 'error',
            'answer' => null,
            'akhir' => null,
            'point' => null,
        );
        $aksi->valid = '0';
        $aksi->save();
        $this->log(response()->json($response));
        return response()->json($response);
    }

    public function save(Request $request)
    {
        foreach ($request->id as $key => $value) {
            $table = Word::find($request->id[$key]);
            $table->awal = $request->awal[$key];
            $table->akhir = $request->akhir[$key];
            $table->save();
        }

        return back();
    }
}
