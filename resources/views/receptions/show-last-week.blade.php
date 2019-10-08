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
                    @include('receptions.partials.card-footer')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('pie')
@if(isset($datas))
    <script type="text/javascript">
        @include('receptions.partials.plot')
    </script>
@endif
@endsection