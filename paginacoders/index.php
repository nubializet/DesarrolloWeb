<!DOCTYPE html>
<html>
<head>
	<title>Coders</title><!--Comentarios-->
	<link rel="stylesheet" type="text/css" href="css/materialize.min.css" media="screen,projection">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<meta name="viewport"  content="width=device-width, initial-scale=1.0"/>
</head>
<body>
	<ul id="dropdown1" class="dropdown-content"><!--Boton derecho-->
	  <li><a href="#!" class="purple-text"><i class="material-icons">face</i>Mi perfil</a></li>
	  <li><a href="#!" class="purple-text"><i class="material-icons">star</i>Salir</a></li>

	</ul>
	<nav>
	  <div class="nav-wrapper purple lighten-1"><!--Barra superior-->

		<a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
		<a href="#">Coders</a>
		  <ul id="slide-out" class="side-nav"><!--Menu desplegable-->
		   	<li>
		   		<li>
		   		<div class="row">
		   			<div class="col s4">
		   				<i class="large material-icons purple-text center">loyalty</i>
		   			</div>
		   				<div class="col s8 grey-text">
		   				<b class="username">Nubia Salgado</b>
		   				<span  class="email">nubializ@gmail.com</span>
		   			</div>
		   		</div>
		   		</li>
			    <li><div class="divider"></div></li>
			    <li><a href="#!"><i class="material-icons yellow-text">star</i> Favoritos</a></li>
			    <li><a href="#!"><i class="material-icons blue-text">image</i> Fotos</a></li>
			    <li><a href="#!"><i class="material-icons orange-text">person</i>Contactos</a></li>
		 	 </li>
		  </ul>
		  <ul class="right">
			  <li>
			  	<a class="dropdown-button" href="#!" data-activates="dropdown1">Nubia Salgado<i class="material-icons right">arrow_drop_down</i></a>
			  </li>
		  </ul>
		 <div class="fixed-action-btn"><!--Icono desplegable-->
		    <a id="btn-floating" class="btn-floating btn-large pulse purple lighten-1">
		      <i class="large material-icons">mode_edit</i>
		    </a>
		    <ul>
		      <li><a class="btn-floating blue"><i class="material-icons">insert_chart</i></a></li>
		      <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
		      <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
		      <li><a class="btn-floating orange"><i class="material-icons">attach_file</i></a></li>
		    </ul>
		  </div>
		  <div class="tap-target yellow" data-activates="btn-floating"><!--Tema-->
		    <div class="tap-target-content">
		      <h5>Title</h5>
		      <p>A bunch of text</p>
		    </div>
		  </div>
		</div>


	</nav>
	<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
	  <script>
    $(document).ready(function(){
     $('.tap-target').tapTarget('open');
     $(".button-collapse").sideNav();
      
     })     
  </script>
</body>
</html>

