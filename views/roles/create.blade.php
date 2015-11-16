@extends('platform::theme.layout')

@section('page-heading')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Tworzenie nowej roli</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/">Home</a>
                </li>
                <li>
                    <a>Administracja</a>
                </li>
                <li>
                    <a href="{{action('\Code4\Platform\Controllers\RolesController@index')}}">Role</a>
                </li>
                <li class="active">
                    <strong>Nowa rola</strong>
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
            <form class="form-horizontal ajax" role="form" method="post" action="{{action('\Code4\Platform\Controllers\RolesController@store')}}">
                <div class="col-lg-6">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h3>Nowa rola</h3>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Nazwa roli</label>
                                        <div class="col-lg-10">{!!$form->get('name')!!}</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Slug</label>
                                        <div class="col-lg-10">{!!$form->get('slug')!!}</div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><i class="fa fa-save"></i> Zapisz</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h3>Uprawnienia</h3>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table">
                                        <?php $lp = 0; ?>
                                        @foreach($permissions as $per => $val)
                                        <thead>
                                            <tr>
                                                <th class="text-warning">
                                                    <button type="button"
                                                            class="btn btn-xs btn-link collapsed"
                                                            data-toggle="collapse"
                                                            data-target="#collapse{{$lp}}"><i class="fa fa-chevron-down"></i> {{$val['name']}}</button>
                                                </th>
                                                <th>
                                                    <label><input class="checkAll" name="collapse{{$lp}}" value="2" type="radio" />&nbsp;&nbsp;Zezwól</label></th>
                                                <th>
                                                    <label><input class="checkAll" name="collapse{{$lp}}" value="3" type="radio" />&nbsp;&nbsp;Zabroń</label></th>
                                                <th>
                                                    <label><input class="checkAll" name="collapse{{$lp}}" value="4" type="radio" />&nbsp;&nbsp;Nie ustawiaj</label></th>
                                            </tr>
                                        </thead>
                                        <tbody id="collapse{{$lp}}" class="collapse" >
                                            @foreach($val['permissions'] as $p => $v)
                                            <tr>
                                                <td>{{$v}}</td>
                                                <td><input type="radio" name="permission[{{$per}}][{{$p}}]" value="true"></td>
                                                <td><input type="radio" name="permission[{{$per}}][{{$p}}]" value="false"></td>
                                                <td><input type="radio" name="permission[{{$per}}][{{$p}}]" value="notset" checked></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <?php $lp++; ?>
                                        @endforeach
                                    </table>
                                    <div class="hr-line-dashed"></div>
                                    <div>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><i class="fa fa-save"></i> Zapisz</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer')
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            /**
             * Sprawdza czy wszystkie elementy w kolumnie są zaznaczone. Jeżeli tak - zaznacza radio w TH
             */
            function checkColumns() {
                $('thead').each(function(i, thead){
                    $(thead).find('.checkAll').each(function(j, headCheckButton){
                        var colNumber = $(headCheckButton).attr('value');
                        var collapse = $(headCheckButton).attr('name');
                        var allChecked = true;
                        $('tbody#'+collapse+' tr td:nth-child('+colNumber+')').each(function(i, item){
                            allChecked = $(item).find('input').is(':checked') ? allChecked : false;
                        });
                        $(headCheckButton).prop('checked', allChecked);
                    });
                });
            }

            checkColumns();

            $('tbody input').on('click', function(){
                checkColumns();
            });


            //Zaznacz wszystkie radio w kolumnie
            $('.checkAll').on('click', function() {
               if ($(this).is(':checked')) {
                   var colNumber = $(this).val();
                   var collapse = $(this).attr('name');
                   $('tbody#'+collapse+' tr td:nth-child('+colNumber+')').each(function(i, item){
                       $(item).find('input').prop('checked', true);
                   });
               }
            });

            $('input[name="name"]').prop('autocomplete', 'off');

            $('input[name="name"]').on('keyup', function(){

                var text = $(this).val();
                text = slug(text);
                $('input[name="slug"]').val(text);

            });

        });
    </script>
@endsection