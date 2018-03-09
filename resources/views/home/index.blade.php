@extends('layouts.app')

@section('content')

<style media="screen">
  .logo { padding: 5px; margin: 30px; border: 0px solid black; float: right; width: 200px; }
  .logo2 { position:relative; top: 155px; left: 15px; float: left; width: 450px; }
  body {
background-color: white;
   }
</style>
<div class="row">
  <div class="col-lg-1">
<img class="logo" src="images/logo.png" id="logo">
</div>
</div>


<div class="container">
<div class="row">
  <div class="col-lg-12 col-md-11 col-xs-11 pull-right">
    <h3 class="header smaller text-center lighter blue">Bienvenido al Sistema de Reportes CIC</h3>
  </div>
</div>

<br>
<style media="screen">
.amarillo{ background-color:yellow;}
</style>



<div class="row">
  <div class="col-lg-1 col-xs-1 col-md-1"></div>
  <div class="col-lg-11 col-md-11 col-xs-11">

  <div class="col-lg-3 col-md-3 ">
<div class="panel panel-warning">
  <div class="panel-heading">
    <h3 class="panel-title">Tarjetas Amarillas</h3>
  </div>
  <div class="panel-body">
    Modulo de Tarjetas Amarillas
  </div>
  <div class="center-block" style="width:100px;">
  <a href="/tarjetas">Acceder...</a>
  </div>
</div>
  </div>


    <div class="col-lg-3 col-md-3">
  <div class="panel panel-danger">
    <div class="panel-heading">
      <h3 class="panel-title">Tarjetas Rojas</h3>
    </div>
    <div class="panel-body">
      Modulo de Tarjetas Rojas
    </div>
    <div class="center-block" style="width:100px;">
    <a href="/">Acceder...</a>
    </div>
  </div>
    </div>

    <div class="col-lg-3 col-md-3">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Energia</h3>
    </div>
    <div class="panel-body">
      Modulo de lecturas de Energia
    </div>
    <div class="center-block" style="width:100px;">
    <a href="/medidores">Acceder...</a>
    </div>
  </div>
    </div>

    <div class="col-lg-3 col-md-3">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Calidad</h3>
    </div>
    <div class="panel-body">
      Modulo de Calidad
    </div>
    <div class="center-block" style="width:100px;">
    <a href="/">Acceder...</a>
    </div>
  </div>
    </div>
    </div>
</div>
</div>
@endsection
