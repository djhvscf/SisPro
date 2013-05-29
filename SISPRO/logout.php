<?php
	session_start();
	if(!isset($_SESSION['Id_usuario'])){
		header("location:login.php");
	} else {
		session_unset();
		session_destroy();
		header("location:login.php?state=logout");
	}
?>