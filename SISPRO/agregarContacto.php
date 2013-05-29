<html lang="es">
	<head>
		<!-- Le styles -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<title>Agregar Contacto</title>
		<link rel="stylesheet"	type="text/css" href="css/inicioStyle.css"/>
		<link rel="stylesheet"	type="text/css" href="css/style.css"/>
		<script type="text/javascript" src="js/agregarContacto.js"></script>
		<script type="text/javascript" src="js/validaContacto.js"></script>
		<script type="text/javascript" src="js/livevalidation_standalone.js"></script>
	</head>
	<body onLoad="activarValidaciones()">
	
	<div class="barraNav"><!--Barra fija-->
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
		
		$gestor = new Gestor();
		$listaMedios = $gestor->listarMedios();
		$listaCarreras = $gestor->listarCarrerasLite();
		$idProspecto = 0;
		$nombreProspecto = array();
		
		if(array_key_exists('prospecto', $_GET))
		{
			$idProspecto = $_GET['prospecto'];
			$queryString = "prospecto=$idProspecto";

			$nombreProspecto = $gestor->obtenerNombreProspecto($idProspecto);
		}
	?>
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
                        <a href="inicio.php">Inicio</a>
                        <span class="divider">/</span>
                    </li>
                    <li>
                        <a href="detalleProspecto.php?prospecto=<?php echo $idProspecto ?>">Datos del prospecto</a>
                        <span class="divider">/</span>
                    </li>
                    <li class="active">Agregar contacto</li>
                </ul>
            </div><!-- /navbar -->
		</div><!--fin barra superior-->

		<div id = "header"> </div>
		<div class="container">
			<?php
				$urlDetalle = "agregarContacto.php?" . $queryString;
				echo "<form name='frmContacto' id='frmContacto' action=$urlDetalle method='post' class='form-horizontal'>";
			?>
				<fieldset>
					<legend>Agregar Contacto</legend>	
			<?php
				if(array_key_exists('txaComentario',$_POST))
				{
					$fecha = $_POST['slcDia']."/".$_POST['slcMes']."/".$_POST['slcAnio']." ".$_POST['slcHora'].":".$_POST['slcMinutos'].":00";
					$comentario = $_POST['txaComentario'];
					$id_carrera = $_POST['slcInfo'];
					$id_medio = $_POST['slcMedio'];
					$id_prospecto = $idProspecto;
					$id_usuario = $_SESSION['Id_usuario'];
					$gestor->agregarContacto($fecha, $comentario, $id_carrera, $id_prospecto, $id_usuario, $id_medio);
					echo "<div id='msj' class='alert alert-success' style='display:block'>El contacto fue agregado.</div>";
					// echo "fecha:".$fecha." comentario:".$comentario." carrera:".$id_carrera." prospecto:".$id_prospecto." usuario:".$id_usuarios;
				}
			?>					
					<div name="divNombre" id="divNombre" class="control-group">
						<label name="lblNombre" id="lblNombre" class="control-label">Nombre</label>
						<div class="controls">
							<span name="txtNombre" id="txtNombre" class="input-xlarge uneditable-input">
								<?php
									foreach($nombreProspecto as $row) {
										echo "$row[1]";
									}
								?>
							</span>
						</div>
					</div>
					<div name="divFecha" id="divFecha" class="control-group">
						<label name="lblFecha" id="lblFecha" class="control-label">Fecha</label>
						<div class="controls">
							<select  width="20px" name="slcDia" id="slcDia" class="input-mini">
								<?php
									for ($i = 1; $i <= 31; $i++) {
										if (date("j") == $i)
											echo "<option selected='selected'>$i</option>";
										else
											echo "<option>$i</option>";
									}
								?>
							</select>
							/
							<select  width="20px" name="slcMes" id="slcMes" class="input-medium">
								<option selected="selected" value = "seleccion">--</option>
								<option value="01">Enero</option>
								<option value="02">Febrero</option>
								<option value="03">Marzo</option>
								<option value="04">Abril</option>
								<option value="05">Mayo</option>
								<option value="06">Junio</option>
								<option value="07">Julio</option>
								<option value="08">Agosto</option>
								<option value="09">Setiembre</option>
								<option value="10">Octubre</option>
								<option value="11">Noviembre</option>
								<option value="12">Diciembre</option>
							</select>
							/
							<select  width="30px" name="slcAnio" id="slcAnio" class="input-small">
								<?php
									$ahora = date("Y");
									$inicio = $ahora - 5;
									for ($i = $inicio; $i <= $ahora; $i++) {
										if ($ahora == $i)
											echo "<option selected='selected'>$i</option>";
										else
											echo "<option>$i</option>";
									}
								?>
							</select>
						</div>
					</div>
					<div name="divHora" id="divHora" class="control-group">
						<label name="lblHora" id="lblHora" class="control-label">Hora</label>
						<div class="controls">
							<select  width="20px" name="slcHora" id="slcHora" class="input-mini">
								<?php
									for ($i = 0; $i <= 23; $i++) {
										if (date("G") == $i)
											echo "<option selected='selected'>$i</option>";
										else
											echo "<option>$i</option>";
									}
								?>
							</select>
							:
							<select name="slcMinutos" id="slcMinutos" class="input-mini">
								<?php
									$minutos = array("00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "46", "47", "48", "49", "50", "51", "52", "53", "54", "55", "56", "57", "58", "59");
									for ($i = 0; $i <= 59; $i++) {
										if (date("i") == $i)
											echo "<option selected='selected'>$minutos[$i]</option>";
										else
											echo "<option>$minutos[$i]</option>";
									}
								?>
							</select>
						</div>
					</div>
					<div name="divInfo" id="divInfo" class="control-group">
						<label name="lblInfo" id="lblInfo" class="control-label">Información suministrada</label>
						<div class="controls" >
							<select name="slcInfo" id="slcInfo" class="input-xlarge">
								<option value="0" selected="selected">--- Seleccione ---</option>
								<?php
									foreach($listaCarreras as $row) {
										echo "<option value=\"$row[0]\">$row[1]</option>";
									}
								?>
							</select>
						</div>
					</div>
					<div name="divMedio" id="divMedio" class="control-group">
						<label name="lblMedio" id="lblMedio" class="control-label">Medio de comunicacion</label>
						<div class="controls" >
							<select name="slcMedio" id="slcMedio" class="input-xlarge">
								<option value="0" selected="selected" >--- Seleccione ---</option>
								<?php
									foreach($listaMedios as $row) {
										echo "<option value=\"$row[0]\">$row[1]</option>";
									}
								?>
							</select>
						</div>
					</div>
					<div name="divComentario" id="divComentario" class="control-group">
						<label name="lblComentario" id="lblComentario" class="control-label">Comentarios</label>
						<div class="controls">
							<textarea name="txaComentario" id="txaComentario" type="text" class="input-xlarge"></textarea>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" onclick="deseleccionarTodos()" class="btn btn-primary">Ingresar</button>
						<input type="reset" name="btnLimpiar" id="btnLimpiar" onclick="PonerCursor()" class="btn" value="Limpiar">
					</div>
				</fieldset>
			</form>
		</div>
			<div id= "footerP">
			<hr> <p> Copyright Yaisoft 2012 &copy; </p> 
		</div>
	</body>
</html>