@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Editar Tipo de Dispositivo {{ $type_device->model }} (Prefijo {{ $type_device->prefix }})
                </div>
                <div class="card-body">
                    {!! Form::model($type_device, ['route' => ['type-devices.update', $type_device->id], 'method' => 'PUT']) !!}
                        <div class="form-group row">
                            <div class="col-md-2">
                                {{ Form::label('prefix', 'Prefijo') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('prefix', null, ['class' => 'form-control', 'required', 'max' => 99, 'min' => 10, 'step' => 1 ]) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                {{ Form::label('model', 'Modelo') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('model', null, ['class' => 'form-control', 'required', 'maxlength' => '20']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                {{ Form::label('description', 'Descripcion') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('description', null, ['class' => 'form-control', 'required', 'maxlength' => '50']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                {{ Form::label('icon_id', 'Icono') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::select('icon_id', $icons, null, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="row">
                            {{ Form::submit('Guardar Cambios', ['class' => 'btn btn-sm btn-primary m-2']) }}
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection