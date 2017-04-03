@component('mail::message')
# Bienvenido a {{ config('app.name') }}

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus eligendi exercitationem minima quae voluptas iste, cum, architecto non explicabo voluptates aperiam laudantium, pariatur assumenda modi debitis nobis cumque. A, consequuntur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima sapiente mollitia ipsum aliquam veritatis illum iste aspernatur? Iusto fugiat est quos, assumenda recusandae, placeat. Non saepe aperiam atque temporibus quis.

@component('mail::button', ['url' => '','color' => 'blue'])
Acción
@endcomponent

Saludos,<br>
{{ config('app.name') }}
@endcomponent
