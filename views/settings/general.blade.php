@extends('platform::layout')

@section('page-heading')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Ustawienia aplikacji</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/">Home</a>
                </li>
                <li>
                    <a>Administracja</a>
                </li>
                <li class="active">
                    <strong>Ustawienia</strong>
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <form class="form-horizontal ajax" role="form" method="post" action="{{$action}}">
                <div class="col-lg-12">
                    <div class="ibox">
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
    <script>
        $.c4forms.alertUnsavedChanges();
    </script>
@endsection