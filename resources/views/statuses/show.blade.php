@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Estado - <strong>{{ $status->name }}</strong>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $status->id }}</td>
                                </tr>
                                <tr>
                                    <td>Icono</td>
                                    <td>{!! $status->icon->scripts !!}</td>
                                </tr>
                                <tr>
                                    <td>Nombre</td>
                                    <td>{{ $status->name }}</td>
                                </tr>
                                <tr>
                                    <td>Descripcion</td>
                                    <td>{{ $status->description }}</td>
                                </tr>
                                <tr>
                                    <td>Scripts</td>
                                    <td>{{ $status->scripts }}</td>
                                </tr>
                                <tr>
                                    <td>Creado</td>
                                    <td>{{ $status->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Editado</td>
                                    <td>{{ $status->updated_at }}</td>
                                </tr>
                        </tbody>
                    </table>
                    @can('statuses.index')
                        <a href="{{ route('statuses.index') }}"><button class="btn btn-sm btn-success float-left">Volver</button></a>
                    @endcan
                    @can('statuses.destroy')
                        {!! Form::open(['route' => ['statuses.destroy', $status->id], 'method' => 'DELETE']) !!}
                            <button class="btn btn-sm btn-danger float-right">Eliminar Status</button>
                        {!! Form::close() !!}
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection