@component('mail::message')
#Sr. {{ $user->name }}:
# {{ $device->id }} - {{ $device->name }} esta fuera de set point.

El dispositivo {{ $device->name }} ({{ $device->description }}) se encuentra fuera de set point al no alcanzar el valor de humedad deseado en el tiempo previsto en el retardo para el aviso, en la configuracion del dispositivo.
Normalmente, esto puede deberse a problemas de rendimiento en suequipo.

Los ultimos datos que tenemos de su equipo son el {{ $device_values->last_created_at }} y se midio una temperatura de {{ $device_values->last_data }}%.
<hr>
Los valores que tiene programados para su equipo son:
<table>
	<tr>
		<td>Humedad Deseada: </td>
		<td>{{ $device->h_set_point }}%.</td>
	</tr>
	<tr>
		<td>Retardo: </td>
		<td>{{ $device->hdly }} minutos.</td>
	</tr>
</table>
<hr>

Desde el siguiente enlace puede revisar las mediciones realizadas por su dispositivo en la ultima hora.

@component('mail::button', ['url' => route('receptions.show-hour', $device->id) ])
Metricas {{ $device->name }}
@endcomponent

Desde el siguiente enlace puede revisar las configuraciones del dispositivo en la ultima hora.

@component('mail::button', ['url' => route('devices.show', $device->id) ])
Configuracion {{ $device->name }}
@endcomponent


Atentamente,<br>
{{ config('app.name') }}
@endcomponent
