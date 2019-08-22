@component('mail::message')
#Sr. {{ $user->name }}:
# {{ $device->name }} esta fuera de rango.

El dispositivo {{ $device->name }} ({{ $device->description }}) se encuentra fuera de los limites establecidos por un tiempo mayor al retardo que se ha determinado.
El dia {{ $device_values->last_created_at }} su equipo salio de rango con una temperatura de {{ $device_values->last_data }}°C.
<hr>
Los valores que tiene programados para su equipo son:
<table>
	<tr>
		<td>Temperatura Deseada: </td>
		<td>{{ $device->t_set_point }}%.</td>
	</tr>
	<tr>
		<td>Retardo: </td>
		<td>{{ $device->tdly }} minutos.</td>
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
