@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Dispositivo tipo - <strong>{{ $type_device->model }}</strong>
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
                                    <td>Prefijo</td>
                                    <td>{{ $type_device->prefix }}</td>
                                </tr>
                                <tr>
                                    <td>Modelo</td>
                                    <td>{{ $type_device->model }}</td>
                                </tr>
                                <tr>
                                    <td>Descripcion</td>
                                    <td>{{ $type_device->description }}</td>
                                </tr>
                                <tr>
                                    <td>Creado</td>
                                    <td>{{ $type_device->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Editado</td>
                                    <td>{{ $type_device->updated_at }}</td>
                                </tr>
                                @if(isset($type_device->data01_unit))
                                    <tr>
                                        <td>Campo 01 Unidad</td>
                                        <td>{{ $type_device->data01_unit }}</td>
                                    </tr>
                                    <tr>
                                        <td>Campo 01 Descripcion</td>
                                        <td>{{ $type_device->data01_name }}</td>
                                    </tr>
                                @endif
                                @if(isset($type_device->data02_unit))
                                    <tr>
                                        <td>Campo 02 Unidad</td>
                                        <td>{{ $type_device->data02_unit }}</td>
                                    </tr>
                                    <tr>
                                        <td>Campo 02 Descripcion</td>
                                        <td>{{ $type_device->data02_name }}</td>
                                    </tr>
                                @endif
                                @if(isset($type_device->data03_unit))
                                    <tr>
                                        <td>Campo 03 Unidad</td>
                                        <td>{{ $type_device->data03_unit }}</td>
                                    </tr>
                                    <tr>
                                        <td>Campo 03 Descripcion</td>
                                        <td>{{ $type_device->data03_name }}</td>
                                    </tr>
                                @endif
                                @if(isset($type_device->data04_unit))
                                    <tr>
                                        <td>Campo 04 Unidad</td>
                                        <td>{{ $type_device->data04_unit }}</td>
                                    </tr>
                                    <tr>
                                        <td>Campo 04 Descripcion</td>
                                        <td>{{ $type_device->data04_name }}</td>
                                    </tr>
                                @endif
                                @if(isset($type_device->data05_unit))
                                    <tr>
                                        <td>Campo 05 Unidad</td>
                                        <td>{{ $type_device->data05_unit }}</td>
                                    </tr>
                                    <tr>
                                        <td>Campo 05 Descripcion</td>
                                        <td>{{ $type_device->data05_name }}</td>
                                    </tr>
                                @endif
                                @if(isset($type_device->data06_unit))
                                    <tr>
                                        <td>Campo 06 Unidad</td>
                                        <td>{{ $type_device->data06_unit }}</td>
                                    </tr>
                                    <tr>
                                        <td>Campo 06 Descripcion</td>
                                        <td>{{ $type_device->data06_name }}</td>
                                    </tr>
                                @endif
                                @if(isset($type_device->data07_unit))
                                    <tr>
                                        <td>Campo 07 Unidad</td>
                                        <td>{{ $type_device->data07_unit }}</td>
                                    </tr>
                                    <tr>
                                        <td>Campo 07 Descripcion</td>
                                        <td>{{ $type_device->data07_name }}</td>
                                    </tr>
                                @endif
                                @if(isset($type_device->data08_unit))
                                    <tr>
                                        <td>Campo 08 Unidad</td>
                                        <td>{{ $type_device->data08_unit }}</td>
                                    </tr>
                                    <tr>
                                        <td>Campo 08 Descripcion</td>
                                        <td>{{ $type_device->data08_name }}</td>
                                    </tr>
                                @endif
                                @if(isset($type_device->data09_unit))
                                    <tr>
                                        <td>Campo 09 Unidad</td>
                                        <td>{{ $type_device->data09_unit }}</td>
                                    </tr>
                                    <tr>
                                        <td>Campo 09 Descripcion</td>
                                        <td>{{ $type_device->data09_name }}</td>
                                    </tr>
                                @endif
                                @if(isset($type_device->data10_unit))
                                    <tr>
                                        <td>Campo 10 Unidad</td>
                                        <td>{{ $type_device->data10_unit }}</td>
                                    </tr>
                                    <tr>
                                        <td>Campo 10 Descripcion</td>
                                        <td>{{ $type_device->data10_name }}</td>
                                    </tr>
                                @endif
                                @if(isset($type_device->data11_unit))
                                    <tr>
                                        <td>Campo 11 Unidad</td>
                                        <td>{{ $type_device->data11_unit }}</td>
                                    </tr>
                                    <tr>
                                        <td>Campo 11 Descripcion</td>
                                        <td>{{ $type_device->data11_name }}</td>
                                    </tr>
                                @endif
                                @if(isset($type_device->data12_unit))
                                    <tr>
                                        <td>Campo 12 Unidad</td>
                                        <td>{{ $type_device->data12_unit }}</td>
                                    </tr>
                                    <tr>
                                        <td>Campo 12 Descripcion</td>
                                        <td>{{ $type_device->data12_name }}</td>
                                    </tr>
                                @endif
                        </tbody>
                    </table>
                    @can('type-devices.destroy')
                        {!! Form::open(['route' => ['type-devices.destroy', $type_device->id], 'method' => 'DELETE']) !!}
                            <button class="btn btn-sm btn-danger float-right">Eliminar Tipo de Dispositivo</button>
                        {!! Form::close() !!}
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection