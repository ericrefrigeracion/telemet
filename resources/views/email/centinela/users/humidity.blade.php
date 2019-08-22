@component('mail::message')
#Sr. {{ $user->name }}:
# {{ $device->name }} esta fuera de rango.

El dispositivo {{ $device->name }} ({{ $device->description }}) se encuentra fuera de los limites establecidos por un tiempo mayor al retardo que se ha determinado.
El dia {{ $device_values->last_created_at }} su equipo salio de rango con una humedad relativa de {{ $device_values->last_data }}%.
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

Desde el siguiente enlace puede revisar los mediciones realizadas por su dispositivo en la ultima hora.

@component('mail::button', ['url' => route('receptions.show-hour', $device->id) ])
Metricas {{ $device->name }}
@endcomponent

Desde el siguiente enlace puede revisar las configuraciones del dispositivo.

@component('mail::button', ['url' => route('devices.show', $device->id) ])
Configuracion {{ $device->name }}
@endcomponent


Atentamente,<br>
{{ config('app.name') }}
@endcomponent
