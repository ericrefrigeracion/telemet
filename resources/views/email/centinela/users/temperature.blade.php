@component('mail::message')
#Sr. {{ $user->name }}:
# {{ $device->name }} esta fuera de rango.

El dispositivo {{ $device->name }} ({{ $device->description }}) se encuentra fuera de los limites de temperatura establecidos por un tiempo mayor al retardo que se ha determinado.
El dia {{ $mail_information->last_created_at }} su equipo salio del rango de valores normales.
<hr>
Los valores que tiene programados para su equipo son:
<table>
	<tr>
		<td>Temperatura Minima: </td>
		<td>{{ $device->tmin }}°C.</td>
	</tr>
	<tr>
		<td>Temperatura Maxima: </td>
		<td>{{ $device->tmax }}°C.</td>
	</tr>
	<tr>
		<td>Retardo: </td>
		<td>{{ $device->tdly }} minutos.</td>
	</tr>
</table>
<hr>

Desde el siguiente enlace puede revisar los mediciones realizadas por su dispositivo en la ultima hora.

@component('mail::button', ['url' => route('receptions.now', $device->id) ])
Metricas {{ $device->name }}
@endcomponent

Desde el siguiente enlace puede revisar las configuraciones del dispositivo.

@component('mail::button', ['url' => route('devices.show', $device->id) ])
Configuracion {{ $device->name }}
@endcomponent


Atentamente,<br>
{{ config('app.name') }}
@endcomponent
