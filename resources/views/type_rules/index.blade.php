@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                <h3>Tipos de Dispositivos</h3>
                    @can('prices.create')
                        <a href="{{ route('prices.create') }}" class="btn btn-sm btn-info float-right">Crear Tipo de Dispositivo</a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Descripcion</th>
                                <th>Modelo</th>
                                <th colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prices as $price)
                                <tr>
                                    <td>{{ $price->description }}</td>
                                    <td>{{ $price->type_device_id }}</td>
                                    @can('prices.show')
                                        <td><a href="{{ route('prices.show', $price->id) }}" class="btn btn-sm btn-success">Ver</a></td>
                                    @endcan
                                    @can('prices.edit')
                                        <td><a href="{{ route('prices.edit', $price->id) }}" class="btn btn-sm btn-default">Editar</a></td>
                                    @endcan
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