@component('mail::message')
#Sr. Administrador:
# {{ $device->name }} esta fuera de rango.

El equipo del sr {{ $user->name }} con ID {{ $device->id }} se encuentra fuera de los limites establecidos de temperatura por un tiempo mayor al que se ha determinado en el retardo al aviso.
El dia {{ $mail_information->last_created_at }} el equipo salio de rango.

<hr>
El numero de telefono del usuario es {{ $user->phone_area_code }} - {{ $user->phone_number }}, su direccion es {{ $user->address }}.
<hr>

Desde el siguiente enlace puede revisar los mediciones realizadas por el dispositivo en la ultima hora.

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
