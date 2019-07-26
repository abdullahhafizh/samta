@extends('layouts.app')

@section('head-content')
<style type="text/css">
	a {
		color: black!important;
		text-decoration: none!important;
		cursor: pointer!important;
	}
</style>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header"><center><h1><b>Report History Permainan</b></h1></center></div>
				<div class="card-body">
					<div class="row justify-content-center">

						<div class="col-sm-12"><center><h2><b>Jawaban Yang Sering Dijawab</b></h2></center><hr></div>
						
						<div class="col-md-4 col-sm-12 form-group">
							<div class="card">
								<div class="card-header"><center><h3><b>Sepanjang Masa</b></h3></center></div>
								<div class="card-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th scope="col"><center>Urutan</center></th>
												<th scope="col">Kata</th>
											</tr>
										</thead>
										<tbody>
											@foreach($satu as $key => $first)
											<tr>
												<th scope="row"><center>#{{ $key+1 }}</center></th>
												<td><a href="{{ url('https://kbbi.kemdikbud.go.id/entri/'.strtolower($first->kata)) }}" target="_blank">{{ strtolower($first->kata) }}</a></td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="col-md-4 col-sm-12 form-group">
							<div class="card">
								<div class="card-header"><center><h3><b>Tahun Ini</b></h3></center></div>
								<div class="card-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th scope="col"><center>Urutan</center></th>
												<th scope="col">Kata</th>
											</tr>
										</thead>
										<tbody>
											@foreach($dua as $key => $first)
											<tr>
												<th scope="row"><center>#{{ $key+1 }}</center></th>
												<td><a href="{{ url('https://kbbi.kemdikbud.go.id/entri/'.strtolower($first->kata)) }}" target="_blank">{{ strtolower($first->kata) }}</a></td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="col-md-4 col-sm-12 form-group">
							<div class="card">
								<div class="card-header"><center><h3><b>Bulan Ini</b></h3></center></div>
								<div class="card-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th scope="col"><center>Urutan</center></th>
												<th scope="col">Kata</th>
											</tr>
										</thead>
										<tbody>
											@foreach($tiga as $key => $first)
											<tr>
												<th scope="row"><center>#{{ $key+1 }}</center></th>
												<td><a href="{{ url('https://kbbi.kemdikbud.go.id/entri/'.strtolower($first->kata)) }}" target="_blank">{{ strtolower($first->kata) }}</a></td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>


						<div class="col-sm-12"><center><h2><b>Jawaban Yang Sering Dicari</b></h2></center><hr></div>
						
						<div class="col-md-4 col-sm-12 form-group">
							<div class="card">
								<div class="card-header"><center><h3><b>Sepanjang Masa</b></h3></center></div>
								<div class="card-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th scope="col"><center>Urutan</center></th>
												<th scope="col">Kata</th>
											</tr>
										</thead>
										<tbody>
											@foreach($empat as $key => $first)
											<tr>
												<th scope="row"><center>#{{ $key+1 }}</center></th>
												<td><a href="{{ url('https://kbbi.kemdikbud.go.id/entri/'.strtolower($first->kata)) }}" target="_blank">{{ strtolower($first->kata) }}</a></td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="col-md-4 col-sm-12 form-group">
							<div class="card">
								<div class="card-header"><center><h3><b>Tahun Ini</b></h3></center></div>
								<div class="card-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th scope="col"><center>Urutan</center></th>
												<th scope="col">Kata</th>
											</tr>
										</thead>
										<tbody>
											@foreach($lima as $key => $first)
											<tr>
												<th scope="row"><center>#{{ $key+1 }}</center></th>
												<td><a href="{{ url('https://kbbi.kemdikbud.go.id/entri/'.strtolower($first->kata)) }}" target="_blank">{{ strtolower($first->kata) }}</a></td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="col-md-4 col-sm-12 form-group">
							<div class="card">
								<div class="card-header"><center><h3><b>Bulan Ini</b></h3></center></div>
								<div class="card-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th scope="col"><center>Urutan</center></th>
												<th scope="col">Kata</th>
											</tr>
										</thead>
										<tbody>
											@foreach($enam as $key => $first)
											<tr>
												<th scope="row"><center>#{{ $key+1 }}</center></th>
												<td><a href="{{ url('https://kbbi.kemdikbud.go.id/entri/'.strtolower($first->kata)) }}" target="_blank">{{ strtolower($first->kata) }}</a></td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>


						<div class="col-sm-12"><center><h2><b>Jawaban Yang Sering Dijawab AI</b></h2></center><hr></div>
						
						<div class="col-md-4 col-sm-12 form-group">
							<div class="card">
								<div class="card-header"><center><h3><b>Sepanjang Masa</b></h3></center></div>
								<div class="card-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th scope="col"><center>Urutan</center></th>
												<th scope="col">Kata</th>
											</tr>
										</thead>
										<tbody>
											@foreach($tujuh as $key => $first)
											<tr>
												<th scope="row"><center>#{{ $key+1 }}</center></th>
												<td><a href="{{ url('https://kbbi.kemdikbud.go.id/entri/'.strtolower($first->kata)) }}" target="_blank">{{ strtolower($first->kata) }}</a></td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="col-md-4 col-sm-12 form-group">
							<div class="card">
								<div class="card-header"><center><h3><b>Tahun Ini</b></h3></center></div>
								<div class="card-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th scope="col"><center>Urutan</center></th>
												<th scope="col">Kata</th>
											</tr>
										</thead>
										<tbody>
											@foreach($delapan as $key => $first)
											<tr>
												<th scope="row"><center>#{{ $key+1 }}</center></th>
												<td><a href="{{ url('https://kbbi.kemdikbud.go.id/entri/'.strtolower($first->kata)) }}" target="_blank">{{ strtolower($first->kata) }}</a></td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="col-md-4 col-sm-12 form-group">
							<div class="card">
								<div class="card-header"><center><h3><b>Bulan Ini</b></h3></center></div>
								<div class="card-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th scope="col"><center>Urutan</center></th>
												<th scope="col">Kata</th>
											</tr>
										</thead>
										<tbody>
											@foreach($sembilan as $key => $first)
											<tr>
												<th scope="row"><center>#{{ $key+1 }}</center></th>
												<td><a href="{{ url('https://kbbi.kemdikbud.go.id/entri/'.strtolower($first->kata)) }}" target="_blank">{{ strtolower($first->kata) }}</a></td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>


						<div class="col-sm-12"><center><h2><b>Jawaban Yang Sering Dijawab (Tidak Baku)</b></h2></center><hr></div>
						
						<div class="col-md-4 col-sm-12 form-group">
							<div class="card">
								<div class="card-header"><center><h3><b>Sepanjang Masa</b></h3></center></div>
								<div class="card-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th scope="col"><center>Urutan</center></th>
												<th scope="col">Kata</th>
											</tr>
										</thead>
										<tbody>
											@foreach($sepuluh as $key => $first)
											<tr>
												<th scope="row"><center>#{{ $key+1 }}</center></th>
												<td><a href="{{ url('https://kbbi.kemdikbud.go.id/entri/'.strtolower($first->kata)) }}" target="_blank">{{ strtolower($first->kata) }}</a></td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="col-md-4 col-sm-12 form-group">
							<div class="card">
								<div class="card-header"><center><h3><b>Tahun Ini</b></h3></center></div>
								<div class="card-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th scope="col"><center>Urutan</center></th>
												<th scope="col">Kata</th>
											</tr>
										</thead>
										<tbody>
											@foreach($sebelas as $key => $first)
											<tr>
												<th scope="row"><center>#{{ $key+1 }}</center></th>
												<td><a href="{{ url('https://kbbi.kemdikbud.go.id/entri/'.strtolower($first->kata)) }}" target="_blank">{{ strtolower($first->kata) }}</a></td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="col-md-4 col-sm-12 form-group">
							<div class="card">
								<div class="card-header"><center><h3><b>Bulan Ini</b></h3></center></div>
								<div class="card-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th scope="col"><center>Urutan</center></th>
												<th scope="col">Kata</th>
											</tr>
										</thead>
										<tbody>
											@foreach($duabelas as $key => $first)
											<tr>
												<th scope="row"><center>#{{ $key+1 }}</center></th>
												<td><a href="{{ url('https://kbbi.kemdikbud.go.id/entri/'.strtolower($first->kata)) }}" target="_blank">{{ strtolower($first->kata) }}</a></td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>


						<div class="col-sm-12"><center><h2><b>Jawaban Yang Sering Dicari (Tidak Baku)</b></h2></center><hr></div>
						
						<div class="col-md-4 col-sm-12 form-group">
							<div class="card">
								<div class="card-header"><center><h3><b>Sepanjang Masa</b></h3></center></div>
								<div class="card-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th scope="col"><center>Urutan</center></th>
												<th scope="col">Kata</th>
											</tr>
										</thead>
										<tbody>
											@foreach($tigabelas as $key => $first)
											<tr>
												<th scope="row"><center>#{{ $key+1 }}</center></th>
												<td><a href="{{ url('https://kbbi.kemdikbud.go.id/entri/'.strtolower($first->kata)) }}" target="_blank">{{ strtolower($first->kata) }}</a></td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="col-md-4 col-sm-12 form-group">
							<div class="card">
								<div class="card-header"><center><h3><b>Tahun Ini</b></h3></center></div>
								<div class="card-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th scope="col"><center>Urutan</center></th>
												<th scope="col">Kata</th>
											</tr>
										</thead>
										<tbody>
											@foreach($empatbelas as $key => $first)
											<tr>
												<th scope="row"><center>#{{ $key+1 }}</center></th>
												<td><a href="{{ url('https://kbbi.kemdikbud.go.id/entri/'.strtolower($first->kata)) }}" target="_blank">{{ strtolower($first->kata) }}</a></td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="col-md-4 col-sm-12 form-group">
							<div class="card">
								<div class="card-header"><center><h3><b>Bulan Ini</b></h3></center></div>
								<div class="card-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th scope="col"><center>Urutan</center></th>
												<th scope="col">Kata</th>
											</tr>
										</thead>
										<tbody>
											@foreach($limabelas as $key => $first)
											<tr>
												<th scope="row"><center>#{{ $key+1 }}</center></th>
												<td><a href="{{ url('https://kbbi.kemdikbud.go.id/entri/'.strtolower($first->kata)) }}" target="_blank">{{ strtolower($first->kata) }}</a></td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
