@extends('layouts.app')

@section('content')
<link href="{{asset('hmcss/main_styles.css')}}" rel="stylesheet">

<style media="screen">
  .logo { padding: 5px; margin: 30px; border: 0px solid black; float: right; width: 150px; }
  .logo2 { position:relative; top 155px; left: 15px; float: left; width: 450px; }
  body {
background-color: white;
background-image: url("{{asset('images/bg.jpg')}}");
   }


   
   
</style>

<div class="row">
  <div class="col-lg-2">
<img class="logo" src="images/logo.png" id="logo">
</div>
</div>


  
    <br>
   
<div class="hero_boxes">
		<div class="hero_boxes_inner">
			<div class="container">
				<div class="row">
          
					<div class="col-lg-3 col-md-6 col-sm-6 hero_box_col">
						<div class="hero_box d-flex flex-row align-items-center justify-content-start">
							<div class="hero_box_content">
								<h2 class="hero_box_title">Tarjetas Amarillas</h2>
								<a href="/tarjetas" class="hero_box_link">ver todas las tarjetas amarillas</a>
							</div>
						</div>
					</div>
          
					<div class="col-lg-3 col-md-6 col-sm-6 hero_box_col">
						<div class="hero_box d-flex flex-row align-items-center justify-content-start">
							<div class="hero_box_content">
								<h2 class="hero_box_title">Tarjetas Rojas</h2>
								<a href="/tarjetas-rojas" class="hero_box_link">ver todas las tarjetas rojas</a>
							</div>
						</div>
					</div>
          
					<div class="col-lg-3 col-md-6 col-sm-6 hero_box_col">
						<div class="hero_box d-flex flex-row align-items-center justify-content-start">
							<div class="hero_box_content">
								<h2 class="hero_box_title">Energia</h2>
								<a href="/medidores" class="hero_box_link">ver todas las lecturas</a>
							</div>
						</div>
          </div>
          
          <div class="col-lg-3 col-md-6 col-sm-6 hero_box_col">
						<div class="hero_box d-flex flex-row align-items-center justify-content-start">
							<div class="hero_box_content">
								<h2 class="hero_box_title">Calidad</h2>
								<a href="#" class="hero_box_link">ver todas las lecturas</a>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

@endsection
