@extends('layouts.admin.app')

@section('content')
    @if ($data->isEmpty())
        <div class="row">
            <h3 class="card-title text-center align-center">
                Data Dosen di Prodi {{ $prodi->name }} Masih Kosong
            </h3>
        </div>

    @else

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
    @endif
    <button class="btn btn-primary" onclick="history.back(-1)"><i class="fas fa-fw fa-arrow-left"></i> Kembali</button>
@endsection
