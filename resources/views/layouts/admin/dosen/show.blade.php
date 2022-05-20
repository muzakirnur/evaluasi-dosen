@extends('layouts.admin.app')

@section('content')
    <hr>
    <div class="row row-cols-3 g-5">
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
                    <label for="name" class="form-label">NIP</label>
                    <input type="text" class="form-control" value="{{ $user->nip }}" aria-label="First name" readonly>
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
    <h3>Matakuliah Yang Diampu</h3>
    <hr>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Matakuliah</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mk as $row)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $row->matakuliah }}</td>
                            <td>
                                <div class="row row-cols-3">
                                    <div class="col">
                                        <a href="{{ route('admin-hasil.matakuliah', $row->id) }}" class="btn btn-primary">
                                            <i class="fas fa-fw fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <div class="mb-3">
                {{ $mk->links() }}
            </div> --}}
        </div>
    </div>
    <button class="btn btn-primary mb-3" onclick="history.back(-1)"><i class="fas fa-fw fa-arrow-left"></i> Kembali</button>
@endsection
