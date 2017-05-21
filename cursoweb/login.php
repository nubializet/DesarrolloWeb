<!DOCTYPE html>
<html>
<head>
	<title>Desarrollo Web</title><!--Comentarios-->
	<link rel="stylesheet" type="text/css" href="css/materialize.min.css" media="screen,projection">
	<meta name="viewport"  content="width=device-width, initial-scale=1.0"/>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col s6">
				<div class="col s12">
					<img src="img/iphone.png" style="width: 100%;">
				</div>
			</div>
			<div class="col s6">
				<form>

					<div class="row">
						<div class="col s12">
							<h2>Login</h2>
						</div>
					</div>

					<div class="row">
						<div class="input-field col s12">
							<input id="email" type="email" class="validate">
							<label for="email">Email</label>
						</div>
					</div>

					<div class="row">
						<div class="input-field col s12">
							<input id="pass" type="password" class="validate">
							<label for="pass">Contraseña</label>
						</div>
					</div>

					<div class="row">
						<div class="col s12 center-align">
							<button type="submit"  class="btn green">
							Entrar
							</button>
							<br><br>
								O <a href="index.php">Registra tu cuenta</a>
						</div>
					</div>

				</form>
			</div>

		</div>
	</div>
	<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>

