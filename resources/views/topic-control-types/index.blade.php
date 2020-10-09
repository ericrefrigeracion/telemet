@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                <h3>Items para Control de Topicos</h3>
                    @can('topic-control-types.create')
                        <a href="{{ route('topic-control-types.create') }}" class="btn btn-sm btn-info float-right">Crear Item Control</a>
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
                            @foreach($topic_control_types as $topic_control_type)
                                <tr>
                                    <td>{{ $topic_control_type->id }}</td>
                                    <td>{{ $topic_control_type->name }}</td>
                                    <td>{{ $topic_control_type->description }}</td>
                                    @can('topic-control-types.show')
                                        <td><a href="{{ route('topic-control-types.show', $topic_control_type->id) }}" class="btn btn-sm btn-success">Ver</a></td>
                                    @endcan
                                    @can('topic-control-types.edit')
                                        <td><a href="{{ route('topic-control-types.edit', $topic_control_type->id) }}" class="btn btn-sm btn-info">Editar</a></td>
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