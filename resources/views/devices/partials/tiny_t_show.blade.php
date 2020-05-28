<tr>
    <th colspan="2">CONFIGURACION</th>
    <th colspan="3">VALOR</th>
</tr>
<tr>
    <td colspan="2">Calibracion de la Medicion (°C)</td>
    <td colspan="3">{{ $device->tiny_t_device->tcal > 0 ? "+" . $device->tiny_t_device->tcal : $device->tiny_t_device->tcal }}</td>
</tr>
<tr>
    <td colspan="2">Minima Establecida (°C)</td>
    <td colspan="3">{{ $device->tiny_t_device->tmin }}</td>
</tr>
<tr>
    <td colspan="2">Maxima Establecida (°C)</td>
    <td colspan="3">{{ $device->tiny_t_device->tmax }}</td>
</tr>
<tr>
    <td colspan="2">Retardo al Aviso (minutos)</td>
    <td colspan="3">{{ $device->tiny_t_device->tdly }}</td>
</tr>
@can('devices.analysis')
    <tr>
        <td colspan="2">Minima Performance (°C/h)</td>
        <td colspan="3">{{ $device->tiny_t_device->pmin }}</td>
    </tr>
    <tr>
        <td colspan="2">Maxima Performance (°C/h)</td>
        <td colspan="3">{{ $device->tiny_t_device->pmax }}</td>
    </tr>
@endcan