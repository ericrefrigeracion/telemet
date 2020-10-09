@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Opciones de configuracion de <strong>{{ $device->id }} - {{ $device->name }}</strong> ({{ $device->description }}).
                    </div>
                    <div class="card-body justify-content-center">
                            <h3>Valores del Dispositivo</h3><br>

                                @foreach($device->device_configurations as $device_configurations)
                                    {!! Form::model($device_configurations, ['route' => ['device-configurations.update', $device_configurations->id], 'method' => 'PUT']) !!}

                                            <div class="form-group row">
                                                <div class="col-2">
                                                    {{ Form::label('value', $device_configurations->topic_control_type->name) }}
                                                </div>
                                                <div class="col-2">
                                                    {{ Form::number('value', null, ['class' => 'form-control', 'required', 'min' => $device_configurations->topic_control_type->min, 'max' => $device_configurations->topic_control_type->max, 'step' => $device_configurations->topic_control_type->step]) }}
                                                </div>
                                                <div class="col-2">
                                                    {{ Form::submit('Guardar Cambios', ['class' => 'btn btn-sm btn-primary mt-1']) }}
                                                </div>
                                            </div>

                                        {!! Form::close() !!}
                                @endforeach
                        @can('devices.show')
                            <a href="{{ route('devices.show', $device->id) }}" class="btn btn-sm btn-success float-left">Volver</a>
                        @endcan

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection