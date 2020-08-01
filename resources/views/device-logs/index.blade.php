@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Informacion de todos los dispositivos
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Informes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($devices as $device)
                                <tr>
                                    <td>
                                        <a href="{{ route('devices.show', $device->id) }}" class="btn btn-sm btn-default">
                                        {{ $device->name }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('device-logs.show', $device->id) }}" class="btn btn-sm btn-danger">
                                        {{ $device->device_logs_count }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $devices->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection