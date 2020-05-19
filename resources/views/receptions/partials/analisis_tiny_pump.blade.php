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
                    from: ,
                    to: ,
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
                name: '{{ $device->type_device->data05_name }}',
                data: [
                        @foreach($datas as $data)
                            @if(isset($data->data05))
                            [ {{ ($data->created_at->timestamp - (3 * 60 * 60)) * 1000 }}, {{ $data->data05}} ],
                            @endif
                        @endforeach
                ],
                tooltip: {
                    valueDecimals: 2,
                    valueSuffix: ' {{ $device->type_device->data05_unit }}'
                },
                marker: {
                    enabled: false
                }
            },{
                name: '{{ $device->type_device->data06_name }}',
                data: [
                        @foreach($datas as $data)
                            @if(isset($data->data06))
                            [ {{ ($data->created_at->timestamp - (3 * 60 * 60)) * 1000 }}, {{ $data->data06 + 2}} ],
                            @endif
                        @endforeach
                ],
                tooltip: {
                    valueDecimals: 2,
                    valueSuffix: ' {{ $device->type_device->data06_unit }}'
                },
                marker: {
                    enabled: false
                }
            },{
                name: '{{ $device->type_device->data07_name }}',
                data: [
                        @foreach($datas as $data)
                            @if(isset($data->data07))
                            [ {{ ($data->created_at->timestamp - (3 * 60 * 60)) * 1000 }}, {{ $data->data07 + 4}} ],
                            @endif
                        @endforeach
                ],
                tooltip: {
                    valueDecimals: 2,
                    valueSuffix: ' {{ $device->type_device->data07_unit }}'
                },
                marker: {
                    enabled: false
                }
            },{
                name: '{{ $device->type_device->data08_name }}',
                data: [
                        @foreach($datas as $data)
                            @if(isset($data->data08))
                            [ {{ ($data->created_at->timestamp - (3 * 60 * 60)) * 1000 }}, {{ $data->data08 }} ],
                            @endif
                        @endforeach
                ],
                tooltip: {
                    valueDecimals: 2,
                    valueSuffix: ' {{ $device->type_device->data08_unit }}'
                },
                marker: {
                    enabled: false
                }
            }

            ]
        });
    }
);