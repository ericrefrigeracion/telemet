@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10 mb-3">
            <div class="card">
                <div class="card-header">
                   Datos disponibles de {{ $device->name }} ({{ $device->description }})
                </div>
                <div class="card-body">
                    @foreach($configurations as $configuration)
                        @can($configuration->permission)
                        <div class="row">
                            <plot-data-receptions :view="{{ $configuration }}" :device_id="{{ $device->id }}"></plot-data-receptions>
                        </div>
                        @endcan
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
