@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                <h3>Iconos</h3>
                    @can('icons.create')
                        <a href="{{ route('icons.create') }}" class="btn btn-sm btn-info float-right">Crear Icono</a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Icono</th>
                                <th>Tipo de aplicacion</th>
                                <th colspan="3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($icons as $icon)
                                <tr>
                                    <td>{{ $icon->id }}</td>
                                    <td>{{ $icon->name }}</td>
                                    <td>{!! $icon->scripts !!}</td>
                                    <td>{{ $icon->type }}</td>
                                    @can('icons.show')
                                        <td><a href="{{ route('icons.show', $icon->id) }}" class="btn btn-sm btn-success">Ver</a></td>
                                    @endcan
                                    @can('icons.edit')
                                        <td><a href="{{ route('icons.edit', $icon->id) }}" class="btn btn-sm btn-info">Editar</a></td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $icons->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection