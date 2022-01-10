@extends('layouts.admin.app')

@section('content')
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
                <th scope="col">Mahasiswa</th>
                <th scope="col">Program Studi</th>
                <th scope="col">Dosen</th>
                <th scope="col">Nilai</th>
                <th scope="col">Saran</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $row->mahasiswa->name }}</td>
                    <td>{{ $row->mahasiswa->prodi->name }}</td>
                    <td>{{ $row->dosen->name }}</td>
                    <td>{{ $row->nilai }}</td>
                    <td>{{ $row->saran }}</td>
                    <td>
                        <div class="row row-cols-3">
                            <div class="col">
                                <a href="#" class="btn btn-primary">
                                    <i class="fas fa-fw fa-eye"></i>
                                </a>
                            </div>
                            <div class="col">
                                <form action="{{ route('admin-hasil.destroy', $row->id) }}">
                                    <button class="btn btn-danger" onclick="window.confirm()">
                                        <i class="fas fa-fw fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mb-3">
        {{ $data->links() }}
    </div>
@endsection
