@extends('layouts.dosen.app')

@section('content')
    <a href="{{ route('mahasiswa-kuisioner.create') }}" class="btn btn-primary mb-2"><i class="fas fa-fw fa-plus"></i>
        Tambah
        Kuisioner</a>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil !</strong> {{ session('succes') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Dosen</th>
                <th scope="col">Program Studi</th>
                <th scope="col">Nilai</th>
                <th scope="col">Saran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $row->dosen->name }}</td>
                    <td>{{ $row->dosen->prodi->name }}</td>
                    <td> {{ $row->nilai }}</td>
                    <td> {{ $row->saran }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection