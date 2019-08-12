@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Editar Informacion Rol: <strong>{{ $role->id }} - {{ $role->name }}</strong>
                </div>
                <div class="card-body">
                    {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'PUT']) !!}
                        <div class="form-group">
                            {{ Form::label('name', 'Nombre de Rol') }}
                            {{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('slug', 'ruta (slug)') }}
                            {{ Form::text('slug', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('description', 'Descripcion') }}
                            {{ Form::text('description', null, ['class' => 'form-control',]) }}
                        </div>
                        <div class="form-group">
                            <label>{{ Form::radio('special', 'all-access') }} Acceso Total</label>
                            <label>{{ Form::radio('special', 'no-access') }} Ningun Acceso</label>
                        </div>
                        <hr>
                        <h3>Lista de Permisos a Aplicar</h3>
                        <div class="list-unstyled">
                            @foreach($permissions as $permission)
                            <li>
                                <label>
                                    {{ Form::checkbox('permissions[]', $permission->id, null) }}
                                    {{ $permission->name}}
                                    <em>({{ $permission->description ?: "Sin Descripcion" }})</em>
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