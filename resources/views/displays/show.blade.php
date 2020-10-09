@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Tipo de visualizacion - <strong>{{ $display->name }}</strong>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $display->id }}</td>
                                </tr>
                                <tr>
                                    <td>Nombre</td>
                                    <td>{{ $display->name }}</td>
                                </tr>
                                <tr>
                                    <td>Descripcion</td>
                                    <td>{{ $display->description }}</td>
                                </tr>
                                <tr>
                                    <td>Slug</td>
                                    <td>{{ $display->slug }}</td>
                                </tr>
                                <tr>
                                    <td>Script</td>
                                    <td>{{ $display->script }}</td>
                                </tr>
                                <tr>
                                    <td>Creado</td>
                                    <td>{{ $display->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Editado</td>
                                    <td>{{ $display->updated_at }}</td>
                                </tr>
                        </tbody>
                    </table>
                    @can('displays.index')
                        <a href="{{ route('displays.index') }}"><button class="btn btn-sm btn-success float-left">Volver</button></a>
                    @endcan
                    @can('displays.destroy')
                        {!! Form::open(['route' => ['displays.destroy', $display->id], 'method' => 'DELETE']) !!}
                            <button class="btn btn-sm btn-danger float-right">Eliminar Visualizacion</button>
                        {!! Form::close() !!}
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection