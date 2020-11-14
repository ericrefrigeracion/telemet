@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Crear Topico
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => ['icons.store']]) !!}
                        <div class="form-group">
                            {{ Form::label('name', 'Nombre') }}
                            {{ Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => '15']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('description', 'Descripcion') }}
                            {{ Form::text('description', null, ['class' => 'form-control', 'maxlength' => '30']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('scripts', 'Scripts') }}
                            {{ Form::text('scripts', null, ['class' => 'form-control', 'maxlength' => '40']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('type', 'Tipo de aplicacion') }}
                            {{ Form::text('type', null, ['class' => 'form-control', 'required', 'maxlength' => '15']) }}
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