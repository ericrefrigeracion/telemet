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
                    @can('devices.configuration')
                        <a href="{{ route('devices.configuration', $device->id) }}" class="btn btn-sm btn-default float-right">Configurar</a>
                    @endcan
                    @can('pays.create')
                        <a href="{{ route('pays.create', $device->id) }}" class="btn btn-sm btn-default float-right">Pagar por el Monitoreo</a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <tbody>
                                <tr>
                                    <td colspan="2">ID</td>
                                    <td colspan="3">{{ $device->id }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">DISPOSITIVO MODELO</td>
                                    <td colspan="3">Centinela - {{ $device->type_device->model }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">DESCRIPCION MODELO</td>
                                    <td colspan="3">{{ $device->type_device->description }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">NOMBRE</td>
                                    <td colspan="3">{{ $device->name }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">DESCRIPCION</td>
                                    <td colspan="3">{{ $device->description }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">CREADO</td>
                                    <td colspan="3">{{ $device->created_at }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">MONITOREO VALIDO HASTA</td>
                                    <td colspan="3">{{ $device->monitor_expires_at->toFormattedDateString() }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">NOTIFICACIONES AL E-MAIL</td>
                                    <td colspan="3">{{ $device->notification_email }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">LLAMADAS AL TELEFONO</td>
                                    <td colspan="3">{{ $device->notification_phone_number }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">TIPO DE PROTECCION</td>
                                    <td colspan="3">{{ $device->protection->description }}</td>
                                </tr>
                                <tr>
                                    <th colspan="5">VALORES DE CONFIGURACION</th>
                                </tr>
                                @foreach($device->device_configurations as $device_configurations)
                                    <tr>
                                        <td colspan="2">{{ $device_configurations->topic_control_type->name }}</td>
                                        <td colspan="3">{{ $device_configurations->value }}</td>
                                    </tr>
                                @endforeach
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