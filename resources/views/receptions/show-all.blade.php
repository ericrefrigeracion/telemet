@extends('layouts.app')

@section('scripts')
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/stock/highstock.js"></script>

<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/solid-gauge.js"></script>

<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/export-data.js"></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(isset($datas))
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">
                    Datos de {{ $device->name }}
                </div>
                <div class="card-body">

                    <p>Ultima Conexion: {{ $device->last_data }} </p>
                    <p>Minima establecida: {{ $device->min }}°C</p>
                    <p>Maxima establecida: {{ $device->max }}°C</p>
                    <p>Retardo para el aviso: {{ $device->dly }} minutos</p>
                    <hr>
                    <p>Temperaturas de Hoy</p>
                    <p>Maxima: {{ $device->max_today }}°C </p>
                    <p>Minima: {{ $device->min_today }}°C </p>
                    <p>Promedio: {{ $device->avg_today }}°C </p>
                    <hr>
                    <p>Temperaturas de Ayer</p>
                    <p>Maxima: {{ $device->max_yesterday }}°C </p>
                    <p>Minima: {{ $device->min_yesterday }}°C </p>
                    <p>Promedio: {{ $device->avg_yesterday }}°C </p>

                </div>
                <div class="card-footer" >
                </div>
            </div>
        </div>
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="card-body">
                    <div id="plot-all" style="height: 400px; width: auto"></div>
                </div>
            </div>
        </div>
        @else
            <div class="col-md-8 mb-3">
                <div class="alert alert-success" role="alert">
                    No hay datos para este dispositivo, asegurate de que este conectado a internet.
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@section('pie')
@if(isset($datas))
    <script type="text/javascript">
        @include('partials.plot-all')
    </script>
@endif
@endsection