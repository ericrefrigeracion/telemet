@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Dispositivos
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($devices as $device)
                                <tr>
                                    @can('devices.show')
                                        <td>
                                            <a href="{{ route('devices.show', $device->id) }}" class="btn btn-sm btn-default">{{ $device->name }}</a>
                                        </td>
                                    @endcan
                                    @can('receptions.show')
                                        <td>
                                            <a href="{{ route('receptions.show', $device->id) }}" class="btn btn-sm btn-primary">Metricas</a>
                                        </td>
                                    @endcan
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