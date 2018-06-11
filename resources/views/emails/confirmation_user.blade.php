@component('mail::message')

Estimad@ administrador el usuario: <strong>{{$user->name}}</strong> con correo: <strong>{{$user->email}}
,quiere acceder a la aplicación de tarjetas, pide autorización para ingresar.
<br>
@component('mail::panel')
<p>Favor haga click en el siguiente enlace para confirmar</p>
@endcomponent

@component('mail::button', ['url' => 'http://localhost:8000/register/verify/'.$user->confirmation_code])
Autorizar Cuenta
@endcomponent

<br>
Sistema de Tarjetas CIC
@endcomponent