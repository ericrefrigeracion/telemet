@component('mail::message')
#Sr. Administrador:
# {{ $device->id }} - {{ $device->name }} esta conectado.

El equipo del sr {{ $user->name }} {{ $user->surname }} con ID {{ $device->id }} se encuentra enviando datos nuevamente.

<hr>
El numero de telefono del usuario es {{ $user->phone_area_code }} - {{ $user->phone_number }}, su direccion es {{ $user->address }}.
<hr>

Desde el siguiente enlace puede revisar las mediciones realizadas por el dispositivo en la ultima hora.

@component('mail::button', ['url' => route('receptions.now', $device->id) ])
Metricas {{ $device->name }}
@endcomponent

Atentamente,<br>
{{ config('app.name') }}
@endcomponent
