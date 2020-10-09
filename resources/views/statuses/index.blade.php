@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                <h3>Status</h3>
                    @can('statuses.create')
                        <a href="{{ route('statuses.create') }}" class="btn btn-sm btn-info float-right">Crear Status</a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Icono</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th colspan="3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($statuses as $status)
                                <tr>
                                    <td>{{ $status->id }}</td>
                                    <td>{!! $status->icon->scripts !!}</td>
                                    <td>{{ $status->name }}</td>
                                    <td>{{ $status->description }}</td>
                                    @can('statuses.show')
                                        <td><a href="{{ route('statuses.show', $status->id) }}" class="btn btn-sm btn-success">Ver</a></td>
                                    @endcan
                                    @can('statuses.edit')
                                        <td><a href="{{ route('statuses.edit', $status->id) }}" class="btn btn-sm btn-info">Editar</a></td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $statuses->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection