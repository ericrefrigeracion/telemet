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
                    Pago generado
                </div>
                <div class="card-body">
                        <h3>Item a pagar</h3>
                            {{ $pay->description }} por un total de ${{ $pay->amount }}.
                        <hr>
                        <div>
                            <a href="{{ $pay->init_point }}" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">Pagar con MercadoPago</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection