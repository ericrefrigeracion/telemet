@component('mail::message')
#Sr. {{ $user->name }} {{ $user->surname }}:
# {{ $device->name }} sin monitoreo.

<hr>
El dispositivo N°{{ $device->id }}, {{ $device->name }} ({{ $device->description }}) dentro de las proximas 24hs va a dejar de contar con el servicio de monitoreo activo debido a que el periodo que corresponde al ultimo pago se termina el {{ $mail_information->last_created_at }}.
<hr>

Desde el siguiente boton puede realizar el pago para extender el servicio de monitoreo de su dispositivo.

@component('mail::button', ['url' => route('pays.create', $device->id) ])
Pagar para {{ $device->name }}
@endcomponent


Atentamente,<br>
{{ config('app.name') }}
@endcomponent

