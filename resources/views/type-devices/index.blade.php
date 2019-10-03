@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                <h3>Tipos de Dispositivos</h3>
                    @can('type-devices.create')
                        <a href="{{ route('type-devices.create') }}" class="btn btn-sm btn-info float-right">Crear Tipo de Dispositivo</a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Prefijo</th>
                                <th>Modelo</th>
                                <th colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($type_devices as $type_device)
                                <tr>
                                    <td>{{ $type_device->prefix }}</td>
                                    <td>{{ $type_device->model }}</td>
                                    @can('type-devices.show')
                                        <td><a href="{{ route('type-devices.show', $type_device->id) }}" class="btn btn-sm btn-success">Ver</a></td>
                                    @endcan
                                    @can('type-devices.edit')
                                        <td><a href="{{ route('type-devices.edit', $type_device->id) }}" class="btn btn-sm btn-default">Editar</a></td>
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