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
                            @if(isset($data->data01))
                            [ {{ $data->created_at_unix }}, {{ $data->data01 + $device->tiny_t_device->tcal }} ],
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
            },{
                name: 'Temperatura estimada del producto',
                data: [
                        @foreach($datas as $data)
                            @if(isset($data->data02))
                            [ {{ $data->created_at->timestamp - ((3 * 60 * 60) * 1000) }}, {{ $data->data02 + $device->tiny_t_device->tcal }} ],
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