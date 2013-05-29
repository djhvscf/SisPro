	<html>
	<head>
		<title>Agregar Usuario</title>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<script type="text/javascript" src="js/livevalidation_standalone.js"></script>
		<script type="text/javascript" src="js/validaUsuario.js"></script>
		<script type="text/javascript" src="js/validacionesUsuarios.js"></script>
		<!--Elaborado por: Dennis Hernández Vargas-->
		<!--Creación: 4/7/2012 7:00p.m.-->
		<!--Ultima modificación: 11:24 p.m.-->
	</head>
	<body onLoad = "activarValidaciones()">
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
    				<ul class="breadcrumb"><!--barra subMenu-->
				    <li>
					    <a href="inicio.php">Inicio</a> <span class="divider">/</span>
					</li>
					<li>
					    <a href="mantenimientoUsuarios.php">Usuarios</a> <span class="divider">/</span>
					</li>
				    <li class="active">Formulario de usuario</li>
				</ul>
</div><!-- /navbar -->
</div><!--fin barra fija-->        
		<div id="headerP"></div>
		<div class="container">
			<form name="frmAgregarUsuario" action="agregarUsuario.php"  method="post" class="form-horizontal">
				<fieldset>
					<legend>Agregar Usuario</legend>
					<div>
					<?php
						$existe;
                        if(array_key_exists('txtNombre',$_POST))
                        {	
							$nombre_usuario=$_POST['txtUsuario'];
							$existe = $gestor->buscarUsuarioExiste($nombre_usuario);
							if($existe == false){
								$nombre=$_POST['txtNombre'];
								$apellido_1=$_POST['txtPrimerApellido'];
								$apellido_2=$_POST['txtSegundoApellido'];
								$num_cedula=$_POST['txtNumCedula'];
								$nombre_usuario=$_POST['txtUsuario'];
								$contrasena=$_POST['pwdClave'];
								$id_estado=$_POST['rbtRol'];
								$gestor->agregarUsuario($nombre,$apellido_1,$apellido_2,$num_cedula,$nombre_usuario,$contrasena,$id_estado);
								echo "<div id='msj' class='alert alert-success' style='display:block'>El usuario fue agregado.</div>";
							}else{
							echo "<div id='msj' class='alert alert-error' style='display:block'>El nombre de usuario ya existe.</div>";
							}
                        }
                    ?>
					
                    </div>
					<div name="divsiglas" id="divsiglas" class="control-group">
						<label name="lblsiglas" id="lblsiglas" class="control-label">Nombre</label>
						<div class="controls">
							<input type="text" id="txtNombre" name="txtNombre" class="input-xlarge" />
						</div>
					</div>
					<div name="divcodigo" id="divcodigo" class="control-group">
						<label name="lblcodigo" id="lblcodigo" class="control-label">Primer apellido</label>
						<div class="controls">
							<input type="text" id="txtPrimerApellido" name="txtPrimerApellido" class="input-xlarge" />
						</div>
					</div>
					<div name="divgrado" id="divgrado" class="control-group">
						<label name="lblgrado" id="lblgrado" class="control-label">Segundo apellido</label>
						<div class="controls">
						<input type="text" id="txtSegundoApellido" name="txtSegundoApellido" class="input-xlarge" />
						</div>
					</div>
					<div name="divname" id="divname" class="control-group">
						<label name="lblname" id="lblname" class="control-label">Numero de cedula</label>
						<div class="controls">
						<input type="text" id="txtNumCedula" name="txtNumCedula" class="input-xlarge" />
						</div>
					</div>
					<div name="divname" id="divname" class="control-group">
						<label name="lblname" id="lblname" class="control-label">Nombre de usuario</label>
						<div class="controls">
						<input type="text" id="txtUsuario" name="txtUsuario" class="input-xlarge"/>
						</div>
					</div>
					<div name="divname" id="divname" class="control-group">
						<label name="lblname" id="lblname" class="control-label">Contraseña</label>
						<div class="controls">
						<input type="password" id="pwdClave" name="pwdClave" class="input-xlarge" />
						</div>
					</div>
					<div name="divname" id="divname" class="control-group">
						<label name="lblname" id="lblname" class="control-label">Confirma contraseña</label>
						<div class="controls">
						<input type="password" id="pwdConfirmClave" name="pwdConfirmClave" class="input-xlarge" />
						</div>
					</div>
					<div name="divname" id="divname" class="control-group">
						<label name="lblname" id="lblname" class="control-label">Rol</label>
						<div class="controls">
							<label class="radio">
								<input type="radio" id="rbtAdmin" name="rbtRol" value="1"/>
								Administrador
							</label>
							<label class="radio">
								<input type="radio" id="rbtUsuario" name="rbtRol" value="2" checked />
								Usuario
							</label>
					</div>
					<div class="form-actions">
						<input type="submit" name="btnIngresarUsuario" value="Ingresar" onClick="" class="btn btn-primary">
						<input type="reset" name="btnLimpiar" id="btnLimpiar" onClick="PoneCursor()" class="btn" value="Limpiar">
					</div>
				</fieldset>
			</form>	
		</div>
		<div id = "footerP">
			<hr> Copyright Yaisoft 2012 &copy;
		</div>
	</body>
</html>