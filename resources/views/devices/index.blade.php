@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card-columns">

                @foreach($devices as $device)
                    <div class="card text-center">
                        <div class="card-header">
                            {{ $device->name }}
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle text-muted">{{ $device->description }}</h6>
                            @if($device->admin_mon && $device->tmon)
                                @if($device->on_temp && $device->on_t_set_point)
                                    <a href="{{ route('alerts.show', $device->id) }}" class="btn btn-sm btn-success m-2">Todo en Orden</a>
                                @endif
                                @if(!$device->on_temp && $device->on_t_set_point)
                                    <a href="{{ route('alerts.show', $device->id) }}" class="btn btn-sm btn-warning m-2">Fuera de Rango</a>
                                @endif
                                @if($device->on_temp && !$device->on_t_set_point)
                                    <a href="{{ route('alerts.show', $device->id) }}" class="btn btn-sm btn-warning m-2">Fuera de Set Point</a>
                                @endif
                                @if(!$device->on_temp && !$device->on_t_set_point)
                                    <a href="{{ route('alerts.show', $device->id) }}" class="btn btn-sm btn-danger m-2">Alerta de Funcionamiento</a>
                                @endif
                            @endif
                            <h4 class="card-title display-4">{{ $device->last_data01 }}°C</h4>
                            @can('receptions.show-hour')
                                <a href="{{ route('receptions.show-hour', $device->id) }}" class="btn btn-sm btn-primary">Metricas</a>
                            @endcan
                            @can('devices.show')
                                <a href="{{ route('devices.show', $device->id) }}" class="btn btn-sm btn-primary">Configuracion</a>
                            @endcan
                            @can('devices.log')
                                <a href="{{ route('devices.log', $device->id) }}" class="btn btn-sm btn-primary">Logs</a>
                            @endcan
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">
                                @if($device->admin_mon)
                                {{ $device->on_line? 'En Linea':'Sin Conexion'}} - {{ $device->last_created_at }}
                                @else
                                Monitoreo vencido - <a href="{{ route('pays.create', $device->id) }}">Pagar por el monitoreo</a>
                                @endif
                            </small>
                        </div>
                    </div>
                @endforeach

            </div>
           {{ $devices->render() }}
        </div>
    </div>
</div>
@endsection