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
                                    <td>Monto de la operacion:</td>
                                    <td>${{ $pay->item_amount }}</td>
                                </tr>
                                <tr>
                                    <td>Tipo de pago:</td>
                                    <td>{{ $pay->payment_type }}</td>
                                </tr>
                                <tr>
                                    <td>Operacion N°:</td>
                                    <td>{{ $pay->collection_id }}</td>
                                </tr>
                                <tr>
                                    <td>Estado del pago:</td>
                                    <td>{{ $pay->collection_status }}</td>
                                </tr>
                                <tr>
                                    <td>Vigente hasta:</td>
                                    <td>{{ $pay->valid_at->toFormattedDateString() }}</td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection