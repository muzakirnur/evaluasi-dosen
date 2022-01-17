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
    <h3>Hasil Evaluasi</h3>
    <hr>
    <a href="{{ route('admin-dosen.export', $dosen->id) }}" class="btn btn-primary mb-3">Download</a>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nilai</th>
                        <th scope="col">Saran</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $row->nilai }}</td>
                            <td>{{ $row->saran }}</td>
                            <td>
                                <div class="row row-cols-3">
                                    <div class="col">
                                        <a href="{{ route('admin-hasil.show', $row->id) }}" class="btn btn-primary">
                                            <i class="fas fa-fw fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mb-3">
                {{ $data->links() }}
            </div>
        </div>
        <div class="col">
            <!-- DONUT CHART -->
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Chart Penilaian Dosen</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="donutChart"
                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <button class="btn btn-primary mb-3" onclick="history.back(-1)"><i class="fas fa-fw fa-arrow-left"></i> Kembali</button>

@endsection

@section('js')
    <script>
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        var donutData = {
            labels: [
                'Sangat Kurang Baik', 'Kurang Baik', 'Cukup', 'Baik', 'Sangat Baik',
            ],
            datasets: [{
                data: [
                    {{ $dataSkb }}, {{ $dataKb }}, {{ $dataC }}, {{ $dataB }},
                    {{ $dataSb }}
                ],
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })
    </script>
@stop
