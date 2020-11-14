@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Editar topico: <strong>{{ $topic->id }} - {{ $topic->name }}</strong>
                </div>
                <div class="card-body justify-content-center">
                    {!! Form::model($topic, ['route' => ['topics.update', $topic->id], 'method' => 'PUT']) !!}
                        <div class="form-group">
                            {{ Form::label('slug', 'Slug para el sistema') }}
                            {{ Form::text('slug', null, ['class' => 'form-control', 'required', 'maxlength' => '20']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('unit', 'Unida de media') }}
                            {{ Form::text('unit', null, ['class' => 'form-control', 'maxlength' => '10']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('name', 'Nombre de la Magnitud') }}
                            {{ Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => '20']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('decimals', 'Decimales') }}
                            {{ Form::number('decimals', null, ['class' => 'form-control', 'required', 'default' => 0, 'min' => 0, 'max' =>3, 'step' => 1]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('icon_id', 'Icono') }}
                            {{ Form::select('icon_id', $icons, null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('color', 'Color (rgba)') }}
                            {{ Form::text('color', null, ['class' => 'form-control', 'required', 'maxlength' => '25']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('filled', 'Area de la curva') }}<br>
                            {{ Form::checkbox('filled', '1') }} Con relleno <br>
                            {{ Form::checkbox('filled', '0') }} Sin relleno
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