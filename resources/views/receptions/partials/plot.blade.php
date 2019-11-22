$.getJSON(
    'https://cdn.jsdelivr.net/gh/highcharts/highcharts@v7.0.0/samples/data/usdeur.json',
    function (data) {

        Highcharts.chart('plot', {
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
                name: '{{ $device->type_device->data01_name }}',
                data: [
                        @foreach($datas as $data)
                            [ {{ $data->created_at_unix }}, {{ $data->data01 + $device->tcal }} ],
                        @endforeach
                ],
                tooltip: {
                    valueDecimals: 2,
                    valueSuffix: ' {{ $device->type_device->data01_unit }}'
                },
                marker: {
                    enabled: false
                }
            },{
                name: 'Temperatura estimada del producto',
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
                }
            }

            ]
        });
    }
);