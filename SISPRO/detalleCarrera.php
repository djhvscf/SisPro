<html>
	<head>
		<title>Detalle de Carrera</title>
		<!--Formulario para modificar carreras del sistema-->
		<!--Elaborado por: Adolfo Blanco C.-->
		<!--Fecha de creación: 10:34 a.m. 06/07/2012-->
		<!--Fecha de última modificación: 10:25 p.m. 15/08/2012-->   
		<link href="css/bootstrap.css" rel="stylesheet"/>
		<link href="css/style.css" rel="stylesheet"/>
		<script type="text/javascript" src="js/activarAdmin.js"></script>
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
			$id_carrera= $_GET['carrera'];
			include "Gestor.php";
			$gestor= new Gestor();
			$grados= $gestor->cargarGrados();
			$queryString = "carrera=$id_carrera";
			$consulta=$gestor->buscarCarreraPorID($id_carrera);
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
			<li class="active">Detalle de carrera</li>
			</ul>
		</div><!-- /navbar -->
	</div><!--fin barra fija-->
        <div id="headerP"></div>		
		<div class="container">
				<?php
					$urlDetalle = "detalleCarrera.php?" . $queryString;
					echo "<form action=$urlDetalle method='post' id='frmAgregarCarrera' class= 'form-horizontal'>";
				?>

				<fieldset>
					<!--Titulo del formulario-->
					<legend><?php echo $nombre = $consulta[3];?></legend>
					<?php
							if(array_key_exists('txtCodigoD',$_POST)){
									$codigo = $_POST['txtCodigo'];
									$existe = $gestor->verificaCarreraModificar($codigo);
							}
							if(array_key_exists('txtCodigoD',$_POST))
							{
								$codigo=$_POST['txtCodigoD'];
								$id_Grado=$_POST['sltId_Grado'];
								$nombre=$_POST['txtNombre'];
								$aprobacion_Conesup=$_POST['rbtAprobacion_Conesup'];
								if($existe <= 1 ){								
								$gestor->modificarCarrera($id_carrera, $codigo, $id_Grado, $nombre, $aprobacion_Conesup);
									echo "<div id='msj' class='alert alert-success' style='display:block'>La carrera fue modificada.</div>";
								}else{
									echo "<div id='msj' class='alert alert-error' style='display:block'>La codigo de la carrera ya existe.</div>";
								}
							}
							$consulta=$gestor->buscarCarreraPorID($id_carrera);
					?>
					<div name="divCodigo" id="divCodigo" class="control-group">
					<label name="lblCodigo" id="lblCodigo" class="control-label">C&oacute;digo</label>
						<div class="controls">
							<?php
								$codigo = $consulta[1];
								echo "<td><input name='txtCodigoD' type='text' id='txtCodigoD' value='$codigo' class='input-xlarge' onClick ='' readOnly/></td>";								 
							?>
						</div>
					</div>
					<div name="divId_Grado" id="divId_Grado" class="control-group">
						<label name="lblId_Grado" id="lblId_Grado" class="control-label">Grado acad&eacute;mico</label>
						<div class="controls">
							<?php
								$id_Grado = $consulta[2];
								if( $id_Grado == 1){
									echo "<select id='sltId_Grado' name='sltId_Grado' class='input-xlarge'>
									<option value ='1' selected='selected'>T&eacute;cnico</option>
									<option value ='2'>Diplomado</option>
									<option value ='3'>Bachillerato</option>
									<option value ='4'>Maestr&iacute;a</option>
									</select>	";
								}else if( $id_Grado == 2){
									echo "<select id='sltId_Grado' name='sltId_Grado' class='input-xlarge'>
									<option value ='1'>T&eacute;cnico</option>
									<option value ='2'selected='selected'>Diplomado</option>
									<option value ='3'>Bachillerato</option>
									<option value ='4'>Maestr&iacute;a</option>
									</select>	";
								}else if( $id_Grado == 3){
									echo "<select id='sltId_Grado' name='sltId_Grado' class='input-xlarge'>
									<option value ='1'>T&eacute;cnico</option>
									<option value ='2'>Diplomado</option>
									<option value ='3' selected='selected'>Bachillerato</option>
									<option value ='4'>Maestr&iacute;a</option>
									</select>	";
								}else if( $id_Grado == 4){
									echo "<select id='sltId_Grado' name='sltId_Grado' class='input-xlarge'>
									<option value ='1'>T&eacute;cnico</option>
									<option value ='2'>Diplomado</option>
									<option value ='3'>Bachillerato</option>
									<option value ='4' selected='selected'>Maestr&iacute;a</option>
									</select>	";
								}
							?>
						</div>
					</div>
					
					<div name="divNombre" id="divNombre" class="control-group">
						<label name="lblNombre" id="lblNombre" class="control-label">Nombre</label>
						<div class="controls">
							<?php
								$nombre = $consulta[3];
								echo "<td><input name='txtNombre' type='text' id='txtNombre' value='$nombre' class='input-xlarge' onClick ='readOnly = false' readOnly/></td>";								 
							?>
						</div>
					</div>
					<div name="divAprobacion_Conesup" id="divAprobacion_Conesup" class="control-group">
						<label name="lblAprobacion_Conesup" id="lblAprobacion_Conesup" class="control-label">Aprobaci&oacute;n Conesup</label>
						<div class="controls">
						<label class="radio">
							<?php
								$aprobacion_Conesup = $consulta[4];
								if($aprobacion_Conesup == true){
									echo "<label class='radio'>
											<td><input type='radio' name='rbtAprobacion_Conesup' id='rbtAprobado' value='1' checked/>Aprobado</td>
										</label>";
									echo "<label class='radio'>
											<td><input type='radio' name='rbtAprobacion_Conesup' id='rbtNoAprobado' value='0'/>No Aprobado</td>
										</label>";
								}else{
									echo "<label class='radio'>
											<td><input type='radio' name='rbtAprobacion_Conesup' id='rbtAprobado' value='1' />Aprobado</td>
										</label>";
									echo "<label class='radio'>
											<td><input type='radio' name='rbtAprobacion_Conesup' id='rbtNoAprobado' value='0' checked/>No Aprobado</td>
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
		</div>	  
		<div id="footerP"><!--inicio del footer-->
			<hr />Copyright Yaisoft 2012 &copy; </p> 
		</div><!--Fin del Footer-->
	</body>
</html>