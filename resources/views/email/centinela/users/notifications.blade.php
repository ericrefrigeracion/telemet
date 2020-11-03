@component('mail::message')
#Estas son las notificaciones de {{ $device->name }} en las ultimas 24hs.

<hr>
@foreach($alerts as $alert)
{{ $alert->alert_created_at }} -> {{ $alert->log }}<br>
@endforeach
<hr>

Desde el siguiente boton puede revisar los detalles de las alertas de su dispositivo.

@component('mail::button', ['url' => route('alerts.index', $device->id) ])
Alertas de {{ $device->name }}
@endcomponent

Atentamente,<br>
{{ config('app.name') }}
@endcomponent