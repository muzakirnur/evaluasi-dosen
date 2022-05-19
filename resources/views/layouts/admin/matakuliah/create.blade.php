@extends('layouts.admin.app')

@section('content')
    <hr>
    <form action="{{ route('admin-matakuliah.save') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Matakuliah</label>
            <input type="text" class="form-control" id="matakuliah" name="matakuliah" placeholder="Masukkan Matakuliah"
                required>
        </div>
        <div class="mb-3">
            <label for="dosen" class="form-label">Porgram Studi</label>
            <select class="form-select" aria-label="Default select example" name="prodi" required>
                <option selected>-- Pilih --</option>
                @foreach ($prodi as $row)
                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="dosen" class="form-label">Dosen Pengampu</label>
            <select class="form-select" aria-label="Default select example" name="dosen" required>
                <option selected>-- Pilih --</option>
                @foreach ($dosen as $row)
                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-success" type="submit">Simpan</button>
        <button class="btn btn-primary" type="button" onclick="history.back(-1)"><i class="fas fa-fw fa-arrow-left"></i>
            Kembali</button>
    </form>
@endsection
