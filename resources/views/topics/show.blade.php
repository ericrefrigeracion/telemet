@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Topico - <strong>{{ $topic->name }}</strong>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $topic->id }}</td>
                                </tr>
                                <tr>
                                    <td>Slug</td>
                                    <td>{{ $topic->slug }}</td>
                                </tr>
                                <tr>
                                    <td>Unidad</td>
                                    <td>{{ $topic->unit }}</td>
                                </tr>
                                <tr>
                                    <td>Nombre</td>
                                    <td>{{ $topic->name }}</td>
                                </tr>
                                <tr>
                                    <td>Decimales</td>
                                    <td>{{ $topic->decimals }}</td>
                                </tr>
                                <tr>
                                    <td>Color</td>
                                    <td>{{ $topic->color }}</td>
                                </tr>
                                <tr>
                                    <td>Relleno</td>
                                    <td>{{ $topic->filled }}</td>
                                </tr>
                                <tr>
                                    <td>Creado</td>
                                    <td>{{ $topic->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Editado</td>
                                    <td>{{ $topic->updated_at }}</td>
                                </tr>
                        </tbody>
                    </table>
                    @can('topics.index')
                        <a href="{{ route('topics.index') }}"><button class="btn btn-sm btn-success float-left">Volver</button></a>
                    @endcan
                    @can('topics.destroy')
                        {!! Form::open(['route' => ['topics.destroy', $topic->id], 'method' => 'DELETE']) !!}
                            <button class="btn btn-sm btn-danger float-right">Eliminar Item</button>
                        {!! Form::close() !!}
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection