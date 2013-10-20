@extends('platform::layout')

@section('header')
    Dodaj użytkownika
@stop

@section('content')



<h1>test Form</h1>


<h2>test New Instance</h2>

<?php
//
$temp = \C4Former::getNewInstance();
$temp->load('testform.form1');
$temp->populate(\Code4\Platform\Models_Konta::find(12));

$temp->select('id')->after('jednostki_id');
$temp->select('id')->fromQuery(\Code4\Platform\Models_Konta::take(50)->get(), 'id', 'konto');

$temp->text('identyfikator')->setValue('aaaa');

$temp->render();

?>



@stop