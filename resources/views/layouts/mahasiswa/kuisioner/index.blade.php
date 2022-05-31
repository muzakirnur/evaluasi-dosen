@extends('layouts.dosen.app')

@section('content')
    <a href="{{ route('mahasiswa-kuisioner.create') }}" class="btn btn-primary mb-2"><i class="fas fa-fw fa-plus"></i>
        Tambah
        Kuisioner</a>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-text"><strong>Berhasil !</strong> {{ session('success') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Matakuliah</th>
                <th scope="col">Dosen</th>
                <th scope="col">Program Studi</th>
                <th scope="col">Saran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $row->matakuliah->matakuliah }}</td>
                    <td>{{ $row->matakuliah->dosen->name }}</td>
                    <td>{{ $row->matakuliah->prodi->name }}</td>
                    <td> {{ $row->saran }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
