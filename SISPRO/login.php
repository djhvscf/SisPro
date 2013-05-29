<html>
<head>
	<title> SisPro Cenfotec </title>	
	<link href="css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/loginStyle.css" />
	<script type="text/javascript" src="js/loginValidation.js"></script>
</head>
<body id="login">
	<?php
		$estado = "";
		$redirect = "inicio.php";
		session_start();
		if(isset($_SESSION['Id_usuario'])) {
			header ("Location: inicio.php");
		}
		if(array_key_exists('state',$_GET)){
			$estado = $_GET['state'];
			$mensaje = "Parámetros no válidos";
			$tipo = "alert-error";
			switch ($estado) {
				case "logout":
					$tipo = "alert-info";
					$mensaje = "La sesión ha sido cerrada con éxito";
				break;
				case "false":
					$mensaje = "Se requiere iniciar sesión para acceder al sistema";
					if(array_key_exists('redirect',$_GET))
						$redirect = $_GET['redirect'];
				break;
				case "invalidCredentials":
					$mensaje = "El usuario y/o la contraseña son incorrectos";
				break;
			}
		}
	?>
	<div class = "login-wrap">
		<div id = "headerLogin"></div>
		<div class="container">
			<div class="row">
				<div class="span8 offset2">
					<?php 
						if(array_key_exists('state',$_GET)){
							print "<div class='alert ".$tipo."'>".$mensaje."</div>";
						}
					?>
				</div>
			</div>
		</div>
		<form name="loginForm" id="loginForm" class="generic" action="validarSesion.php<?php print "?redirect=$redirect"; ?>" method="post">
			<div class = "loginFormHeader">
				<h2> Iniciar sesi&oacute;n</h2>
			</div>
			<div id	="user" class="field">
				<label>Nombre de usuario</label>
				<input name="txtUsername" id="txtUsername" type="text" class="text" placeholder="Nombre de Usuario" tabindex="1" maxlength="12">
			</div>
			<div id="pass" class="field">
				<label>Contrase&ntilde;a</label>
				<input name="txtPassword" id="txtPassword" type="password" class="text" placeholder="Contrase&ntilde;a" tabindex="1" maxlength="20">
			</div>
			<br><br><br>
			<div class="loginButton">
				<input id="login-submit" type="submit" value="Ingresar">
			</div>
		</form>
	</div>
	<div class="footer">
		<hr> <p>Copyright Yaisoft 2012 &copy; </p>	
	</div>		
</body>
</html>