@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Editar Tipo de Proteccion {{ $protection->type }}
                </div>
                <div class="card-body">
                    {!! Form::model($protection, ['route' => ['protections.update', $protection->id], 'method' => 'PUT']) !!}
                        <div class="form-group">
                            {{ Form::label('description', 'Descripcion') }}
                            {{ Form::text('description', null, ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('class', 'Codigo html del Icono') }}
                            {{ Form::text('class', null, ['class' => 'form-control', 'required']) }}
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