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
            tooltip: {
                headerFormat: '{point.x} {{ $device->type_device->data01_unit }}',
                shared: true
            },
            legend: {
                enabled: true
            },
            plotOptions: {
            },

            series: [{
                type: 'spline',
                name: '{{ $device->type_device->data01_name }}',
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
            @if($device->type_device_id == 3)
            {
                name: '{{ $device->type_device->data02_name }}',
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
    }
);