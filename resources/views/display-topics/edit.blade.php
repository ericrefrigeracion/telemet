@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Editar tipo Visualizacion: <strong>{{ $display_topic->id }} - {{ $display_topic->name }}</strong>
                </div>
                <div class="card-body justify-content-center">
                    {!! Form::model($display_topic, ['route' => ['display-topics.update', $display_topic->id], 'method' => 'PUT']) !!}
                        <div class="form-group">
                            {{ Form::label('display_id', 'Grafico') }}
                            {{ Form::select('display_id', $displays, null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('topic_id', 'Topico') }}
                            {{ Form::select('topic_id', $topics, null, ['class' => 'form-control']) }}
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