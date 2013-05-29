<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title> SisPro - Inicio </title>
	<link rel="stylesheet"	type="text/css" href="css/inicioStyle.css"/>
	<link rel="stylesheet"	type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet"	type="text/css" href="css/style.css"/>

	<script type="text/javascript" src="js/filterTable.js"></script>
	<script type="text/javascript" src="js/sorttable.js"></script>
	<script type="text/javascript" src="js/multipaginasTabla.js"></script>
	<script type="text/javascript" src="js/activarAdmin.js"></script>


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
	} else {
		header("Location: login.php?state=false&redirect=inicio.php");
	}
	// ==========================================
	include "Gestor.php";
	$gestor= new Gestor();
	$listaProspectos=$gestor->listarProspectos();

	$buscar = "";
	if(array_key_exists('Buscar',$_GET))
	{
		$buscar = $_GET['Buscar'];
		$listaProspectos = $gestor->buscaProspecto($buscar);
	}
	else
	{
		$listaProspectos = $gestor->listarProspectos();
			
	}
	
	if(array_key_exists('page', $_GET)) {
		$page = $_GET['page'];
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
                            <a href="inicio.php">Inicio</a>
                        </li>
                    </ul>
    </div><!-- /navbar -->
</div><!--Barra fija-->  				 
  <div id = "header"></div>  
  <div class = "content">
  	<div class = "options">
  		<div id="searchwrapper">
  			<form class="well form-search">
		 		<input type="search" class="span4" placeholder="B&uacute;squeda" name="Buscar"  />
		 		<button type="submit" class="btn">Buscar</button>
		 		<a class="btn btn-primary pull-right" href="agregarProspecto.php">
		 			<i class="icon-user icon-white"></i>
		 			Agregar prospecto
		 		</a>
		 	</form>
		</div><!--SearchWrapper-->
  	</div><!--Options-->
  	
  <div class="theTable">
  <table class="table table-bordered table-striped sortable">
  	<thead>
		<tr>
			<th>Nombre</th>
			<th>Primer Apellido</th>
			<th>Segundo Apellido</th>
			<th>C&eacute;dula</th>
			<th>Tel&eacute;fono</th>
			<th>Correo electr&oacute;nico</th>
			<th>Último contacto</th>
			<th>Detalle</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$cant = count($listaProspectos);
			$limit = 10;
						
			if(empty($page)){    
				$page = 1;      
			}
			$limitnew = $valorInicial + $limit * $page; 
			$limitvalue = $limitnew - $limit;
			
			
			$fromRow = ($page - 1) * $limit;
			$toRow = $fromRow + $limit;
			for ($i = $fromRow; $i<$toRow; $i++) {
				$unprospecto = $listaProspectos[$i];
				$idProspecto = $unprospecto[0];
				if (isset($idProspecto)) {
					$ultimoContacto = $gestor->buscarUltimoContactoDeProspecto($idProspecto);
					echo "<tr>";
					
					$queryString = "prospecto=$idProspecto";
					$urlDetalle = "detalleProspecto.php?" . $queryString;
					$fechaUltimoContacto = $ultimoContacto[1];
					if (!$fechaUltimoContacto) {
						$fechaUltimoContacto = "No posee contactos";
					} else {
						$fechaUltimoContacto = date("d/m/y H:i", strtotime($fechaUltimoContacto));  
					}
					echo "<td>$unprospecto[1]</td>";
					echo "<td>$unprospecto[2]</td>";
					echo "<td>$unprospecto[3]</td>";
					echo "<td>$unprospecto[4]</td>";
					echo "<td>$unprospecto[5]</td>";
					echo "<td>$unprospecto[8]</td>";
					echo "<td>$fechaUltimoContacto</td>";
					echo "<td><a href=$urlDetalle>Ver</a></td>";
					echo "</tr>";
				}
			}
			/*
			foreach($listaProspectos as $row) {
					echo "<tr>";
					$idProspecto = $row[0];
					$queryString = "prospecto=$idProspecto";
					$urlDetalle = "detalleProspecto.php?" . $queryString;
					$ultimoContacto = $gestor->buscarUltimoContactoDeProspecto($idProspecto);
					$fechaUltimoContacto = $ultimoContacto[1];
					if (!$fechaUltimoContacto) {
						$fechaUltimoContacto = "No posee contactos";
					} else {
						$fechaUltimoContacto = date("d/m/y H:i", strtotime($fechaUltimoContacto));  
					}
					echo "<td>$row[1]</td>";
					echo "<td>$row[2]</td>";
					echo "<td>$row[3]</td>";
					echo "<td>$row[4]</td>";
					echo "<td>$row[5]</td>";
					echo "<td>$row[8]</td>";
					echo "<td>$fechaUltimoContacto</td>";
					echo "<td><a href=$urlDetalle>Ver</a></td>";
					echo "</tr>";
				}*/
 
		?>
	</tbody>
  </table>
  </div><!--theTable-->
  
<div class="tableFooterOptions"> 
		<?php
			$rowInicial = $fromRow + 1;
			
			if ($toRow > $cant) {
				$rowFinal = $cant;
			} else {
				$rowFinal = $toRow;
			}
			echo "<h4 id='numeroFilas'> Mostrando $rowInicial-$rowFinal de $cant prospectos</h4>";
			
			$numofpages = ceil($cant/ $limit);

			 if($page != 1 && $page == $numofpages){
					$pageprev = $page -1;
					$finalPageString = "page=$pageprev";
					$finalPage = "inicio.php?" . $finalPageString; 
					echo "<a href=$finalPage class='btn btn' id='atras'> <i class='icon-step-backward'></i></a>";
					echo("<h5 id='pageNumber'> P&aacute;gina $page de $numofpages</h5>");  
			}else if ($page == 1 && $page != $numofpages)  {
					$pagenext = $page + 1;
					$finalPageString1 = "page=$pagenext";
					$finalPage1 = "inicio.php?" . $finalPageString1; 
					echo("<h5 id='pageNumber'> P&aacute;gina $page de $numofpages</h5>");  
					echo "&nbsp; <a href=$finalPage1 class='btn btn' id='delante'> <i class='icon-step-forward'></i></a>";

			} else if ($page == 1 && $page == $numofpages) {
					echo("<h5 id='pageNumber'> P&aacute;gina $page de $numofpages</h5>");  

			}			
			else {
					$backpagenumber = $page -1;
					$backPageString = "page=$backpagenumber";
					$backPage = "inicio.php?" . $backPageString; 
					echo "<a href=$backPage class='btn btn' id='atras'> <i class='icon-step-backward'></i></a>";
					echo("<h5 id='pageNumber'> P&aacute;gina $page de $numofpages</h5>");
					$nextpagenumber = $page + 1;
					$nextPageString = "page=$nextpagenumber";
					$nextPage = "inicio.php?" . $nextPageString; 
					echo "&nbsp; <a href=$nextPage class='btn btn' id='delante'> <i class='icon-step-forward'></i></a>";

			}			
			

			for($i = 1; $i <= $numofpages; ++$i){
				if($i == $page){
					//echo("<h5 id='pageNumber'> P&aacute;gina $page de $numofpages</h5>");  
				}else{
					$finalPageString1 = "page=$i";
					$finalPage1 = "inicio.php?" . $finalPageString1; 
					//echo "&nbsp; <a href=$finalPage1 class='btn btn' id='delante'> <i class='icon-step-forward'></i></a>";
				}
			}
				
				
		?>		
  	
		
	</div>
  
  </div><!--content-->
  
  <div id="footerP">
  <hr> <p> Copyright Yaisoft 2012 &copy; </p> 
  </div>
	
</body>


</html>