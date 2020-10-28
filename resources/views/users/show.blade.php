@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Usuarios - <strong>{{ $user->name }}</strong>
                    @can('users.edit')
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-default float-right">Editar Informacion</a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre Completo:</th>
                                <th>{{ $user->name }} {{ $user->surname }}</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>N° de Documento:</td>
                                    <td>{{ $user->dni }}</td>
                                </tr>
                                <tr>
                                    <td>Rol asignado:</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            {{ $role->name }};
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>E-Mail:</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td>E-Mail verificado:</td>
                                    <td>{{ $user->email_verified_at }}</td>
                                </tr>
                                <tr>
                                    <td>Numero de Telefono:</td>
                                    <td>{{ $user->phone_area_code }} - {{ $user->phone_number }}</td>
                                </tr>
                                <tr>
                                    <td>Direccion:</td>
                                    <td>{{ $user->address }}</td>
                                </tr>
                                <tr>
                                    <td>Creado</td>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Modificado</td>
                                    <td>{{ $user->updated_at }}</td>
                                </tr>
                                <tr>
                                    <td>Permisos:</td>
                                    <td>
                                        @foreach($user->permissions as $permission)
                                            {{ $permission->name }};
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dispositivos:</td>
                                    <td>
                                        @foreach($user->devices as $device)
                                            {{ $device->name }};
                                        @endforeach
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                    @can('users.destroy')
                        {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE']) !!}
                            <button class="btn btn-sm btn-danger float-right">Eliminar Usuario</button>
                        {!! Form::close() !!}
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection