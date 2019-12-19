@component('mail::message')
#Sr. Administrador:
# {{ $device->id }} - {{ $device->name }} tiene un rendimiento por debajo del esperado.

El equipo del sr {{ $user->name }} {{ $user->surname }} con ID {{ $device->id }} se encuentra fuera de set point al no alcanzar el valor de temperatura deseado en el tiempo previsto en el retardo para el aviso, en la configuracion del dispositivo.

La ultima vez que el equipo llego a la temperatura deseada fue {{ $mail_information->last_created_at }}.

<hr>
El numero de telefono del usuario es {{ $user->phone_area_code }} - {{ $user->phone_number }}, su direccion es {{ $user->address }}.
<hr>

Desde el siguiente enlace puede revisar las mediciones realizadas por el dispositivo en la ultima hora.

@component('mail::button', ['url' => route('receptions.now', $device->id) ])
Metricas {{ $device->name }}
@endcomponent

Desde el siguiente enlace puede revisar las configuraciones del dispositivo.

@component('mail::button', ['url' => route('devices.show', $device->id) ])
Configuracion {{ $device->name }}
@endcomponent


Atentamente,<br>
{{ config('app.name') }}
@endcomponent
