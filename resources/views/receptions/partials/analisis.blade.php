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
                name: 'Promedio ultima hora',
                data: [
                        @foreach($datas as $data)
                            [ {{ $data->created_at_unix }}, {{ $data->data02 }} ],
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
                            [ {{ $data->created_at_unix }}, {{ $data->data04 }} ],
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
                            [ {{ $data->created_at_unix }}, {{ $data->data05 }} ],
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
                            [ {{ $data->created_at_unix }}, {{ $data->data06 }} ],
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
                name: 'Before',
                data: [
                        @foreach($datas as $data)
                            [ {{ $data->created_at_unix }}, {{ $data->data07 }} ],
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
                            [ {{ $data->created_at_unix }}, {{ $data->data08 }} ],
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
                            [ {{ $data->created_at_unix }}, {{ $data->data09 }} ],
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