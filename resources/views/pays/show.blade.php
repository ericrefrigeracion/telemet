@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4>Centinela - <strong>Pago del dia {{ $pay->created_at }}</strong></h4>
                    <p>{{$pay->description}}</p>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
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
                                    <td>Item:</td>
                                    <td>{{ $pay->price_id }}</td>
                                </tr>
                                <tr>
                                    <td>Usuario:</td>
                                    <td>${{ $pay->payment_id }}</td>
                                </tr>
                                <tr>
                                    <td>Tipo de pago:</td>
                                    <td>{{ $pay->payment_type }}</td>
                                </tr>
                                <tr>
                                    <td>Operacion Tipo:</td>
                                    <td>{{ $pay->operation_type }}</td>
                                </tr>
                                <tr>
                                    <td>Tipo de pago:</td>
                                    <td>{{ $pay->payment_type }}</td>
                                </tr>
                                <tr>
                                    <td>Estado del pago:</td>
                                    <td>{{ $pay->status }}</td>
                                </tr>
                                <tr>
                                    <td>Detalle del pago:</td>
                                    <td>{{ $pay->detail }}</td>
                                </tr>
                                <tr>
                                    <td>Pago verificado:</td>
                                    <td>{{ $pay->verified_by_sistem }}</td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection