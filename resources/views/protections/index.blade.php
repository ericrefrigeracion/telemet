@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                <h3>Tipos de Proteccion</h3>
                    @can('protections.create')
                        <a href="{{ route('protections.create') }}" class="btn btn-sm btn-info float-right">Crear Tipo de Proteccion</a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Tipo de Proteccion (slug)</th>
                                <th>Descripcion</th>
                                <th colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($protections as $protection)
                                <tr>
                                    <td>{{ $protection->type }}</td>
                                    <td>{{ $protection->description }}</td>
                                    @can('protections.show')
                                        <td><a href="{{ route('protections.show', $protection->id) }}" class="btn btn-sm btn-success">Ver</a></td>
                                    @endcan
                                    @can('protections.edit')
                                        <td><a href="{{ route('protections.edit', $protection->id) }}" class="btn btn-sm btn-default">Editar</a></td>
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