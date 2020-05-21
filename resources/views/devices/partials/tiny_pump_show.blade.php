<tr>
    <th colspan="2">CONFIGURACION DE MEDICION</th>
    <th colspan="3">VALOR</th>
</tr>
<tr>
    <td colspan="2">Fuente de la Señal de Control</td>
    <td colspan="3">{{ $device->tiny_pump_device->signal_mode == 'local' ? 'LOCAL' : 'REMOTA' }}</td>
</tr>
@if($device->tiny_pump_device->signal_mode == 'remote')
    <tr>
        <td colspan="2">Dispositivo de control</td>
        <td colspan="3">{{ $device->tiny_pump_device->control_number }}</td>
    </tr>
@endif
<tr>
    <td colspan="2">Tipo de Funcionamiento del Sistema</td>
    <td colspan="3">{{ $device->tiny_pump_device->control_mode == 'filled' ? 'PARA VACIADO' : 'PARA LLENADO' }}</td>
</tr>
<tr>
    <td colspan="2">Calibracion de la Medicion (cms):</td>
    <td colspan="3">{{ $device->tiny_pump_device->l_cal > 0 ? "+" . $device->tiny_pump_device->l_cal : $device->tiny_pump_device->l_cal }}</td>
</tr>
<tr>
    <td colspan="2">Offset (cms):</td>
    <td colspan="3">{{ $device->tiny_pump_device->l_offset }}</td>
</tr>
<tr>
    <td colspan="2">Minimo nivel Permitido (cms):</td>
    <td colspan="3">{{ $device->tiny_pump_device->l_min }}</td>
</tr>
<tr>
    <td colspan="2">Maximo nivel Permitido (cms):</td>
    <td colspan="3">{{ $device->tiny_pump_device->l_max }}</td>
</tr>
<tr>
    <td colspan="2">Retardo al Aviso (minutos):</td>
    <td colspan="3">{{ $device->tiny_pump_device->l_dly }}</td>
</tr>
<tr>
    <th colspan="2">CONFIGURACION DE SALIDAS</th>
    <th>TIPO DE USO</th>
    <th>MINIMA</th>
    <th>MAXIMA</th>
</tr>
<tr>
    <td colspan="2">Canal 1</td>
    <td>{{ $device->tiny_pump_device->channel1_config == 'auto' ? 'AUTOMATICO' : 'MANUAL' }}</td>
    <td>{{ $device->tiny_pump_device->channel1_min }}</td>
    <td>{{ $device->tiny_pump_device->channel1_max }}</td>
</tr>
<tr>
    <td colspan="2">Canal 2</td>
    <td>{{ $device->tiny_pump_device->channel2_config == 'auto' ? 'AUTOMATICO' : 'MANUAL' }}</td>
    <td>{{ $device->tiny_pump_device->channel2_min }}</td>
    <td>{{ $device->tiny_pump_device->channel2_max }}</td>
</tr>
<tr>
    <td colspan="2">Canal 3</td>
    <td>{{ $device->tiny_pump_device->channel3_config == 'auto' ? 'AUTOMATICO' : 'MANUAL' }}</td>
    <td>{{ $device->tiny_pump_device->channel3_min }}</td>
    <td>{{ $device->tiny_pump_device->channel3_max }}</td>
</tr>
<tr>
    <th colspan="5">
        @if($device->tiny_pump_device->device_update)
            Este dispositivo recibio la configuracion actual el {{ $device->tiny_pump_device->device_update }}.
        @else
            Este dispositivo no recibio la configuracion actual aun, apenas establezca conexion sera enviada.
        @endif
    </th>
</tr>