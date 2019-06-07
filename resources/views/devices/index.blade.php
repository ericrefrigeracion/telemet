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
                                @can('devices.all')
                                    <th>ID</th>
                                @endcan
                                <th>Nombre</th>
                                <th>Acciones</th>
                                @can('devices.log')
                                    <th></th>
                                @endcan
                                @can('alerts.show')
                                    <th></th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($devices as $device)
                                <tr>
                                    @can('devices.all')
                                        <td>{{ $device->id }}</td>
                                    @endcan
                                    @can('devices.show')
                                        <td>
                                            <a href="{{ route('devices.show', $device->id) }}" class="btn btn-sm btn-default">{{ $device->name }}</a>
                                        </td>
                                    @endcan
                                    @can('receptions.show')
                                        <td>
                                            <a href="{{ route('receptions.show', $device->id) }}" class="btn btn-sm btn-primary">Metricas</a>
                                        </td>
                                    @endcan
                                    @can('devices.log')
                                        <td>
                                            <a href="{{ route('devices.log', $device->id) }}" class="btn btn-sm btn-primary">Logs</a>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $devices->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection