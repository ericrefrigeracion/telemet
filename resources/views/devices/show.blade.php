@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Centinela - <strong>{{ $device->name }} ({{ $device->description }})</strong>
                    @can('devices.edit')
                        <a href="{{ route('devices.edit', $device->id) }}" class="btn btn-sm btn-default float-right">Editar Informacion</a>
                    @endcan
                    @can('pays.create')
                        <a href="{{ route('pays.create', $device->id) }}" class="btn btn-sm btn-default float-right">Pagar por el Monitoreo</a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th colspan="2">VALOR</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td colspan="2">{{ $device->id }}</td>
                                </tr>
                                <tr>
                                    <td>DISPOSITIVO MODELO</td>
                                    <td colspan="2">{{ $device->type_device->model }}</td>
                                </tr>
                                <tr>
                                    <td>NOMBRE</td>
                                    <td colspan="2">{{ $device->name }}</td>
                                </tr>
                                <tr>
                                    <td>DESCRIPCION</td>
                                    <td colspan="2">{{ $device->description }}</td>
                                </tr>
                                <tr>
                                    <td>CREADO</td>
                                    <td colspan="2">{{ $device->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>MONITOREO VALIDO HASTA</td>
                                    <td colspan="2">{{ $device->monitor_expires_at->toFormattedDateString() }}</td>
                                </tr>
                                <tr>
                                    <td>NOTIFICACIONES AL E-MAIL</td>
                                    <td colspan="2">{{ $device->notification_email }}</td>
                                </tr>
                                <tr>
                                    <td>LLAMADAS AL TELEFONO</td>
                                    <td colspan="2">{{ $device->notification_phone_number }}</td>
                                </tr>
                                <tr>
                                    <td>TIPO DE PROTECCION</td>
                                    <td colspan="2">{{ $device->protection->description }}</td>
                                </tr>
                                @if($device->type_device_id == 2)
                                    @include('devices.partials.tiny_t_show')
                                @endif
                                @if($device->type_device_id == 7)
                                    @include('devices.partials.tiny_pump_show')
                                @endif
                        </tbody>
                    </table>
                    @can('devices.destroy')
                        {!! Form::open(['route' => ['devices.destroy', $device->id], 'method' => 'DELETE']) !!}
                            <button class="btn btn-sm btn-danger float-right">Eliminar Dispositivo</button>
                        {!! Form::close() !!}
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection