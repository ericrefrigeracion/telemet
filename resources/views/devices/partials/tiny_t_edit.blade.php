<div class="col-md-6 mb-2">
    <h3>Valores de Temperatura</h3><br>
    {!! Form::model($device->tiny_t_device, ['route' => ['devices.update_tiny_t', $device->id], 'method' => 'PUT']) !!}
    <div class="form-group">
        {{ Form::label('tcal', 'Calibracion de la Medicion (°C)') }}
        {{ Form::number('tcal', null, ['class' => 'form-control', 'default' => 0, 'min' => -5, 'max' => 5, 'step' => 0.01]) }}
    </div>
    <div class="form-group">
        {{ Form::label('t_set_point', 'Temperatura Deseada (°C)') }}
        {{ Form::number('t_set_point', null, ['class' => 'form-control', 'required', 'min' => -30, 'max' => 80, 'step' => 0.01]) }}
    </div>
    <div class="form-group">
        {{ Form::label('tmin', 'Minima Temperatura Permitida (°C)') }}
        {{ Form::number('tmin', null, ['class' => 'form-control', 'required', 'min' => -40, 'max' => 80, 'step' => 0.01]) }}
    </div>
    <div class="form-group">
        {{ Form::label('tmax', 'Maxima Temperatura Permitida (°C)') }}
        {{ Form::number('tmax', null, ['class' => 'form-control', 'required', 'min' => -30, 'max' => 80, 'step' => 0.01]) }}
    </div>
    <div class="form-group">
        {{ Form::label('tdly', 'Retardo al Aviso (minutos)') }}
        {{ Form::number('tdly', null, ['class' => 'form-control', 'required', 'default' => 60, 'min' => 0, 'max' => 360]) }}
    </div>
    @can('devices.log')
        <div class="form-group">
            {{ Form::label('pmin', 'Minima Performance Permitida (°C/h)') }}
            {{ Form::number('pmin', null, ['class' => 'form-control', 'required', 'min' => 0, 'max' => 40, 'step' => 0.01]) }}
        </div>
        <div class="form-group">
            {{ Form::label('pmax', 'Maxima Performance Permitida (°C/h)') }}
            {{ Form::number('pmax', null, ['class' => 'form-control', 'required', 'min' => 0, 'max' => 40, 'step' => 0.01]) }}
        </div>
        <div class="form-group">
            {{ Form::label('pdly', 'Retardo Performance (minutos)') }}
            {{ Form::number('pdly', null, ['class' => 'form-control', 'required', 'default' => 30, 'min' => 0, 'max' => 60]) }}
        </div>
    @endcan
    <div>
        {{ Form::submit('Guardar Cambios', ['class' => 'btn btn-sm btn-primary']) }}
    </div>
    {!! Form::close() !!}
</div>