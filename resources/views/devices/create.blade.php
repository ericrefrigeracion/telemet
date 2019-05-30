@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Agregar Dispositivo
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => ['devices.store']]) !!}
                        <div class="form-group">
                            {{ Form::label('id', 'ID del dispositivo') }}
                            {{ Form::number('id', null, ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('name', 'Nombre del dispositivo') }}
                            {{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
                        </div>
                        <div>
                            {{ Form::submit('Crear Dispositivo', ['class' => 'btn btn-sm btn-primary']) }}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection