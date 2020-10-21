@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Relacion - <strong>{{ $display_topic->display->name }} - {{ $display_topic->topic->name }}</strong>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $display_topic->id }}</td>
                                </tr>
                                <tr>
                                    <td>grafico</td>
                                    <td>{{ $display_topic->display->name }}</td>
                                </tr>
                                <tr>
                                    <td>grafico</td>
                                    <td>{{ $display_topic->topic->name }}</td>
                                </tr>
                                <tr>
                                    <td>Creado</td>
                                    <td>{{ $display_topic->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Editado</td>
                                    <td>{{ $display_topic->updated_at }}</td>
                                </tr>
                        </tbody>
                    </table>
                    @can('display-topics.index')
                        <a href="{{ route('display-topics.index') }}"><button class="btn btn-sm btn-success float-left">Volver</button></a>
                    @endcan
                    @can('display-topics.destroy')
                        {!! Form::open(['route' => ['display-topics.destroy', $display_topic->id], 'method' => 'DELETE']) !!}
                            <button class="btn btn-sm btn-danger float-right">Eliminar Visualizacion</button>
                        {!! Form::close() !!}
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection