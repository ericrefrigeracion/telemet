@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Editar Informacion: <strong>{{ $device->id }} - {{ $device->name }}</strong> ({{ $device->description }}).
                </div>
                <div class="card-body justify-content-center">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                             <h3>Valores del Dispositivo</h3><br>
                            {!! Form::model($device, ['route' => ['devices.update_device', $device->id], 'method' => 'PUT']) !!}
                                <div class="form-group">
                                    {{ Form::label('name', 'Nombre del Dispositivo') }}
                                    {{ Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => '25']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('description', 'Descripcion del Dispositivo') }}
                                    {{ Form::text('description', null, ['class' => 'form-control', 'maxlength' => '25']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('notification_email', 'Enviar Notificaciones A:') }}
                                    {{ Form::select('notification_email', [
                                        $device->user->email => $device->user->email,
                                        $device->user->notification_email_1 => $device->user->notification_email_1,
                                        $device->user->notification_email_2 => $device->user->notification_email_2,
                                        $device->user->notification_email_3 => $device->user->notification_email_3,
                                        'No quiero recibir notificaciones' => 'No quiero recibir notificaciones',
                                    ], null, ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('notification_phone_number', 'Llamar A:') }}
                                    {{ Form::select('notification_phone_number', [
                                        $device->user->phone_area_code . ' - ' . $device->user->phone_number => $device->user->phone_area_code . ' - ' . $device->user->phone_number,
                                        $device->user->notification_phone_number_1 => $device->user->notification_phone_number_1,
                                        $device->user->notification_phone_number_2 => $device->user->notification_phone_number_2,
                                        $device->user->notification_phone_number_3 => $device->user->notification_phone_number_3,
                                        'No llamar a Nadie' => 'No llamar a Nadie',
                                    ], null, ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('protection_id', 'Protegido:') }}
                                    {{ Form::select('protection_id', [
                                        $protections[0]->id => $protections[0]->description,
                                        $protections[1]->id => $protections[1]->description,
                                        $protections[2]->id => $protections[2]->description,
                                        $protections[3]->id => $protections[3]->description,
                                    ], null, ['class' => 'form-control']) }}
                                </div>
                                <div>
                                    {{ Form::submit('Guardar Cambios', ['class' => 'btn btn-sm btn-primary']) }}
                                </div>
                            {!! Form::close() !!}
                        </div>
                        @if($device->type_device_id == 2)
                            @include('devices.partials.tiny_t_edit')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection