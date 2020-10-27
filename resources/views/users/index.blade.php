@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Usuarios
                    @can('users.create')
                        <a href="{{ route('users.create') }}" class="btn btn-sm btn-info float-right">Crear Usuario</a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Rol</th>
                                <th colspan="3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        {{ $user->id }}
                                    </td>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            {{ $role->name }};
                                        @endforeach
                                    </td>
                                    <td>
                                        @can('users.show')
                                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-success m-2">Ver</a>
                                        @endcan
                                        @can('users.edit')
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning m-2">Editar</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection