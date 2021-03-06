@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Alertas dispositivo {{ $device->id }} - {{ $device->name }}
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Alerta</th>
                                <th>Ocurido</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alerts as $alert)

                                <tr>
                                    <td>{{ $alert->log }}</td>
                                    <td>{{ $alert->alert_created_at }}</td>
                                </tr>

                            @endforeach
                          </tbody>
                    </table>
                    {{ $alerts->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection