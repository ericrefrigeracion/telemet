@extends('layouts.app')

@section('scripts')
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/export-data.js"></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Metricas dispositivo <strong>{{ $device->name }}</strong>
                </div>
                <div class="card-body">
                    <div id="plot" style="height: 400px; min-width: 300px"></div>
                </div>
                <div class="card-footer" >
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('pie')

<script type="text/javascript">
    $.getJSON('https://cdn.jsdelivr.net/gh/highcharts/highcharts@v7.0.0/samples/data/usdeur.json', function (data) {

        // Create the chart
        Highcharts.stockChart('plot', {

            rangeSelector: {
                selected: 1
            },

            title: {
                text: 'Datos medidos en °C'
            },

            yAxis: {

                plotBands: [{
                    from: {{ $device->min }},
                    to: {{ $device->max }},
                    color: 'rgba(68, 170, 213, 0.2)',
                    label: {
                        text: 'Valor Deseado'
                    }
                }]
            },

            series: [{
                name: '°C',
                data: [
                        @foreach($datas as $data)
                            [ {{ ($data->created_at->timestamp) * 1000 }}, {{ $data->data01 + $device->cal }} ],
                        @endforeach
                ],
                type: 'spline',
                tooltip: {
                    valueDecimals: 2
                }
            },
            @if($data->data02)
            {
                name: 'Sensor 2',
                data: [
                        @foreach($datas as $data)
                            [ {{ ($data->created_at->timestamp) * 1000 }}, {{ $data->data02 }} ],
                        @endforeach
                ],
                type: 'spline',
                tooltip: {
                    valueDecimals: 2
                }
            },
            @endif
            @if($data->data03)
            {
                name: 'Sensor 3',
                data: [
                        @foreach($datas as $data)
                            [ {{ ($data->created_at->timestamp) * 1000 }}, {{ $data->data03 }} ],
                        @endforeach
                ],
                type: 'spline',
                tooltip: {
                    valueDecimals: 2
                }
            },
            @endif
            @if($data->data04)
            {
                name: 'Sensor 4',
                data: [
                        @foreach($datas as $data)
                            [ {{ ($data->created_at->timestamp) * 1000 }}, {{ $data->data04 }} ],
                        @endforeach
                ],
                type: 'spline',
                tooltip: {
                    valueDecimals: 2
                }
            },
            @endif
            @if($data->data05)
            {
                name: 'Sensor 5',
                data: [
                        @foreach($datas as $data)
                            [ {{ ($data->created_at->timestamp) * 1000 }}, {{ $data->data05 }} ],
                        @endforeach
                ],
                type: 'spline',
                tooltip: {
                    valueDecimals: 2
                }
            },
            @endif
            @if($data->data06)
            {
                name: 'Sensor 6',
                data: [
                        @foreach($datas as $data)
                            [ {{ ($data->created_at->timestamp) * 1000 }}, {{ $data->data06 }} ],
                        @endforeach
                ],
                type: 'spline',
                tooltip: {
                    valueDecimals: 2
                }
            },
            @endif
            @if($data->data07)
            {
                name: 'Sensor 7',
                data: [
                        @foreach($datas as $data)
                            [ {{ ($data->created_at->timestamp) * 1000 }}, {{ $data->data07 }} ],
                        @endforeach
                ],
                type: 'spline',
                tooltip: {
                    valueDecimals: 2
                }
            },
            @endif
            @if($data->data08)
            {
                name: 'Sensor 8',
                data: [
                        @foreach($datas as $data)
                            [ {{ ($data->created_at->timestamp) * 1000 }}, {{ $data->data08 }} ],
                        @endforeach
                ],
                type: 'spline',
                tooltip: {
                    valueDecimals: 2
                }
            },
            @endif
            @if($data->data09)
            {
                name: 'Sensor 9',
                data: [
                        @foreach($datas as $data)
                            [ {{ ($data->created_at->timestamp) * 1000 }}, {{ $data->data09 }} ],
                        @endforeach
                ],
                type: 'spline',
                tooltip: {
                    valueDecimals: 2
                }
            },
            @endif
            @if($data->data10)
            {
                name: 'Sensor 10',
                data: [
                        @foreach($datas as $data)
                            [ {{ ($data->created_at->timestamp) * 1000 }}, {{ $data->data10 }} ],
                        @endforeach
                ],
                type: 'spline',
                tooltip: {
                    valueDecimals: 2
                }
            },
            @endif
            @if($data->data11)
            {
                name: 'Sensor 11',
                data: [
                        @foreach($datas as $data)
                            [ {{ ($data->created_at->timestamp) * 1000 }}, {{ $data->data11 }} ],
                        @endforeach
                ],
                type: 'spline',
                tooltip: {
                    valueDecimals: 2
                }
            },
            @endif
            ]
        });
    });
</script>

@endsection