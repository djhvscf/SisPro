<html>
<head>
<title>Lista de Usuarios</title> <!--Formulario para agregar carreras al sistema-->
        <!--Elaborado por: YAISOFT-->
        <!--Fecha de creación: 2:14 p.m. 09/07/2012-->
        <!--Fecha de última modificación: 10:05 p.m. 12/07/2012-->   
		<link href="css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet"	type="text/css" href="css/inicioStyle.css"/>
        <link href="css/style.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.css" rel="stylesheet">
		<script type="text/javascript" src="js/bootstrap-dropdown.js"></script>
		<script type="text/javascript" src="js/validaCarrera.js"></script><!--llamada del validador de datos del formulario-->
        <!--<script type="text/javascript" src="js/filterTable.js"></script><!--llamada del filtro del la tabla-->
		<script type="text/javascript" src="js/sorttable.js"></script><!--ordena campos en tabla-->
</head>
<body>
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
		$listaUsuarios=$gestor->buscarUsuarios($buscar);
	}
	else
	{
		$listaUsuarios=$gestor->listarUsuarios();

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
					    <a href="inicio.php">Inicio</a> <span class="divider">/</span>
					</li>
					<li class="active">Usuarios</li>
				</ul>
</div><!-- /navbar -->
</div><!--fin de barra fija-->
   	<div id="headerP"></div>
     <div class = "content">
		<div class = "options">
  		<div id="searchwrapper">
  			<form class="well form-search">
		 		<input type="search" class="span4" placeholder="B&uacute;squeda" name="Buscar" />
		 		<button type="submit" class="btn">Buscar</button>
		 		<a class="btn btn-primary pull-right" href="agregarUsuario.php">
		<i class="icon-plus icon-white"></i>
		 			Agregar nuevo usuario</a>
		 	</form>
		</div>
		</div>
            <div class="theTable">
              <table id="sf" class="table table-bordered table-striped sortable">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Primer Apellido</th>
                        <th>Segundo Apellido</th>
                        <th>Nombre de Usuario</th>
                        <th>Detalle</th>
                    </tr>
                </thead>
                <tbody>
					<?php
						foreach($listaUsuarios as $row) {
							echo "<tr>";
							$id_usuario= $row[0];
							$queryString = "usuario=$id_usuario";
							$urlVer = "detalleUsuario.php?" . $queryString;
							echo "<td>$row[1]</td>";
							echo "<td>$row[2]</td>";
							echo "<td>$row[3]</td>";
							echo "<td>$row[5]</td>";
							echo "<td><a href=$urlVer>Ver</a></td>";
							echo "</tr>";
						}
					?>
                </tbody>
              </table>
</div>
</div>
<div id="footerP">
	<hr>Copyright Yaisoft 2012 &copy;
</div>
</div>
</body>
</html>