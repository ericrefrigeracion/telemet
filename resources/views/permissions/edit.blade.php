@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Editar Informacion: <strong>{{ $permission->id }} - {{ $permission->name }}</strong> ({{ $permission->description }}).
                </div>
                <div class="card-body justify-content-center">
                    {!! Form::model($permission, ['route' => ['permissions.update', $permission->id], 'method' => 'PUT']) !!}
                        <div class="form-group">
                            {{ Form::label('name', 'Nombre del permiso') }}
                            {{ Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength=25']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('slug', 'Slug del permiso') }}
                            {{ Form::text('slug', null, ['class' => 'form-control', 'required', 'maxlength=25']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('description', 'Descripcion del permiso') }}
                            {{ Form::text('description', null, ['class' => 'form-control', 'maxlength=25']) }}
                        </div>
                        <div>
                            {{ Form::submit('Guardar Cambios', ['class' => 'btn btn-sm btn-primary']) }}
                        </div>
                    {!! Form::close() !!}
                    @can('permissions.destroy')
                        {!! Form::open(['route' => ['permissions.destroy', $permission->id], 'method' => 'DELETE']) !!}
                            <button class="btn btn-sm btn-danger float-right">Eliminar Permiso</button>
                        {!! Form::close() !!}
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection