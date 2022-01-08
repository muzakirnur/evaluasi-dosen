@extends('layouts.dosen.app')

@section('content')
    <p>Selamat Datang {{ Auth::user()->name }}</p>
@stop
