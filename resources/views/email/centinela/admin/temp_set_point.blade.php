@component('mail::message')
#Sr. Administrador:
# {{ $device->id }} - {{ $device->name }} esta fuera de set point.

El equipo del sr {{ $user->name }} {{ $user->surname }} con ID {{ $device->id }} se encuentra fuera de set poin al no alcanzar el valor de temperatura deseado en el tiempo previsto en el retardo para el aviso, en la configuracion del dispositivo.

Los ultimos datos que tenemos de su equipo son el {{ $device_values->last_created_at }} y se midio una temperatura de {{ $device_values->last_data }}°C.

<hr>
El numero de telefono del usuario es {{ $user->notification_phone }}, su direccion es {{ $user->address }}.
<hr>

Desde el siguiente enlace puede revisar las mediciones realizadas por el dispositivo en la ultima hora.

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
