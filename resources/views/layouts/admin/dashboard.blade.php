@extends('layouts.admin.app')

@section('content')
    <p>Selamat Datang {{ Auth::user()->name }}</p>
@stop
