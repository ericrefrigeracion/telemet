@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Crear Nuevo Usuario
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => ['users.store']]) !!}
                        <div class="form-group">
                            {{ Form::label('email', 'Email') }}
                            {{ Form::email('email', null, ['class' => 'form-control', 'required', 'maxlength' => '25']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('password', 'Contraseña') }}
                            {{ Form::text('password', null, ['class' => 'form-control', 'required', 'maxlength' => '25']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('name', 'Nombre') }}
                            {{ Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => '25']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('surname', 'Apellido') }}
                            {{ Form::text('surname', null, ['class' => 'form-control', 'required', 'maxlength' => '25']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('dni', 'Numero de Documento') }}
                            {{ Form::number('dni', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('phone_area_code', 'Codigo de Area') }}
                            {{ Form::number('phone_area_code', null, ['class' => 'form-control',]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('phone_number', 'Numero de Telefono') }}
                            {{ Form::number('phone_number', null, ['class' => 'form-control',]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('address', 'Direccion') }}
                            {{ Form::text('address', null, ['class' => 'form-control', 'maxlength' => '30']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('notification_email_1', 'E-Mail para avisos 1') }}
                            {{ Form::email('notification_email_1', null, ['class' => 'form-control', 'maxlength' => '30']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('notification_email_2', 'E-Mail para avisos 2') }}
                            {{ Form::email('notification_email_2', null, ['class' => 'form-control', 'maxlength' => '30']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('notification_email_3', 'E-Mail para avisos 3') }}
                            {{ Form::email('notification_email_3', null, ['class' => 'form-control', 'maxlength' => '30']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('notification_phone_number_1', 'Telefono para avisos 1') }}
                            {{ Form::text('notification_phone_number_1', null, ['class' => 'form-control', 'maxlength' => '30']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('notification_phone_number_2', 'Telefono para avisos 2') }}
                            {{ Form::text('notification_phone_number_2', null, ['class' => 'form-control', 'maxlength' => '30']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('notification_phone_number_3', 'Telefono para avisos 3') }}
                            {{ Form::text('notification_phone_number_3', null, ['class' => 'form-control', 'maxlength' => '30']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('role_id', 'Rol a aplicar') }}
                            {{ Form::select('role_id', $roles, null, ['class' => 'form-control']) }}
                        </div>
                        <div>
                            {{ Form::submit('Crear Usuario', ['class' => 'btn btn-sm btn-primary']) }}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection