@component('mail::message')
#Sr. {{ $user->name }}:
# Se acredito un pago para {{ $device->name }}.

<hr>
Actualmente, el monitoreo para {{ $device->name }} ({{ $device->description }}) permanecera activo hasta la fecha {{ $mail_information->last_created_at }}.
<hr>

Desde el siguiente boton puede revisar los detalles del pago realizado.

@component('mail::button', ['url' => route('pays.index') ])
Mis Pagos
@endcomponent

Atentamente,<br>
{{ config('app.name') }}
@endcomponent
