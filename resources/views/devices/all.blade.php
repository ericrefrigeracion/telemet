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
                            <tr class="text-center">
                                <th>Usr</th>
                                <th>Dispositivo</th>
                                <th>Protegido</th>
                                <th>Estado</th>
                                <th>Rango</th>
                                <th>Ciclo</th>
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
                                    @if($device->protected)
                                    <td><i class="far fa-eye text-success m-2" title="Protegido"></i></td>
                                    @else
                                    <td><i class="far fa-eye-slash text-success m-2" title="Horario Permitido"></i></td>
                                    @endif
                                    @if($device->on_line)
                                    <td class="text-success" title="En Linea"><i class="fas fa-wifi"></i></td>
                                    @else
                                    <td class="text-danger" title="Desconectado"><i class="fas fa-wifi"></i></td>
                                    @endif
                                    @if($device->on_temp)
                                    <td><i class="fas fa-temperature-high text-success m-2" title="Temperatura dentro de los Limites"></i></td>
                                    @else
                                    <td><i class="fas fa-temperature-high text-danger m-2" title="Temperatura fuera de Rango"></i></td>
                                    @endif
                                    @if($device->on_t_set_point)
                                    <td><i class="far fa-check-circle text-success" title="Ciclo Normal"></i></td>
                                    @else
                                    <td><i class="far fa-times-circle text-danger" title="Ciclo Lento"></i></td>
                                    @endif
                                    @can('devices.show')
                                        <td>
                                            <a href="{{ route('devices.show', $device->id) }}" class="text-primary m-2" title="Configuracion Del Dispositivo"><i class="fas fa-cogs"></i></a>
                                        </td>
                                    @endcan
                                    @can('receptions.show-hour')
                                        <td>
                                            <a href="{{ route('receptions.show-hour', $device->id) }}" class="text-primary m-2" title="Graficos De Temperatura"><i class="fas fa-chart-line"></i></a>
                                        </td>
                                    @endcan
                                    @can('devices.log')
                                        <td>
                                            <a href="{{ route('devices.log', $device->id) }}" class="text-primary m-2" title="Logs Dispositivo"><i class="fas fa-clipboard-list"></i></a>
                                        </td>
                                    @endcan
                                    @can('alerts.show')
                                        <td>
                                            <a href="{{ route('alerts.show', $device->id) }}" class="text-primary m-2" title="Nuevas Alertas"><i class="fas fa-bell"></i></a>
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