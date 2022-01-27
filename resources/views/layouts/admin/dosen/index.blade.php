@extends('layouts.admin.app')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-text"><strong>Berhasil !</strong> {{ session('success') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <a href="{{ route('export-pdf.dosen') }}" class="btn btn-danger mb-3">Export PDF</a>
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
            @foreach ($data as $key => $row)
                <tr>
                    <th>{{ $data->firstItem() + $key }}</th>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->nip }}</td>
                    <td>{{ $row->prodi->name }}</td>
                    <td>
                        <div class="row row-cols-5">
                            <div class="col">
                                <a href="{{ route('admin-dosen.show', $row->id) }}" class="btn btn-primary">
                                    <i class="fas fa-fw fa-eye"></i>
                                </a>
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
