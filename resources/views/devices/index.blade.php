@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Dispositivos
                    @can('devices.create')
                        <a href="{{ route('devices.create')}}" class="btn btn-primary btn-sm float-right">
                            Agregar Dispositivo
                        </a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th colspan="2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($devices as $device)
                                <tr>
                                    <td>
                                        @can('devices.show')
                                            <a href="{{ route('devices.show', $device->id) }}" class="btn btn-sm btn-default">{{ $device->name }}</a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('devices.edit')
                                            <a href="{{ route('devices.edit', $device->id) }}" class="btn btn-sm btn-danger">Monitoreo</a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('receptions.show')
                                            <a href="{{ route('receptions.show', $device->id) }}" class="btn btn-sm btn-primary">Metricas</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection