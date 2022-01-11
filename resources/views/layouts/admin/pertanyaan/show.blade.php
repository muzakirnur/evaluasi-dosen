@extends('layouts.admin.app')

@section('content')
    <hr>
    <form action="{{ route('admin-pertanyaan.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="pertanyaan" class="form-label">Pertanyaan</label>
        <div class="row">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="question" placeholder="Masukkan Pertanyaan..."
                    aria-label="Masukkan Pertanyaan..." aria-describedby="button-addon2" required
                    value="{{ $data->question }}">
                <button class="btn btn-outline-success" type="submit" id="button-addon2">Simpan</button>
            </div>
        </div>
    </form>
    <button class="btn btn-primary" onclick="history.back(-1)"><i class="fas fa-fw fa-arrow-left"></i> Kembali</button>
@endsection
