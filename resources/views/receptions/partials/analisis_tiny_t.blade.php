$.getJSON(
    'https://cdn.jsdelivr.net/gh/highcharts/highcharts@v7.0.0/samples/data/usdeur.json',
    function (data) {

        Highcharts.chart('analysis', {
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
                    from: {{ $device->tiny_t_device->pmin }},
                    to: {{ $device->tiny_t_device->pmax }},
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
                name: 'Pendiente',
                data: [
                        @foreach($datas as $data)
                            @if(isset($data->data03))
                            [ {{ ($data->created_at->timestamp - (3 * 60 * 60)) * 1000 }}, {{ $data->data03 }} ],
                            @endif
                        @endforeach
                ],
                tooltip: {
                    valueDecimals: 2,
                    valueSuffix: ' {{ $device->type_device->data01_unit }}'
                },
                marker: {
                    enabled: false
                },
            },{
                name: 'Estado',
                data: [
                        @foreach($datas as $data)
                            @if(isset($data->data04))
                            [ {{ ($data->created_at->timestamp - (3 * 60 * 60)) * 1000 }}, {{ $data->data04 }} ],
                            @endif
                        @endforeach
                ],
                tooltip: {
                    valueDecimals: 2,
                    valueSuffix: ' {{ $device->type_device->data01_unit }}'
                },
                marker: {
                    enabled: false
                },
            },{
                name: 'Promedio pendiente',
                data: [
                        @foreach($datas as $data)
                            @if(isset($data->data05))
                            [ {{ ($data->created_at->timestamp - (3 * 60 * 60)) * 1000 }}, {{ $data->data05 }} ],
                            @endif
                        @endforeach
                ],
                tooltip: {
                    valueDecimals: 2,
                    valueSuffix: ' {{ $device->type_device->data01_unit }}'
                },
                marker: {
                    enabled: false
                },
            },{
                name: 'Suma Positiva Pendiente',
                data: [
                        @foreach($datas as $data)
                            @if(isset($data->data06))
                            [ {{ ($data->created_at->timestamp - (3 * 60 * 60)) * 1000 }}, {{ $data->data06 }} ],
                            @endif
                        @endforeach
                ],
                tooltip: {
                    valueDecimals: 2,
                    valueSuffix: ' {{ $device->type_device->data01_unit }}'
                },
                marker: {
                    enabled: false
                },
            },{
                name: 'Suma Pendiente',
                data: [
                        @foreach($datas as $data)
                            @if(isset($data->data07))
                            [ {{ ($data->created_at->timestamp - (3 * 60 * 60)) * 1000 }}, {{ $data->data07 }} ],
                            @endif
                        @endforeach
                ],
                tooltip: {
                    valueDecimals: 2,
                    valueSuffix: ' {{ $device->type_device->data01_unit }}'
                },
                marker: {
                    enabled: false
                },
            }

            ]
        });
    }
);