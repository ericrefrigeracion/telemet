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
                name: 'Temperatura deseada',
                data: [
                        @foreach($datas as $data)
                            [ {{ $data->created_at_unix }}, {{ $device->tiny_t_device->t_set_point }} ],
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
                name: 'Promedio ultima hora',
                data: [
                        @foreach($datas as $data)
                            @if($data->data02)
                            [ {{ $data->created_at_unix }}, {{ $data->data02 }} ],
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
                name: 'promedio ultimas 6hs',
                data: [
                        @foreach($datas as $data)
                            @if($data->data03)
                            [ {{ $data->created_at_unix }}, {{ $data->data03 }} ],
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
                name: 'promedio ultimas 12hs',
                data: [
                        @foreach($datas as $data)
                            @if($data->data04)
                            [ {{ $data->created_at_unix }}, {{ $data->data04 }} ],
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
                name: 'promedio ultimas 24hs',
                data: [
                        @foreach($datas as $data)
                            @if($data->data05)
                            [ {{ $data->created_at_unix }}, {{ $data->data05 }} ],
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
                name: 'Error',
                data: [
                        @foreach($datas as $data)
                            @if($data->data06)
                            [ {{ $data->created_at_unix }}, {{ $data->data06 }} ],
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
                name: 'Integral',
                data: [
                        @foreach($datas as $data)
                            @if($data->data07)
                            [ {{ $data->created_at_unix }}, {{ $data->data07 }} ],
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
                name: 'Derivada',
                data: [
                        @foreach($datas as $data)
                            @if($data->data08)
                            [ {{ $data->created_at_unix }}, {{ $data->data08 }} ],
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