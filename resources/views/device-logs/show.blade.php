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
                                    <th colspan="1">Fecha</th>
                                    <th colspan="6">Descripcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($device_logs as $device_log)
                                    <tr>
                                        <td colspan="1">{{ $device_log->created_at->toFormattedDateString() }}</td>
                                        <td colspan="6">{{ $device_log->content }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td colspan="5">
                                        <div class="form-group">
                                            {{ Form::text('content', null, ['class' => 'form-control', 'required']) }}
                                        </div>
                                    </td>
                                    <td colspan="1">
                                        <div>
                                            {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-success mt-1']) }}
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