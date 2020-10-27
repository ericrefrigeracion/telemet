@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Configurar Tipo de Dispositivo {{ $type_device->model }} (Prefijo {{ $type_device->prefix }})
                </div>
                <div class="card-body">
                    @foreach($type_device->type_device_configurations as $type_device_configuration)

                        <div class="row mb-2">
                            <div class="col-md-2">
                                Topico de entrada:
                            </div>
                            <div class="col-md-2">
                                {{ $type_device_configuration->topic->name }}
                            </div>
                            <div class="col-md-3">
                                {{ $type_device_configuration->topic_control_type->name }}
                            </div>
                            @can('devices.destroy')
                            <div class="col-md-2">
                                {!! Form::open(['route' => ['type-device-configurations.destroy', $type_device_configuration->id], 'method' => 'DELETE']) !!}
                                    <button class="btn btn-sm btn-danger mt-1">Eliminar Item</button>
                                {!! Form::close() !!}
                            </div>
                            @endcan
                        </div>
                    @endforeach

                    {!! Form::open(['route' => ['type-device-configurations.store']]) !!}
                    {{ Form::hidden('type_device_id', $type_device->id) }}

                        <div class="form-group row mt-2">
                            <div class="col-md-2">
                                {{ Form::label('topic', 'Topico de entrada:') }}
                            </div>
                            <div class="col-md-2">
                                {{ Form::select('topic_id', $topics, null, ['class' => 'form-control']) }}
                            </div>
                            <div class="col-md-3">
                                {{ Form::select('topic_control_type_id', $topic_control_types, null, ['class' => 'form-control']) }}
                            </div>
                            <div class="col-md-2">
                                {{ Form::submit('Crear Nuevo Item', ['class' => 'btn btn-sm btn-success mt-1']) }}
                            </div>
                        </div>
                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>
</div>
@endsection