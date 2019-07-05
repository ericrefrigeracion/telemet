@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Centinela - <strong>Pago del dia {{ $pay->created_at }}</strong>
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
                                    <td>{{ $pay->id }}</td>
                                </tr>
                                <tr>
                                    <td>Dispositivo pagado:</td>
                                    <td>{{ $pay->device_id }}</td>
                                </tr>
                                <tr>
                                    <td>Medio de pago:</td>
                                    <td>{{ $pay->method }}</td>
                                </tr>
                                <tr>
                                    <td>Monto de la operacion:</td>
                                    <td>{{ $pay->amount }}</td>
                                </tr>
                                <tr>
                                    <td>Estado del pago:</td>
                                    <td>{{ $pay->status }}</td>
                                </tr>
                                <tr>
                                    <td>Vigente hasta:</td>
                                    <td>{{ $pay->vigent_until }}</td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection