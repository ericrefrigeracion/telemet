@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Alertas
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                @can('devices.all')
                                    <th>ID</th>
                                @endcan
                                <th>Nombre</th>
                                <th>Nuevas Alertas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($devices as $device)
                                <tr>
                                    @can('devices.all')
                                        <td>{{ $device->id }}</td>
                                    @endcan
                                    <td>
                                        @can('devices.show')
                                                <a href="{{ route('devices.show', $device->id) }}" class="btn btn-sm btn-default">
                                        @endcan
                                        {{ $device->name }}
                                        @can('devices.show')</a>@endcan
                                    </td>
                                    <td>
                                        @can('alerts.show')
                                                <a href="{{ route('alerts.show', $device->id) }}" class="btn btn-sm btn-danger">
                                        @endcan
                                        {{ $device->alerts_count }}
                                        @can('alerts.show')</a>@endcan
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