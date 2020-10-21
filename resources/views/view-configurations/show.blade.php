@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Configuracion de vista - <strong>{{ $view_configuration->id }}</strong>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <tbody>
                                <tr>
                                    <td>Dispositivo</td>
                                    <td>{{ $view_configuration->type_device->model }}</td>
                                    <td>{{ $view_configuration->type_device->description }}</td>
                                </tr>
                                <tr>
                                    <td>Vista</td>
                                    <td>{{ $view_configuration->display->name }}</td>
                                    <td>{{ $view_configuration->display->description }}</td>
                                </tr>
                                <tr>
                                    <td>Orden</td>
                                    <td>{{ $view_configuration->order }}</td>
                                    <td>Permiso</td>
                                    <td>{{ $view_configuration->permission }}</td>
                                </tr>
                        </tbody>
                    </table>
                    @can('view-configurations.index')
                        <a href="{{ route('view-configurations.index') }}"><button class="btn btn-sm btn-success float-left">Volver</button></a>
                    @endcan
                    @can('topic-control-types.destroy')
                        {!! Form::open(['route' => ['view-configurations.destroy', $view_configuration->id], 'method' => 'DELETE']) !!}
                            <button class="btn btn-sm btn-danger float-right">Eliminar Item</button>
                        {!! Form::close() !!}
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection