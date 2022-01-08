@extends('adminlte::page')

@section('title', config('app.name') . ' - ' . $page)

@section('content_header')
    <h1>{{ $page }}</h1>
    <hr>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
