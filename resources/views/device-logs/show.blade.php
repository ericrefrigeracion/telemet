@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Informacion de dispositivo {{ $device->id }} - {{ $device->name }}
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => ['device-logs.store']]) !!}
                        {{ Form::hidden('device_id', $device->id) }}
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th colspan="3">Descripcion</th>
                                    <th>Creado por</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($device_logs as $device_log)
                                    <tr>
                                        <td>{{ $device_log->created_at->toFormattedDateString() }}</td>
                                        <td colspan="3">{{ $device_log->content }}</td>
                                        <td>{{ $device_log->user_name }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4">
                                        <div class="form-group">
                                            {{ Form::text('content', null, ['class' => 'form-control', 'required']) }}
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            {{ Form::submit('Guardar Informacion', ['class' => 'btn btn-sm btn-block btn-success mt-1']) }}
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection