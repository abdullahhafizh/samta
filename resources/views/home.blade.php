@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Dashboard <a class="float-right">{{ $count }} ({{ str_limit($percent, 3, null) }}%)</a></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('save') }}" autocomplete="off">
                        @csrf
                        <div class="row">
                            @foreach($words as $word)
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="row">
                                        <input type="hidden" name="id[]" value="{{ $word->id }}">
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="kata[]" tabindex="-1" value="{{ $word->kata }}" readonly>
                                        </div>
                                        <div class="col-sm-4">
                                            <input class="form-control" autofocus type="text" name="awal[]" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="akhir[]" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="col-sm-12">
                                <button class="btn btn-primary btn-lg btn-block">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
