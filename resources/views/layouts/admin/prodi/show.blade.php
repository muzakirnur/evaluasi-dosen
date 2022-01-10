@extends('layouts.admin.app')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">NIP</th>
                <th scope="col">Program Studi</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <th>{{ $loop->iteration }}</th>
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
