$.getJSON(
    'https://cdn.jsdelivr.net/gh/highcharts/highcharts@v7.0.0/samples/data/usdeur.json',
    function (data) {

        Highcharts.chart('plot', {
            chart: {
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
                }
            },
            legend: {
                enabled: true
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                type: 'spline',
                name: '{{ $device->type_device->data01_name }}',
                data: [
                        @foreach($datas as $data)
                            [ {{ $data->created_at_unix }}, {{ $data->data01 + $device->tcal }} ],
                        @endforeach
                ],
                tooltip: {
                    valueDecimals: 2
                },
                marker: {
                    enabled: false
                },
            },
            @if($device->type_device_id == 3)
            {
                name: '{{ $device->type_device->data02_name }}',
                data: [
                        @foreach($datas as $data)
                            [ {{ $data->created_at_unix }}, {{ $data->data02 + $device->hcal }} ],
                        @endforeach
                ],
                tooltip: {
                    valueDecimals: 1
                },
                marker: {
                    enabled: false
                },
            },
            @endif
            ]
        });
    }
);