<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Digital</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- bootstrap & fontawesome -->
		<!--<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">-->
		<link href="{{asset('assets/font-awesome/4.2.0/css/font-awesome.min.css')}}" rel="stylesheet">
		<link href="{{asset('css/app.css')}}" rel="stylesheet">
		<link href="{{asset('css/jquery-ui.min.css')}}" rel="stylesheet">
		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="{{asset('assets/fonts/fonts.googleapis.com.css')}}">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-colvis-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/datatables.min.css"/>

		<!-- ace styles -->
		<link rel="stylesheet" href="{{asset('assets/css/ace.min.css')}}" class="ace-main-stylesheet" id="main-ace-style">
		
		<!-- ace settings handler navbar-fixed-top-->

<!-- stylo para navbar en tarjetas -->
		<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #045FB4;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #A9E2F3;
  color: black;
}

.topnav a.active {
  background-color: #4CAF50;
  color: white;
}
</style>
		
	</head>
	<body class="no-skin">
	<style>
		.fix-sidebar{
  		position: fixed;
			}
		</style>
		<div id="navbar" class="navbar navbar-default navbar-fixed-top" role="navigation">

			<div class="navbar-container" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="/" class="navbar-brand">
						<small>
							<i class="fa fa"></i>
							Sistema de Tarjetas Unilever Comayagua
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">

						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<!--<img class="nav-user-photo" src="assets/avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info">-->
									<small>Bienvenid@ {{ Auth::user()->name }}</small>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<!--enlace para configuracion-->
								<li>
									<a href="#">
										<i class="ace-icon fa fa-cog"></i>
										Ajustes
									</a>
								</li>
									<!--enlace para perfil de usuario-->
								<li>
									<a href="{{URL::action('UsersController@show', Auth::user()->id)}}">
										<i class="ace-icon fa fa-user"></i>
										Perfil
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="{{ route('logout') }}" onclick="event.preventDefault();
									document.getElementById('logout-form').submit();">
										<i class="ace-icon fa fa-power-off"></i>
										Cerrar Sesion
									</a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											{{ csrf_field() }}
									</form>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container" id="main-container">
			<!--<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>-->

			<div id="sidebar" class="sidebar responsive fix-sidebar">
				<!--<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>-->

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<style media="screen">
							.logoU { position:relative top: 5px; left: 10px; padding: 5px; float:none; width: 95px; }
						</style>

							<img class="logoU" src="{{asset('images/logo.png')}}" id="logo">
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="active">
						<a href="/">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Pagina Principal </span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-tags"></i>
							<span class="menu-text">
								Tarjetas
							</span>
							<b class="arrow fa fa-angle-down"></b>
						</a>

            				<b class="arrow"></b>
						<ul class="submenu">

							<li class="">
								<a href="/tarjetas">
									<i class="menu-icon fa fa-caret-right"></i>
									Tarjetas Amarillas
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="/tarjetas-rojas">
									<i class="menu-icon fa fa-caret-right"></i>
									Tarjetas Rojas
								</a>

								<b class="arrow"></b>
							</li>							
						</ul>
					</li> <!--Fin de primer menu de tarjetas-->



					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Areas </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<li class="">
								<a href="/areas">
									<i class="menu-icon fa fa-caret-right"></i>
									Listado de Areas
								</a>

								<b class="arrow"></b>
							</li>
							
						</ul>
					</li>

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-gavel"></i>
							<span class="menu-text"> Equipos </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<li class="">
								<a href="/equipos">
									<i class="menu-icon fa fa-caret-right"></i>
									Listado de Equipos
								</a>
								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="/equipos/create">
									<i class="menu-icon fa fa-caret-right"></i>
									Crear Nuevo
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>


					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-tag"></i>
							<span class="menu-text"> Categorias </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="/categorias">
									<i class="menu-icon fa fa-caret-right"></i>
									Lista de Categorias
								</a>
								<b class="arrow"></b>
							</li>

						</ul>
					</li>

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-th"></i>
							<span class="menu-text">Eventos</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="/eventos">
									<i class="menu-icon fa fa-caret-right"></i>
									Lista de Eventos
								</a>
								<b class="arrow"></b>
							</li>

						</ul>
					</li>

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-file-o"></i>
							<span class="menu-text">Causas</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="/causas">
									<i class="menu-icon fa fa-caret-right"></i>
									Lista de Causas
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>


					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-tasks"></i>
							<span class="menu-text">Plantas</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="/plantas">
									<i class="menu-icon fa fa-caret-right"></i>
									Lista de Plantas
								</a>
								<b class="arrow"></b>
							</li>

							<!--<li class="">
								<a href="/plantas/create">
									<i class="menu-icon fa fa-caret-right"></i>
									Crear Nueva Planta
								</a>
								<b class="arrow"></b>
							</li>-->
						</ul>
					</li>


					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-user"></i>
							<span class="menu-text">Empleados</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="/users">
									<i class="menu-icon fa fa-caret-right"></i>
									Lista de Usuarios
								</a>
								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="/roles">
									<i class="menu-icon fa fa-caret-right"></i>
									Lista de Roles
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<li class="">
						<a href="" class="dropdown-toggle">
							<i class="menu-icon fa fa-bolt"></i>
							<span class="menu-text">Energia</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="/medidores">
									<i class="menu-icon fa fa-caret-right"></i>
									Lecturas de Energia
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>


				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="/">Home</a>
							</li>

							{{--<li class="active">Dashboard</li>--}}

						</ul><!-- /.breadcrumb -->
					</div>
					<script type="text/javascript">




						//try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}

					</script>
<div class="container-fluid">
	 @yield('contenido')
</div>


			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder"></span>
							Copyright Elmer Hernandez©   2018
						</span>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="https://www.facebook.com/geovany.hernandez.3781">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

						</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
</div><!-- /.main-container -->
		<!-- basic scripts -->

		 <script src="{{asset('assets/js/jquery-3.3.1.js')}}"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-colvis-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/datatables.min.js"></script>
		<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
	    <script src="{{asset('js/jquery-ui.min.js')}}"></script>

		<!-- page specific plugin scripts -->
		{{--<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('assets/js/jquery.dataTables.bootstrap.min.js')}}"></script>
		<script src="{{asset('assets/js/dataTables.tableTools.min.js')}}"></script>
		<script src="{{asset('assets/js/dataTables.colVis.min.js')}}"></script>--}}
		<!-- ace scripts -->
		<script src="{{asset('assets/js/ace-elements.min.js')}}"></script>
		<script src="{{asset('assets/js/ace.min.js')}}"></script>
		<!--<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>-->
		<script src="{{asset('js/app.js')}}"></script>
		
        @yield('scripts')
{!! Toastr::message() !!}
	</body>
</html>
