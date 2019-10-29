@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Regla Programada para dispositivo N°{{ $rule->device_id }}
                </div>
                <div class="card-body">
                    <p>
                        Esta regla permite que el dispositivo N°{{ $rule->device_id }} se encuentre fuera de rango sin generar ningun aviso por Email o alertas en el panel de control los dias {{ $rule->day }} entre la hora {{ $rule->start_time }} y la hora {{ $rule->stop_time }}.
                    </p>

                    @can('rules.destroy')
                        {!! Form::open(['route' => ['rules.destroy', $rule->id], 'method' => 'DELETE']) !!}
                            <button class="btn btn-sm btn-danger float-right">Eliminar Regla</button>
                        {!! Form::close() !!}
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection