@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Dispositivos
                    @can('devices.create')
                        <a href="{{ route('devices.create')}}" class="btn btn-primary btn-sm float-right">
                            Agregar Dispositivo
                        </a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="10px">ID</th>
                                <th>Nombre</th>
                                <th>Agregado</th>
                                <th colspan="4">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dispositivos as $dispositivo)
                                <tr>
                                    <td>{{ $dispositivo->id }}</td>
                                    <td>{{ $dispositivo->name }}</td>
                                    <td>{{ $dispositivo->created_at }}</td>
                                    <td>
                                        @can('receptions.show')
                                            <a href="{{ route('receptions.show', $dispositivo->id) }}" class="btn btn-sm btn-primary">Metricas</a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('device-configurations.edit')
                                            <a href="{{ route('device-configurations.edit', $dispositivo->id) }}" class="btn btn-sm btn-danger">Monitoreo</a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('devices.edit')
                                            <a href="{{ route('devices.edit', $dispositivo->id) }}" class="btn btn-sm btn-default">Informacion</a>
                                        @endcan
                                    </td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection