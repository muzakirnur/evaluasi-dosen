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
    <hr class="divider">
    <form action="{{ route('profile.update', $data->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row row-cols-2 g-5">
            <div class="col-auto">
                <div class="flex-shrink-0">
                    <img src="{{ asset('img/profile/' . $data->avatar) }}" alt="Profile Dosen" class="img-fluid mb-3"
                        style="width: 180px; border-radius: 10px;">
                    <x-adminlte-input-file name="avatar" placeholder="Choose a file..." />
                    <small class="form-text text-muted">
                        Type : jpg, png, jpeg
                    </small>
                </div>
            </div>
            <div class="col-auto">
                <div class="row">
                    <div class="col mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ $data->name }}">
                    </div>
                </div>
                <div class="row row-cols-3">
                    <div class="col mb-3">
                        <label for="name" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" value="{{ $data->email }}" readonly>
                    </div>
                    @if ($data->nip == null)
                        <div class="col-auto mb-3">
                            <label for="name" class="form-label">NIM</label>
                            <input type="text" class="form-control" name="nim" value="{{ $data->nim }}">
                        </div>
                    @else
                        <div class="col-auto mb-3">
                            <label for="name" class="form-label">NIP</label>
                            <input type="text" class="form-control" name="nip" value="{{ $data->nip }}">
                        </div>
                    @endif
                    <div class="col-auto mb-3">
                        <label for="name" class="form-label">Prodi</label>
                        <select name="prodi_id" id="prodi_id" class="form-select">
                            <option value="{{ $data->prodi_id }}">{{ $data->prodi->name }}</option>
                        </select>
                    </div>
                </div>

                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </div>
    </form>
@endsection
