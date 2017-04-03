@component('mail::message')

Hola {{$user->first_name}}, estás recibiendo este mensaje porque has cambiado tu correo electrónico, necesitamos corroborar que este correo te pertenezca.

Los datos son:

### Usuario : {{$user->email}}
### Contraseña ******

Ahora tu cuenta se encuentra desactivada, sin embargo puedes activarla dando clic en el botón de abajo.

@component('mail::button', ['url' => $user->activation_url ,'color' => 'green'])
	Activar cuenta
@endcomponent


Saludos,<br>
{{ config('app.name') }}
@endcomponent
