@component('mail::message')
#Sr. {{ $user->name }}:
# {{ $device->name }} esta desconectado.

No hemos recibido datos de su dispositivo en los ultimos diez minutos,
normalmente esto puede deberse a problemas de la conexion a internet o con la energia electrica.
Los ultimos datos que tenemos de su equipo son el {{ $device_values->last_created_at }} y se midio una temperatura de {{ $device_values->last_data }}°C.

Desde el siguiente enlace puede revisar las mediciones realizadas por su dispositivo.

@component('mail::button', ['url' => route('receptions.show', $device->id) ])
Metricas {{ $device->name }}
@endcomponent

Atentamente,<br>
{{ config('app.name') }}
@endcomponent
