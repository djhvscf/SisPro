<?php
	//session_start();
	include "Gestor.php";
	$gestor = new Gestor();

	$usuario = $_POST['txtUsername'];
	$clave = $_POST['txtPassword'];
	$redirect = $_GET['redirect'];

	$consulta = $gestor->buscarUsuario($usuario, $clave);

	if (count($consulta)==0){
		header("location:login.php?state=invalidCredentials");
	}
	else{
		session_start();
		$_SESSION['Id_usuario'] = $consulta[0];
		$_SESSION['nombre'] = $consulta[1];
		$_SESSION['apellido_1'] = $consulta[2];
		$_SESSION['apellido_2'] = $consulta[3];
		$_SESSION['nombre_usuario'] = $consulta[4];
		$_SESSION['contrasena'] = $consulta[5];
		$_SESSION['id_estado'] = $consulta[6];
		header("location:$redirect");
	}
?>