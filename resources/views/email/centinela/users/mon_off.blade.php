@component('mail::message')
#Sr. {{ $user->name }} {{ $user->surname }}:
# {{ $device->name }} sin monitoreo.

<hr>
El dispositivo N°{{ $device->id }}, {{ $device->name }} ({{ $device->description }}) desde este momento no cuenta con el servicio activo de monitoreo debido a que el periodo que corresponde al ultimo pago se ha terminado.
<hr>

Desde el siguiente boton puede realizar el pago para activar el servicio de monitoreo de su dispositivo.

@component('mail::button', ['url' => route('pays.create', $device->id) ])
Pagar para {{ $device->name }}
@endcomponent


Atentamente,<br>
{{ config('app.name') }}
@endcomponent
