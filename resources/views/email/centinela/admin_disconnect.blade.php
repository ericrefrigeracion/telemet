@component('mail::message')
#Sr. Administrador:
# {{ $device->name }} esta desconectado.

El equipo del sr {{ $user->name }} con ID {{ $device->id }} se encuentra sin enviar datos por los ultimos 10minutos.
normalmente esto se puede deber a problemas de la conexion a internet o con la energia electrica.

Los ultimos datos que tenemos de su equipo son el {{ $device_values->last_created_at }} y se midio una temperatura de {{ $device_values->last_data01 }}°C.

<hr>
El numero de telefono del usuario es {{ $user->notification_phone }}, su direccion es {{ $user->address }}.
<hr>

Desde el siguiente enlace puede revisar las mediciones realizadas por el dispositivo.

@component('mail::button', ['url' => route('receptions.show', $device->id) ])
Metricas {{ $device->name }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
