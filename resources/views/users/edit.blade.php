@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Editar Informacion Usuario: <strong>{{ $user->id }} - {{ $user->name }} {{ $user->surname }}</strong>
                </div>
                <div class="card-body">
                    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) !!}
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
                            {{ Form::label('email', 'E-Mail') }}
                            {{ Form::email('email', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('phone_area_code', 'Codigo de Area') }}
                            {{ Form::number('phone_area_code', null, ['class' => 'form-control',]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('phone_number', 'Numero de Telefono') }}
                            {{ Form::number('phone_area_code', null, ['class' => 'form-control',]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('address', 'Direccion') }}
                            {{ Form::text('address', null, ['class' => 'form-control', 'maxlength' => '30']) }}
                        </div>
                        <hr>
                        <h3>Lista de Roles a Aplicar</h3>
                        <div class="list-unstyled">
                            @foreach($roles as $role)
                            <li>
                                <label>
                                    {{ Form::checkbox('roles[]', $role->id, null) }}
                                    {{ $role->name}}
                                    <em>({{ $role->description ?: "Sin Descripcion" }})</em>
                                </label>
                            </li>
                            @endforeach
                        </div>
                        <div>
                            {{ Form::submit('Guardar Cambios', ['class' => 'btn btn-sm btn-primary']) }}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection