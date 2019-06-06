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
                            [ {{ ($data->created_at->timestamp - 10800) * 1000 }}, {{ $data->data01 + $device->cal }} ],
                        @endforeach
                ],
                type: 'spline',
                tooltip: {
                    valueDecimals: 2
                }
            },{
                name: '°F',
                data: [
                        @foreach($datas as $data)
                            [ {{ ($data->created_at->timestamp - 10800) * 1000 }}, {{ $data->data02 }} ],
                        @endforeach
                ],
                type: 'spline',
                tooltip: {
                    valueDecimals: 2
                }
            },{
                name: '°F',
                data: [
                        @foreach($datas as $data)
                            [ {{ ($data->created_at->timestamp - 10800) * 1000 }}, {{ $data->data03 }} ],
                        @endforeach
                ],
                type: 'spline',
                tooltip: {
                    valueDecimals: 2
                }
            },{
                name: '°F',
                data: [
                        @foreach($datas as $data)
                            [ {{ ($data->created_at->timestamp - 10800) * 1000 }}, {{ $data->data04 }} ],
                        @endforeach
                ],
                type: 'spline',
                tooltip: {
                    valueDecimals: 2
                }
            },{
                name: '°F',
                data: [
                        @foreach($datas as $data)
                            [ {{ ($data->created_at->timestamp - 10800) * 1000 }}, {{ $data->data05 }} ],
                        @endforeach
                ],
                type: 'spline',
                tooltip: {
                    valueDecimals: 2
                }
            }]
        });
    });
</script>

@endsection