@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Agregar Dispositivo
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => ['devices.store']]) !!}
                        <div class="form-group">
                            {{ Form::label('id', 'ID del dispositivo') }}
                            <div class="row">
                                {{ Form::number('prefix', null, ['class' => 'form-control col-1 ml-3 mr-1', 'required', 'min' => 1, 'max' => 99]) }}
                                {{ Form::number('id', null, ['class' => 'form-control col-3', 'required', 'min' => 10000, 'max' => 9999999999999999999]) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('name', 'Nombre del dispositivo') }}
                            {{ Form::text('name', null, ['class' => 'form-control col-5', 'required', 'maxlength=25']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('description', 'Descripcion del dispositivo') }}
                            {{ Form::text('description', null, ['class' => 'form-control col-8', 'maxlength=50']) }}
                        </div>
                        <div>
                            {{ Form::submit('Crear Dispositivo', ['class' => 'btn btn-sm btn-primary']) }}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection