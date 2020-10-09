@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                <h3>Topicos</h3>
                    @can('topics.create')
                        <a href="{{ route('topics.create') }}" class="btn btn-sm btn-info float-right">Crear Topico</a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Slug</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th colspan="3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topics as $topic)
                                <tr>
                                    <td>{{ $topic->id }}</td>
                                    <td>{{ $topic->slug }}</td>
                                    <td>{{ $topic->name }}</td>
                                    <td>{{ $topic->unit }}</td>
                                    @can('topics.show')
                                        <td><a href="{{ route('topics.show', $topic->id) }}" class="btn btn-sm btn-success">Ver</a></td>
                                    @endcan
                                    @can('topics.edit')
                                        <td><a href="{{ route('topics.edit', $topic->id) }}" class="btn btn-sm btn-info">Editar</a></td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $topics->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection