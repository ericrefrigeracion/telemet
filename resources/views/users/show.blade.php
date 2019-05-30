@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                                <th>NOMBRE</th>
                                <th>VALOR</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <td>Nombre</td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td>E-Mail</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td>Mail de Notificacion</td>
                                    <td>{{ $user->notification_mail }}</td>
                                </tr>
                                <tr>
                                    <td>CREADO</td>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Verificado</td>
                                    <td>{{ $user->email_verified_at }}</td>
                                </tr>
                                <tr>
                                    <td>Modificado</td>
                                    <td>{{ $user->updated_at }}</td>
                                </tr>
                                <tr>
                                    <td>Telefono de Notificacion</td>
                                    <td>{{ $user->notification_phone }}</td>
                                </tr>
                                <tr>
                                    <td>Direccion</td>
                                    <td>{{ $user->address }}</td>
                                </tr>
                                <tr>
                                    <td>Dia de Pago</td>
                                    <td>{{ $user->payment_day }}</td>
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