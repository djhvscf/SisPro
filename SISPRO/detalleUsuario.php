<html>
	<head>
		<title>Modificar usuario</title>
		<link href="css/bootstrap.css" rel="stylesheet" />
		<link href="css/style.css" rel="stylesheet" />
		<script type="text/javascript" src="js/modificarDatos.js"></script><!--llamada del modificador de datos del formulario-->
		<script type="text/javascript" src="js/livevalidation_standalone.js"></script><!--llamada del validador de datos del formulario-->
		<script type="text/javascript" src="js/validacionesUsuarios.js"></script><!--llamada del validador de datos del formulario-->
		
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
		$_usuario= $_GET['usuario'];
		include "Gestor.php";
		$gestor= new Gestor();
		$queryString = "usuario=$_usuario";
		$consulta=$gestor->buscarUsuarioPorID($_usuario);
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
							<a href="mantenimientoUsuarios.php">Usuarios</a> <span class="divider">/</span>
						</li>
						<li class="active">Detalle de usuario</li>
					</ul>
			</div>
			<!-- /navbar -->
		</div>
		<!--fin de barra fija-->
		<div id="headerP"></div>
		<div class="container">
				<?php
					$urlDetalle = "detalleUsuario.php?" . $queryString;
					echo "<form action=$urlDetalle method='post' id='frmAgregarUsuario' class= 'form-horizontal'>";
				?>
			
				<fieldset>
					<!--Titulo del formulario-->
					
					<legend><?php echo $nombre = $consulta[1]." ".$apellido_1 = $consulta[2]." ".$apellido_2 = $consulta[3];?></legend>
							<?php
								if(array_key_exists('txtUsuario',$_POST)){
									$nombre_usu = $_POST['txtUsuario'];
									$existe = $gestor->verificaUsuarioModificar($nombre_usu);
								}
								if(array_key_exists('txtNombre',$_POST))
								{	
									$nombre=$_POST['txtNombre'];
									$apellido_1=$_POST['txtPrimerApellido'];
									$apellido_2=$_POST['txtSegundoApellido'];
									$num_cedula=$_POST['txtNumCedula'];
									$nombre_usu=$_POST['txtUsuario'];
									$contrasena=$_POST['pwdClave'];
									$id_estado=$_POST['rbtRol'];
									$claveActual=$_POST['pwdClaveActual'];
									$claveUs = $gestor->buscarUsuarioContrasena($id_usuario);
									if($claveActual == $claveUs ){
									if($existe <= 1 ){
										$gestor->modificarUsuario($_usuario, $nombre,$apellido_1,$apellido_2,$num_cedula,$nombre_usu, $contrasena, $id_estado);
										echo "<div id='msj' class='alert alert-success'>El usuario fue modificado.</div>";
									}else{
										echo "<div id='msj' class='alert alert-error' style='display:block'>El nombre de usuario ya existe.</div>";
									}
									}else{
										echo "<div id='msj' class='alert alert-error' style='display:block'>La clave del administrador actual es incorrecta. Se requiere ingresar su clave para modificar los datos del usuario.</div>";
									}
								}
								$consulta=$gestor->buscarUsuarioPorID($_usuario);
							?>
					<div name="divNombre" id="divNombre" class="control-group">
						<label name="lblNombre" id="lblNombre" class="control-label">Nombre</label>
						<div class="controls">
							<?php
								$nombre = $consulta[1];
								echo "<td><input name='txtNombre' type='text' id='txtNombre' value='$nombre' class='input-xlarge' onClick ='readOnly = false' readOnly/></td>";
								 
							?>
						</div>
					</div>
					<div name="divPrimerApellido" id="divPrimerApellido" class="control-group">
						<label name="lblPrimerApellido" id="lblPrimerApellido" class="control-label">Primer apellido</label>
						<div class="controls">
							<?php
								$apellido_1 = $consulta[2];
								echo "<td><input type='text' name='txtPrimerApellido' id='txtPrimerApellido' value='$apellido_1' class='input-xlarge' onClick='readOnly = false' readOnly/></td>";
							?>
						</div>
					</div>
					<div name="divSegundoApellido" id="divSegundoApellido" class="control-group">
						<label name="lblSegundoApellido" id="lblSegundoApellido" class="control-label">Segundo apellido</label>
						<div class="controls">
							<?php
								$apellido_2 = $consulta[3];
								echo "<td><input type='text' name='txtSegundoApellido' id='txtSegundoApellido' value='$apellido_2' class='input-xlarge' onClick='readOnly = false' readOnly/></td>";
							?>
						</div>
					</div>
					<div name="divUsuario" id="divUsuario" class="control-group">
						<label name="lblUsuario" id="lblUsuario" class="control-label">Nombre de Usuario</label>
						<div class="controls">
							<?php
								$nombre_usuario = $consulta[5];
								echo "<td><input type='text' name='txtUsuario' id='txtUsuario' value='$nombre_usuario' class='input-xlarge' onClick='' readOnly/></td>";
							?>
						</div>
					</div>
					<div name="divNumCedula" id="divNumCedula" class="control-group">
						<label name="lblNumCedula" id="lblNumCedula" class="control-label">N&uacute;mero de c&eacute;dula</label>
						<div class="controls">
							<?php
								$num_cedula = $consulta[4];
								echo "<td><input type='text' name='txtNumCedula' id='txtNumCedula' value='$num_cedula' class='input-xlarge' onClick='' readOnly/></td>";
							?>
						</div>
					</div>
					<div name="divClave" id="divClave" class="control-group">
						<label name="lblClave" id="lblClave" class="control-label">Contraseña</label>
						<div class="controls">
							<?php
								$contrasena = $consulta[6];
								echo "<td><input type='password' name='pwdClave' id='pwdClave' value='$contrasena' class='input-xlarge' onClick='readOnly = false' readOnly/></td>";
							?>
						</div>
					</div>
					<div name="divConfirmClave" id="divConfirmClave" class="control-group">
						<label name="lblConfirmClave" id="lblConfirmClave" class="control-label">Confirmar contraseña</label>
						<div class="controls">
							<?php								
								echo "<td><input type='password' name='pwdConfirmClave' id='pwdConfirmClave' value='$contrasena' class='input-xlarge' onClick='readOnly = false' readOnly/></td>";
							?>
						</div>
					</div>
					<div name="divClaveActual" id="divClaveActual" class="control-group">
						<label name="lblClaveActual" id="lblClaveActual" class="control-label">Contraseña del usuario actual</label>
						<div class="controls">
								<td><input type='password' name='pwdClaveActual' id='pwdClaveActual' value="" class='input-xlarge' onClick=""/></td>
						</div>
					</div>
					<div name="divRol" id="divRol" class="control-group">
						<label name="lblRol" id="lblRol" class="control-label">Rol asignado</label>
						<div class="controls">
							<label class="radio">
							<?php
								$id_estado = $consulta[7];
								if($id_estado == 1){
									echo "<label class='radio'>
											<td><input type='radio' name='rbtRol' id='rbtAdmin' value='1' checked/>Administrador</td>
										</label>";
									echo "<label class='radio'>
											<td><input type='radio' name='rbtRol' id='rbtUsuario' value='2'/>Usuario</td>
										</label>";
								}else{
									echo "<label class='radio'>
											<td><input type='radio' name='rbtRol' id='rbtAdmin' value='1' />Administrador</td>
										</label>";
									echo "<label class='radio'>
											<td><input type='radio' name='rbtRol' id='rbtUsuario' value='2' checked/>Usuario</td>
										</label>";
								}
							?>
							</label>
						</div>
					</div>
					<div class="form-actions">
						<input type="submit" name="btnUpdate" id="btnUpdate" onClick="" class="btn btn-primary" value="Actualizar">
					</div>
				</fieldset>
			</form>

		<div id="footerP"><!--inicio del footer-->
			<hr />Copyright Yaisoft 2012 &copy;
		</div><!--Fin del Footer-->
	</body>
</html>