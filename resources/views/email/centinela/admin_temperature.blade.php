@component('mail::message')
#Sr. Administrador:
# {{ $device->name }} esta fuera de rango.

El equipo del sr {{ $user->name }} con ID {{ $device->id }} se encuentra fuera de los limites establecidos por un tiempo mayor al que se ha determinado.
El dia {{ $device_values->last_created_at }} el equipo salio de rango con una temperatura de {{ $device_values->last_data01 }}°C.

<hr>
El numero de telefono del usuario es {{ $user->notification_phone }}, su direccion es {{ $user->address }}.
<hr>

Los valores que tiene programados para el equipo son:
<table>
	<tr>
		<td>Minima: </td>
		<td>{{ $device->min }}°C.</td>
	</tr>
	<tr>
		<td>Maxima: </td>
		<td>{{ $device->max }}°C.</td>
	</tr>
	<tr>
		<td>Retardo: </td>
		<td>{{ $device->dly }} minutos.</td>
	</tr>
</table>
<hr>

Desde el siguiente enlace puede revisar los mediciones realizadas por el dispositivo.

@component('mail::button', ['url' => route('receptions.show', $device->id) ])
Metricas {{ $device->name }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
