@extends('layouts.dosen.app')

@section('content')
    <div class="row">
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $matakuliah->count() }}</h3>

                    <p>Matakuliah Saya</p>
                </div>
                <div class="icon">
                    <i class="fas fa-fw fa-chart-bar"></i>
                </div>
                <a href="{{ route('dosen-kuisioner.index') }}" class="small-box-footer text-dark">Lihat <i
                        class="fas fa-fw fa-eye"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $hasil->count() }}</h3>

                    <p>Hasil Evaluasi</p>
                </div>
                <div class="icon">
                    <i class="fas fa-fw fa-chart-bar"></i>
                </div>
                <a href="{{ route('dosen-kuisioner.index') }}" class="small-box-footer text-dark">Lihat <i
                        class="fas fa-fw fa-eye"></i></a>
            </div>
        </div>
    </div>
@endsection
