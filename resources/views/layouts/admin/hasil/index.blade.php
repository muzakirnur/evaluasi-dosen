@extends('layouts.admin.app')

@section('content')
    <a href="#" class="btn btn-primary mb-2"><i class="fas fa-fw fa-plus"></i> Tambah Pertanyaan</a>
    @if (session()->has('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Berhasil !</strong> {{ session('succes') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">NIM</th>
                <th scope="col">Program Studi</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $row->question }}</td>
                    <td>
                        <a href="#" class="btn btn-primary">
                            <i class="fas fa-fw fa-eye"></i>
                        </a>
                        <form action="{{ route('admin-mahasiswa.destroy', $row->id) }}">
                            <button class="btn btn-danger" onclick="window.confirm()">
                                <i class="fas fa-fw fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
