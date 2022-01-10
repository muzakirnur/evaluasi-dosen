@extends('adminlte::page')

@section('title', config('app.name') . ' - ' . $page)

@section('content_header')
    <h1>{{ $page }}</h1>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stop

@section('js')
    <script>
        var url = "{{ url('chart') }}";
        var Labels = new Array();
        var Prices = new Array();
        $(document).ready(function() {
            $.get(url, function(response) {
                response.forEach(function(data) {
                    Labels.push(data.name);
                    Prices.push(data.nilai);
                });
                var ctx = document.getElementById("canvas").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: Years,
                        datasets: [{
                            label: 'Infosys Price',
                            data: Prices,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            });
        });
    </script>
@stop
