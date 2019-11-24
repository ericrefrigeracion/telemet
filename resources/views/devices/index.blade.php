@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card-columns">

                @foreach($devices as $device)
                    <div class="card text-center{{ $device->on_line ? '':' border-danger'}}">
                        <div class="card-header{{ $device->on_line ? '':' bg-danger text-white'}}">
                            {{ $device->name }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                 <div class="col text-center">
                                    @if($device->admin_mon && $device->on_line && $device->protected)
                                        @if($device->tiny_t_device->on_temp  && $device->tiny_t_device->on_t_set_point)
                                            Todo en orden<i class="far fa-check-circle text-success m-2"></i>
                                        @endif
                                        @if(!$device->tiny_t_device->on_temp && $device->tiny_t_device->on_t_set_point)
                                            Fuera de Rango<i class="fas fa-exclamation text-warning m-2"></i>
                                        @endif
                                        @if($device->tiny_t_device->on_temp && !$device->tiny_t_device->on_t_set_point)
                                            Ciclo Lento<i class="fas fa-exclamation text-warning m-2"></i>
                                        @endif
                                        @if(!$device->tiny_t_device->on_temp && !$device->tiny_t_device->on_t_set_point)
                                            Alerta de Funcionamiento<i class="fas fa-exclamation text-danger m-2"></i>
                                        @endif
                                        @if($device->protected)
                                            <i class="far fa-eye text-success m-2" title="Protegido"></i>
                                        @endif
                                        @if(!$device->protected && $device->protection_id != 4)
                                            <i class="far fa-eye-slash text-success m-2" title="Horario Permitido"></i>
                                        @endif
                                    @endif
                                    @if(!$device->admin_mon)
                                        <small>
                                            Monitoreo Vencido - <a href="{{ route('pays.create', $device->id) }}">Pagar por el monitoreo</a>
                                       </small>
                                    @endif
                                    </div>
                                </div>
                            <div class="row">
                                @if($device->admin_mon)
                                    <div class="col-2">
                                        <i class="fas fa-user-shield text-success m-2" title="Monitoreo Vigente"></i>
                                        <i class="{{ $device->protection->class }} m-2" title="{{ $device->protection->description }}"></i>
                                        <i class="fas fa-wifi {{ $device->wifi_color }} m-2" title="{{ $device->wifi_description }}"></i>
                                    </div>
                                @else
                                    <div class="col-2">
                                        <i class="fas fa-user-shield text-danger m-2" title="Monitoreo Vencido"></i>
                                        <i class="{{ $device->protection->class }} text-danger m-2" title="{{ $device->protection->description }} (Deshabilitado por falta de Pago)"></i>
                                        <i class="fas fa-wifi {{ $device->wifi_color }} m-2" title="{{ $device->wifi_description }}"></i>
                                    </div>
                                @endif
                                <div class="col-10 text-center">
                                    <div class="row">
                                        <i class="card-title {{ $device->status_class }} {{ $device->status }}"title="{{ $device->status_title }}"></i>
                                        <div class="card-title h1 m-2" title="Temperatura medida">{{ $device->last_data01 }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col h4 text-center m-0 mt-3">
                                    @can('receptions.show-hour')
                                        <a href="{{ route('receptions.show-hour', $device->id) }}" class="text-primary m-2" title="Evolucion de las Temperaturas"><i class="fas fa-chart-line"></i></a>
                                    @endcan
                                    @can('devices.show')
                                        <a href="{{ route('devices.show', $device->id) }}" class="text-primary m-2" title="Configuracion Del Dispositivo"><i class="fas fa-cogs"></i></a>
                                    @endcan
                                    @can('alerts.show')
                                        @if($device->alerts_count > 0)
                                            <a href="{{ route('alerts.show', $device->id) }}" class="text-primary m-2" title="Nuevas Alertas">{{ $device->alerts_count }} <i class="fas fa-bell"></i></a>
                                        @endif
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <div class="card-footer{{ $device->on_line ? '':' bg-danger'}}">
                            <small class="{{ $device->on_line ? '':' text-white'}}">
                                @if($device->admin_mon)
                                    {{ $device->on_line ? 'En Linea':'Sin Conexion'}} - {{ $device->last_created_at }}
                                @else
                                    {{ $device->last_created_at }}
                                @endif
                            </small>
                        </div>
                    </div>
                @endforeach
                @can('devices.create')
                    <div class="card text-center">
                        <div class="card-header text-white bg-success">
                            Agregar Dispositivo
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('devices.create') }}" class="btn btn-xl text-success"><i class="fas fa-plus h1 display-1"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-success">
                            <a href="{{ route('devices.create') }}" class="m-0 text-white">Informacion</a>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection