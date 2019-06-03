@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Editar Informacion Usuario: <strong>{{ $user->id }} - {{ $user->name }}</strong>
                </div>
                <div class="card-body">
                    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) !!}
                        <div class="form-group">
                            {{ Form::label('name', 'Nombre de Usuario') }}
                            {{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('notification_mail', 'E-Mail de Notificacion') }}
                            {{ Form::email('notification_mail', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('notification_phone', 'Telefono de Notificacion') }}
                            {{ Form::number('notification_phone', null, ['class' => 'form-control',]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('address', 'Direccion') }}
                            {{ Form::text('address', null, ['class' => 'form-control',]) }}
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