 $.getJSON('https://cdn.jsdelivr.net/gh/highcharts/highcharts@v7.0.0/samples/data/usdeur.json', function (data) {

        // Create the chart
        Highcharts.stockChart('plot-all', {

            rangeSelector: {
                selected: 1
            },

            title: {
                text: 'Metricas de {{ $device->name }}'
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
                            [ {{ $data->created_at_unix }}, {{ $data->data01 + $device->cal }} ],
                        @endforeach
                ],
                type: 'spline',
                tooltip: {
                    valueDecimals: 2
                }
            },
            @if($data->data02)
            {
                name: 'HR %',
                data: [
                        @foreach($datas as $data)
                            [ {{ $data->created_at_unix }}, {{ $data->data02 }} ],
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