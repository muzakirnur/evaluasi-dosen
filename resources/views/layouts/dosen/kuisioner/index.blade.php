@extends('layouts.dosen.app')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil !</strong> {{ session('succes') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- <div class="row row-cols-2 g-5"> --}}
    <div class="col">
        {{-- <a href="{{ route('dosen.export') }}" class="btn btn-primary mb-3">Download</a> --}}
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Matakuliah</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td> {{ $row->matakuliah }}</td>
                        <td>
                            <a href="{{ route('dosen-hasil.matakuliah', $row->id) }}" class="btn btn-primary">
                                <i class="fas fa-fw fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
    {{-- <div class="col">
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
        </div> --}}

    {{-- </div> --}}
@endsection
{{-- @section('js')
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
@stop --}}
