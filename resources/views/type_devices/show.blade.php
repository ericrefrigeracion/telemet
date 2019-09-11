@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Dispositivo tipo - <strong>{{ $type_device->description }}</strong>
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
                                    <td>{{ $type_device->id }}</td>
                                </tr>
                                <tr>
                                    <td>Valor</td>
                                    <td>{{ $type_device->price }}</td>
                                </tr>
                                <tr>
                                    <td>Para dispositivo modelo</td>
                                    <td>{{ $type_device->type_device_id }}</td>
                                </tr>
                                <tr>
                                    <td>Dias de servicio</td>
                                    <td>{{ $type_device->days }}</td>
                                </tr>
                                <tr>
                                    <td>Descripcion</td>
                                    <td>{{ $type_device->description }}</td>
                                </tr>
                                <tr>
                                    <td>Tipo de pago Excluido</td>
                                    <td>{{ $type_device->excluded }}</td>
                                </tr>
                                <tr>
                                    <td>Maxima cantidad de Cuotas</td>
                                    <td>{{ $type_device->installments }}</td>
                                </tr>
                                <tr>
                                    <td>Creado</td>
                                    <td>{{ $type_device->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Editado</td>
                                    <td>{{ $type_device->updated_at }}</td>
                                </tr>

                        </tbody>
                    </table>
                    @can('type_devices.destroy')
                        {!! Form::open(['route' => ['type_devices.destroy', $type_device->id], 'method' => 'DELETE']) !!}
                            <button class="btn btn-sm btn-danger float-right">Eliminar Tipo de Dispositivo</button>
                        {!! Form::close() !!}
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection