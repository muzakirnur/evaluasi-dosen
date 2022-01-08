@extends('layouts.admin.app')

@section('content')
    <hr>
    <form action="{{ route('admin-pertanyaan.save') }}" method="POST">
        @csrf
        <label for="pertanyaan" class="form-label">Pertanyaan</label>
        <div class="row">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="pertanyaan" placeholder="Masukkan Pertanyaan..."
                    aria-label="Masukkan Pertanyaan..." aria-describedby="button-addon2" required>
                <button class="btn btn-outline-success" type="submit" id="button-addon2">Simpan</button>
            </div>
        </div>
    </form>
@endsection
