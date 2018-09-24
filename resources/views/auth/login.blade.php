
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Digital</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
  </head>
  <body>

    <div class="col-lg-6 col-sm-6 col-lg-offset-3 col-sm-offset-2">
@if(Session::has('success'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  {{Session::get('success')}}
</div>
@endif
</div>         
                                <form class="login" method="POST" action="{{ route('login') }}">
                                    {{ csrf_field() }}
                                    <h1 class="login-title">COMPLEJO INDUSTRIAL COMAYAGUA</h1>
                                    <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <input id="email" type="email" placeholder="Email" class="login-input" name="email" value="{{ old('email') }}" required autofocus>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif                               
                                    </div>
                                    

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input id="password" type="password" placeholder="Contraseña" class="login-input" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="form-group">
                                    <button type="submit" class="login-button-verde">
                                        Entrar
                                    </button>
                <a href="{{ route('register') }}"><button type="button" class="login-button-rojo">
                                      Registrarse
                                    </button></a>
                                    <a class="login-lost" href="{{ route('password.request') }}">
                                        Olvidó su contraseña?
                                    </a>
                            </div>
                        </form>
  </body>
</html>
