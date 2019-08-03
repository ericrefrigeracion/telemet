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
        <div class="col-md-8 mb-3">
            @if(isset($datas))
                <div class="card">
                    <div class="card-header"><h3>Datos de {{ $device->name }}</h3></div>
                    <div class="card-body">
                        <div id="plot" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
                    </div>
                </div>
            @else
                <div class="alert alert-success" role="alert">
                    No hay datos para este dia, consulta los datos anteriores en el boton de abajo
                </div>
            @endif
        </div>
    </div>
    <div class="row justify-content-center">
        @can('receptions.show-all')
            <div class="col-md-8 mb-3">
                <a type="button" class="btn btn-primary btn-lg btn-block" href="{{ route('receptions.show-all', $device->id) }}">Ver todos los datos de {{ $device->name }}</a>
            </div>
        @endcan
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