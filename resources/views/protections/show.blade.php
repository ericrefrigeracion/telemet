@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Proteccion tipo - <strong>{{ $protection->type }}</strong>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>VALOR</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $protection->id }}</td>
                                </tr>
                                <tr>
                                    <td>Tipo</td>
                                    <td>{{ $protection->type }}</td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>{{ $protection->description }}</td>
                                </tr>
                                <tr>
                                    <td>Icono</td>
                                    <td><i class="{{ $protection->class }}"></i></td>
                                </tr>
                                <tr>
                                    <td>Creado</td>
                                    <td>{{ $protection->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Editado</td>
                                    <td>{{ $protection->updated_at }}</td>
                                </tr>
                        </tbody>
                    </table>
                    @can('protections.destroy')
                        {!! Form::open(['route' => ['protections.destroy', $protection->id], 'method' => 'DELETE']) !!}
                            <button class="btn btn-sm btn-danger float-right">Eliminar Tipo de Proteccion</button>
                        {!! Form::close() !!}
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection