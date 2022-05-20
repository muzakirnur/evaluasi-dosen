@extends('layouts.admin.app')

@section('content')
    <a href="{{ route('admin-matakuliah.create') }}" class="btn btn-primary mb-2"><i class="fas fa-fw fa-plus"></i> Tambah
        Matakuliah</a>
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
                <th scope="col">Program Studi</th>
                <th scope="col">Dosen Pengampu</th>
                <th scope="col">NIP</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $row)
                <tr>
                    <th>{{ $data->firstItem() + $key }}</th>
                    <td>{{ $row->matakuliah }}</td>
                    <td>{{ $row->prodi->name }}</td>
                    <td>{{ $row->dosen->name }}</td>
                    <td>{{ $row->dosen->nip }}</td>
                    <td>
                        <div class="row row-cols-3">
                            <div class="col">
                                <a href="{{ route('admin-matakuliah.show', $row->id) }}" class="btn btn-primary">
                                    <i class="fas fa-fw fa-eye"></i>
                                </a>
                            </div>
                            <div class="col">
                                <a class="btn btn-danger" onclick="return confirm('Are you sure?')"
                                    href="{{ route('admin-matakuliah.destroy', $row->id) }}"><i
                                        class="fas fa-fw fa-trash"></i></a>
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
