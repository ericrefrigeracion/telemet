@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Generar un Pago
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => ['pays.store']]) !!}
                        <h3>Periodo a pagar</h3>
                        <div class="list-unstyled">
                            <li><label>{{ Form::radio('days', 30) }} 30 dias ($850 Ars)</label></li>
                            <li><label>{{ Form::radio('days', 60) }} 60 dias ($1500 Ars)</label></li>
                            <li><label>{{ Form::radio('days', 360) }} 360 dias ($7400 Ars)</label></li>
                        </div>
                        <hr>
                        <h3>Equipo a pagar</h3>
                        <div class="list-unstyled">
                            @foreach($devices as $device)
                            <li>
                                <label>{{ Form::radio('device_id', $device->id) }} {{ $device->name }}</label>
                            </li>
                            @endforeach
                        </div>
                        <hr>
                        <div>
                            {{ Form::submit('Crear Pago', ['class' => 'btn btn-sm btn-primary']) }}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection