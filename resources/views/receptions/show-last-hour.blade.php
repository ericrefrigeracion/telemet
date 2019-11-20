@extends('layouts.app')

@section('head_scripts')
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10 mb-3">
            <div class="card">
                <div class="card-header">
                   Evolucion de Temperaturas {{ $device->name }} ({{ $device->description }})
                </div>
                <div class="card-body">
                    @if(isset($datas))
                    <div id="plot" style="height: 400px; width: auto"></div>
                    <div id="plot2" style="height: 400px; width: auto"></div>
                    @else
                        <div class="alert alert-success" role="alert">
                            No hay datos de este dispositivo en la ultima hora, revisa datos anteriores.
                        </div>
                    @endif
                </div>
                <div class="card-footer">
                    @include('receptions.partials.card-footer')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_scripts')
@if(isset($datas))
    <script type="text/javascript">
        @include('receptions.partials.plot')
    </script>
    <script type="text/javascript">
        $.getJSON(
    'https://cdn.jsdelivr.net/gh/highcharts/highcharts@v7.0.0/samples/data/usdeur.json',
    function (data) {

        Highcharts.chart('plot2', {
            chart: {
                type: 'spline',
                zoomType: 'x'
            },
            title: {
                text: null
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: null
                },
                plotBands: [ {
                    from: {{ $device->tiny_t_device->tmin }},
                    to: {{ $device->tiny_t_device->tmax }},
                    color: 'rgba(68, 170, 213, 0.1)',
                    label: {
                        text: null,
                        style: {
                            color: '#606060'
                        }
                    }
                }]
            },
            legend: {
                enabled: true
            },
            plotOptions: {
            },

            series: [{
                name: 'promedio ultima hora',
                data: [
                        @foreach($datas as $data)
                            @if($data->data02)
                            [ {{ $data->created_at_unix }}, {{ $data->data02 }} ],
                            @endif
                        @endforeach
                ]},{
                name:'promedio ultimas 6hs',
                data: [
                        @foreach($datas as $data)
                            @if($data->data03)
                            [ {{ $data->created_at_unix }}, {{ $data->data03 }} ],
                            @endif
                        @endforeach
                ]},
                tooltip: {
                    valueDecimals: 2,
                    valueSuffix: ' {{ $device->type_device->data01_unit }}'
                },
                marker: {
                    enabled: false
                },
            },

            ]
        });
    }
);
    </script>
@endif
@endsection