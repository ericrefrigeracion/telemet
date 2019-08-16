@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h3>Generar un Pago para {{ $device->name }}</h3>
                </div>
                <div class="card-body">
                    <p>El dispositivo a pagar es el N°{{ $device->id }} con el nombre {{ $device->name }} ({{ $device->description }}).</p>
                    <p>En este momento el monitoreo esta vigente hasta el dia {{ $device->monitor_expires_at->toFormattedDateString() }}.</p>
                    <p>En la lista de abajo se encuentran los distintos periodos que puede pagar con la cantitad de cuotas posibles, el monto total en pesos y el costo diario de cada periodo.</p>

                    <ul>
                    @foreach($prices as $price)
                    {!! Form::open(['route' => ['pays.store', $device->id , $price->id ]]) !!}
                        <li> {{ $price->description }} - ${{ $price->amount }} Ars (${{ $price->diary }}Ars/dia) - {{ $price->installments }} Cuotas </p>
                        {{ Form::submit('Realizar Pago', ['class' => 'btn btn-sm btn-primary']) }}
                        </li><br>
                    {!! Form::close() !!}
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection