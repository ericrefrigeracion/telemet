@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Alertas
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Nuevas Reportes</th>
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
                                        <a href="{{ route('reports.show', $device->id) }}" class="btn btn-sm btn-danger">
                                        {{ $device->alerts_count }}</a>
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