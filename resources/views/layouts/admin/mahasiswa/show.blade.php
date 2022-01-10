@extends('layouts.admin.app')

@section('content')
    <hr>
    <div class="row row-cols-2">
        <div class="col-auto">
            <div class="flex-shrink-0">
                <img src="{{ asset('img/profile/' . $user->avatar) }}" alt="Profile Dosen" class="img-fluid"
                    style="width: 180px; border-radius: 10px;">
            </div>
        </div>
        <div class="col-auto">
            <div class="row row-cols-3">
                <div class="col mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" value="{{ $user->name }}" aria-label="First name" readonly>
                </div>
                <div class="col mb-3">
                    <label for="name" class="form-label">NIM</label>
                    <input type="text" class="form-control" value="{{ $user->nim }}" aria-label="First name" readonly>
                </div>
                <div class="col mb-3">
                    <label for="name" class="form-label">Prodi</label>
                    <input type="text" class="form-control" value="{{ $user->prodi->name }}" aria-label="Last name"
                        readonly>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="name" class="form-label">Email</label>
                    <input type="text" class="form-control" value="{{ $user->email }}" aria-label="Last name" readonly>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h3>Hasil Evaluasi</h3>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Mahasiswa</th>
                <th scope="col">Program Studi</th>
                <th scope="col">Nilai</th>
                <th scope="col">Saran</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $row->dosen->name }}</td>
                    <td>{{ $row->dosen->prodi->name }}</td>
                    <td>{{ $row->nilai }}</td>
                    <td>{{ $row->saran }}</td>
                    <td>
                        <div class="row row-cols-3">
                            <div class="col">
                                <a href="{{ route('admin-hasil.show', $row->id) }}" class="btn btn-primary">
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
