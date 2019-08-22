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
        <div class="col-md-10 mb-3">
            <div class="card">
                <div class="card-header">
                    Datos de la ultima semana de {{ $device->name }} ({{ $device->description }})
                </div>
                <div class="card-body">
                    @if(isset($datas))
                    <div id="plot" style="height: 400px; width: auto"></div>
                    @else
                        <div class="alert alert-success" role="alert">
                            No hay datos de este dispositivo en la ultima semana, revisa su conexion a internet.
                        </div>
                    @endif
                </div>
                <div class="card-footer">
                    @can('receptions.show-hour')
                        <a href="{{ route('receptions.show-hour', $device->id) }}" class="btn btn-sm btn-primary m-1">Ver ultima hora</a>
                    @endcan
                    @can('receptions.show-day')
                        <a href="{{ route('receptions.show-day', $device->id) }}" class="btn btn-sm btn-primary m-1">Ver ultimo dia</a>
                    @endcan
                    @can('receptions.show-week')
                        <a href="{{ route('receptions.show-week', $device->id) }}" class="btn btn-sm btn-primary m-1 active">Ver ultima semana</a>
                    @endcan
                    @can('receptions.show-month')
                        <a href="{{ route('receptions.show-month', $device->id) }}" class="btn btn-sm btn-primary m-1">Ver ultimo mes</a>
                    @endcan
                    @can('receptions.show-all')
                        <a href="{{ route('receptions.show-all', $device->id) }}" class="btn btn-sm btn-primary m-1">Ver todos los datos</a>
                    @endcan
                </div>
            </div>
        </div>
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