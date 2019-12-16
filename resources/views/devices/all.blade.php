@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Dispositivos - Todos
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>Usr</th>
                                <th>Dispositivo</th>
                                <th colspan="4">Estado</th>
                                <th colspan="4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($devices as $device)
                                <tr class="text-center">
                                    @can('users.show')
                                    <td><a href="{{ route('users.show', $device->user_id) }}" class="btn btn-sm btn-default">{{ $device->user_id }}</a></td>
                                    @endcan
                                    <td>{{ $device->id }}</td>
                                    @if($device->on_line)
                                        <td class="text-success" title="En Linea"><i class="fas fa-link m-2"></i></td>
                                    @else
                                        <td class="text-danger" title="Desconectado"><i class="fas fa-unlink m-2"></i></td>
                                    @endif
                                    @if($device->protected)
                                        <td><i class="far fa-eye text-success m-2" title="Protegido"></i></td>
                                        @if($device->tiny_t_device->on_temp)
                                            <td><i class="fas fa-temperature-high text-success m-2" title="Temperatura dentro de los Limites"></i></td>
                                        @else
                                            <td><i class="fas fa-temperature-high text-danger m-2" title="Temperatura fuera de Rango"></i></td>
                                        @endif
                                        @if(1)
                                            <td><i class="far fa-check-circle text-success m-2" title="Ciclo Normal"></i></td>
                                        @else
                                            <td><i class="far fa-times-circle text-danger m-2" title="Ciclo Lento"></i></td>
                                        @endif
                                    @else
                                        @if($device->protection_id == 4)
                                            <td><i class="far fa-eye-slash text-danger m-2" title="Proteccion Deshabilitada"></i></td>
                                            <td><i class="fas fa-temperature-high text-muted m-2" title="Rango sin Monitoreo"></i></td>
                                            <td><i class="far fa-times-circle text-muted m-2" title="Ciclo sin Monitoreo"></i></td>
                                        @else
                                            <td><i class="far fa-eye-slash text-success m-2" title="Horario Permitido"></i></td>
                                            <td><i class="fas fa-temperature-high text-muted m-2" title="Control de temperatura deshabilitado momentaneamente"></i></td>
                                            <td><i class="far fa-check-circle text-muted m-2" title="Control de ciclo deshabilitado momentaneamente"></i></td>
                                        @endif
                                    @endif
                                    @can('devices.edit')
                                        <td>
                                            <a href="{{ route('devices.edit', $device->id) }}" class="text-primary m-2" title="Configuracion Del Dispositivo"><i class="fas fa-cogs m-2"></i></a>
                                        </td>
                                    @endcan
                                    @can('receptions.now')
                                        <td>
                                            <a href="{{ route('receptions.now', $device->id) }}" class="text-primary m-2" title="Evolucion de las Temperaturas"><i class="fas fa-chart-line m-2"></i></a>
                                        </td>
                                    @endcan
                                    @can('devices.log')
                                        <td>
                                            <a href="{{ route('devices.log', $device->id) }}" class="text-primary m-2" title="Logs Dispositivo"><i class="fas fa-clipboard-list m-2"></i></a>
                                        </td>
                                    @endcan
                                    @can('alerts.show')
                                        <td>
                                            <a href="{{ route('alerts.show', $device->id) }}" class="text-primary m-2" title="Nuevas Alertas"><i class="fas fa-bell m-2"></i></a>
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
    </script>
@endsection