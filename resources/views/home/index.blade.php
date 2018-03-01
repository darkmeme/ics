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


<div class="row">
  <div class="col-lg-8 pull-right">
    <h3 class="header smaller lighter blue">Bienvenido al Sistema de Reportes CIC</h3>
  </div>
</div>

<br>
<style media="screen">
.amarillo{ background-color:yellow;}
</style>



<div class="container">
  <div class="col-lg-2">

  </div>

<div class="row">
  <div class="col-xl-2 col-sm-2 mb-3">
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


    <div class="col-xl-2 col-sm-2 mb-3">
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

    <div class="col-xl-2 col-sm-2 mb-3">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Energia</h3>
    </div>
    <div class="panel-body">
      Modulo de lecturas de nergia
    </div>
    <div class="center-block" style="width:100px;">
    <a href="/medidores">Acceder...</a>
    </div>
  </div>
    </div>

    <div class="col-xl-2 col-sm-2 mb-3">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Calidad</h3>
    </div>
    <div class="panel-body">
      <br>
      Modulo de Calidad

    </div>
    <div class="center-block" style="width:100px;">
    <a href="/">Acceder...</a>
    </div>
  </div>
    </div>

<!--<div class="center-block" style="width:150px;height:100px;background-color:red;">
  <p>prueba</p>
</div>-->




</div>
@endsection
