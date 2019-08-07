@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Editar Informacion: <strong>{{ $device->id }} - {{ $device->name }}</strong> ({{ $device->description }}).
                </div>
                <div class="card-body justify-content-center">
                    {!! Form::model($device, ['route' => ['devices.update', $device->id], 'method' => 'PUT']) !!}
                        <div class="form-group">
                            {{ Form::label('name', 'Nombre del Dispositivo') }}
                            {{ Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => '25']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('description', 'Nombre del Dispositivo') }}
                            {{ Form::text('description', null, ['class' => 'form-control', 'required', 'maxlength' => '25']) }}
                        </div>
                        <p>Avisos por E-mail</p>
                        <div class="btn-group btn-group-toggle mb-3" data-toggle="buttons">
                            <label class="btn btn-secondary{{ $device->send_mails ? ' focus active' : '' }}">{{ Form::radio('send_mails', '1') }} Activar</label>
                            <label class="btn btn-secondary{{ !$device->send_mails ? ' focus active' : '' }}">{{ Form::radio('send_mails', '0') }} Desactivar</label>
                        </div>
                        <hr><br>
                        <div class="row">
                        <div class="col-md-6">
                        <h3>Valores de Temperatura</h3><br>
                        <p>Monitoreo de Temperatura</p>
                        <div class="btn-group btn-group-toggle mb-3" data-toggle="buttons">
                            <label class="btn btn-secondary{{ $device->tmon ? ' focus active' : '' }}">{{ Form::radio('tmon', '1') }} Activar</label><br>
                            <label class="btn btn-secondary{{ !$device->tmon ? ' focus active' : '' }}">{{ Form::radio('tmon', '0') }} Desactivar</label>
                        </div>
                        <div class="form-group">
                            {{ Form::label('tcal', 'Calibracion de la Medicion (°C)') }}
                            {{ Form::number('tcal', null, ['class' => 'form-control', 'default' => 0, 'min' => -5, 'max' => 5, 'step' => 0.01]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('tmin', 'Minima Temperatura Permitida (°C)') }}
                            {{ Form::number('tmin', null, ['class' => 'form-control', 'required', 'min' => -30, 'max' => 80, 'step' => 0.01]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('tmax', 'Maxima Temperatura Permitida (°C)') }}
                            {{ Form::number('tmax', null, ['class' => 'form-control', 'required', 'min' => -30, 'max' => 80, 'step' => 0.01]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('tdly', 'Retardo al Aviso (minutos)') }}
                            {{ Form::number('tdly', null, ['class' => 'form-control', 'required', 'default' => 60, 'min' => 0, 'max' => 60]) }}
                        </div>
                        </div>
                        @if($device->mdl == 'th')
                            <div class="col-md-6">
                            <h3>Valores de Humedad</h3><br>
                            <p>Monitoreo de Humedad</p>
                            <div class="btn-group btn-group-toggle mb-3" data-toggle="buttons">
                                <label class="btn btn-secondary{{ $device->hmon ? ' focus active' : '' }}">{{ Form::radio('hmon', '1') }} Activar</label><br>
                                <label class="btn btn-secondary{{ !$device->hmon ? ' focus active' : '' }}">{{ Form::radio('hmon', '0') }} Desactivar</label>
                            </div>
                            <div class="form-group">
                                {{ Form::label('hcal', 'Calibracion de la Medicion (% HR)') }}
                                {{ Form::number('hcal', null, ['class' => 'form-control', 'default' => 0, 'min' => -5, 'max' => 5, 'step' => 0.01]) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('hmin', 'Minima Humedad Permitida (% HR)') }}
                                {{ Form::number('hmin', null, ['class' => 'form-control', 'required', 'min' => 30, 'max' => 95, 'step' => 0.01]) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('hmax', 'Maxima Humedad Permitida (% HR)') }}
                                {{ Form::number('hmax', null, ['class' => 'form-control', 'required', 'min' => 30, 'max' => 95, 'step' => 0.01]) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('hdly', 'Retardo al Aviso (minutos)') }}
                                {{ Form::number('hdly', null, ['class' => 'form-control', 'required', 'default' => 60, 'min' => 0, 'max' => 60]) }}
                            </div>
                            </div>
                        @endif
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