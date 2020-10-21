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
                    {!! Form::open(['route' => ['display-topics.store']]) !!}
                        <div class="form-group">
                            {{ Form::label('display_id', 'Grafico') }}
                            {{ Form::select('display_id', $displays, null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('topic_id', 'Topico') }}
                            {{ Form::select('topic_id', $topics, null, ['class' => 'form-control']) }}
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