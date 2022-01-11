@extends('layouts.admin.app')

@section('content')

    <div class="row row-cols-2 g-5">
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="Nama" class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control" disabled value="{{ $data->mahasiswa->name }}">
            </div>
            <div class="mb-3">
                <label for="NIM" class="form-label">NIM</label>
                <input type="text" class="form-control" disabled value="{{ $data->mahasiswa->nim }}">
            </div>
            <div class="mb-3">
                <label for="Prodi" class="form-label">Prodi</label>
                <input type="text" class="form-control" disabled value="{{ $data->mahasiswa->prodi->name }}">
            </div>
            <div class="mb-3">
                <label for="Email" class="form-label">Email</label>
                <input type="text" class="form-control" disabled value="{{ $data->mahasiswa->user->email }}">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="Nama" class="form-label">Nama Dosen</label>
                <input type="text" class="form-control" disabled value="{{ $data->dosen->name }}">
            </div>
            <div class="mb-3">
                <label for="NIP" class="form-label">NIP</label>
                <input type="text" class="form-control" disabled value="{{ $data->dosen->nip }}">
            </div>
            <div class="mb-3">
                <label for="Prodi" class="form-label">Prodi</label>
                <input type="text" class="form-control" disabled value="{{ $data->dosen->prodi->name }}">
            </div>
            <div class="mb-3">
                <label for="Email" class="form-label">Email</label>
                <input type="text" class="form-control" disabled value="{{ $data->dosen->user->email }}">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="nilai" class="form-label">Nilai</label>
                <input type="text" class="form-control" disabled value="{{ $data->nilai }}">
            </div>
            <div class="mb-3">
                <label for="saran" class="form-label">Saran</label>
                <textarea name="saran" id="saran" cols="10" rows="8" class="form-control"
                    disabled>{{ $data->saran }}</textarea>
            </div>
        </div>
    </div>
    <button class="btn btn-light shadow" onclick="history.back(-1)">Kembali</button>

@endsection
