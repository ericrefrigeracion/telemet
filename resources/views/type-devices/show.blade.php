@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Dispositivo tipo - <strong>{{ $type_device->model }}</strong>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $type_device->id }}</td>
                                </tr>
                                <tr>
                                    <td>Prefijo</td>
                                    <td>{{ $type_device->prefix }}</td>
                                </tr>
                                <tr>
                                    <td>Modelo</td>
                                    <td>{{ $type_device->model }}</td>
                                </tr>
                                <tr>
                                    <td>Descripcion</td>
                                    <td>{{ $type_device->description }}</td>
                                </tr>
                                <tr>
                                    <td>Creado</td>
                                    <td>{{ $type_device->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Editado</td>
                                    <td>{{ $type_device->updated_at }}</td>
                                </tr>
                        </tbody>
                    </table>
                    @can('type-devices.destroy')
                        {!! Form::open(['route' => ['type-devices.destroy', $type_device->id], 'method' => 'DELETE']) !!}
                            <button class="btn btn-sm btn-danger float-right">Eliminar Tipo de Dispositivo</button>
                        {!! Form::close() !!}
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection