@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Editar Icono: <strong>{{ $icon->id }} - {{ $icon->name }}</strong>
                </div>
                <div class="card-body justify-content-center">
                    {!! Form::model($icon, ['route' => ['icons.update', $icon->id], 'method' => 'PUT']) !!}
                        <div class="form-group">
                            {{ Form::label('name', 'Nombre') }}
                            {{ Form::text('name', null, ['class' => 'form-control', 'readonly']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('description', 'Descripcion') }}
                            {{ Form::text('description', null, ['class' => 'form-control', 'maxlength' => '10']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('scripts', 'Scripts') }}
                            {{ Form::text('scripts', null, ['class' => 'form-control', 'required', 'maxlength' => '15']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('type', 'Tipo deaplicacion') }}
                            {{ Form::text('type', null, ['class' => 'form-control', 'required', 'maxlength' => '15']) }}
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