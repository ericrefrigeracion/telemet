@component('mail::message')
#Sr. {{ $user->name }}:
# {{ $device->id }} - {{ $device->name }} esta conectado.

El equipo {{ $device->name }} ({{ $device->description }}) se encuentra enviando datos nuevamente.

Los ultimos datos que tenemos de su equipo son el {{ $device_values->last_created_at }} y se midio una temperatura de {{ $device_values->last_data }}°C.

<hr>

Desde el siguiente enlace puede revisar las mediciones realizadas por su dispositivo en la ultima hora.

@component('mail::button', ['url' => route('receptions.show-hour', $device->id) ])
Metricas {{ $device->name }}
@endcomponent

Atentamente,<br>
{{ config('app.name') }}
@endcomponent
