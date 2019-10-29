@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Alerta por Email N° {{ $mail_alert->id }} - dispositivo N° {{ $mail_alert->device_id }}
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Usuario</td>
                                <td>{{ $mail_alert->user_id }}</td>
                            </tr>
                            <tr>
                                <td>Tipo de Alerta</td>
                                <td>{{ $mail_alert->type }}</td>
                            </tr>
                            <tr>
                                <td>Ultima Medicion</td>
                                <td>{{ $mail_alert->last_data }}</td>
                            </tr>
                            <tr>
                                <td>Momento de la Falla</td>
                                <td>{{ $mail_alert->last_created_at }}</td>
                            </tr>
                            <tr>
                                <td>Email creado</td>
                                <td>{{ $mail_alert->created_at }}</td>
                            </tr>
                            <tr>
                                <td>Envio al Administrador</td>
                                <td>{{ $mail_alert->send_to_admin_at }}</td>
                            </tr>
                            <tr>
                                <td>Envio al Usuario</td>
                                <td>{{ $mail_alert->send_to_user_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection