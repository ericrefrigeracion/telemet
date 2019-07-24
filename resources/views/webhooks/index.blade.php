@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    WebHooks recibidos desde la plataformade MercadoPago
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>User(MP)</th>
                                <th>Pago ID(MP)</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($webhooks as $webhook)
                                    <tr>
                                        <td>{{ $webhook->type }}</td>
                                        <td>{{ $webhook->user_id }}</td>
                                        <td><a href="{{ route('webhooks.show', $webhook->id) }}" class="btn btn-sm btn-default">{{ $webhook->data_id }}<a/></td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                    {{ $webhooks->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection