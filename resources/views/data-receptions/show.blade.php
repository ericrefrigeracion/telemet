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
            <div class="card">
                <div class="card-header">
                   Datos disponibles de {{ $device->name }} ({{ $device->description }})
                </div>
                <div class="card-body">
                    <div id="plot" style="height: 300px; width: auto"></div>
                    @if(isset($information))
                        @include('data-receptions.partials.information')
                    @endif
                </div>
                @if($device->admin_mon)
                    @include('data-receptions.partials.card-footer')
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_scripts')
    @include('data-receptions.partials.plot_tiny')

@endsection