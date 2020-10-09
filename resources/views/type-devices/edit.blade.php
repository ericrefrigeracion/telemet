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
                                {{ Form::label('description', 'Descripcion') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('description', null, ['class' => 'form-control', 'required', 'maxlength' => '40']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('icon_id', 'Icono') }}
                                {{ Form::select('icon_id', $icons, null, ['class' => 'form-control']) }}
                            </div>
                            <div class="col-md-2">
                                {{ Form::submit('Guardar Cambios', ['class' => 'btn btn-sm btn-primary mt-1']) }}
                            </div>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection