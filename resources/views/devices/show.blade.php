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
                                    <td>CREADO</td>
                                    <td>{{ $device->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>AVISO POR E-MAIL</td>
                                    <td>{{ $device->send_mails ? 'ACTIVO' : 'INACTIVO' }}</td>
                                </tr>
                                <tr>
                                    <td>MONITOREO TEMPERATURA</td>
                                    <td>{{ $device->tmon ? 'ACTIVO' : 'INACTIVO' }}</td>
                                </tr>
                                @if($device->tmon)
                                        <tr><th>CONFIGURACION</th><th>VALOR</th></tr>
                                        <tr>
                                            <td>Calibracion de la Medicion (°C)</td>
                                            <td>{{ $device->tcal > 0 ? "+" . $device->tcal : $device->tcal }}</td>
                                        </tr>
                                        <tr>
                                            <td>Minima Establecida (°C)</td>
                                            <td>{{ $device->tmin }}</td>
                                        </tr>
                                        <tr>
                                            <td>Maxima Establecida (°C)</td>
                                            <td>{{ $device->tmax }}</td>
                                        </tr>
                                        <tr>
                                            <td>Retardo al Aviso (minutos)</td>
                                            <td>{{ $device->tdly }}</td>
                                        </tr>
                                @endif
                                @if($device->mdl == 'th')
                                <tr>
                                    <td>MONITOREO HUMEDAD</td>
                                    <td>{{ $device->hmon ? 'ACTIVO' : 'INACTIVO' }}</td>
                                </tr>
                                @if($device->hmon)
                                        <tr><th>CONFIGURACION</th><th>VALOR</th></tr>
                                        <tr>
                                            <td>Calibracion de la Medicion (%)</td>
                                            <td>{{ $device->tcal > 0 ? "+" . $device->tcal : $device->tcal }}</td>
                                        </tr>
                                        <tr>
                                            <td>Minima Establecida (%)</td>
                                            <td>{{ $device->hmin }}</td>
                                        </tr>
                                        <tr>
                                            <td>Maxima Establecida (%)</td>
                                            <td>{{ $device->hmax }}</td>
                                        </tr>
                                        <tr>
                                            <td>Retardo al Aviso (minutos)</td>
                                            <td>{{ $device->hdly }}</td>
                                        </tr>
                                @endif
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