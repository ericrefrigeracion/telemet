@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Dispositivos - Todos
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
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
                                    <td>{{ $device->id }}</td>
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
                                    @can('alerts.show')
                                        <td>
                                            <a href="{{ route('alerts.show', $device->id) }}" class="btn btn-sm btn-danger">Alertas</a>
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