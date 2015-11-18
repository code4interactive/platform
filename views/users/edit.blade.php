@extends('platform::layout')

@section('page-heading')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Edycja użytkownika <strong>{{$user->first_name}} {{$user->last_name}}</strong> <small>{{$user->job_title}}</small></h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/">Home</a>
                </li>
                <li>
                    <a>Administracja</a>
                </li>
                <li>
                    <a href="{{action('\Code4\Platform\Controllers\UsersController@index')}}">Użytkownicy</a>
                </li>
                <li class="active">
                    <strong>Edycja użytkownika</strong>
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
            <form class="form-horizontal ajax" role="form" method="post" action="{{action('\Code4\Platform\Controllers\UsersController@update', $user->id)}}">
                <input type="hidden" name="_method" value="put" />
                <input type="hidden" name="id" value="{{$user->id}}"/>
                <div class="col-lg-6">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h3>Edycja użytkownika</h3>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="messageBox"></div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Email</label>
                                        <div class="col-lg-10">{!!$form->get('email')->value($user->email)!!}</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Hasło</label>
                                        <div class="col-lg-10">{!!$form->get('password')!!}</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Powtórz hasło</label>
                                        <div class="col-lg-10">{!!$form->get('password2')!!}</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Rola</label>
                                        <div class="col-lg-10">
                                            {!! $form->get('role')->options($roles)->value($user->roles) !!}
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Imię</label>
                                        <div class="col-lg-10">{!!$form->get('first_name')->value($user->first_name)!!}</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Nazwisko</label>
                                        <div class="col-lg-10">{!!$form->get('last_name')->value($user->last_name)!!}</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Tytuł / Stanowisko</label>
                                        <div class="col-lg-10">{!!$form->get('job_title')->value($user->job_title)!!}</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Aktywny</label>
                                        <div class="col-lg-10" style="padding-top: 6px;">
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" name="activate" {{Activation::completed($user)!==false?'checked':''}} class="onoffswitch-checkbox" id="activate">
                                                    <label class="onoffswitch-label" for="activate">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-10 col-lg-offset-2">
                                            <label> {!!$form->get('send_email')!!} Powiadom mailowo </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="hr-line-dashed"></div>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><i class="fa fa-save"></i> Aktualizuj</button>
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
                                                <?php
                                                $itemPerm = "notset";
                                                if (array_key_exists($p, $user->permissions)) {
                                                    $itemPerm = $user->permissions[$p] ? "true" : "false";
                                                }
                                                ?>
                                                <tr>
                                                    <td>{{$v}}</td>
                                                    <td>{!!$form->get('ptrue')->name('permission['.$per.']['.$p.']')->checked($itemPerm)!!}</td>
                                                    <td>{!!$form->get('pfalse')->name('permission['.$per.']['.$p.']')->checked($itemPerm)!!}</td>
                                                    <td>{!!$form->get('pnotset')->name('permission['.$per.']['.$p.']')->checked($itemPerm)!!}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <?php $lp++; ?>
                                        @endforeach
                                    </table>
                                    <div class="row">
                                        <div class="hr-line-dashed"></div>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><i class="fa fa-save"></i> Aktualizuj</button>
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
        });
    </script>
@endsection