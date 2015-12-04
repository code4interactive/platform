@extends('platform::layout')

@section('page-heading')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Ustawienia aplikacji - Użytkownik</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/">Home</a>
                </li>
                <li>
                    <a>Administracja</a>
                </li>
                <li class="active">
                    <strong>Ustawienia użytkownika</strong>
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <form class="form-horizontal ajax" role="form" method="post" action="{{action('\Code4\Platform\Controllers\SettingsController@storeGeneralUser')}}">
                <div class="col-lg-12">
                    <div class="ibox">
                        <ul class="nav nav-tabs nav-tabs-white">
                            @foreach($tabs as $blockName => $block)
                                <li class="{!! $blockName == $currentBlock ? 'active' : '' !!}"><a href="{{action($block['url'])}}"><i class="fa {!! $block['icon'] !!}"></i> {!! $block['title'] !!}</a></li>
                            @endforeach
                        </ul>
                        <div class="ibox-content" >
                            <div class="row">
                                <div class="col-lg-6">
                                    @foreach ($form->all() as $field)
                                        @if ($field->type() == 'separator' || $field->type() == 'htmlTag' || $field->type() == 'header')
                                            {!! $field !!}
                                        @else
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">{!! $field->label() !!}</label>
                                            <div class="col-lg-9">{!! $field !!}</div>
                                        </div>
                                        @endif
                                    @endforeach
                                    <div class="hr-line-dashed"></div>
                                    <button class="btn btn-primary" type="submit">Zapisz ustawienia</button>
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
@endsection