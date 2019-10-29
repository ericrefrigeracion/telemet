@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    WebHook {{ $webhook->id }}
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>Tipo</td>
                                    <td>{{ $webhook->type }}</td>
                                </tr>
                                <tr>
                                    <td>Usuario de MercadoPago</td>
                                    <td>{{ $webhook->user_id }}</td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection