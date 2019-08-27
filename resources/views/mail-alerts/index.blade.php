@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Alertas por Email
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Momento</th>
                                <th>Dispositivo</th>
                                <th>Falla</th>
                                <th>Usuario</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mail_alerts as $mail_alert)
                                <tr>
                                    <td>
                                        {{ $mail_alert->last_created_at }}
                                    </td>
                                    <td>
                                        <a href="{{ route('devices.show', $mail_alert->device_id) }}" class="btn btn-sm btn-default">
                                        {{ $mail_alert->device_id }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('mail-alerts.show', $mail_alert->id) }}" class="btn btn-sm btn-default">
                                        {{ $mail_alert->type }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('users.show', $mail_alert->user_id) }}" class="btn btn-sm btn-default">
                                        {{ $mail_alert->user_id }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $mail_alerts->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection