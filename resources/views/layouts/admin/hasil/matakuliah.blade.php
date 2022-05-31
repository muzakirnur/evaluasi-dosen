@extends('layouts.admin.app')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Berhasil !</strong> {{ session('succes') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <a href="{{ route('admin-hasil.download', request()->segment(4)) }}" class="btn btn-success mb-3">Export Excel</a>
    <a href="{{ route('export-pdf.hasil', request()->segment(4)) }}" class="btn btn-danger mb-3">Export PDF</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Matakuliah</th>
                <th scope="col">Mahasiswa</th>
                <th scope="col">Program Studi</th>
                <th scope="col">Dosen</th>
                <th scope="col">Nilai</th>
                <th scope="col">Saran</th>
                <th scope="col">Grade</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $row)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $row->matakuliah->matakuliah }}</td>
                    <td>{{ $row->mahasiswa->name }}</td>
                    <td>{{ $row->mahasiswa->prodi->name }}</td>
                    <td>{{ $row->matakuliah->dosen->name }}</td>
                    <td>{{ $row->nilai }}</td>
                    <td>{{ $row->saran }}</td>
                    <td>{{ $row->grade }}</td>
                    <td>
                        <div class="col">
                            <a href="{{ route('admin-hasil.show', $row->id) }}" class="btn btn-primary">
                                <i class="fas fa-fw fa-eye"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mb-3">
        {{ $data->links() }}
    </div>
    <hr>
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
                <p>Nilai Rata Rata = {{ $data->sum('nilai') / $data->count() }}</p>
                @if ($data->sum('nilai') / $data->count() == 10)
                    <p>Grade = Sangat Baik</p>
                @elseif ($data->sum('nilai') / $data->count() <= 9.9)
                    <p>Grade = Baik</p>
                @elseif ($data->sum('nilai') / $data->count() <= 8.9)
                    <p>Grade = Cukup</p>
                @elseif ($data->sum('nilai') / $data->count() <= 7.9)
                    <p>Grade = Kurang Baik</p>
                @elseif ($data->sum('nilai') / $data->count() <= 6.9)
                    <p>Grade = Sangat Kurang Baik</p>
                @endif
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
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
