<html>
<head>
	<title>Detalle de contacto</title> 
			<link href="css/bootstrap.css" rel="stylesheet">
			<link href="css/style.css" rel="stylesheet">
			<script type="text/javascript" src="js/modificarDatos.js"></script><!--llamada del validador de datos del formulario-->
			<script type="text/javascript" src="js/livevalidation_standalone.js"></script>
			<script type="text/javascript" src="js/validacionesContactos.js"></script>
			<script language="JavaScript">
			function validar(formulario)
			{
				if (formulario.txtComentarios.value=="")
				{
					alert("Debe ingresar comentarios");
					frmDetalleContacto.txtNombre.focus()
					return false;
				}
			
				if (window.confirm('¿Desea eliminar el contacto permanentemente?')) {
					formulario.submit();
				} else {
					return false;
				}
			}
		</script>
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
	} else {
		header("Location: login.php?state=false&redirect=inicio.php");
	}
	// ==========================================
		
		//$id_prospecto = $_GET['prospecto'];
		include "Gestor.php";
		$gestor= new Gestor();
		
		if (array_key_exists('contacto', $_GET))
		{
			$id_contacto= $_GET['contacto'];
			$prospecto = $gestor->buscarProspectoPorContacto($id_contacto);
			$idProspecto = $prospecto[0];
		}

	
	$queryString = "contacto=$id_contacto";
	$consulta=$gestor->buscarContactoPorID($id_contacto);
	 

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
                        <li>
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
										<a href="detalleProspecto.php?prospecto=<?php echo $idProspecto ?>">Datos del prospecto</a><span class="divider">/</span>
									</li>
                                    <li class="active">Datos del contacto</li>
                                </ul>
                </div><!-- /navbar -->
            </div><!--Barra fija-->             			    
		<div id="headerP"></div>
		<div class="container">
				<?php
					$urlDetalle = "detalleContacto.php?" . $queryString;
					echo "<form action=$urlDetalle method='post' id='frmDetalleContacto' name='frmDetalleContacto' class= 'form-horizontal'>";
										
					$id_contacto = $consulta[0];
					$fecha = $consulta[1];
					$comentarios = $consulta[2];
					$id_carrera = $consulta[3];
					$id_prospecto = $consulta[4];
					$id_usuario = $consulta[5];
					$id_medio = $consulta[6];
					
					$carrera = $gestor->buscarCarreraPorID($id_carrera);
					$nombreCarrera = $carrera[2] . " en " . $carrera[3];
					$prospecto = $gestor->buscarProspectoPorId($id_prospecto);
					$nombreProspecto = $prospecto[1] . '&nbsp;' .  $prospecto[2] . '&nbsp;' . $prospecto[3];
					$usuario = $gestor->buscarUsuarioPorID($id_usuario);
					$nombreUsuario = $usuario[5];
					$medioComunicacion = $gestor->buscarMedioPorID($id_medio);
					$nombreMedio = $medioComunicacion[1];
				?>
				<fieldset>
					<?php
						$dia = date("d-m-y", strtotime($fecha));  
						$hora = date("H:i", strtotime($fecha));  
						echo "<legend>Contacto $dia </legend>";
						
						if ($_POST['btnActualizarContacto']) {
							$comentarios=$_POST['txtComentarios'];
							$gestor->modificarContacto($id_contacto, $comentarios);
							echo "<div id='msj' class='alert alert-success' style='display:block'>El contacto fue modificado.</div>";
						} else if ($_POST['btnEliminarContacto']) {
  							$gestor->eliminarContacto($id_contacto);
							echo "<script language='JavaScript'>";
							echo "document.location = 'detalleProspecto.php?prospecto=$id_prospecto&delete=true';";
							echo "</script>";
						} 
					?>
					<div name="divgrado" id="divgrado" class="control-group">
						<label name="lblgrado" id="lblgrado" class="control-label">Nombre de prospecto</label>
						<div class="controls">
							<?php
							echo "<input name='txtProspectoDeContacto' id='txtProspectoDeContacto' type='text' class='input-xlarge' value=$nombreProspecto readOnly>";
							?>
						</div>
					</div>
					<div name="divsiglas" id="divsiglas" class="control-group">
						<label name="lblsiglas" id="lblsiglas" class="control-label">Fecha</label>
						<div class="controls">
							<?php
								echo "<input name='txtFechaContacto' id='txtFechaContacto' type='text' class='input-xlarge' value=$dia readOnly>";
							?>
						</div>
					</div>
					<div name="divcodigo" id="divcodigo" class="control-group">
						<label name="lblcodigo" id="lblcodigo" class="control-label">Hora</label>
						<div class="controls">
							<?php
								echo "<input name='txtHoraContacto' id='txtHoraContacto' type='text' class='input-xlarge' value=$hora readOnly>";
							?>
						</div>
					</div>
					
					<div name="divname" id="divname" class="control-group">
						<label name="lblname" id="lblname" class="control-label">Usuario encargado</label>
						<div class="controls">
							<?php
								echo "<input name='txtUsuario' id='txtUsuario' type='text' class='input-xlarge' value=$nombreUsuario readOnly>";
							?>
						</div>
					</div>
					<div name="divmedio" id="divmedio" class="control-group">
						<label name="lblmedio" id="lblmedio" class="control-label">Medio de comunicaci&oacute;n</label>
						<div class="controls">
							<?php
								echo "<input name='txtMedio' id='txtMedio' type='text' class='input-xlarge' value=$nombreMedio readOnly>";
							?>
						</div>
					</div>
					<div name="divcomentarios" id="divcomentarios" class="control-group">
						<label name="lblcomentarios" id="lblcomentarios" class="control-label">Comentarios</label>
						<div class="controls">
							<?php
								echo "<textarea name='txtComentarios' id='txtComentarios' type='text' class='input-xxlarge'>$comentarios </textarea>";
							?>
						</div>
					</div>
					<div class="form-actions">
						<input type="submit" name="btnActualizarContacto" id="btnActualizarContacto" onClick="" class="btn btn-primary" value="Actualizar">
						<input type="submit" name="btnEliminarContacto" id="deleteButton" onClick="" class="btn btn-danger" value="Eliminar">
					</div>
				</fieldset>
			</form>			
		</div>		
		<div id="footerP">
		<hr> <p> Copyright Yaisoft 2012 &copy; </p> 
		</div>
	</body>
</html>