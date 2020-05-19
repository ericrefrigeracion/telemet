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
                    from: {{ $device->tiny_pump_device->l_min }},
                    to: {{ $device->tiny_pump_device->l_max }},
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
                            [ {{ ($data->created_at->timestamp - (3 * 60 * 60)) * 1000 }}, {{ $data->data01 + $device->tiny_pump_device->l_cal }} ],
                            @endif
                        @endforeach
                ],
                tooltip: {
                    valueDecimals: 1,
                    valueSuffix: ' {{ $device->type_device->data01_unit }}'
                },
                marker: {
                    enabled: false
                }
            },{
                name: '{{ $device->type_device->data02_name }}',
                data: [
                        @foreach($datas as $data)
                            @if(isset($data->data02))
                            [ {{ ($data->created_at->timestamp - (3 * 60 * 60)) * 1000 }}, {{ $data->data02 + 4}} ],
                            @endif
                        @endforeach
                ],
                tooltip: {
                    valueDecimals: 2,
                    valueSuffix: ' {{ $device->type_device->data02_unit }}'
                },
                marker: {
                    enabled: false
                }
            },{
                name: '{{ $device->type_device->data03_name }}',
                data: [
                        @foreach($datas as $data)
                            @if(isset($data->data03))
                            [ {{ ($data->created_at->timestamp - (3 * 60 * 60)) * 1000 }}, {{ $data->data03 + 2 }} ],
                            @endif
                        @endforeach
                ],
                tooltip: {
                    valueDecimals: 2,
                    valueSuffix: ' {{ $device->type_device->data03_unit }}'
                },
                marker: {
                    enabled: false
                }
            },{
                name: '{{ $device->type_device->data04_name }}',
                data: [
                        @foreach($datas as $data)
                            @if(isset($data->data04))
                            [ {{ ($data->created_at->timestamp - (3 * 60 * 60)) * 1000 }}, {{ $data->data04 }} ],
                            @endif
                        @endforeach
                ],
                tooltip: {
                    valueDecimals: 2,
                    valueSuffix: ' {{ $device->type_device->data04_unit }}'
                },
                marker: {
                    enabled: false
                }
            }

            ]
        });
    }
);