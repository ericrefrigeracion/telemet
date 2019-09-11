@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Precios - <strong>Item {{ $price->id }}</strong>
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
                                    <td>{{ $price->id }}</td>
                                </tr>
                                <tr>
                                    <td>Valor</td>
                                    <td>{{ $price->price }}</td>
                                </tr>
                                <tr>
                                    <td>Para dispositivo modelo</td>
                                    <td>{{ $price->type_device_id }}</td>
                                </tr>
                                <tr>
                                    <td>Dias de servicio</td>
                                    <td>{{ $price->days }}</td>
                                </tr>
                                <tr>
                                    <td>Descripcion</td>
                                    <td>{{ $price->description }}</td>
                                </tr>
                                <tr>
                                    <td>Tipo de pago Excluido</td>
                                    <td>{{ $price->excluded }}</td>
                                </tr>
                                <tr>
                                    <td>Maxima cantidad de Cuotas</td>
                                    <td>{{ $price->installments }}</td>
                                </tr>
                                <tr>
                                    <td>Creado</td>
                                    <td>{{ $price->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Editado</td>
                                    <td>{{ $price->updated_at }}</td>
                                </tr>

                        </tbody>
                    </table>
                    @can('prices.destroy')
                        {!! Form::open(['route' => ['prices.destroy', $price->id], 'method' => 'DELETE']) !!}
                            <button class="btn btn-sm btn-danger float-right">Eliminar Item</button>
                        {!! Form::close() !!}
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection