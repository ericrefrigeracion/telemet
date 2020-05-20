<tr>
    <th>CONFIGURACION DE MEDICION</th>
    <th colspan="2"></th>
</tr>
<tr>
    <td>Calibracion de la Medicion (cms):</td>
    <td colspan="2">{{ $device->tiny_pump_device->l_cal > 0 ? "+" . $device->tiny_pump_device->l_cal : $device->tiny_pump_device->l_cal }}</td>
</tr>
<tr>
    <td>Offset (cms):</td>
    <td colspan="2">{{ $device->tiny_pump_device->l_offset }}</td>
</tr>
<tr>
    <td>Minimo nivel Permitido (cms):</td>
    <td colspan="2">{{ $device->tiny_pump_device->l_min }}</td>
</tr>
<tr>
    <td>Maximo nivel Permitido (cms):</td>
    <td colspan="2">{{ $device->tiny_pump_device->l_max }}</td>
</tr>
<tr>
    <td>Retardo al Aviso (minutos):</td>
    <td colspan="2">{{ $device->tiny_pump_device->l_dly }}</td>
</tr>
<tr>
    <th>CONFIGURACION DE SALIDAS</th>
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
<tr>
    <th colspan="3">
        @if($device->tiny_pump_device->device_update)
            Este dispositivo recibio la configuracion actual el {{ $device->tiny_pump_device->device_update }}.
        @else
            Este dispositivo no recibio la configuracion actual aun, apenas establezca conexion sera enviada.
        @endif
    </th>
</tr>