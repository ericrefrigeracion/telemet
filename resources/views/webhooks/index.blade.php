@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    WebHooks recibidos desde la plataformade MercadoPago
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Webhook_ID</th>
                                <th>Topic</th>
                                <th>Creado</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($webhooks as $webhook)
                                    <tr>
                                        <td>{{ $webhook->id }}</td>
                                        <td>{{ $webhook->webhook_id }}</td>
                                        <td>{{ $webhook->topic }}<a/></td>
                                        <td>{{ $webhook->created_at}}</td>
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