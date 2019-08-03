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
                    Datos de la ultima semana de {{ $device->name }} ({{ $device->description }})
                </div>
                <div class="card-body">

                    <p>Temperaturas de la Semana</p>
                    <p>Maxima: {{ $device->tmax_week }}°C </p>
                    <p>Minima: {{ $device->tmin_week }}°C </p>
                    <p>Promedio: {{ $device->tavg_week }}°C </p>
                    @if($device->mdl == 'th')
                        <hr>
                        <p>Humedad de la Semana</p>
                        <p>Maxima: {{ $device->hmax_week }}% </p>
                        <p>Minima: {{ $device->hmin_week }}% </p>
                        <p>Promedio: {{ $device->havg_week }}% </p>
                    @endif

                </div>
                <div class="card-footer">
                    @can('receptions.show')
                        <a href="{{ route('receptions.show', $device->id) }}" class="btn btn-sm btn-primary">Ver los datos de hoy</a>
                    @endcan
                    <br>
                    @can('receptions.show-all')
                        <a href="{{ route('receptions.show-all', $device->id) }}" class="btn btn-sm btn-primary mt-2">Ver todos los datos</a>
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