@extends('platform::theme.layout')

@section('page-heading')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Role użytkowników</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/">Home</a>
                </li>
                <li>
                    <a>Administracja</a>
                </li>
                <li class="active">
                    <strong>Role</strong>
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
                            <a href="{{action('\Code4\Platform\Controllers\RolesController@create')}}" class="btn btn-primary btn-xs " type="button"><i class="fa fa-book"></i> Dodaj nową rolę</a>
                        </div>
                        <h5 class="pull-left" style="padding-left: 10px">Lista ról</h5>
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
@endsection

@section('scripts')
    {!! $dt->renderScript() !!}

    <script>
        //CONFIRM DELETE

        $(document).ready(function() {

            $(document.body).on('click','')

        });

    </script>

@endsection