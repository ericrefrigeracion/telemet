@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Pagos realizados
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Pago N°</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($pays as $pay)
                                    <tr>
                                        <td>
                                            <a href="{{ route('pays.show', $pay->id) }}" class="btn btn-sm btn-default">{{ $pay->payment_id }}</a>
                                        </td>
                                        <td>
                                            {{ $pay->status }}
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                    {{ $pays->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection