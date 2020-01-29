@component('mail::message')
#Sr. Administrador:
# Se ha creado un nuevo usuario:

El sr {{ $user->name }} {{ $user->surname }} con ID {{ $user->id }} se ha registrado en el sistema.

<hr>
La direccion de mail del usuario es {{ $user->email }}.
<hr>

Desde el siguiente enlace puede revisar la informacion del usuario.

@component('mail::button', ['url' => route('users.show', $user->id) ])
Informacion de {{ $user->name }}
@endcomponent

Atentamente,<br>
{{ config('app.name') }}
@endcomponent
