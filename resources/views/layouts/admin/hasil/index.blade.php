@extends('layouts.admin.app')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Berhasil !</strong> {{ session('succes') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- <a href="{{ route('admin-hasil.download') }}" class="btn btn-primary mb-3">Download</a> --}}
    {{-- <a href="{{ route('export-pdf.all') }}" class="btn btn-danger mb-3">Export PDF</a> --}}
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Matakuliah</th>
                <th scope="col">Mahasiswa</th>
                <th scope="col">Program Studi</th>
                <th scope="col">Dosen</th>
                <th scope="col">Nilai</th>
                <th scope="col">Saran</th>
                <th scope="col">Grade</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $row)
                <tr>
                    <th>{{ $data->firstItem() + $key }}</th>
                    <td>{{ $row->matakuliah->matakuliah }}</td>
                    <td>{{ $row->mahasiswa->name }}</td>
                    <td>{{ $row->mahasiswa->prodi->name }}</td>
                    <td>{{ $row->matakuliah->dosen->name }}</td>
                    <td>{{ $row->nilai }}</td>
                    <td>{{ $row->saran }}</td>
                    <td>{{ $row->grade }}</td>
                    <td>
                        <div class="col">
                            <a href="{{ route('admin-hasil.show', $row->id) }}" class="btn btn-primary">
                                <i class="fas fa-fw fa-eye"></i>
                            </a>
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
