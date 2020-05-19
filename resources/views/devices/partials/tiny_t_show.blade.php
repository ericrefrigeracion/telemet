<tr>
    <th>CONFIGURACION</th>
    <th>VALOR</th>
</tr>
<tr>
    <td>Calibracion de la Medicion (°C)</td>
    <td>{{ $device->tiny_t_device->tcal > 0 ? "+" . $device->tiny_t_device->tcal : $device->tiny_t_device->tcal }}</td>
</tr>
<tr>
    <td>Minima Establecida (°C)</td>
    <td>{{ $device->tiny_t_device->tmin }}</td>
</tr>
<tr>
    <td>Maxima Establecida (°C)</td>
    <td>{{ $device->tiny_t_device->tmax }}</td>
</tr>
<tr>
    <td>Retardo al Aviso (minutos)</td>
    <td>{{ $device->tiny_t_device->tdly }}</td>
</tr>
@can('devices.analysis')
    <tr>
        <td>Minima Performance (°C/h)</td>
        <td>{{ $device->tiny_t_device->pmin }}</td>
    </tr>
    <tr>
        <td>Maxima Performance (°C/h)</td>
        <td>{{ $device->tiny_t_device->pmax }}</td>
    </tr>
@endcan