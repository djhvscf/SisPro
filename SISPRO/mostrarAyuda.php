<html>
	<head>
		<title>Mostrar Ayuda</title>
		<link href="css/bootstrap.css" rel="stylesheet" />
		<link href="css/style.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="css/inicioStyle.css" />
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
			} else {
				header("Location: login.php?state=false&redirect=inicio.php");
			}
			// ==========================================
			?>
		<div class="barraNav">
			<!--Barra fija-->
			<div class="navbar">
				<!--Barra de menu superior-->
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
						</div>
						<!-- /.nav-collapse -->
					</div>
				</div>
				<!-- /navbar-inner -->
				<ul class="breadcrumb"><!--barra subMenu-->
				<li>
				<a href="inicio.php">Inicio</a><span class="divider">/</span>
				</li>
				<li class="active">Ayuda</li>
				</ul>
			</div>
			<!-- /navbar -->
		</div>
		<!--fin barra fija-->
		<div id="headerP"></div>
		<div class="container">
		<div class="page-header">
		<h1>Ayuda <small></small></h1>
		</div>
		<div class="hero-unit">
		<p>La página se divide en listas buscables, formularios de ingreso y formularios de detalles.</p>
		<br />
		<p>Lista buscable:</p>
		<img src="img/listaBuscable.png" alt="Lista Buscable" />
		<br /><br />
		<p>En ella se presenta:</p>
		<ul>
		<li>La barra de búsqueda que realiza una búsqueda por las principales columnas de la tabla.</li>
		<li>Al hacer clic en la cabecera de las columnas se ordenan según el criterio elegido.</li>
		<li>Botón de agregar registro nuevo se encuentra en la parte superior derecha de la tabla. </li>
		</ul>
		<br /><br />
		<p>Formulario de Ingreso:</p>
		<img src="img/formularioDeIngreso.png" alt="Formulario de Ingreso" />
		<br /><br />
		<p>En ella se presenta:</p>
		<ul>
		<li>Campos de relleno</li>
		<li>Listas seleccionables</li>
		<li>Botones de Limpiar e Ingresar los datos</li>
		</ul>
		<br /><br />
		<p>Mostrar Detalles:</p>
		<img src="img/mostrarDetalles.png" alt="Mostrar Detalles" />
		<br /><br />
		<p>En ella se presenta:</p>
		<ul>
		<li>Campos modificables de datos</li>
		<li>Botón de actualizar los datos</li>
		</ul>
		</div>
		</div>
		<div id="footerP">
		<hr /> <p> Copyright Yaisoft 2012 &copy; </p> 
		</div>
	</body>
</html>