@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                	<h3>Como comprar un dispositivo</h3>
                </div>
                <div class="card-body">
                	<p>Descripcion</p>
                </div>
                <div class="card-footer">
                	@can('devices.show')
  			            <a href="{{ route('devices.buy') }}" class="btn btn-block btn-success">Comprar un nuevo dispositivo</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection