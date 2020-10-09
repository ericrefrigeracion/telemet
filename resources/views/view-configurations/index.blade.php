@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                <h3>Configuracion de vistas</h3>
                    @can('prices.create')
                        <a href="{{ route('view-configurations.create') }}" class="btn btn-sm btn-info float-right">Crear Configuracion</a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Dispositivo</th>
                                <th>Grafico</th>
                                <th>Topico</th>
                                <th>Ubicacion</th>
                                <th colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($view_configurations as $view_configuration)
                                <tr>
                                    <td>{{ $view_configuration->id }}</td>
                                    <td>{{ $view_configuration->type_device->model }}</td>
                                    <td>{{ $view_configuration->display->name }}</td>
                                    <td>{{ $view_configuration->topic->slug }}</td>
                                    <td>{{ $view_configuration->order}}</td>
                                    @can('view-configurations.show')
                                        <td><a href="{{ route('view-configurations.show', $view_configuration->id) }}" class="btn btn-sm btn-success">Ver</a></td>
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