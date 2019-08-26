@component('mail::message')
#Sr. {{ $user->name }}:
# {{ $device->name }} esta desconectado.

No hemos recibido datos de su dispositivo {{ $device->name }} ({{ $device->description }}),
normalmente esto puede deberse a problemas de la conexion a internet o con la energia electrica.

Los ultimos datos que tenemos de su dispositivo son el {{ $mail_information->last_created_at }}.

Desde el siguiente boton puede revisar las mediciones realizadas por su dispositivo en la ultima hora.

@component('mail::button', ['url' => route('receptions.show-hour', $device->id) ])
Metricas {{ $device->name }}
@endcomponent

Atentamente,<br>
{{ config('app.name') }}
@endcomponent
