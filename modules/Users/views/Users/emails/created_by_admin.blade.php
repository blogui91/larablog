@component('mail::message')
# Bienvenido a {{ config('app.name') }}

Hola {{$user->first_name}}, estás recibiendo este mensaje porque el administrador de esta plataforma te ha dado de alta, solo tienes que entrar a nuestro sitio para que veas nuestro contenido Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae quidem, nam. Odit amet, libero, deleniti doloribus dolore alias, numquam, possimus ipsum quam hic praesentium laboriosam eius totam repellat nisi eum. 

Hemos creado una contraseña temporal para tí, te recomentadamos que al iniciar sesión la cambies por una que recuerdes bien.

Los datos son:

### Usuario : {{$user->email}}
### Contraseña {{$user->pw_temp}}

@component('mail::button', ['url' => url('login'),'color' => 'blue'])
Iniciar sesión
@endcomponent

Saludos,<br>
{{ config('app.name') }}
@endcomponent
