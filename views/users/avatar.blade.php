@extends('platform::layout')

@section('page-heading')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Rejestracja nowego użytkownika</h2>
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
                    <strong>Dodaj użytkownika</strong>
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

            <div class="avatar micro ">
                <div class="text color-5">
                    <abbr class="initials-text">AB</abbr>
                </div>
            </div>

            <div class="avatar micro inline">
                <div class="photo">
                    <img src="https://secure.gravatar.com/avatar/1661a4db91dc99251d0579871855cc98?s=60&amp;r=g&amp;d=identicon" alt="Artur Bartczak">
                </div>
            </div>


            <div class="avatar small inline ">
                <div class="text color-5">
                    <abbr class="initials-text">AB</abbr>
                </div>
            </div>

            <div class="avatar small ">
                <div class="photo">
                    <img src="https://secure.gravatar.com/avatar/1661a4db91dc99251d0579871855cc98?s=60&amp;r=g&amp;d=identicon" alt="Artur Bartczak">
                </div>
            </div>

            <div class="avatar medium ">
                <div class="text color-0">
                    <abbr class="initials-text">AB</abbr>
                </div>
            </div>

            <div class="avatar medium ">
                <div class="photo">
                    <img src="https://secure.gravatar.com/avatar/1661a4db91dc99251d0579871855cc98?s=60&amp;r=g&amp;d=identicon" alt="Artur Bartczak">
                </div>
            </div>

            <div class="avatar medium">
                <div class="text color-0">
                    <abbr class="initials-text">AB</abbr>
                </div>
            </div>

            <div class="avatar medium">
                <div class="photo">
                    <img src="https://secure.gravatar.com/avatar/1661a4db91dc99251d0579871855cc98?s=60&amp;r=g&amp;d=identicon" alt="Artur Bartczak">
                </div>
            </div>

            <div class="avatar large reversed ">
                <div class="text color-3">
                    <abbr class="initials-text">AB</abbr>
                </div>
            </div>

            <div class="avatar large ">
                <div class="photo">
                    <img src="https://secure.gravatar.com/avatar/1661a4db91dc99251d0579871855cc98?s=60&amp;r=g&amp;d=identicon" alt="Artur Bartczak">
                </div>
            </div>

            <div class="avatar huge border ">
                <div class="text color-3">
                    <abbr class="initials-text">AB</abbr>
                </div>
            </div>

            <div class="avatar huge ">
                <div class="photo">
                    <img src="https://secure.gravatar.com/avatar/1661a4db91dc99251d0579871855cc98?s=100&amp;r=g&amp;d=identicon" alt="Artur Bartczak">
                </div>
            </div>

        </div>
    </div>
@endsection

@section('footer')
@endsection

@section('scripts')
@endsection


