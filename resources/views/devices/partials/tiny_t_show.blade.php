<tr>
    <th>CONFIGURACION</th>
    <th>VALOR</th>
</tr>
<tr>
    <td>Calibracion de la Medicion (°C)</td>
    <td>{{ $tiny_t_device->tcal > 0 ? "+" . $tiny_t_device->tcal : $tiny_t_device->tcal }}</td>
</tr>
<tr>
    <td>Temperatura Deseada (°C)</td>
    <td>{{ $tiny_t_device->t_set_point }}</td>
</tr>
    <tr>
        <td>Minima Establecida (°C)</td>
        <td>{{ $tiny_t_device->tmin }}</td>
    </tr>
    <tr>
        <td>Maxima Establecida (°C)</td>
        <td>{{ $tiny_t_device->tmax }}</td>
    </tr>
<tr>
    <td>Retardo al Aviso (minutos)</td>
    <td>{{ $tiny_t_device->tdly }}</td>
</tr>