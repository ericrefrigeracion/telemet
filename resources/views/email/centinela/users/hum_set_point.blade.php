@component('mail::message')
#Sr. {{ $user->name }}:
# {{ $device->id }} - {{ $device->name }} esta fuera de set point.

El dispositivo {{ $device->name }} ({{ $device->description }}) se encuentra con ciclo lento, no ha alcanzado el valor de humedad deseado en el tiempo previsto en la configuracion del dispositivo.
La ultima vez que el equipo llego a la humedad deseada fue {{ $mail_information->last_created_at }}.
Normalmente, esto puede deberse a problemas de rendimiento en su equipo.

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

Desde el siguiente boton puede revisar las mediciones realizadas por su dispositivo en la ultima hora.

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
