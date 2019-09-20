@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Dispositivos - Todos
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Usr</th>
                                <th>Dispositivo</th>
                                <th>Protegido</th>
                                <th>Estado</th>
                                <th>Rango</th>
                                <th>Ciclo</th>
                                <th>Acciones</th>
                                @can('receptions.show-hour')
                                    <th></th>
                                @endcan
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
                                    @can('users.show')
                                    <td><a href="{{ route('users.show', $device->user_id) }}" class="btn btn-sm btn-default">{{ $device->user_id }}</a></td>
                                    @endcan
                                    <td>{{ $device->id }}</td>
                                    @if($device->protected)
                                    <td class="text-success">SI</td>
                                    @else
                                    <td class="text-danger">NO</td>
                                    @endif
                                    @if($device->on_line)
                                    <td class="text-success">En Linea</td>
                                    @else
                                    <td class="text-danger">Desconectado</td>
                                    @endif
                                    @if($device->on_temp)
                                    <td class="text-success">Normal</td>
                                    @else
                                    <td class="text-danger">Fuera de Rango</td>
                                    @endif
                                    @if($device->on_t_set_point)
                                    <td class="text-success">Normal</td>
                                    @else
                                    <td class="text-danger">Ciclo Lento</td>
                                    @endif
                                    @can('devices.show')
                                        <td>
                                            <a href="{{ route('devices.show', $device->id) }}" class="btn btn-sm btn-primary">Config</a>
                                        </td>
                                    @endcan
                                    @can('receptions.show-hour')
                                        <td>
                                            <a href="{{ route('receptions.show-hour', $device->id) }}" class="btn btn-sm btn-primary">Metricas</a>
                                        </td>
                                    @endcan
                                    @can('devices.log')
                                        <td>
                                            <a href="{{ route('devices.log', $device->id) }}" class="btn btn-sm btn-primary">Logs</a>
                                        </td>
                                    @endcan
                                    @can('alerts.show')
                                        <td>
                                            <a href="{{ route('alerts.show', $device->id) }}" class="btn btn-sm btn-primary">Alertas</a>
                                        </td>
                                    @endcan
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
@section('script')
    <script>
        $(document).ready(function(){

        });
    </script>
@endsection