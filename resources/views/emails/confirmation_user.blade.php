@component('mail::message')

Estimad@ <strong>{{$user->name}}</strong> favor confirma tu correo:
<br>
@component('mail::panel')
<p>Favor haga click en el siguiente enlace para confirmar</p>
@endcomponent

@component('mail::button', ['url' => 'http://localhost:8000/register/verify/'.$user->confirmation_code])
Confirmar Cuenta
@endcomponent

<br>
Sistema de Tarjetas CIC
@endcomponent