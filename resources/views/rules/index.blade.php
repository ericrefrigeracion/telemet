@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Horarios programados en los que se desactiva el monitoreo de los dispositivos
                </div>
                @foreach($devices as $device)
                <div class="card-body">
                    Horarios Permitidos para {{ $device->name }} ({{ $device->description }})
                    {!! Form::open(['route' => ['rules.store']]) !!}
                        {{ Form::hidden('device_id', $device->id) }}
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Dia de la Semana</th>
                                    <th>Hora de Inicio</th>
                                    <th>Hora de Finalizacion</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($device->rules as $rule)
                                    <tr>
                                        <td>{{ $rule->day }}</td>
                                        <td>{{ $rule->start_time }}</td>
                                        <td>{{ $rule->stop_time }}</td>
                                        @can('rules.show')
                                            <td><a href="{{ route('rules.show', $rule->id) }}" class="btn btn-sm btn-default">Ver</a></td>
                                        @endcan
                                        @can('rules.edit')
                                            <td><a href="{{ route('rules.edit', $rule->id) }}" class="btn btn-sm btn-default">Editar</a></td>
                                        @endcan
                                    </tr>
                                @endforeach
                                    <tr>
                                        <td>
                                            <div class="form-group">
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
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                {{ Form::time('start_time', null, ['class' => 'form-control']) }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                {{ Form::time('stop_time', null, ['class' => 'form-control',]) }}
                                            </div>
                                        </td>
                                        <td colspan="2">
                                        @can('rules.create')
                                            <div>
                                                {{ Form::submit('Crear Regla', ['class' => 'btn btn-sm btn-block btn-success mt-1']) }}
                                            </div>
                                        @endcan
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    {!! Form::close() !!}


                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection