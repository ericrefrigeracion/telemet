@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Icono - <strong>{{ $icon->name }}</strong>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $icon->id }}</td>
                                </tr>
                                <tr>
                                    <td>Nombre</td>
                                    <td>{{ $icon->name }}</td>
                                </tr>
                                <tr>
                                    <td>Descripcion</td>
                                    <td>{{ $icon->description }}</td>
                                </tr>
                                <tr>
                                    <td>Icono</td>
                                    <td>{!! $icon->scripts !!}</td>
                                </tr>
                                <tr>
                                    <td>Tipo deaplicacion</td>
                                    <td>{{ $icon->type }}</td>
                                </tr>
                                <tr>
                                    <td>Creado</td>
                                    <td>{{ $icon->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Editado</td>
                                    <td>{{ $icon->updated_at }}</td>
                                </tr>
                        </tbody>
                    </table>
                    @can('icons.index')
                        <a href="{{ route('icons.index') }}"><button class="btn btn-sm btn-success float-left">Volver</button></a>
                    @endcan
                    @can('icons.destroy')
                        {!! Form::open(['route' => ['icons.destroy', $icon->id], 'method' => 'DELETE']) !!}
                            <button class="btn btn-sm btn-danger float-right">Eliminar Icono</button>
                        {!! Form::close() !!}
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection