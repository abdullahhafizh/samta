@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Beta Test ( {{ $age }} ) - Waktu : <a class="timer">0</a></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="row" id="board">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input type="text" id="answer" name="answer" class="form-control" required autofocus autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div id="load" style="display: none;">Loading</div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal duplicate" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kata sudah ada</h5>
                <button id="button" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Cari kata yang lain.</p>
            </div>
            <div class="modal-footer">
                <button id="button" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fail" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kata tidak ada</h5>
                <button id="button" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Cari kata yang lain.</p>
            </div>
            <div class="modal-footer">
                <button id="button" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal win" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Permainan berakhir</h5>
                <button id="button" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Menang.</p>
            </div>
            <div class="modal-footer">
                <button id="end" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal session" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sesi berakhir</h5>
                <button id="button" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Kembali lagi besok.</p>
            </div>
            <div class="modal-footer">
                <button id="end" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal timeout" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Waktu Habis</h5>
                <button id="button" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Tidak menjawab selama 60 detik.</p>
            </div>
            <div class="modal-footer">
                <button id="end" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('foot-content')
<script type="text/javascript">
    var count = 0,
    $time = $('.time'),
    timer,
    paused = false,
    counter = function(){
        count++;
        if (count > 15) { count = 1; }
        $time.html(count);
        timer = setTimeout(function(){
            counter();
        }, 1000);
    };
    counter();
    $('button').on('click', function(){
        clearTimeout(timer);
        if ($(this).hasClass('restart')) {
            count = 0;
            paused = false;
            counter();
        } else {
            paused = !paused;
            if (!paused) {
                counter();
            }
        }
    });

    $(document).ready(function(){
        $(document).on('click', '#button', function(e) {
            $('#load').hide();
            $("#answer").empty();
            $("#answer").val(cache);
            $("#answer").focus();
        });

        $(document).on('click', '#end', function(e) {
            location.reload();
        });

        $("#answer").focus();
        var cache = null;
        $(document).on('keyup', '#answer', function(e) {
            var input = $('#answer').val();
            
            if(e.keyCode == 13)
            {
                $('#load').show();
                if (cache == null) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '{{ route('answer') }}',
                        type: 'POST',
                        data: {_token: CSRF_TOKEN, answer:$("#answer").val()},
                        dataType: 'JSON',
                        success: function (data) {
                            $('#load').hide();
                            if(data.status == 'duplicate') {
                                $('.duplicate').modal('show');
                            }
                            if(data.status == 'win') {
                                $('.win').modal('show');
                            }
                            if(data.status == 'session') {
                                $('.session').modal('show');
                            }
                            else if(data.status == 'success') {
                                $('#answer').removeAttr("required");
                                $('#answer').removeAttr("autofocus");
                                $('#answer').removeAttr("name");
                                $('#answer').prop('readonly', true);
                                $('#answer').attr("tab-index", "-1");
                                $('#answer').removeAttr("id");

                                $("#board").append('<div class="col-sm-2"><div class="form-group"><input type="text" class="form-control" value="' + data.answer +'" readonly></div></div><div class="col-sm-2"><div class="form-group"><input type="text" id="answer" name="answer" class="form-control" required autofocus></div></div>');
                                $( "#answer" ).focus();
                                $( "#answer" ).val(data.akhir);
                                cache = data.akhir;
                            }
                            else if(data.status == 'error') {
                                $('.fail').modal('show');
                            }
                        }
                    });
                }
                else {
                    if (cache == input.substr(0, cache.length)) {
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: '{{ route('answer') }}',
                            type: 'POST',
                            data: {_token: CSRF_TOKEN, answer:$("#answer").val()},
                            dataType: 'JSON',
                            success: function (data) {
                                $('#load').hide();
                                if(data.status == 'duplicate') {
                                    $('.duplicate').modal('show');
                                }
                                if(data.status == 'win') {
                                    $('.win').modal('show');
                                }
                                if(data.status == 'session') {
                                    $('.session').modal('show');
                                }
                                else if(data.status == 'success') {
                                    $('#answer').removeAttr("required");
                                    $('#answer').removeAttr("autofocus");
                                    $('#answer').removeAttr("name");
                                    $('#answer').prop('readonly', true);
                                    $('#answer').attr("tab-index", "-1");
                                    $('#answer').removeAttr("id");
                                    
                                    $("#board").append('<div class="col-sm-2"><div class="form-group"><input type="text" class="form-control" value="' + data.answer +'" readonly></div></div><div class="col-sm-2"><div class="form-group"><input type="text" id="answer" name="answer" class="form-control" required autofocus autocomplete="off"></div></div>');
                                    $( "#answer" ).focus();
                                    $( "#answer" ).val(data.akhir);
                                    cache = data.akhir;
                                }
                                else if(data.status == 'error') {
                                    $('.fail').modal('show');
                                }
                            }
                        });
                    }
                    else {
                        $('#load').hide();
                        $("#answer").empty();
                        $("#answer").val(cache);
                        $("#answer").focus();
                    }
                }
            }
        });
});
</script>
@endsection
