@extends('layouts.app')

@section('scripts')
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
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
                    <hr>
                    <p>Temperaturas de Hoy</p>
                    <p>Maxima: {{ $device->tmax_today }}°C </p>
                    <p>Minima: {{ $device->tmin_today }}°C </p>
                    <p>Promedio: {{ $device->tavg_today }}°C </p>
                    <hr>
                    <p>Temperaturas de Ayer</p>
                    <p>Maxima: {{ $device->tmax_yesterday }}°C </p>
                    <p>Minima: {{ $device->tmin_yesterday }}°C </p>
                    <p>Promedio: {{ $device->tavg_yesterday }}°C </p>
                    @if($device->mdl == 'th')
                        <hr>
                        <p>Humedad de Hoy</p>
                        <p>Maxima: {{ $device->hmax_today }}% </p>
                        <p>Minima: {{ $device->hmin_today }}% </p>
                        <p>Promedio: {{ $device->havg_today }}% </p>
                        <hr>
                        <p>Humedad de Ayer</p>
                        <p>Maxima: {{ $device->hmax_yesterday }}% </p>
                        <p>Minima: {{ $device->hmin_yesterday }}% </p>
                        <p>Promedio: {{ $device->havg_yesterday }}% </p>
                    @endif
                </div>
                <div class="card-footer">
                    @can('receptions.show')
                        <a href="{{ route('receptions.show', $device->id) }}" class="btn btn-sm btn-primary">Ver los datos de hoy</a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="card-body">
                    <div id="plot" style="height: 400px; width: auto"></div>
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
        @include('partials.plot')
    </script>
@endif
@endsection