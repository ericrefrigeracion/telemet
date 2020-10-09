@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Editar tipo de control de topico: <strong>{{ $topic_control_type->id }} - {{ $topic_control_type->name }}</strong>
                </div>
                <div class="card-body justify-content-center">
                    {!! Form::model($topic_control_type, ['route' => ['topic-control-types.update', $topic_control_type->id], 'method' => 'PUT']) !!}
                        <div class="form-group">
                            {{ Form::label('slug', 'Slug para el sistema') }}
                            {{ Form::text('slug', null, ['class' => 'form-control', 'readonly', 'required', 'maxlength' => '10']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('name', 'Nombre del tipo de control') }}
                            {{ Form::text('name', null, ['class' => 'form-control', 'readonly', 'required', 'maxlength' => '15']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('description', 'Descripcion breve de funcionamiento') }}
                            {{ Form::text('description', null, ['class' => 'form-control', 'required', 'maxlength' => '40']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('operation', 'Operador para el sistema') }}
                            {{ Form::text('operation', null, ['class' => 'form-control', 'required', 'maxlength' => '5']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('min', 'Minimo valor permitido') }}
                            {{ Form::number('min', null, ['class' => 'form-control', 'required', 'default' => 0, 'min' => -99, 'max' => 999, 'step' => 1]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('max', 'Maximo valor permitido') }}
                            {{ Form::number('max', null, ['class' => 'form-control', 'required', 'default' => 0, 'min' => -99, 'max' =>999, 'step' => 1]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('step', 'Resolucion necesaria') }}
                            {{ Form::number('step', null, ['class' => 'form-control', 'required', 'default' => 0, 'min' => 0, 'max' => 1, 'step' => 0.01]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('reference', 'Valor por defecto') }}
                            {{ Form::number('reference', null, ['class' => 'form-control', 'required', 'default' => 0, 'min' => -99, 'max' => 999, 'step' => 1]) }}
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