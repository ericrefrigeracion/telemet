<div class="col-md-6 mb-2">
    <h3>Valores de Nivel</h3><br>
    {!! Form::model($device->tiny_pump_device, ['route' => ['devices.update_tiny_t', $device->id], 'method' => 'PUT']) !!}
    <div class="form-group">
        {{ Form::label('l_cal', 'Calibracion de la Medicion (cms)') }}
        {{ Form::number('l_cal', null, ['class' => 'form-control', 'default' => 0, 'min' => -5, 'max' => 5, 'step' => 0.01]) }}
    </div>
    <div class="form-group">
        {{ Form::label('l_min', 'Minimo Nivel Permitido (cms)') }}
        {{ Form::number('l_min', null, ['class' => 'form-control', 'required', 'min' => 0, 'max' => 480, 'step' => 0.1]) }}
    </div>
    <div class="form-group">
        {{ Form::label('l_max', 'Maximo Nivel Permitido (cms)') }}
        {{ Form::number('l_max', null, ['class' => 'form-control', 'required', 'min' => 0, 'max' => 480, 'step' => 0.1]) }}
    </div>
    <div class="form-group">
        {{ Form::label('l_dly', 'Retardo al Aviso (minutos)') }}
        {{ Form::number('l_dly', null, ['class' => 'form-control', 'required', 'default' => 60, 'min' => 0, 'max' => 360]) }}
    </div>
    <div>
        {{ Form::submit('Guardar Cambios', ['class' => 'btn btn-sm btn-primary']) }}
    </div>
    {!! Form::close() !!}
</div>