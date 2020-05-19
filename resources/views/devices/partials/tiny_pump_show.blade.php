<tr>
    <th colspan="2">CONFIGURACION</th>
    <th>VALOR</th>
</tr>
<tr>
    <td colspan="2">Calibracion de la Medicion (cms)</td>
    <td>{{ $device->tiny_pump_device->l_cal > 0 ? "+" . $device->tiny_pump_device->l_cal : $device->tiny_pump_device->l_cal }}</td>
</tr>
<tr>
    <td colspan="2">Minimo Nivel Establecido (cms)</td>
    <td>{{ $device->tiny_pump_device->l_min }}</td>
</tr>
<tr>
    <td colspan="2">Maximo Nivel Establecido (cms)</td>
    <td>{{ $device->tiny_pump_device->l_max }}</td>
</tr>
<tr>
    <td colspan="2">Offset (cms)</td>
    <td>{{ $device->tiny_pump_device->l_offset }}</td>
</tr>
<tr>
    <td colspan="2">Retardo al Aviso (minutos)</td>
    <td>{{ $device->tiny_pump_device->l_dly }}</td>
</tr>
<tr>
    <th>CONFIGURACION</th>
    <th>MINIMA</th>
    <th>MAXIMA</th>
</tr>
<tr>
    <td>Canal 1</td>
    <td>{{ $device->tiny_pump_device->channel1_min }}</td>
    <td>{{ $device->tiny_pump_device->channel1_max }}</td>
</tr>
<tr>
    <td>Canal 2</td>
    <td>{{ $device->tiny_pump_device->channel2_min }}</td>
    <td>{{ $device->tiny_pump_device->channel2_max }}</td>
</tr>
<tr>
    <td>Canal 3</td>
    <td>{{ $device->tiny_pump_device->channel3_min }}</td>
    <td>{{ $device->tiny_pump_device->channel3_max }}</td>
</tr>