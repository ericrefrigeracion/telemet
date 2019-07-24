@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                                <tr>
                                    <td>Accion</td>
                                    <td>{{ $webhook->action }}</td>
                                </tr>
                                <tr>
                                    <td>ID de pago MercadoPago</td>
                                    <td>{{ $webhook->data_id }}</td>
                                </tr>
                                <tr>
                                    <td>Fecha de creacion MercadoPago</td>
                                    <td>{{ $webhook->date_created }}</td>
                                </tr>
                                <tr>
                                    <td>Fecha de creacion Telemet</td>
                                    <td>{{ $webhook->created_at }}</td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection