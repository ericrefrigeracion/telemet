@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Crear Item de Pago
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => ['prices.store']]) !!}
                        <div class="form-group">
                            {{ Form::label('description', 'Descripcion del pago') }}
                            {{ Form::text('description', null, ['class' => 'form-control', 'required', 'maxlength' => '40']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('type_device_id', 'Modelo de dispositivo') }}<br>
                            @foreach($type_devices as $type_device)
                                <label>{{ Form::radio('type_device_id', $type_device->id) }} {{ $type_device->model }} </label><br>
                            @endforeach
                        </div>
                        <div class="form-group">
                            {{ Form::label('price', 'Valor del Item') }}
                            {{ Form::number('price', null, ['class' => 'form-control', 'required', 'default' => 0, 'min' => 0, 'step' => 0.01]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('days', 'Dias que dura el item de monitoreo') }}
                            {{ Form::number('days', null, ['class' => 'form-control', 'required', 'default' => 0, 'min' => 0, 'max' => 365, 'step' => 1]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('installments', 'Cantidad de cuotas aceptadas') }}
                            {{ Form::number('installments', null, ['class' => 'form-control', 'required', 'default' => 1, 'min' => 1, 'max' => 12, 'step' => 1]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('excluded', 'Medio de pago excluido') }}<br>
                            <label>{{ Form::radio('excluded', 'credit_card') }} Tarjeta de Credito</label><br>
                            <label>{{ Form::radio('excluded', 'debit_card') }} Tarjeta de Debito</label><br>
                            <label>{{ Form::radio('excluded', 'ticket') }} Efectivo (Rapipago, Pagofacil, etc)</label><br>
                            <label>{{ Form::radio('excluded', 'atm') }} Transferencia</label><br>
                            <label>{{ Form::radio('excluded', '') }} Todos Aceptados</label><br>
                        </div>
                        <div>
                            {{ Form::submit('Crear Item', ['class' => 'btn btn-sm btn-primary']) }}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection