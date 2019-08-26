@component('mail::message')
#Sr. Administrador:
# {{ $device->id }} - {{ $device->name }} esta desconectado.

El equipo del sr {{ $user->name }} {{ $user->surname }} con ID {{ $device->id }} se encuentra sin enviar datos por los ultimos 10 minutos.

Los ultimos datos que tenemos de su equipo son el {{ $mail_information->last_created_at }}.

<hr>
El numero de telefono del usuario es {{ $user->phone_area_code }} - {{ $user->phone_number }}, su direccion es {{ $user->address }}.
<hr>

Desde el siguiente enlace puede revisar las mediciones realizadas por el dispositivo en la ultima hora.

@component('mail::button', ['url' => route('receptions.show-hour', $device->id) ])
Metricas {{ $device->name }}
@endcomponent

Atentamente,<br>
{{ config('app.name') }}
@endcomponent
