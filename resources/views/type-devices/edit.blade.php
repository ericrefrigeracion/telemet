@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Editar Tipo de Dispositivo {{ $type_device->model }} (Prefijo {{ $type_device->prefix }})
                </div>
                <div class="card-body">
                    {!! Form::model($type_device, ['route' => ['type-devices.update', $type_device->id], 'method' => 'PUT']) !!}
                        <div class="form-group">
                            {{ Form::label('description', 'Descripcion') }}
                            {{ Form::text('description', null, ['class' => 'form-control', 'required', 'maxlength' => '40']) }}
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('data01_unit', 'Unidad de medida Campo 01') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('data01_unit', null, ['class' => 'form-control', 'maxlength' => '5']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('data01_name', 'Nombre del Campo 01') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('data01_name', null, ['class' => 'form-control', 'maxlength' => '25']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('data02_unit', 'Unidad de medida Campo 02') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('data02_unit', null, ['class' => 'form-control', 'maxlength' => '5']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('data02_name', 'Nombre del Campo 02') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('data02_name', null, ['class' => 'form-control', 'maxlength' => '25']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('data03_unit', 'Unidad de medida Campo 03') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('data03_unit', null, ['class' => 'form-control', 'maxlength' => '5']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('data03_name', 'Nombre del Campo 03') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('data03_name', null, ['class' => 'form-control', 'maxlength' => '25']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('data04_unit', 'Unidad de medida Campo 04') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('data04_unit', null, ['class' => 'form-control', 'maxlength' => '5']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('data04_name', 'Nombre del Campo 04') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('data04_name', null, ['class' => 'form-control', 'maxlength' => '25']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('data05_unit', 'Unidad de medida Campo 05') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('data05_unit', null, ['class' => 'form-control', 'maxlength' => '5']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('data05_name', 'Nombre del Campo 05') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('data05_name', null, ['class' => 'form-control', 'maxlength' => '25']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('data06_unit', 'Unidad de medida Campo 06') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('data06_unit', null, ['class' => 'form-control', 'maxlength' => '5']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('data06_name', 'Nombre del Campo 06') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('data06_name', null, ['class' => 'form-control', 'maxlength' => '25']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('data07_unit', 'Unidad de medida Campo 07') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('data07_unit', null, ['class' => 'form-control', 'maxlength' => '5']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('data07_name', 'Nombre del Campo 07') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('data07_name', null, ['class' => 'form-control', 'maxlength' => '25']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('data08_unit', 'Unidad de medida Campo 08') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('data08_unit', null, ['class' => 'form-control', 'maxlength' => '5']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('data08_name', 'Nombre del Campo 08') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('data08_name', null, ['class' => 'form-control', 'maxlength' => '25']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('data09_unit', 'Unidad de medida Campo 09') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('data09_unit', null, ['class' => 'form-control', 'maxlength' => '5']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('data09_name', 'Nombre del Campo 09') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('data09_name', null, ['class' => 'form-control', 'maxlength' => '25']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('data10_unit', 'Unidad de medida Campo 10') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('data10_unit', null, ['class' => 'form-control', 'maxlength' => '5']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('data10_name', 'Nombre del Campo 10') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('data10_name', null, ['class' => 'form-control', 'maxlength' => '25']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('data11_unit', 'Unidad de medida Campo 11') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('data11_unit', null, ['class' => 'form-control', 'maxlength' => '5']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('data11_name', 'Nombre del Campo 11') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('data11_name', null, ['class' => 'form-control', 'maxlength' => '25']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('data12_unit', 'Unidad de medida Campo 12') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('data12_unit', null, ['class' => 'form-control', 'maxlength' => '5']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('data12_name', 'Nombre del Campo 12') }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('data12_name', null, ['class' => 'form-control', 'maxlength' => '25']) }}
                            </div>
                        </div>
                        <div>
                            {{ Form::submit('Guardar Cambios', ['class' => 'btn btn-sm btn-primary']) }}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection