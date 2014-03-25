@extends('platform::template.layout')

@section('header')
    <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> C4Forms <span>&gt; test form 1</span></h1>
@stop

@section('content')

<?php
//
$temp = \C4Former::getNewInstance();
$temp->load('platform::Tests/testform.testform1');
//$temp->text('username')->setLabel('aaaa');
$temp->render();

?>

@stop