@extends('layouts.admin.app')

@section('content')
    <hr>
    <form action="{{ route('admin-prodi.save') }}" method="POST">
        @csrf
        <label for="prodi" class="form-label">Program Studi</label>
        <div class="row row-cols-3">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="name" placeholder="Masukkan Prodi..."
                    aria-label="Masukkan Prodi..." aria-describedby="button-addon2" required>
                <button class="btn btn-outline-success" type="submit" id="button-addon2">Simpan</button>
            </div>
        </div>
    </form>
@endsection
