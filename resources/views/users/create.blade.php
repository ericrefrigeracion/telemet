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