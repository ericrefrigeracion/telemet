@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Crear Tipo de Dispositivo
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => ['type-devices.store']]) !!}
                    <div class="row">
                        <div class="form-group col-md-3">
                            {{ Form::label('prefix', 'Prefijo para identificacion') }}
                            {{ Form::number('prefix', null, ['class' => 'form-control', 'required', 'min' => 10, 'max' => 99, 'step' => 1]) }}
                        </div>
                        <div class="form-group col-md-5">
                            {{ Form::label('model', 'Modelo de dispositivo') }}
                            {{ Form::text('model', null, ['class' => 'form-control', 'required', 'maxlength' => '20']) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8">
                            {{ Form::label('description', 'Descripcion del dispositivo') }}
                            {{ Form::text('description', null, ['class' => 'form-control', 'required', 'maxlength' => '50']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('icon_id', 'Icono') }}
                            {{ Form::select('icon_id', $icons, null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            {{ Form::submit('Crear Item', ['class' => 'btn btn-sm btn-primary']) }}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection