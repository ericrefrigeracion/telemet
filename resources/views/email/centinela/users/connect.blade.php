@component('mail::message')
#Sr. {{ $user->name }}:
# {{ $device->name }} esta conectado.

El equipo {{ $device->name }} ({{ $device->description }}) se encuentra enviando datos nuevamente.

<hr>

Desde el siguiente boton puede revisar las ultimas mediciones realizadas por su dispositivo.

@component('mail::button', ['url' => route('data-receptions.show', $device->id) ])
Metricas {{ $device->name }}
@endcomponent

Atentamente,<br>
{{ config('app.name') }}
@endcomponent
