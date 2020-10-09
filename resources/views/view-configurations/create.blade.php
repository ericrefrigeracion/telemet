@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Crear Configuracion de vista
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => ['view-configurations.store']]) !!}
                        <div class="form-group">
                            {{ Form::label('type_device_id', 'Modelo de dispositivo') }}
                            {{ Form::select('type_device_id', $type_devices, null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('display_id', 'Grafico') }}
                            {{ Form::select('display_id', $displays, null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('topic_id', 'Topico') }}
                            {{ Form::select('topic_id', $topics, null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('order', 'Orden en la vista') }}
                            {{ Form::number('order', null, ['class' => 'form-control', 'required', 'default' => 1, 'min' => 1, 'max' => 20, 'step' => 1]) }}
                        </div>
                        <div>
                            {{ Form::submit('Crear Item', ['class' => 'btn btn-sm btn-primary']) }}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection