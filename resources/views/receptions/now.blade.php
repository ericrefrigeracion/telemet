@extends('layouts.app')

@section('head_scripts')
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10 mb-3">
            <chart-tiny-t v-bind:datas="{{ $datas }}"></chart-tiny-t>
            <div class="card">
                <div class="card-header">
                   Datos de la ultima hora de {{ $device->name }} ({{ $device->description }})
                </div>
                <div class="card-body">
                    @if(isset($datas))
                    <div id="plot" style="height: 400px; width: auto"></div>
                    @can('devices.analysis')
                    <div id="analysis" style="height: 400px; width: auto"></div>
                    @endcan
                    @else
                        <div class="alert alert-success" role="alert">
                            No hay datos de este dispositivo en la ultima hora, revisa datos anteriores.
                        </div>
                    @endif
                </div>
                <div class="card-footer">
                    @include('receptions.partials.card-footer')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_scripts')
@if(isset($datas))
    <script type="text/javascript">
        @if($device->type_device_id == 2)
            @include('receptions.partials.plot_tiny_t')
        @endif
        @if($device->type_device_id == 7)
            @include('receptions.partials.plot_tiny_pump')
        @endif
    </script>
    @can('devices.analysis')
        @if($device->type_device_id == 2)
            <script type="text/javascript"> @include('receptions.partials.analisis_tiny_t') </script>
        @endif
        @if($device->type_device_id == 7)
            <script type="text/javascript"> @include('receptions.partials.analisis_tiny_pump') </script>
        @endif
    @endcan
@endif
@endsection