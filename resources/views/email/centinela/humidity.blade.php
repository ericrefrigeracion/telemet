@component('mail::message')
#Sr. {{ $user->name }}:
# {{ $device->name }} esta fuera de rango.

Su dispositivo se encuentra fuera de los limites establecidos por un tiempo mayor al que se ha determinado.
El dia {{ $device_values->last_created_at }} su equipo salio de rango con una humedad relativa de {{ $device_values->last_data }}%.
<hr>
Los valores que tiene programados para su equipo son:
<table>
	<tr>
		<td>Minima: </td>
		<td>{{ $device->hmin }}%.</td>
	</tr>
	<tr>
		<td>Maxima: </td>
		<td>{{ $device->hmax }}%.</td>
	</tr>
	<tr>
		<td>Retardo: </td>
		<td>{{ $device->hdly }} minutos.</td>
	</tr>
</table>
<hr>

Desde el siguiente enlace puede revisar los mediciones realizadas por su dispositivo.

@component('mail::button', ['url' => route('receptions.show', $device->id) ])
Metricas {{ $device->name }}
@endcomponent

Atentamente,<br>
{{ config('app.name') }}
@endcomponent
