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
                name: 'Pendiente',
                data: [
                        @foreach($datas as $data)
                            @if(isset($data->data03))
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
                name: 'Estado',
                data: [
                        @foreach($datas as $data)
                            @if(isset($data->data04))
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
            }

            ]
        });
    }
);