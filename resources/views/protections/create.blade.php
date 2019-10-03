@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Crear Tipo Proteccion
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => ['protections.store']]) !!}
                        <div class="form-group">
                            {{ Form::label('type', 'Tipo de Proteccion (slug)') }}
                            {{ Form::text('type', null, ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('description', 'Descripcion') }}
                            {{ Form::text('description', null, ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('class', 'Codigo html del Icono') }}
                            {{ Form::text('class', null, ['class' => 'form-control', 'required']) }}
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