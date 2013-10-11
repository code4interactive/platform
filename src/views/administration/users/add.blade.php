@extends('platform::layout')

@section('header')
    Dodaj użytkownika
@stop

@section('content')



test Form

<?php

/*$form = \C4Former::instance();

$form->text("aaa");
$form->text("bbb")->after("aaa");

$form->test();*/

\C4Former::text("aa");
\C4Former::text("bb");
\C4Former::text("cc")->before("bb");

\C4Former::test();

?>



@stop