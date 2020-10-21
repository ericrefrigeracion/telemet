@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                <h3>Relacion Grafico - Topico</h3>
                    @can('display-topics.create')
                        <a href="{{ route('display-topics.create') }}" class="btn btn-sm btn-info float-right">Crear Relacion</a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Grafico</th>
                                <th>Topico</th>
                                <th colspan="3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($display_topics as $display_topic)
                                <tr>
                                    <td>{{ $display_topic->id }}</td>
                                    <td>{{ $display_topic->display->name }}</td>
                                    <td>{{ $display_topic->topic->name }}</td>
                                    @can('display-topics.show')
                                        <td><a href="{{ route('display-topics.show', $display_topic->id) }}" class="btn btn-sm btn-success">Ver</a></td>
                                    @endcan
                                    @can('display-topics.edit')
                                        <td><a href="{{ route('display-topics.edit', $display_topic->id) }}" class="btn btn-sm btn-info">Editar</a></td>
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