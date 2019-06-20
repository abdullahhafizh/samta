<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Word;
use Virtual;
use Carbon\Carbon;
use Illuminate\Support\Str;

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
        $data['count'] = Word::whereNull('awal')->orWhereNull('akhir')->count();
        $percent = Word::whereNotNull('awal')->orWhereNotNull('akhir')->count();
        $data['percent'] = ($percent/$data['count'])*100;
        $data['words'] = Word::whereNull('awal')->orWhereNull('akhir')->limit(20)->get();
        return view('home')->with($data);
    }

    public function test()
    {
        // $cek = cek('kamus');
        // if($cek == '0') {
        //     return 'Sesi berakhir. Kembali lagi besok.';
        // }
        Carbon::setLocale('id');
        $data['age'] = Carbon::createFromFormat('Y-m-d','2019-03-11')->diffForHumans();
        Virtual::truncate();
        return view('test')->with($data);
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

    public function answer(Request $request)
    {
        $this->log($request->answer);
        if(cek($request->answer) == '0')
        {
            $this->log("session");
            $response = array(
                'status' => 'session',
                'answer' => null,
                'akhir' => null,
                'point' => null,
            );
            $this->log(response()->json($response));
            return response()->json($response);
        }
        $id = 0;
        if(cek($request->answer) == '2') {
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
                $kalimat->save();

                $virtual = new Virtual;
                $virtual->word_id = $kalimat->id;
                $virtual->save();

                $all = Virtual::all();
                $ids = [];
                foreach ($all as $key => $value) {
                    $ids[] = $value->word_id;
                }

                $word = search($ids, $request->answer);                
                $this->log(response()->json($word));

                if ($word == null) {
                    $this->log("menang");
                    $response = array(
                        'status' => 'win',
                        'answer' => null,
                        'akhir' => null,
                        'point' => null,
                    );
                    $this->log(response()->json($response));
                    return response()->json($response);
                }                
                if (Word::where('kata', 'like', split($word->kata, 2).'%')->exists()) {                    
                    $virtual = new Virtual;
                    $virtual->word_id = $word->id;
                    $virtual->save();

                    $response = array(
                        'status' => 'success',
                        'answer' => $word->kata,
                        'akhir' => split($word->kata, 2),
                        'point' => $word->point,
                    );
                    $this->log(response()->json($response));
                    return response()->json($response);
                }
                else if (Word::where('kata', 'like', split($word->kata, 1).'%')->exists()) {                    
                    $virtual = new Virtual;
                    $virtual->word_id = $word->id;
                    $virtual->save();

                    $response = array(
                        'status' => 'success',
                        'answer' => $word->kata,
                        'akhir' => split($word->kata, 1),
                        'point' => $word->point,
                    );
                    $this->log(response()->json($response));
                    return response()->json($response);
                }
                else {
                    $this->log("menang");
                    $response = array(
                        'status' => 'win',
                        'answer' => null,
                        'akhir' => null,
                        'point' => null,
                    );
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
