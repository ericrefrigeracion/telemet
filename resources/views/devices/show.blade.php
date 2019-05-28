@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Dispositivo <strong>{{ $device->name }}</strong>
                    @can('devices.destroy')
                        <a href="{{ route('devices.destroy',$device->id)}}" class="btn btn-danger btn-sm float-right">
                            Eliminar Dispositivo
                        </a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>VALOR</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $device->id }}</td>
                                </tr>
                                <tr>
                                    <td>NOMBRE</td>
                                    <td>{{ $device->name }}</td>
                                </tr>
                                <tr>
                                    <td>CREADO</td>
                                    <td>{{ $device->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>MODIFICADO</td>
                                    <td>{{ $device->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>MONITOREO</td>
                                    <td>{{ $device->monitor ? 'ACTIVO' : 'INACTIVO' }}</td>
                                </tr>
                                <tr>
                                    <td>AVISO POR EMAIL</td>
                                    <td>{{ $config->mail_send ? 'ACTIVO' : 'INACTIVO' }}</td>
                                </tr>
                                @if($device->monitor)
                                    @if($config->data01_mon)
                                        <tr><th>CANAL 1</th><th>VALOR</th></tr>
                                        <tr>
                                            <td>Minima Establecida ({{ $config->data01_typ }})</td>
                                            <td>{{ $config->data01_min }}</td>
                                        </tr>
                                        <tr>
                                            <td>Maxima Establecida ({{ $config->data01_typ }})</td>
                                            <td>{{ $config->data01_max }}</td>
                                        </tr>
                                        <tr>
                                            <td>Retardo al Aviso (minutos)</td>
                                            <td>{{ $config->data01_dly }}</td>
                                        </tr>
                                        <tr>
                                            <td>Calibracion del Canal ({{ $config->data01_typ }})</td>
                                            <td>{{ $config->data01_cal > 0 ? "+" . $config->data01_cal : $config->data01_cal }}</td>
                                        </tr>
                                    @endif
                                    @if($config->data02_mon)
                                        <tr><th>CANAL 2</th><th>VALOR</th></tr>
                                        <tr>
                                            <td>Minima Establecida ({{ $config->data02_typ }})</td>
                                            <td>{{ $config->data02_min }}</td>
                                        </tr>
                                        <tr>
                                            <td>Maxima Establecida ({{ $config->data02_typ }})</td>
                                            <td>{{ $config->data02_max }}</td>
                                        </tr>
                                        <tr>
                                            <td>Retardo al Aviso (minutos)</td>
                                            <td>{{ $config->data02_dly }}</td>
                                        </tr>
                                        <tr>
                                            <td>Calibracion del Canal ({{ $config->data02_typ }})</td>
                                            <td>{{ $config->data02_cal > 0 ? "+" . $config->data02_cal : $config->data02_cal }}</td>
                                        </tr>
                                    @endif
                                    @if($config->data03_mon)
                                        <tr><th>CANAL 3</th><th>VALOR</th></tr>
                                        <tr>
                                            <td>Minima Establecida ({{ $config->data03_typ }})</td>
                                            <td>{{ $config->data03_min }}</td>
                                        </tr>
                                        <tr>
                                            <td>Maxima Establecida ({{ $config->data03_typ }})</td>
                                            <td>{{ $config->data03_max }}</td>
                                        </tr>
                                        <tr>
                                            <td>Retardo al Aviso (minutos)</td>
                                            <td>{{ $config->data03_dly }}</td>
                                        </tr>
                                        <tr>
                                            <td>Calibracion del Canal ({{ $config->data03_typ }})</td>
                                            <td>{{ $config->data03_cal > 0 ? "+" . $config->data03_cal : $config->data03_cal }}</td>
                                        </tr>
                                    @endif
                                    @if($config->data04_mon)
                                        <tr><th>CANAL 4</th><th>VALOR</th></tr>
                                        <tr>
                                            <td>Minima Establecida ({{ $config->data04_typ }})</td>
                                            <td>{{ $config->data04_min }}</td>
                                        </tr>
                                        <tr>
                                            <td>Maxima Establecida ({{ $config->data04_typ }})</td>
                                            <td>{{ $config->data04_max }}</td>
                                        </tr>
                                        <tr>
                                            <td>Retardo al Aviso (minutos)</td>
                                            <td>{{ $config->data04_dly }}</td>
                                        </tr>
                                        <tr>
                                            <td>Calibracion del Canal ({{ $config->data04_typ }})</td>
                                            <td>{{ $config->data04_cal > 0 ? "+" . $config->data04_cal : $config->data04_cal }}</td>
                                        </tr>
                                    @endif
                                    @if($config->data05_mon)
                                        <tr><th>CANAL 5</th><th>VALOR</th></tr>
                                        <tr>
                                            <td>Minima Establecida ({{ $config->data05_typ }})</td>
                                            <td>{{ $config->data05_min }}</td>
                                        </tr>
                                        <tr>
                                            <td>Maxima Establecida ({{ $config->data05_typ }})</td>
                                            <td>{{ $config->data05_max }}</td>
                                        </tr>
                                        <tr>
                                            <td>Retardo al Aviso (minutos)</td>
                                            <td>{{ $config->data05_dly }}</td>
                                        </tr>
                                        <tr>
                                            <td>Calibracion del Canal ({{ $config->data05_typ }})</td>
                                            <td>{{ $config->data05_cal > 0 ? "+" . $config->data05_cal : $config->data05_cal }}</td>
                                        </tr>
                                    @endif
                                    @if($config->data06_mon)
                                        <tr><th>CANAL 6</th><th>VALOR</th></tr>
                                        <tr>
                                            <td>Minima Establecida ({{ $config->data06_typ }})</td>
                                            <td>{{ $config->data06_min }}</td>
                                        </tr>
                                        <tr>
                                            <td>Maxima Establecida ({{ $config->data06_typ }})</td>
                                            <td>{{ $config->data06_max }}</td>
                                        </tr>
                                        <tr>
                                            <td>Retardo al Aviso (minutos)</td>
                                            <td>{{ $config->data06_dly }}</td>
                                        </tr>
                                        <tr>
                                            <td>Calibracion del Canal ({{ $config->data06_typ }})</td>
                                            <td>{{ $config->data06_cal > 0 ? "+" . $config->data06_cal : $config->data06_cal }}</td>
                                        </tr>
                                    @endif
                                    @if($config->data07_mon)
                                        <tr><th>CANAL 7</th><th>VALOR</th></tr>
                                        <tr>
                                            <td>Minima Establecida ({{ $config->data07_typ }})</td>
                                            <td>{{ $config->data07_min }}</td>
                                        </tr>
                                        <tr>
                                            <td>Maxima Establecida ({{ $config->data07_typ }})</td>
                                            <td>{{ $config->data07_max }}</td>
                                        </tr>
                                        <tr>
                                            <td>Retardo al Aviso (minutos)</td>
                                            <td>{{ $config->data07_dly }}</td>
                                        </tr>
                                        <tr>
                                            <td>Calibracion del Canal ({{ $config->data07_typ }})</td>
                                            <td>{{ $config->data07_cal > 0 ? "+" . $config->data07_cal : $config->data07_cal }}</td>
                                        </tr>
                                    @endif
                                    @if($config->data08_mon)
                                        <tr><th>CANAL 8</th><th>VALOR</th></tr>
                                        <tr>
                                            <td>Minima Establecida ({{ $config->data08_typ }})</td>
                                            <td>{{ $config->data08_min }}</td>
                                        </tr>
                                        <tr>
                                            <td>Maxima Establecida ({{ $config->data08_typ }})</td>
                                            <td>{{ $config->data08_max }}</td>
                                        </tr>
                                        <tr>
                                            <td>Retardo al Aviso (minutos)</td>
                                            <td>{{ $config->data08_dly }}</td>
                                        </tr>
                                        <tr>
                                            <td>Calibracion del Canal ({{ $config->data08_typ }})</td>
                                            <td>{{ $config->data08_cal > 0 ? "+" . $config->data08_cal : $config->data08_cal }}</td>
                                        </tr>
                                    @endif
                                    @if($config->data09_mon)
                                        <tr><th>CANAL 9</th><th>VALOR</th></tr>
                                        <tr>
                                            <td>Minima Establecida ({{ $config->data09_typ }})</td>
                                            <td>{{ $config->data09_min }}</td>
                                        </tr>
                                        <tr>
                                            <td>Maxima Establecida ({{ $config->data09_typ }})</td>
                                            <td>{{ $config->data09_max }}</td>
                                        </tr>
                                        <tr>
                                            <td>Retardo al Aviso (minutos)</td>
                                            <td>{{ $config->data09_dly }}</td>
                                        </tr>
                                        <tr>
                                            <td>Calibracion del Canal ({{ $config->data09_typ }})</td>
                                            <td>{{ $config->data09_cal > 0 ? "+" . $config->data09_cal : $config->data09_cal }}</td>
                                        </tr>
                                    @endif
                                    @if($config->data10_mon)
                                        <tr><th>CANAL 10</th><th>>VALOR</th></tr>
                                        <tr>
                                            <td>Minima Establecida ({{ $config->data10_typ }})</td>
                                            <td>{{ $config->data10_min }}</td>
                                        </tr>
                                        <tr>
                                            <td>Maxima Establecida ({{ $config->data10_typ }})</td>
                                            <td>{{ $config->data10_max }}</td>
                                        </tr>
                                        <tr>
                                            <td>Retardo al Aviso (minutos)</td>
                                            <td>{{ $config->data10_dly }}</td>
                                        </tr>
                                        <tr>
                                            <td>Calibracion del Canal ({{ $config->data10_typ }})</td>
                                            <td>{{ $config->data10_cal > 0 ? "+" . $config->data10_cal : $config->data10_cal }}</td>
                                        </tr>
                                    @endif
                                    @if($config->data11_mon)
                                        <tr><th>CANAL 11</th><th>>VALOR</th></tr>
                                        <tr>
                                            <td>Minima Establecida ({{ $config->data11_typ }})</td>
                                            <td>{{ $config->data11_min }}</td>
                                        </tr>
                                        <tr>
                                            <td>Maxima Establecida ({{ $config->data11_typ }})</td>
                                            <td>{{ $config->data11_max }}</td>
                                        </tr>
                                        <tr>
                                            <td>Retardo al Aviso (minutos)</td>
                                            <td>{{ $config->data11_dly }}</td>
                                        </tr>
                                        <tr>
                                            <td>Calibracion del Canal ({{ $config->data11_typ }})</td>
                                            <td>{{ $config->data11_cal > 0 ? "+" . $config->data11_cal : $config->data11_cal }}</td>
                                        </tr>
                                    @endif
                                @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection