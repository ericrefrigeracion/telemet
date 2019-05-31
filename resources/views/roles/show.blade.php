@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Roles - <strong>{{ $role->name }}</strong>
                    @can('roles.edit')
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-default float-right">Editar Informacion</a>
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
                                    <td>{{ $role->id }}</td>
                                </tr>
                                <tr>
                                    <td>Nombre</td>
                                    <td>{{ $role->name }}</td>
                                </tr>
                                <tr>
                                    <td>Slug</td>
                                    <td>{{ $role->slug }}</td>
                                </tr>
                                <tr>
                                    <td>Descripcion</td>
                                    <td>{{ $role->description }}</td>
                                </tr>
                                <tr>
                                    <td>Creado</td>
                                    <td>{{ $role->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Editado</td>
                                    <td>{{ $role->updated_at }}</td>
                                </tr>
                        </tbody>
                    </table>
                    @can('roles.destroy')
                        {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'DELETE']) !!}
                            <button class="btn btn-sm btn-danger float-right">Eliminar Rol</button>
                        {!! Form::close() !!}
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection