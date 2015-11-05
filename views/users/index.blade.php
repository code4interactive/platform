@extends('platform::layout')

@section('page-heading')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Lista użytkowników</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/">Home</a>
                </li>
                <li>
                    <a>Administracja</a>
                </li>
                <li class="active">
                    <strong>Użytkownicy</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
@endsection

@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <div class="pull-left" style="margin-top: -3px;">
                            <a href="{{action('\Code4\Platform\Controllers\UsersController@create')}}" class="btn btn-primary btn-xs " type="button"><i class="fa fa-user"></i> Dodaj nowego użytkownika</a>
                        </div>
                        <h5 class="pull-left" style="padding-left: 10px">Lista użytkowników</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                {!! $dt->renderTable() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <div class="modal inmodal fade" id="userBadgeModal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Etykieta użytkownika</h4>
                    <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary printBadge"><i class="fa fa-print"></i> Drukuj</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')


    {!! $dt->renderScript() !!}


    <script type="text/javascript">
        $(document).ready(function () {

            $('body').on('click', 'a.generateQr', function(e){

                e.preventDefault();
                var badgeUrl = $(this).attr('href');
                $.ajax({
                    url: badgeUrl,
                    dataType: "html"
                }).done(function(html) {
                    $('#userBadgeModal .modal-body').html(html);
                    $('#userBadgeModal').modal('show');

                });
                return false;
            });

            //Drukowanie
            $('#userBadgeModal .printBadge').on('click', function(){

                $("#userBadgeModal .modal-body").print({
                    globalStyles: false,
                    mediaPrint: true,
                    stylesheet: null,
                    iframe: true
                });

            });

        });
    </script>

@endsection