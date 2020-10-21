@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                <h3>Tipos de visualizacion</h3>
                    @can('displays.create')
                        <a href="{{ route('displays.create') }}" class="btn btn-sm btn-info float-right">Crear Item Control</a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th colspan="3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($displays as $display)
                                <tr>
                                    <td>{{ $display->id }}</td>
                                    <td>{{ $display->name }}</td>
                                    <td>{{ $display->description }}</td>
                                    @can('displays.show')
                                        <td><a href="{{ route('displays.show', $display->id) }}" class="btn btn-sm btn-success">Ver</a></td>
                                    @endcan
                                    @can('displays.edit')
                                        <td><a href="{{ route('displays.edit', $display->id) }}" class="btn btn-sm btn-info">Editar</a></td>
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