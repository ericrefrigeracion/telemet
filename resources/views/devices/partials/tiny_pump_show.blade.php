<tr>
    <th>CONFIGURACION</th>
    <th>VALOR</th>
</tr>
<tr>
    <td>Calibracion de la Medicion (cms)</td>
    <td>{{ $device->tiny_pump_device->l_cal > 0 ? "+" . $device->tiny_pump_device->l_cal : $device->tiny_pump_device->l_cal }}</td>
</tr>
<tr>
    <td>Minimo Nivel Establecido (cms)</td>
    <td>{{ $device->tiny_pump_device->l_min }}</td>
</tr>
<tr>
    <td>Maximo Nivel Establecido (cms)</td>
    <td>{{ $device->tiny_pump_device->l_max }}</td>
</tr>
<tr>
    <td>Offset (cms)</td>
    <td>{{ $device->tiny_pump_device->l_offset }}</td>
</tr>
<tr>
    <td>Retardo al Aviso (minutos)</td>
    <td>{{ $device->tiny_pump_device->tdly }}</td>
</tr>