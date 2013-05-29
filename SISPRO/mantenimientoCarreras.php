<html >
<head>
	<title> Mantenimiento de carreras </title>
	<link rel="stylesheet"	type="text/css" href="css/inicioStyle.css"/>
	<link rel="stylesheet"	type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet"	type="text/css" href="css/style.css"/>
	<script type = "text/javascript" charset="utf-8"></script>
	<script type="text/javascript" src="js/activarAdmin.js"></script>
	<script type="text/javascript" src="js/sorttable.js"></script><!--ordena campos en tabla-->
	<script type="text/javascript" src="js/validarCarreras.js"></script><!--llamada del validador de datos del formulario-->
	<script type="text/javascript" src="js/livevalidation_standalone.js"></script>
</head>
<body onLoad="irAPrimera(); ocultarBarraAdminInicio();" id = "wrap">
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
	$buscar = "";
	if(array_key_exists('Buscar',$_GET))
	{
		$buscar = $_GET['Buscar'];
		$listarCarreras=$gestor->buscarCarreras($buscar);
	}
	else
	{
		$listarCarreras=$gestor->listarCarreras();

	}
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
                    <a href="inicio.php">Inicio</a><span class="divider">/</span>
                </li>
				<li class="active">Carreras</li>
            </ul>
    </div><!-- /navbar -->
</div><!--Barra fija-->  				 
  <div id = "header"></div>  
  <div class = "content">
  	<div class = "options">
  		<div id="searchwrapper">
  			<form class="well form-search">
		 		<input type="search" class="span4" placeholder="B&uacute;squeda" name="Buscar" id="sf_filter" onKeyUp="filterTable(this, 'sf_filter')" />
		 		<button type="submit" class="btn">Buscar</button>
		 		<a class="btn btn-primary pull-right" href="agregarCarrera.php">
		 			<i class="icon-user icon-white"></i>
		 			Agregar nueva carrera
		 		</a>
		 	</form>
		</div>	
  	</div><!--Options-->
	
  <div class="theTable">
  <table id="sf" class="table table-bordered table-striped sortable">
  	<thead>
		<tr>
			<th>C&oacute;digo</th>
			<th>Grado acad&eacute;mico</th>
			<th>Nombre</th>
			<th>Aprobaci&oacute;n Conesup</th>
			<th>Detalles </th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($listarCarreras as $row) {
					echo "<tr>";
					$id_Carrera = $row[0];
					$queryString = "carrera=$id_Carrera";
					$urlVer = "detalleCarrera.php?" . $queryString;
					echo "<td>$row[1]</td>";
					echo "<td>$row[5]</td>";//Nombre del grado
					echo "<td>$row[3]</td>";
					if($row[4] == 1){
					echo "<td>Aprobado</td>";
					}else{
					echo "<td>No aprobado</td>";
					}
					echo "<td><a href=$urlVer>Ver</a></td>";
					echo "</tr>";
				}
		?>
	</tbody>
  </table>
  </div>
  </div>
	<div id="footerP">
	<hr> <p> Copyright Yaisoft 2012 &copy; </p> 
</div>
</body>
</html>