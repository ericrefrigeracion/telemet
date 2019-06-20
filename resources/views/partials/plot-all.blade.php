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
        title: {
            text: ''
        },
        minorGridLineWidth: 0,
        gridLineWidth: 0,
        alternateGridColor: null,
        plotBands: [
        @if($device->tmon)
            {
                from: {{ $device->tmin }},
                to: {{ $device->tmax }},
                color: 'rgba(68, 170, 213, 0.2)',
                label: {
                    text: 'Temperatura Deseada',
                    style: {
                        color: '#606060'
                    }
                }
            },
        @endif
        @if($device->hmon)
            {
                from: {{ $device->hmin }},
                to: {{ $device->hmax }},
                color: 'rgba(214, 214, 214, 0.4)',
                label: {
                    text: 'Humedad Deseada',
                    style: {
                        color: '#606060'
                    }
                }
            }
        @endif
        ]
    },

            series: [{
                name: '°C',
                data: [
                        @foreach($datas as $data)
                            [ {{ $data->created_at_unix }}, {{ $data->data01 + $device->tcal }} ],
                        @endforeach
                ],
                type: 'spline',
                tooltip: {
                    valueDecimals: 2
                }
            },
            @if($device->mdl == 'th')
            {
                name: 'HR %',
                data: [
                        @foreach($datas as $data)
                            [ {{ $data->created_at_unix }}, {{ $data->data02 + $device->hcal }} ],
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