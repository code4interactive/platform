@extends('platform::layout')

@section('header')
    Dodaj użytkownika
@stop

@section('content')



<h1>test Form</h1>

<?php

/*$form = \C4Former::instance();

$form->text("aaa");
$form->text("bbb")->after("aaa");

$form->test();*/

\C4Former::text("aa");
\C4Former::text("bb");
\C4Former::text("cc")->before("bb");

\C4Former::select("aaa")->option("test");
//\C4Former::test();
?>

<h2>test New Instance</h2>

<?php
//
$temp = \C4Former::getNewInstance();
$temp->load('configName');
$temp->render();
//$temp->text("ddd");
//$temp->text("eee");
//$temp->test();

?>



@stop