@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Centinela - <strong>{{ $device->name }}</strong>
                    @can('devices.edit')
                        <a href="{{ route('devices.edit', $device->id) }}" class="btn btn-sm btn-default float-right">Editar Informacion</a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>VALOR</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $device->id }}</td>
                                </tr>
                                <tr>
                                    <td>NOMBRE</td>
                                    <td>{{ $device->name }}</td>
                                </tr>
                                <tr>
                                    <td>Calibracion de la Medicion (°C)</td>
                                    <td>{{ $device->cal > 0 ? "+" . $device->cal : $device->cal }}</td>
                                </tr>
                                <tr>
                                    <td>CREADO</td>
                                    <td>{{ $device->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>MODIFICADO</td>
                                    <td>{{ $device->updated_at }}</td>
                                </tr>
                                <tr>
                                    <td>MONITOREO</td>
                                    <td>{{ $device->mon ? 'ACTIVO' : 'INACTIVO' }}</td>
                                </tr>
                                @if($device->mon)
                                        <tr><th>CONFIGURACION</th><th>VALOR</th></tr>
                                        <tr>
                                            <td>Minima Establecida (°C)</td>
                                            <td>{{ $device->min }}</td>
                                        </tr>
                                        <tr>
                                            <td>Maxima Establecida (°C)</td>
                                            <td>{{ $device->max }}</td>
                                        </tr>
                                        <tr>
                                            <td>Retardo al Aviso (minutos)</td>
                                            <td>{{ $device->dly }}</td>
                                        </tr>
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