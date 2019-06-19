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
                    Editar Informacion: <strong>{{ $device->id }} - {{ $device->name }}</strong>
                </div>
                <div class="card-body justify-content-center">
                    {!! Form::model($device, ['route' => ['devices.update', $device->id], 'method' => 'PUT']) !!}
                        <div class="form-group">
                            {{ Form::label('name', 'Nombre del Dispositivo') }}
                            {{ Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => '25']) }}
                        </div>
                        <div class="form-group">
                            <label>{{ Form::radio('send_mails', '1') }} Quiero que me llegue e-mail de aviso</label><br>
                            <label>{{ Form::radio('send_mails', '0') }} NO quiero que me lleguen e-mails</label>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                        <strong>Valores de Temperatura</strong>
                        <div class="form-group">
                            {{ Form::label('tcal', 'Calibracion de la Medicion (°C)') }}
                            {{ Form::number('tcal', null, ['class' => 'form-control', 'default' => 0, 'min' => -5, 'max' => 5, 'step' => 0.01]) }}
                        </div>
                        <div class="form-group">
                            <label>{{ Form::radio('tmon', '1') }} Monitoreo Activado</label><br>
                            <label>{{ Form::radio('tmon', '0') }} Monitoreo Desactivado</label>
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
                            <strong>Valores de Humedad</strong>
                            <div class="form-group">
                                {{ Form::label('hcal', 'Calibracion de la Medicion (% HR)') }}
                                {{ Form::number('hcal', null, ['class' => 'form-control', 'default' => 0, 'min' => -5, 'max' => 5, 'step' => 0.01]) }}
                            </div>
                            <div class="form-group">
                                <label>{{ Form::radio('hmon', '1') }} Monitoreo Activado</label><br>
                                <label>{{ Form::radio('hmon', '0') }} Monitoreo Desactivado</label>
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