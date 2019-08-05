@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Generar un Pago</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => ['pays.store']]) !!}
                        <h4>Periodo a pagar</h4>
                        <div class="list-unstyled">
                            @foreach($prices as $price)
                                @if($price->days != 0)
                                    <li>
                                        <label>{{ Form::radio('days', $price->days) }} {{ $price->description }} - ${{ $price->amount }} Ars (${{ $price->diary }}Ars/dia) - {{ $price->installments }} Cuotas.</label>
                                    </li>
                                @endif
                            @endforeach
                        </div>
                        <hr>
                        <h4>Equipo a pagar</h4>
                        <div class="list-unstyled">
                            @foreach($devices as $device)
                                <li>
                                    <label>{{ Form::radio('device_id', $device->id) }} {{ $device->id }} - {{ $device->name }}({{ $device->description }})</label>
                                </li>
                            @endforeach
                        </div>
                        <hr>
                        <div>
                            {{ Form::submit('Realizar Pago', ['class' => 'btn btn-sm btn-primary']) }}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection