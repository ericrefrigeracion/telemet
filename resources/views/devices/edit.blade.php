@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Editar Informacion: <strong>{{ $device->id }} - {{ $device->name }}</strong>
                </div>
                <div class="card-body">
                    {!! Form::model($device, ['route' => ['devices.update', $device->id], 'method' => 'PUT']) !!}
                        <div class="form-group">
                            {{ Form::label('name', 'Nombre del Dispositivo') }}
                            {{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
                        </div>
                        @if($device->mon)
                        <div class="form-group">
                            {{ Form::label('min', 'Minima Temperatura Permitida') }}
                            {{ Form::number('min', null, ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('max', 'Maxima Temperatura Permitida') }}
                            {{ Form::number('max', null, ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('dly', 'Retardo en el Aviso') }}
                            {{ Form::number('dly', null, ['class' => 'form-control', 'required', 'default' => 60, 'min' => 0, 'max' => 60]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('cal', 'Calibracion de la Medicion') }}
                            {{ Form::number('cal', null, ['class' => 'form-control', 'default' => 0, 'min' => -5, 'max' => 5]) }}
                        </div>
                    @endif
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