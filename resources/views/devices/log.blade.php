@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Logs dispositivo {{ $device->id }} - {{ $device->name }}
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Log</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($device_logs as $device_log)
                                <tr>
                                    <td>{{ $device_log->id }}</td>
                                    <td>{{ $device_log->log }}</td>
                                    <td>{{ $device_log->created_at }}</td>
                                 </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $device_logs->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection