@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">

                <div class="card-header">{{ isset($search) ? 'Hasil Pencarian "'.$search.'"' : 'Pencarian' }}</a></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('searchPost') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="input" class="form-control" value="{{ isset($search) ? $search : null }}">
                        </div>
                    </form>
                    <div class="row justify-content-center">
                        @if(isset($words))
                        @foreach($words as $word)
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <div class="card">
                                    <div class="card-body"><center><h1><b>{{ $word->kata }}</b></h1></center></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @if(count($words) <= 0)
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="card-body">
                                    <center><h1><b>Pencarian tidak ditemukan.</b></h1></center>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-sm-12">
                            <div class="row justify-content-center">
                                {{ $words->links() }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
