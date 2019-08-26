@component('mail::message')
#Sr. {{ $user->name }}:
# {{ $device->name }} esta monitoreado.

<hr>
El dispositivo N°{{ $device->id }}, {{ $device->name }} ({{ $device->description }}) desde este momento cuenta con el servicio activo de monitoreo al acreditarse el pago.
Actualmente, el monitoreo permanecera activo hasta la fecha {{ $mail_information->last_created_at }}.
<hr>

Atentamente,<br>
{{ config('app.name') }}
@endcomponent
