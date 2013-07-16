@extends('platform::layout')

@section('header')
    Dodaj użytkownika
@stop

@section('content')

@include('platform::administration.users.addForm')

@stop