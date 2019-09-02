@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Agregar Permiso
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => ['permissions.store']]) !!}
                        <div class="form-group">
                            {{ Form::label('id', 'ID del permiso') }}
                            {{ Form::number('id', null, ['class' => 'form-control', 'required']) }}
                        </div>
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
                            {{ Form::submit('Crear Permiso', ['class' => 'btn btn-sm btn-primary']) }}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection