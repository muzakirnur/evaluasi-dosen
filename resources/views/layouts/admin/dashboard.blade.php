@extends('layouts.admin.app')

@section('content')
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $pertanyaan }}</h3>

                        <p>Pertanyaan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-fw fa-question"></i>
                    </div>
                    <a href="{{ route('admin-pertanyaan.create') }}" class="small-box-footer text-dark">Tambah <i
                            class="fa fa-plus"></i></a>
                </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $mahasiswa }}</h3>

                        <p>Mahasiswa</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-fw fa-users"></i>
                    </div>
                    <a href="{{ route('admin-mahasiswa.index') }}" class="small-box-footer text-dark">Lihat <i
                            class="fas fa-fw fa-eye"></i></a>
                </div>
            </div>

            <!-- ./col -->

            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $dosen }}</h3>

                        <p>Dosen</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-fw fa-user-graduate"></i>
                    </div>
                    <a href="{{ route('admin-dosen.index') }}" class="small-box-footer text-dark">Lihat <i
                            class="fas fa-fw fa-eye"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $hasil }}</h3>

                        <p>Hasil Evaluasi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-fw fa-chart-bar"></i>
                    </div>
                    <a href="{{ route('admin-hasil.index') }}" class="small-box-footer text-dark">Lihat <i
                            class="fas fa-fw fa-eye"></i></a>
                </div>
            </div>
        </div>

    </section>
@stop
