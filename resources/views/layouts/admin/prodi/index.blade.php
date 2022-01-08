@extends('layouts.admin.app')

@section('content')
    <a href="{{ route('admin-prodi.create') }}" class="btn btn-primary mb-2"><i class="fas fa-fw fa-plus"></i> Tambah
        Prodi</a>
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
                <th scope="col">Program Studi</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $row->name }}</td>
                    <td>
                        <div class="row">
                            <a href="#" class="btn btn-primary">
                                <i class="fas fa-fw fa-eye"></i>
                            </a>
                            <form action="{{ route('admin-mahasiswa.destroy', $row->id) }}">
                                <button class="btn btn-danger" onclick="window.confirm()">
                                    <i class="fas fa-fw fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
