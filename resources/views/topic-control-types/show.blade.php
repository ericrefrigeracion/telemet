@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Control para topicos - <strong>{{ $topic_control_type->name }}</strong>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $topic_control_type->id }}</td>
                                </tr>
                                <tr>
                                    <td>Slug</td>
                                    <td>{{ $topic_control_type->slug }}</td>
                                </tr>
                                <tr>
                                    <td>Nombre</td>
                                    <td>{{ $topic_control_type->name }}</td>
                                </tr>
                                <tr>
                                    <td>Descripcion</td>
                                    <td>{{ $topic_control_type->description }}</td>
                                </tr>
                                <tr>
                                    <td>Descripcion</td>
                                    <td>{{ $topic_control_type->description }}</td>
                                </tr>
                                <tr>
                                    <td>Operacion Logica que realiza</td>
                                    <td>{{ $topic_control_type->operation }}</td>
                                </tr>
                                <tr>
                                    <td>Minimo valor permitido</td>
                                    <td>{{ $topic_control_type->min }}</td>
                                </tr>
                                <tr>
                                    <td>Maximo valor permitido</td>
                                    <td>{{ $topic_control_type->max }}</td>
                                </tr>
                                <tr>
                                    <td>Resolucion necesaria</td>
                                    <td>{{ $topic_control_type->step }}</td>
                                </tr>
                                <tr>
                                    <td>Valor por defecto</td>
                                    <td>{{ $topic_control_type->default }}</td>
                                </tr>
                                <tr>
                                    <td>Creado</td>
                                    <td>{{ $topic_control_type->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Editado</td>
                                    <td>{{ $topic_control_type->updated_at }}</td>
                                </tr>
                        </tbody>
                    </table>
                    @can('topic-control-types.index')
                        <a href="{{ route('topic-control-types.index') }}"><button class="btn btn-sm btn-success float-left">Volver</button></a>
                    @endcan
                    @can('topic-control-types.destroy')
                        {!! Form::open(['route' => ['topic-control-types.destroy', $topic_control_type->id], 'method' => 'DELETE']) !!}
                            <button class="btn btn-sm btn-danger float-right">Eliminar Item</button>
                        {!! Form::close() !!}
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection