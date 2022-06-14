@extends('layouts.admin.app')

@section('content')
    <hr>
    <form action="{{ route('admin-matakuliah.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Matakuliah</label>
            <input type="text" class="form-control" id="matakuliah" name="matakuliah" value="{{ $data->matakuliah }}"
                required>
        </div>
        <div class="mb-3">
            <label for="dosen" class="form-label">Porgram Studi</label>
            <select class="form-select" aria-label="Default select example" name="prodi" required>
                <option value="{{ $data->prodi_id }}" selected>{{ $data->prodi->name }}</option>
                @foreach ($prodi as $row)
                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="dosen" class="form-label">Dosen Pengampu</label>
            <select class="form-select" aria-label="Default select example" name="dosen" required>
                <option value="{{ $data->dosen_id }}" selected>{{ $data->dosen->name }}</option>
                @foreach ($dosen as $row)
                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-success" type="submit">Update</button>
        <button class="btn btn-primary" type="button" onclick="history.back(-1)"><i class="fas fa-fw fa-arrow-left"></i>
            Kembali</button>
    </form>
@endsection
