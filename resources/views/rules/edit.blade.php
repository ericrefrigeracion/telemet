@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Editar Regla: <strong>{{ $rule->day }}, de {{ $rule->start_time }}hs a {{ $rule->stop_time }}hs.</strong>
                </div>
                <div class="card-body justify-content-center">
                    {!! Form::model($rule, ['route' => ['rules.update', $rule->id], 'method' => 'PUT']) !!}
                        {{ Form::hidden('device_id', $rule->device_id) }}
                        <div class="form-group">
                            {{ Form::label('day', 'Dia Permitido') }}
                            {{ Form::select('day', [
                                '' => 'Seleccione un Dia',
                                'Domingo' => 'Domingo',
                                'Lunes' => 'Lunes',
                                'Martes' => 'Martes',
                                'Miercoles' => 'Miercoles',
                                'Jueves' => 'Jueves',
                                'Viernes' => 'Viernes',
                                'Sabado' => 'Sabado',
                                'Lunes a Viernes' => 'Lunes a Viernes',
                                'Todos los Dias' => 'Todos los Dias',
                            ], null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('start_time', 'Momento en que se desactiva el monitoreo') }}
                            {{ Form::text('start_time', null, ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('stop_time', 'Momento en que se vuelve a activar el monitoreo') }}
                            {{ Form::text('stop_time', null, ['class' => 'form-control', 'required']) }}
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