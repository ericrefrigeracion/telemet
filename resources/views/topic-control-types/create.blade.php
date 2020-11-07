@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Crear Tipo de control para un topico
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => ['topic-control-types.store']]) !!}
                        <div class="form-group">
                            {{ Form::label('slug', 'Slug para el sistema') }}
                            {{ Form::text('slug', null, ['class' => 'form-control', 'required', 'maxlength' => '10']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('name', 'Nombre del tipo de control') }}
                            {{ Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => '15']) }}
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
                            {{ Form::label('default', 'Valor por defecto') }}
                            {{ Form::number('default', null, ['class' => 'form-control', 'required', 'default' => 0, 'min' => -99, 'max' => 999, 'step' => 0.1]) }}
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