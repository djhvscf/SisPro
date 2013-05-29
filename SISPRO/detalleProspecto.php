<html>
<head>
	<title>Detalle de Prospectos</title>
	<link rel="stylesheet"	type="text/css" href="css/tablaStyle.css"/>
	<link rel="stylesheet"	type="text/css" href="css/bootstrap.css"/>
	<script type="text/javascript" src="js/editarProspecto.js"></script><!--llamada del validador de datos del formulario-->
    <script type="text/javascript" src="js/modificarDatosProspectos.js"></script><!--llamada del validador de datos del formulario-->
	<script type="text/javascript" src="js/livevalidation_standalone.js"></script>
	<script type="text/javascript" src="js/filterTable.js"></script>
</head>

<body id = "wrap" onLoad="activarValidaciones()">
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
							<ul class="dropdown-menu"><!--Menu desplegable de mantenimiento-->
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
                                <li class="active">Datos del prospecto</li>
                            </ul>
            </div><!-- /navbar -->
</div><!--fin barra fija-->

				 
  <div id = "header"> </div>
  
  <div class = "content">
  
	<div class="row">
		<div class="span8 offset2">
			<?php 
				if(array_key_exists('delete',$_GET)){
					$estado = $_GET['delete'];
					switch ($estado) {
						case "true":
							print "<div class='alert alert-info'>El contacto fue borrado con éxito</div>";
						break;
					}
				}
			?>
		</div>
	</div>
  	<div class = "details">
	<table id="tablaAgregarProspect">
						<fieldset><!--Titulo del formulario-->
						<legend>Datos de Prospecto</legend>
		<?php
		include "Gestor.php";
		$id_prospecto= $_GET['prospecto'];
		$gestor= new Gestor();
		$prospecto = 0;
		$buscar = "";
		$listaContactos = array();
		if(array_key_exists('Buscar',$_GET))
		{
			$prospecto = $_GET['prospecto'];
			$buscar = $_GET['Buscar'];
			$listaContactos = $gestor->listarContactosFiltrar($prospecto, $buscar);
			
		}
		else
		{
		
			if(array_key_exists('prospecto',$_GET))
			{
				$prospecto = $_GET['prospecto'];
				$listaContactos = $gestor->listarContactos($prospecto);
				
			}
		}
		
		//Modificar Prospecto sin duplicar identificacion Victor
		
		if(array_key_exists('cedula',$_POST)){
			$identificacion=$_POST['cedula'];
			$existe = $gestor->verificaIdModificar($identificacion,$prospecto);
		}
		if(array_key_exists('txtNombreProspecto',$_POST))
			{			
				$nombre=$_POST['txtNombreProspecto'];
				$apellido1=$_POST['txtprimerApellidoPros'];
				$apellido2=$_POST['segundoApellido'];
				$identificacion=$_POST['cedula'];
				$telefono=$_POST['numeroTelefono'];
				$telefonoO=$_POST['numeroTelefonoO'];
				$celular=$_POST['numeroCelular'];
				$email=$_POST['correoElectronico'];
				$colegio=$_POST['txtcolegioProcedencia'];
				$estadoProspecto=$_POST['rbtEstado'];
				if ($existe == false) {
				$gestor->modificarProspecto($id_prospecto, $nombre, $apellido1, $apellido2, $identificacion, $telefono, $telefonoO, $celular, $email, $colegio, $estadoProspecto);
				echo "<div class='alert alert-success modPros'>El Prospecto fue actualizado</div>";
				}else{
					echo "<div class='alert alert-alert'>El prospecto ya ha sido registrado en el sistema.</div>";
				}
			}
		$queryString = "prospecto=$id_prospecto";
		$consulta=$gestor->buscarProspectoPorID($id_prospecto);
	?> 
	<?php
		$urlDetalle = "detalleProspecto.php?" . $queryString;
		echo "<form action=$urlDetalle method='POST' id='frmDatosProspect' class= 'form-horizontal'>";
	?>
                    <tr>
						<td width="188">Nombre</td>
						<td width="278">
							<?php $nombre = $consulta[1]; 
								echo "<input name='txtNombreProspecto' type='text' class='input-large' id='txtNombreProspecto' value='$nombre' class='input-xlarge' onClick ='readOnly = false' readOnly />";
							?>
						</td>
						<td width="14">&nbsp;</td>
						<td width="176">Correo electr&oacute;nico</td>
						<td width="296">
							<?php $email = $consulta[8]; 
								echo "<input name='correoElectronico' type='text' class='input-large' id='correoElectronico' value='$email' class='input-xlarge' onClick ='readOnly = false' readOnly  />";
						?>
						</td>
					</tr>
						<tr>
							<td>Primer apellido</td>
							<td>
								<?php $apellido1 = $consulta[2];
									echo "<input name='txtprimerApellidoPros' type='text' class='input-large' id='txtprimerApellidoPros' value='$apellido1' class='input-xlarge' onClick ='readOnly = false' readOnly />";
								?>
							</td>
							<td>&nbsp;</td>
							<td>Colegio de procedencia</td>
							<td>
								<?php $colegio = $consulta[9];
									echo "<input name='txtcolegioProcedencia' type='text' class='input-large' id='txtcolegioProcedencia' value='$colegio' class='input-xlarge' onClick ='readOnly = false' readOnly />";
								?>								
							</td>
						</tr>
						<tr>
							<td>Segundo apellido</td>
							<td>
								<?php $apellido2 = $consulta[3];
									echo "<input name='segundoApellido' type='text' class='input-large' id='segundoApellido' value='$apellido2' class='input-xlarge' onClick ='readOnly = false' readOnly />";
								?>
                            </td>
							<td>&nbsp;</td>
							<td>Estado del prospecto</td>
							<?php
								$estadoProspecto = $consulta[10];
								if($estadoProspecto == 1){
									echo "<td><input name='rbtEstado' type='radio' id='rbtInteresado' value='1' checked/>&nbsp;&nbsp;Interesado</td>";
								}else{
								echo "<label class='radio'><td><input name='rbtEstado' type='radio' id='rbtInteresado' value='1' />&nbsp;&nbsp;Interesado</td></label>";
								}
							?>
							</tr>
						<tr>
							<td>N&uacute;mero de Identificaci&oacute;n</td>
							<td>
                    			<?php $cedula = $consulta[4];
									echo "<input name='cedula' type='text' class='input-large' id='cedula' value='$cedula' class='input-xlarge' onClick ='readOnly = false' readOnly  />";
								?>
							</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>
								<?php
									$estadoProspecto = $consulta[10];
									if($estadoProspecto == 2){
										echo "<input name='rbtEstado' type='radio' id='rbtSinInteres' value='2' checked/>&nbsp;&nbsp;Sin Inter&eacute;s";
									}else{
										echo "<input name='rbtEstado' type='radio' id='rbtSinInteres' value='2' />&nbsp;&nbsp;Sin Inter&eacute;s";
									}
								?>
							</td>
						</tr>
						<tr>
							<td>N&uacute;mero de tel&eacute;fono</td>
							<td>
                      			<?php $telefono = $consulta[5];
									echo "<input name='numeroTelefono' type='text' class='input-large' id='numeroTelefono' value='$telefono' class='input-xlarge' onClick ='readOnly = false' readOnly />";
								?>
							</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>
								<?php
									$estadoProspecto = $consulta[10];
									if($estadoProspecto == 3){
										echo "<input name='rbtEstado' type='radio' id='rbtMatriculado' value='3' checked/>&nbsp;Matriculado";
									}else{
										echo "<input name='rbtEstado' type='radio' id='rbtMatriculado' value='3' />&nbsp;Matriculado";
									}
								?>
						</tr>
					<tr>
						<td>N&uacute;mero de tel&eacute;fono 2</td>
						<td>
							<?php $telefonoO = $consulta[6];
								echo "<input name='numeroTelefonoO' type='text' class='input-large' id='numeroTelefonoO' value='$telefonoO' class='input-xlarge' onClick ='readOnly = false' readOnly />";
							?>
                        </td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>N&uacute;mero de celular</td>
						<td>
							<?php $celular = $consulta[7];
								echo "<input name='numeroCelular' type='text' class='input-large' id='numeroCelular' value='$celular' class='input-xlarge' onClick ='readOnly = false' readOnly />";
							?>						
						</td>
						<td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>
                             <div class="submitButton">
                                <input type="submit" class="btn btn-primary" value="Actualizar" onClick="<?php echo $status;?>">
                            </div>
                        </td>
					</tr>
					<tr>
                    	<td></td>
                    </tr>
					<tr></tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>
						</td>
					</tr>
					</fieldset>
                    </form>
					</table>
  	</div>
  	<div id = "space"></div>
  	<div class = "options">
  		<div id="searchwrapper">
      <legend>Historial de contactos</legend>
  			<form class="well form-search">
		 		<input type="search" class="span4" placeholder="B&uacute;squeda" name="Buscar"/>
				<input type="hidden" name="prospecto" value="<?php print "$prospecto" ?>"/>
		 		<button type="submit" class="btn">Buscar</button>
		 		<a class="btn btn-primary pull-right" href="agregarContacto.php?prospecto=<?php echo "$prospecto"; ?>"><i class="icon-plus icon-white"></i>Agregar nuevo contacto</a>
		 	</form>
		</div>
		
  	</div>
  <div class="theTable">
  <table class="table table-bordered table-striped sortable">
  	<thead>
		<tr>
			<th>Fecha de contacto</th>
			<th>Hora</th>
			<th>Medio de comunicaci&oacute;n</th>
			<th>    </th>
			<th>    </th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($listaContactos as $row) {
				echo "<tr>";
				$idContacto = $row[0];
				$queryString = "contacto=$idContacto&prospecto=$id_prospecto";
				$urlDetalle = "detalleContacto.php?".$queryString;
				echo "<td>$row[1]</td>";
				echo "<td>$row[2]</td>";
				echo "<td>$row[3]</td>";
				echo "<td><a href=$urlDetalle>Ver</a></td>";
				echo "</tr>";
			}
		?>
	</tbody>
  </table>
  </div>
  </div> 
  
  <div id="footer">
  <hr> <p> Copyright Yaisoft 2012 &copy; </p> 
  </div>
	
</body>

</html>