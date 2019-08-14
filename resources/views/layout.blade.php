<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title> @yield('title') </title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	
	<link rel="stylesheet" href="{{ asset('css/schedule.css') }}">
	<link rel="stylesheet" href="{{ asset('css/fontawesome.v5.8.2.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
	
	
	<style>
		* { 
			outline: none; 
		}
	</style>
</head>
<body>

	
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
		<a class="navbar-brand" href="#">
			@section('brand-text')
			@show
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav ml-auto">
				@section('navbarOptions')
				@show
			</ul>
		</div>
	</nav>
	
	<div>
		<div class="alert alert-warning mx-auto container mt-5 text-center" role="alert">
			<b>Le recomendamos que active las notificaciones para una mejor experiencia</b>
		</div>
		@section('content')
		@show		
	</div>

	

	@section('form')
	@show

	<script type="text/javascript" src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>


	<script type="text/javascript">
		function prueba_notificacion() {
			if (Notification) {
				if (Notification.permission !== "granted") {
					Notification.requestPermission()
				}
				var title = "LINE - TIME"
				var extra = {
					body: "{{ Session::get('mensaje',"Bienvenido a Linea de tiempo") }}"
				}
				var noti = new Notification( title, extra)

				setTimeout( function() { noti.close() }, 5000)
			}
		}

		window.onload=prueba_notificacion();

	</script>

</body>
</html>