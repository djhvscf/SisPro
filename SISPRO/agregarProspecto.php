<html>
	<head>
		<title>Agregar Prospecto</title>
		<!--Formulario para agregar Prospectos en el sistema-->
		<!--Elaborado por: Adolfo Blanco Coto-->
		<!--Fecha de creación: 11:14 a.m. 06/07/2012-->
		<!--Fecha de última modificación: 2:11 p.m. 10/08/2012-->  
		<link href="css/bootstrap.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="css/inicioStyle.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">	
		<script type="text/javascript" src="js/activarAdmin.js"></script>
		<script type="text/javascript" src="js/filterTable.js"></script><!--llamada del filtro del la tabla-->
		<script type="text/javascript" src="js/sorttable.js"></script><!--ordena campos en tabla-->
		<script type="text/javascript" src="js/validarProspectos.js"></script><!--llamada del validador de datos del formulario-->
		<script type="text/javascript" src="js/livevalidation_standalone.js"></script>
	</head>
	<body onLoad="activarValidaciones(); ocultarBarraAdmin();">
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
					<li class="active">Agregar Prospecto</li>
				</ul>
			</div>
			<!-- /navbar -->
		</div>
		<!--fin barra superior-->
		<div id="headerP"></div>
		<div class="container">
			<?php
				
				if(array_key_exists('txtcedula',$_POST)){
					$identificacion=$_POST['txtcedula'];
					$existe = $gestor->verificaIdentificacion($identificacion);
				}
				
				if(array_key_exists('txtNombreProspecto',$_POST)){
					$nombre=$_POST['txtNombreProspecto'];
					$apellido1=$_POST['txtprimerApellidoPros'];
					$apellido2=$_POST['txtsegundoApellidoPros'];
					$identificacion=$_POST['txtcedula'];
					$telefono=$_POST['txtnumeroTelefono'];
					$telefonoO=$_POST['txtnumeroTelefonoO'];
					$celular=$_POST['txtnumeroCelular'];
					$email=$_POST['txtMail'];
					$colegio=$_POST['txtcolegioProcedencia'];
					$estado = 1;
					if ($existe == 0) {
					$gestor->agregarProspecto($nombre, $apellido1, $apellido2, $identificacion, $telefono, $telefonoO, $celular, $email, $colegio,$estado);
						echo "<div class='alert alert-success'>El prospecto fue registrado exitosamente.</div>";
					}else{
						echo "<div class='alert alert-alert'>El prospecto ya existe.</div>";
					}
				}
			?>
			<form name="frmDatosProspect" action="agregarProspecto.php" method="POST" class="form-horizontal"><!--Inicio de formulario-->
				<fieldset>
					<!--Titulo del formulario-->
					<legend>Agregar Prospecto</legend>
					<div name="divNombreProspecto" id="divNombreProspecto" class="control-group">
						<label name="lblNombreProspecto" id="lblNombreProspecto" class="control-label">Nombre</label>
						<div class="controls">
							<input name="txtNombreProspecto" id="txtNombreProspecto" type="text" class="input-xlarge">
						</div>
					</div>
					<div name="divprimerApellidoPros" id="divprimerApellidoPros" class="control-group">
						<label name="lblprimerApellidoPros" id="lblprimerApellidoPros" class="control-label">Primer apellido</label>
						<div class="controls">
							<input name="txtprimerApellidoPros" id="txtprimerApellidoPros" type="text" class="input-xlarge">
						</div>
					</div>
					<div name="divsegundoApellidoPros" id="divsegundoApellidoPros" class="control-group">
						<label name="lblsegundoApellidoPros" id="lblsegundoApellidoPros" class="control-label">Segundo apellido</label>
						<div class="controls">
							<input name="txtsegundoApellidoPros" id="txtsegundoApellidoPros" type="text" class="input-xlarge">
						</div>
					</div>
					<div name="divcedula" id="divcedula" class="control-group">
						<label name="lblcedula" id="lblcedula" class="control-label">N&uacute;mero de c&eacute;dula o pasaporte</label>
						<div class="controls">
							<input name="txtcedula" id="txtcedula" type="text" class="input-xlarge">
						</div>
					</div>
					<div name="divnumeroTelefono" id="divnumeroTelefono" class="control-group">
						<label name="lblnumeroTelefono" id="lblnumeroTelefono" class="control-label">N&uacute;mero de tel&eacute;fono</label>
						<div class="controls">
							<input name="txtnumeroTelefono" id="txtnumeroTelefono" type="text" class="input-xlarge">
						</div>
					</div>
					<div name="divnumeroTelefonoO" id="divnumeroTelefonoO" class="control-group">
						<label name="lblnumeroTelefonoO" id="lblnumeroTelefonoO" class="control-label">N&uacute;mero de tel&eacute;fono (adicional)</label>
						<div class="controls">
							<input name="txtnumeroTelefonoO" id="txtnumeroTelefonoO" type="text" class="input-xlarge">
						</div>
					</div>
					<div name="divnumeroCelular" id="divnumeroCelular" class="control-group">
						<label name="lblnumeroCelular" id="lblnumeroCelular" class="control-label">N&uacute;mero de celular</label>
						<div class="controls">
							<input name="txtnumeroCelular" id="txtnumeroCelular" type="text" class="input-xlarge">
						</div>
					</div>
					<div name="divMail" id="divMail" class="control-group">
						<label name="lblMail" id="lblMail" class="control-label">Correo electr&oacute;nico</label>
						<div class="controls">
							<input name="txtMail" id="txtMail" type="text" class="input-xlarge">
						</div>
					</div>
					<div name="divcolegioProcedencia" id="divcolegioProcedencia" class="control-group">
						<label name="lblcolegioProcedencia" id="lblcolegioProcedencia" class="control-label">Colegio de procedencia</label>
						<div class="controls">
							<input name="txtcolegioProcedencia" id="txtcolegioProcedencia" type="text" class="input-xlarge">
						</div>
					</div>
					<div class="form-actions">
						<input type="submit" name="btnIngresarProspecto" value="Ingresar" onClick="" class="btn btn-primary">
						<input type="reset" name="btnLimpiar" id="btnLimpiar" onClick="PonerCursor()" class="btn" value="Limpiar">
					
					</div>
				</fieldset>
			</form>
		</div>
		<div id="footerP">
			<hr />
			Copyright Yaisoft 2012 &copy;
		</div>
	</body>
</html>