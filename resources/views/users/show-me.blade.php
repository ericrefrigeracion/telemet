@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Usuarios - <strong>{{ $user->name }}</strong>
                    @can('users.edit-me')
                        <a href="{{ route('users.edit-me') }}" class="btn btn-sm btn-default float-right">Editar Informacion</a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>{{ $user->name }}</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>E-Mail</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td>E-Mail de Notificacion</td>
                                    <td>{{ $user->notification_mail }}</td>
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
                                    <td>Creado</td>
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
                                    <td>Dia de Pago</td>
                                    <td>{{ $user->payment_day }}</td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection