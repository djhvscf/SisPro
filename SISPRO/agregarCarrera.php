<html>
	<head>
		<title>Formulario Carrera</title> 
		<!--Formulario para agregar carreras al sistema-->
		<!--Elaborado por: Victor Perez Rodriguez-->
		<!--Fecha de creación: 10:34 a.m. 06/07/2012-->
		<!--Fecha de última modificación: 10:05 p.m. 11/08/2012-->   
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/styleCarrera.css" type="text/css" rel="stylesheet">
		<link href="css/style.css" type="text/css" rel="stylesheet">
		<script type="text/javascript" src="js/activarAdmin.js"></script>
		<script type="text/javascript" src="js/filterTable.js"></script><!--llamada del filtro del la tabla-->
		<script type="text/javascript" src="js/sorttable.js"></script><!--ordena campos en tabla-->
		<script type="text/javascript" src="js/validaCarrera.js"></script><!--llamada del validador de datos del formulario-->
		<script type="text/javascript" src="js/livevalidation_standalone.js"></script>
	</head>
	<body onLoad="activarValidaciones()">
	<?php
		// ===== Comprueba Session ==================
	$id_usuario = 0;
	$nombre_usuario = "";
	$rol_usuario = 0;
	session_start();
	if(isset($_SESSION['Id_usuario'])) {
		$id_usuario = $_SESSION['Id_usuario'];
		$nombre_usuario = $_SESSION['nombre_usuario'];
		$rol_usuario = $_SESSION['id_estado'];
		if ($rol_usuario == 2)
			header("Location: inicio.php");
	} else {
		header("Location: login.php?state=false&redirect=inicio.php");
	}
	// ==========================================
		include "Gestor.php";
		$gestor= new Gestor();
	?>
	<div class="barraNav"><!--Barra fija-->
		<div class="navbar"><!--Barra de menu superior-->
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</a>
					<a class="brand" href="#">Sistema de Administraci&oacute;n de Prospectos</a>
					<div class="nav-collapse">
						<div class="btn-toolbar nav pull-right mantenimiento">
							<?php
							if($rol_usuario == 1) {
							print "
							<li id = 'mantenimiento'>
								<a href='#'><i class='icon-wrench icon-white'></i>
								Mantenimiento
								</a>
								<ul class='dropdown-menu'><!--Menu desplegable de mantenimiento-->
									<li><a href='mantenimientoUsuarios.php'><i class='icon-user'></i> Usuarios</a></li>
									<li><a href='mantenimientoCarreras.php'><i class='icon-book'></i> Carreras</a></li>
								</ul>
							</li>
							";
							}
						?>
							<li>
								<a href="mostrarAyuda.php">Ayuda</a>
							</li>
							<div class="btn-toolbar nav usuario">
								<li><a href="#"> <i class="icon-user icon-white"></i>
									<div id = "nombreUsuario">
								<?php print $nombre_usuario; ?>
								</div>
									</a>
									<ul class="dropdown-menu"><!--Menu desplegable de Usuario-->
									<li><a href="detalleUsuarioPorUsuario.php<?php print "?id_usuario=$id_usuario"; ?>"> Cambiar contrase&ntilde;a</a></li>
									<li class="divider"></li>
									<li><a href="logout.php"> Cerrar sesi&oacute;n</a></li>
									</ul>
							</div>        
						</div>   
					</div><!-- /.nav-collapse -->
				</div>
			</div><!-- /navbar-inner -->
				<ul class="breadcrumb">
					<!--barra subMenu-->
					<li>
						<a href="inicio.php">Inicio</a> <span class="divider">/</span>
					</li>
					<li>
					<a href="mantenimientoCarreras.php">Carreras</a> <span class="divider">/</span>
					</li>
					<li class="active">Agregar Carrera</li>
				</ul>
		</div>
		<!-- /navbar -->
	</div>
		<!--fin barra superior-->
		<div id="headerP"></div>
		<div class="container">
			<form name="frmDatosCarrera" action="agregarCarrera.php" method="POST" class="form-horizontal"><!--Inicio de formulario-->
				<fieldset>
					<!--Titulo del formulario-->
					<legend>Agregar Carrera</legend>
					<?php
					$existe;
				if(array_key_exists('txtCodigo',$_POST))
				{
					$codigo = $_POST['txtCodigo'];
					$existe = $gestor->buscarCarreraExiste($codigo);
					if($existe == false){
						$codigo=$_POST['txtCodigo'];
						$id_grado=$_POST['sltId_Grado'];					
						$nombre=$_POST['txtNombre'];
						$aprobacion_conesup=$_POST['rbtAprobacion_Conesup'];
						$gestor->agregarCarrera($codigo, $id_grado, $nombre, $aprobacion_conesup);
						echo "<div id='msj' class='alert alert-success' style='display:block'>La carrera fue agregada.</div>";
					}else{
						echo "<div id='msj' class='alert alert-error' style='display:block'>El c&oacute;digo ya existe.</div>";
					}
				}
			?>
					<div name="divCodigo" id="divCodigo" class="control-group">
						<label name="divCodigo" id="lblCodigo" class="control-label">C&oacute;digo</label>
						<div class="controls">
							<input name="txtCodigo" id="txtCodigo" type="text" class="input-xlarge">
						</div>
					</div>					
					<div name="divId_Grado" id="divId_Grado" class="control-group">
						<label name="lblId_Grado" id="lblId_Grado" class="control-label">Grado</label>
						<div class="controls">
					<select id="sltId_Grado" name="sltId_Grado" class="input-xlarge">
						<option selected="selected" value = "seleccion">--Seleccione grado acad&eacute;mico</option>
						<option value = "1">T&eacute;cnico</option>
						<option value = "2">Diplomado</option>
						<option value ="3">Bachillerato</option>
						<option value ="4">Maestr&iacute;a</option>
					</select>		
						</div>
					
					</div>
					<div name="divNombre" id="divNombre" class="control-group">
						<label name="lblNombre" id="lblNombre" class="control-label">Nombre</label>
						<div class="controls">
							<input name="txtNombre" id="txtNombre" type="text" class="input-xlarge">
						</div>
					</div>
					<div name="divAprobacion_Conesup" id="divAprobacion_Conesup" class="control-group">
						<label name="lblAprobacion_Conesup" id="lblAprobacion_Conesup" class="control-label">Aprobaci&oacute;n Conesup</label>
						<div class="controls">
							<label class="radio">
								<input type="radio" id="rbtAdmin" name="rbtAprobacion_Conesup" value="1"/>
								Si
							</label>
							<label class="radio">
								<input type="radio" id="rbtNo" name="rbtAprobacion_Conesup" checked value="0"/>
								No
							</label>
						</div>
					</div>
					<div class="form-actions">
						<input type="submit" name="btnIngresarCarrera" value="Ingresar" onClick="" class="btn btn-primary">
						<input type="reset" name="btnLimpiar" id="btnLimpiar" onClick="PonerCursor()" class="btn" value="Limpiar">				
					</div>
				</fieldset>
			</form>
		</div>
		<div id="footerP">
			<hr />
			<hr> <p> Copyright Yaisoft 2012 &copy; </p> 
		</div>
	</body>
</html>