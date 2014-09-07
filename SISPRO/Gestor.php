<?php

include "AccesoDatos.php";
error_reporting(0);
class Gestor {
	var $acceso;
	
	function Gestor(){	
		$this->acceso=new AccesoDatos();	
	}
	
//Agregar Prospectos - Victor
	public function agregarProspecto($pnombre, $papellido1, $papellido2, $pidentificacion, $ptelefono, $ptelefonoO, $pcelular, $pemail, $pcolegio,$pestado){
		$sql="INSERT INTO Prospecto(nombre, apellido1, apellido2, numero_identificacion, telefono_1, telefono_2, telefono_3, correo_electronico, colegio_procedencia, idestado) 
		VALUES ('".$pnombre."','".$papellido1."','".$papellido2."','".$pidentificacion."','".$ptelefono."','".$ptelefonoO."','".$pcelular."','".$pemail."','".$pcolegio."','".$pestado."')";
		$this->acceso->ejecutarSQL($sql);
		$this->acceso->cerrarConexion();
	}
	//Buscar Prospectos
		public function buscarProspectoPorId($id_prospecto){
				
		$sql = "SELECT * FROM Prospecto WHERE id_prospecto=".$id_prospecto;
		$rs = $this->acceso->ejecutarSQL($sql);
		
		if (odbc_fetch_row($rs)){
			$id_prospecto=odbc_result($rs,"id_prospecto");
			$nombre=odbc_result($rs,"nombre");
			$apellido1=odbc_result($rs,"apellido1");
			$apellido2=odbc_result($rs,"apellido2");
			$identificacion=odbc_result($rs,"numero_identificacion");
			$telefono=odbc_result($rs,"telefono_1");
			$telefonoO=odbc_result($rs,"telefono_2");
			$celular=odbc_result($rs,"telefono_3");
			$email=odbc_result($rs,"correo_electronico");
			$colegio=odbc_result($rs,"colegio_procedencia");
			$estadoProspecto=odbc_result($rs,"idestado");
			$consulta = array($id_prospecto,$nombre,$apellido1,$apellido2,$identificacion,$telefono,$telefonoO,$celular,$email,$colegio,$estadoProspecto);
		}
		$this->acceso->cerrarConexion();
		return $consulta;
			
	}
	//Modificar Prospectos
		public function modificarProspecto($id_prospecto, $pnombre, $papellido1, $papellido2, $pidentificacion, $ptelefono, $ptelefonoO, $pcelular, $pemail, $pcolegio, $pestadoProspecto){	
		$sql="UPDATE Prospecto SET nombre='".$pnombre."', apellido1='".$papellido1."',apellido2='".$papellido2."',numero_identificacion='".$pidentificacion."',telefono_1='".$ptelefono."',telefono_2='".$ptelefonoO."',telefono_3='".$pcelular."',correo_electronico='".$pemail."',colegio_procedencia='".$pcolegio."', idestado='".$pestadoProspecto."' WHERE id_prospecto=".$id_prospecto."";
		$this->acceso->ejecutarSQL($sql);
		$this->acceso->cerrarConexion();
	}
	//Consultar Prospecto
		public function consultarProspecto($pcodigo){
		
		$registro=array();
		$consulta=array();
		$sql = "SELECT * FROM Prospecto WHERE id_prospecto=".$id_prospecto;
		$rs = $this->acceso->ejecutarSQL($sql);
		
		if (odbc_fetch_row($rs)){
			$id_prospecto=odbc_result($rs,"id_prospecto");
			$nombre=odbc_result($rs,"nombre");
			$apellido1=odbc_result($rs,"apellido1");
			$apellido2=odbc_result($rs,"apellido2");
			$identificacion=odbc_result($rs,"numero_identificacion");
			$telefono=odbc_result($rs,"telefono_1");
			$telefonoO=odbc_result($rs,"telefono_2");
			$celular=odbc_result($rs,"telefono_3");
			$email=odbc_result($rs,"correo_electronico");
			$colegio=odbc_result($rs,"colegio_procedencia");
			$consulta = array($id_prospecto,$nombre,$apellido1,$apellido2,$identificacion,$telefono,$telefonoO,$celular,$email,$colegio);
		}
		$this->acceso->cerrarConexion();
		return $consulta;
			
	}
	
	public function verificaIdentificacion($pidentificacion){
	
		$consulta=0;
		
		$sql = "SELECT COUNT (*) AS numero_identificacion FROM Prospecto WHERE numero_identificacion='$pidentificacion'";
		$rs = $this->acceso->ejecutarSQL($sql);
		
		if (odbc_result($rs,"numero_identificacion") > 0){
			$consulta=1;
		}
		$this->acceso->cerrarConexion();
		return $consulta;
	}
	
		public function verificaIdModificar($pidentificacion, $pprospecto){
	
		$consulta=false;
		
		$sql = "SELECT COUNT (*) AS numero_identificacion FROM Prospecto WHERE numero_identificacion='$pidentificacion' AND id_prospecto <> $pprospecto";
		$rs = $this->acceso->ejecutarSQL($sql);
		
		
		if (odbc_result($rs,"numero_identificacion") >= 1){
			$consulta=true;
		}
		$this->acceso->cerrarConexion();
		return $consulta;
	}	
	
	//buscar Prospectos Victor
	public function buscaProspecto($buscar){

		$sql = "";
		$rs = false;
		$registro = array();
		$consulta = array();
		
		// Sentencia SQL para traer los datos
		$sql = " SELECT * From Prospecto 
		WHERE nombre LIKE '%".$buscar."%'
		OR apellido1 LIKE '%".$buscar."%'
		OR apellido2 LIKE '%".$buscar."%'
		OR numero_identificacion LIKE '%".$buscar."%'
		OR telefono_1 LIKE '%".$buscar."%'
		OR telefono_2 LIKE '%".$buscar."%'
		OR telefono_3 LIKE '%".$buscar."%'
		OR correo_electronico LIKE '%".$buscar."%'
		OR colegio_procedencia LIKE '%".$buscar."%'		
		";
				
		$rs = $this->acceso->ejecutarSQL($sql);
		
		while(odbc_fetch_row($rs)){
			$id_prospecto=odbc_result($rs,"id_prospecto");
			$nombre=odbc_result($rs,"nombre");
			$apellido1=odbc_result($rs,"apellido1");
			$apellido2=odbc_result($rs,"apellido2");
			$identificacion=odbc_result($rs,"numero_identificacion");
			$telefono1=odbc_result($rs,"telefono_1");
			$telefono2=odbc_result($rs,"telefono_2");
			$telefono3=odbc_result($rs,"telefono_3");
			$correo=odbc_result($rs,"correo_electronico");
			$colegioProcedencia=odbc_result($rs,"colegio_procedencia");
			$idEstado=odbc_result($rs,"idestado");
			$registro = array($id_prospecto=>array($id_prospecto,$nombre,$apellido1,$apellido2,$identificacion,$telefono1,$telefono2,$telefono3,$correo, $colegioProcedencia,$idEstado));
			$consulta = array_merge($consulta, $registro);			
		}
		$this->acceso->cerrarConexion();
		return $consulta;
		
	}
	
	
	
	//Fin Casos - Victor
	
	//ADOLFO
	//Agregar Carreras - Adolfo
	public function agregarCarrera($codigo, $gradoAcademico, $nombre, $aprobadoConesup){
		$sql="INSERT INTO Carrera(codigo, id_grado, nombre, aprobacion_conesup) VALUES ('".$codigo."', '".$gradoAcademico."','".$nombre.     "','".$aprobadoConesup."')";
		$this->acceso->ejecutarSQL($sql);
		$this->acceso->cerrarConexion();
	}
	
	public function modificarCarrera($id_carrera, $codigo, $id_Grado, $nombre, $aprobacion_Conesup){
		$sql="UPDATE Carrera SET codigo=" ."'". $codigo  . "'" . ", id_grado  =" . "'"  . $id_Grado    . "'" .", nombre    =" ."'" .$nombre .      "'"  . ", aprobacion_conesup=". "'" .$aprobacion_Conesup. "'" . "WHERE Id_carrera=$id_carrera";		
		$this->acceso->ejecutarSQL($sql);
		$this->acceso->cerrarConexion();
	}
	
	public function buscarCarreraExiste($buscar){
		
		$sql="";
		$rs=false;
		$registro=array();
		$consulta=array();
		$existe=false;
		
		$sql= "SELECT * FROM Carrera WHERE codigo='".$buscar."';";
		$rs = $this->acceso->ejecutarSQL($sql);
		while(odbc_fetch_row($rs)){
			$existe=true;
		}
		$this->acceso->cerrarConexion();
		return $existe;
	}
	
	public function verificaCarreraModificar($codigo){
	
		$consulta=0;
		
		$sql = "SELECT COUNT (*) AS codigo FROM Carrera WHERE codigo='".$codigo."';";
		$rs = $this->acceso->ejecutarSQL($sql);
		$existe = odbc_result($rs,"codigo");
		if ($existe > 1 ){
			$consulta= 2;
		}
		$this->acceso->cerrarConexion();
		return $consulta;
	}
	
	 //Listar Carreras - Adolfo
	public function listarCarreras(){
		$sql="";
		$rs=false;
		$registro=array();
		$consulta=array();
		$sql = "SELECT Carrera.Id_carrera, Carrera.codigo, Carrera.id_grado, Carrera.nombre, Carrera.aprobacion_conesup, Grado.nombre_grado
		FROM Carrera
		INNER JOIN Grado
		ON Carrera.id_grado = Grado.id_grado;";
		$rs = $this->acceso->ejecutarSQL($sql);
		
		while(odbc_fetch_row($rs)){
			$id_carrera=odbc_result($rs,"Id_carrera");
			$codigo=odbc_result($rs,"codigo");			
			$id_grado=odbc_result($rs,"id_grado");
			$nombre=odbc_result($rs,"nombre");
			$aprobacion_conesup=odbc_result($rs,"aprobacion_conesup");
			$nombre_grado=odbc_result($rs,"nombre_grado");
			$registro = array($id_carrera=>array($id_carrera,$codigo,$id_grado,$nombre,$aprobacion_conesup, $nombre_grado));
			$consulta = array_merge($consulta, $registro);			
		}
		$this->acceso->cerrarConexion();
		return $consulta;
	}
		
	public function cargarGrados(){
		$sql="";
		$rs=false;
		$registro=array();
		$consulta=array();
		
		$sql = "SELECT * FROM Grado";
		$rs = $this->acceso->ejecutarSQL($sql);
		
		while(odbc_fetch_row($rs)){
			$id_grado=odbc_result($rs,"id_grado");
			$nombre=odbc_result($rs,"nombre_grado");
			$registro = array($id_grado=>array($id_grado,$nombre));
			$consulta = array_merge($consulta, $registro);			
		}
		$this->acceso->cerrarConexion();
		return $consulta;
	}
	
	public function buscarCarreras($buscar){
		
		$sql="";
		$rs=false;
		$registro=array();
		$consulta=array();
		$sql= "SELECT  Carrera.Id_carrera, Carrera.codigo, Carrera.id_grado, Carrera.nombre, Carrera.aprobacion_conesup, Grado.nombre_grado FROM Carrera
				INNER JOIN Grado
				ON Carrera.id_grado = Grado.id_grado
				WHERE Carrera.codigo LIKE '%".$buscar."%'
				OR Grado.nombre_grado LIKE '%".$buscar."%'
				OR Carrera.nombre LIKE '%".$buscar."%';";
				
		$rs = $this->acceso->ejecutarSQL($sql);
		
		while(odbc_fetch_row($rs)){
			$id_carrera=odbc_result($rs,"Id_carrera");
			$codigo=odbc_result($rs,"codigo");			
			$id_grado=odbc_result($rs,"id_grado");
			$nombre=odbc_result($rs,"nombre");
			$aprobacion_conesup=odbc_result($rs,"aprobacion_conesup");
			$nombre_grado=odbc_result($rs,"nombre_grado");
			$registro = array($id_carrera=>array($id_carrera,$codigo,$id_grado,$nombre,$aprobacion_conesup, $nombre_grado));
			$consulta = array_merge($consulta, $registro);			
		}
		$this->acceso->cerrarConexion();
		return $consulta;
	}
	
	
	//Buscar carrera - Jose P.
	public function buscarCarreraPorID($id_carrera){
		$sql = "SELECT Carrera.Id_carrera, Carrera.codigo, Carrera.id_grado, Carrera.nombre, Carrera.aprobacion_conesup, Grado.nombre_grado
		FROM Carrera
		INNER JOIN Grado
		ON Carrera.id_grado = Grado.id_grado WHERE Carrera.id_carrera=".$id_carrera;
		//$sql = "SELECT * FROM Carrera WHERE id_carrera=".$id_carrera;
		$rs = $this->acceso->ejecutarSQL($sql);
		
		if (odbc_fetch_row($rs)){
			$id_carrera=odbc_result($rs,"id_carrera");
			$codigo=odbc_result($rs,"codigo");			
			$id_grado=odbc_result($rs,"id_grado");
			$nombre=odbc_result($rs,"nombre");
			$aprobacion_conesup=odbc_result($rs,"aprobacion_conesup");
			$nombre_grado=odbc_result($rs,"nombre_grado");
			$consulta = array($id_carrera,$codigo,$id_grado,$nombre,$aprobacion_conesup, $nombre_grado);
		}
		$this->acceso->cerrarConexion();
		return $consulta;
	}
	
	// ============================================================================================
	// Nombre Prospecto - Melvin
	// ============================================================================================
	public function obtenerNombreProspecto($id_prospecto){
		// ========================================================================================
		// VARIABLES>>
		// ========================================================================================
		$sql="";
		$rs=false;
		$registro=array();
		$consulta=array();
	
		// Sentencia SQL para traer los datos
		$sql="SELECT Prospecto.id_prospecto, Prospecto.nombre, Prospecto.apellido1, Prospecto.apellido2 FROM Prospecto WHERE id_prospecto = ".$id_prospecto.";";
		$rs = $this->acceso->ejecutarSQL($sql);
		
		while(odbc_fetch_row($rs)){
			$nombre = odbc_result($rs, "nombre");
			$apellido1 = odbc_result($rs, "apellido1");
			$apellido2 = odbc_result($rs, "apellido2");
			
			$id_prospecto = odbc_result($rs, "id_prospecto");
			$nombre_prospecto = $nombre." ".$apellido1." ".$apellido2;
			
			$registro = array($id_prospecto=>array($id_prospecto,$nombre_prospecto));
			$consulta = array_merge($consulta, $registro);			
		}
		
		$this->acceso->cerrarConexion();
		return $consulta;
	}
	
	// ============================================================================================
	// Agregar Contactos - Melvin
	// ============================================================================================
	public function agregarContacto($fecha, $comentario, $id_carrera, $id_prospecto, $id_usuarios, $id_medio){
		// ========================================================================================
		// VARIABLES>>
		// ========================================================================================
		$sql = "";
		
		$sql="INSERT INTO contacto(fecha, comentarios, id_carrera, id_prospecto, idusuario, id_medio) VALUES ('".$fecha."', '".$comentario."', ".$id_carrera.", ".$id_prospecto.", ".$id_usuarios.", ".$id_medio.");";
		$this->acceso->ejecutarSQL($sql);
		$this->acceso->cerrarConexion();
	}	
	
	// ============================================================================================
	// Listar Medios - Melvin
	// ============================================================================================
	
	public function listarMedios(){
		// ========================================================================================
		// VARIABLES>>
		// ========================================================================================
		$sql="";
		$rs=false;
		$registro=array();
		$consulta=array();
	
		// Sentencia SQL para traer los datos
		$sql = "SELECT * FROM Medio_comunicacion;";
		$rs = $this->acceso->ejecutarSQL($sql);
		
		while(odbc_fetch_row($rs)){
			$id_medio = odbc_result($rs, "id_Medio");
			$nombre_medio = odbc_result($rs, "medio_nombre");
			
			$registro = array($id_medio=>array($id_medio, $nombre_medio));
			$consulta = array_merge($consulta, $registro);			
		}
		
		$this->acceso->cerrarConexion();
		return $consulta;
	}
	
	// ============================================================================================
	// Listar Carreras - Melvin
	// ============================================================================================
	public function listarCarrerasLite(){
		// ========================================================================================
		// VARIABLES>>
		// ========================================================================================
		$sql="";
		$rs=false;
		$registro=array();
		$consulta=array();
	
		// Sentencia SQL para traer los datos
		$sql = "SELECT Carrera.Id_carrera, Grado.nombre_grado, Carrera.nombre FROM Grado INNER JOIN Carrera ON Grado.id_grado = Carrera.id_grado;";
		$rs = $this->acceso->ejecutarSQL($sql);
		
		while(odbc_fetch_row($rs)){
			$id_carrera = odbc_result($rs, 1);
			$grado_carrera = odbc_result($rs, 2);
			$nombre_corto_carrera = odbc_result($rs, 3);
			
			$nombre_carrera = $grado_carrera." en ".$nombre_corto_carrera;
			
			$registro = array($id_carrera=>array($id_carrera, $nombre_carrera));
			$consulta = array_merge($consulta, $registro);			
		}
		
		$this->acceso->cerrarConexion();
		return $consulta;
	}
	
	// ============================================================================================
	// Listar Contactos - Melvin
	// ============================================================================================
	public function listarContactos($idprospecto){
		// ========================================================================================
		// VARIABLES>>
		// ========================================================================================
		$sql="";
		$rs=false;
		$registro=array();
		$consulta=array();
	
		// Sentencia SQL para traer los datos
		$sql = "
		SELECT contacto.id_contacto, contacto.fecha, Medio_comunicacion.medio_nombre 
		FROM Medio_comunicacion INNER JOIN contacto ON Medio_comunicacion.id_Medio = contacto.id_medio 
		WHERE contacto.id_prospecto = ".$idprospecto."
		ORDER BY fecha DESC;";
		
		$rs = $this->acceso->ejecutarSQL($sql);
		
		while(odbc_fetch_row($rs)){
			$id_contacto = odbc_result($rs, "id_contacto");
			$fecha = odbc_result($rs, "fecha");
			$medio = odbc_result($rs, "medio_nombre");
			
			$dia = date("d-M-y", strtotime($fecha));  
			$hora = date("H:i", strtotime($fecha));  
			
			$registro = array($id_contacto=>array($id_contacto, $dia, $hora, $medio));
			$consulta = array_merge($consulta, $registro);			
		}
		
		$this->acceso->cerrarConexion();
		return $consulta;
	}
	
	// ============================================================================================
	// Listar Contactos - Melvin
	// ============================================================================================
	public function listarContactosFiltrar($idprospecto, $buscar){
		// ========================================================================================
		// VARIABLES>>
		// ========================================================================================
		$sql = "";
		$rs = false;
		$registro = array();
		$consulta = array();
		
		// Sentencia SQL para traer los datos
		$sql = "
		SELECT contacto.id_contacto, contacto.fecha, Medio_comunicacion.medio_nombre 
		FROM Medio_comunicacion INNER JOIN contacto ON Medio_comunicacion.id_Medio = contacto.id_medio 
		WHERE contacto.id_prospecto = ".$idprospecto."
		AND (
			fecha LIKE '%".$buscar."%'
			OR medio_nombre LIKE '%".$buscar."%'
		);";
		
		$rs = $this->acceso->ejecutarSQL($sql);
		
		while(odbc_fetch_row($rs)){
			$id_contacto = odbc_result($rs, "id_contacto");
			$fecha = odbc_result($rs, "fecha");
			$medio = odbc_result($rs, "medio_nombre");
			
			$dia = date("d-M-y", strtotime($fecha));  
			$hora = date("H:i", strtotime($fecha));  
			
			$registro = array($id_contacto=>array($id_contacto, $dia, $hora, $medio));
			$consulta = array_merge($consulta, $registro);			
		}
		
		$this->acceso->cerrarConexion();
		return $consulta;
	}
	
		//DENNIS
	//Agregar Usuarios - Dennis
	
	public function agregarUsuario($pnombre, $papellido_1, $papellido_2, $pnumero_cedula, $pnombre_usuario, $pcontrasena, $pid_estado){
		$sql="INSERT INTO usuario(nombre, apellido1, apellido2, numero_cedula, nombreusuario, contrasenna, idestado) VALUES ('".$pnombre."','".$papellido_1."','".$papellido_2."','".$pnumero_cedula."','".$pnombre_usuario."','".$pcontrasena."','".$pid_estado."')";
		$this->acceso->ejecutarSQL($sql);
		$this->acceso->cerrarConexion();
	}

	//Listar Usuarios - Dennis
	public function listarUsuarios(){
		$sql="";
		$rs=false;
		$registro=array();
		$consulta=array();
		
		$sql = "SELECT * FROM usuario";
		$rs = $this->acceso->ejecutarSQL($sql);
		
		while(odbc_fetch_row($rs)){
			$idusuario=odbc_result($rs,"idusuario");//0
			$nombre=odbc_result($rs,"nombre");//1
			$apellido1=odbc_result($rs,"apellido1");//2
			$apellido2=odbc_result($rs,"apellido2");//3
			$numero_cedula=odbc_result($rs,"numero_cedula");//4
			$nombreusuario=odbc_result($rs,"nombreusuario");//5
			$contrasenna=odbc_result($rs,"contrasenna");//6
			$idestado=odbc_result($rs,"idestado");//7
			$registro = array($idusuario=>array($idusuario,$nombre,$apellido1,$apellido2,$numero_cedula, $nombreusuario, $contrasenna, $idestado));
			$consulta = array_merge($consulta, $registro);			
		}
		$this->acceso->cerrarConexion();
		return $consulta;
	}
	
	//Buscar Usuarios Por ID - Dennis
	public function buscarUsuarioPorID($idusuario){
				
		$sql = "SELECT * FROM usuario WHERE idusuario=".$idusuario;
		$rs = $this->acceso->ejecutarSQL($sql);
		
		if (odbc_fetch_row($rs)){
			$idusuario=odbc_result($rs,"idusuario");
			$nombre=odbc_result($rs,"nombre");
			$apellido1=odbc_result($rs,"apellido1");
			$apellido2=odbc_result($rs,"apellido2");
			$numero_cedula=odbc_result($rs,"numero_cedula");
			$nombreusuario=odbc_result($rs,"nombreusuario");
			$contrasenna=odbc_result($rs,"contrasenna");
			$idestado=odbc_result($rs,"idestado");
			$consulta = array($idusuario, $nombre, $apellido1, $apellido2, $numero_cedula, $nombreusuario, $contrasenna, $idestado);
		}
		$this->acceso->cerrarConexion();
		return $consulta;
	}
	
	public function buscarUsuarioExiste($buscar){
		
		$sql="";
		$rs=false;
		$registro=array();
		$consulta=array();
		$existe=false;
		
		$sql= "SELECT * FROM usuario WHERE nombreusuario='".$buscar."';";
		$rs = $this->acceso->ejecutarSQL($sql);
		while(odbc_fetch_row($rs)){
			$existe=true;
		}
		$this->acceso->cerrarConexion();
		return $existe;
	}
	public function buscarUsuarioContrasena($buscar){
		
		$sql="";
		$rs=false;
		$registro=array();
		$consulta=array();
		$existe=false;
		$contrasenna;
		
		$sql= "SELECT contrasenna FROM usuario WHERE idusuario=".$buscar;
		$rs = $this->acceso->ejecutarSQL($sql);
		while(odbc_fetch_row($rs)){
			$contrasenna=odbc_result($rs,"contrasenna");
		}
		$this->acceso->cerrarConexion();
		return $contrasenna;
	}
	
	public function verificaUsuarioModificar($nombreusuario){
	
		$consulta=0;
		
		$sql = "SELECT COUNT (*) AS nombreusuario FROM usuario WHERE nombreusuario='".$nombreusuario."';";
		$rs = $this->acceso->ejecutarSQL($sql);
		$existe = odbc_result($rs,"nombreusuario");
		if ($existe > 1 ){
			$consulta= 2;
		}
		$this->acceso->cerrarConexion();
		return $consulta;
	}	
	
	public function buscarUsuarios($buscar){
		
		$sql="";
		$rs=false;
		$registro=array();
		$consulta=array();
		
		$sql= "SELECT * FROM usuario
				WHERE nombre LIKE '%".$buscar."%'
				OR apellido1 LIKE '%".$buscar."%'
				OR apellido2 LIKE '%".$buscar."%'
				OR nombreusuario LIKE '%".$buscar."%'
				OR numero_cedula LIKE '%".$buscar."%';";
				
		$rs = $this->acceso->ejecutarSQL($sql);
		
		while(odbc_fetch_row($rs)){
			$idusuario=odbc_result($rs,"idusuario");//0
			$nombre=odbc_result($rs,"nombre");//1
			$apellido1=odbc_result($rs,"apellido1");//2
			$apellido2=odbc_result($rs,"apellido2");//3
			$numero_cedula=odbc_result($rs,"numero_cedula");//4
			$nombreusuario=odbc_result($rs,"nombreusuario");//5
			$contrasenna=odbc_result($rs,"contrasenna");//6
			$idestado=odbc_result($rs,"idestado");//7
			$registro = array($idusuario=>array($idusuario,$nombre,$apellido1,$apellido2,$numero_cedula, $nombreusuario, $contrasenna, $idestado));
			$consulta = array_merge($consulta, $registro);			
		}
		$this->acceso->cerrarConexion();
		return $consulta;
	}
	
	//Modificar Usuarios - Dennis
	public function modificarUsuario($idusuario, $pnombre, $papellido_1, $papellido_2, $pnumero_cedula, $pnombre_usuario, $pcontrasena, $pid_estado){
		$sql="UPDATE usuario SET nombre=" ."'". $pnombre . "'" . ", apellido1=" . "'"  . $papellido_1 . "'" .", apellido2=" ."'" .$papellido_2 . "'"  . ", numero_cedula=". "'" .$pnumero_cedula. "'" . ",nombreusuario=". "'" .$pnombre_usuario."'" . ",contrasenna="."'".$pcontrasena."'".",idestado="."'".$pid_estado. "'". "WHERE idusuario=$idusuario";		
		$this->acceso->ejecutarSQL($sql);
		$this->acceso->cerrarConexion();
	}
	
	
	//JOSE
	//Listar Prospectos - Jose
	public function listarProspectos(){
		$sql="";
		$rs=false;
		$registro=array();
		$consulta=array();
		$rowPerPage = 4;
		
		$sql = "SELECT Prospecto.id_prospecto, Prospecto.nombre, Prospecto.apellido1, Prospecto.apellido2, Prospecto.numero_identificacion, Prospecto.telefono_1, Prospecto.correo_electronico, contacto.fecha FROM Prospecto INNER JOIN contacto ON contacto.id_prospecto = Prospecto.id_prospecto WHERE contacto.fecha = (SELECT max(fecha) from contacto where contacto.id_prospecto = Prospecto.id_prospecto) UNION SELECT Prospecto.id_prospecto, Prospecto.nombre, Prospecto.apellido1, Prospecto.apellido2, Prospecto.numero_identificacion, Prospecto.telefono_1, Prospecto.correo_electronico, null FROM Prospecto WHERE id_prospecto NOT IN (SELECT Prospecto.id_prospecto FROM Prospecto INNER JOIN contacto ON contacto.id_prospecto = Prospecto.id_prospecto) ORDER BY contacto.fecha DESC";
		$rs = $this->acceso->ejecutarSQL($sql);
		
		while(odbc_fetch_row($rs)){
			$id_prospecto=odbc_result($rs,"id_prospecto");
			$nombre=odbc_result($rs,"nombre");
			$apellido1=odbc_result($rs,"apellido1");
			$apellido2=odbc_result($rs,"apellido2");
			$identificacion=odbc_result($rs,"numero_identificacion");
			$telefono1=odbc_result($rs,"telefono_1");
			$telefono2=odbc_result($rs,"telefono_2");
			$telefono3=odbc_result($rs,"telefono_3");
			$correo=odbc_result($rs,"correo_electronico");
			$colegioProcedencia=odbc_result($rs,"colegio_procedencia");
			$idEstado=odbc_result($rs,"idestado");
			$registro = array($id_prospecto=>array($id_prospecto,$nombre,$apellido1,$apellido2,$identificacion,$telefono1,$telefono2,$telefono3,$correo, $colegioProcedencia,$idEstado));
			$consulta = array_merge($consulta, $registro);			
		}
		$this->acceso->cerrarConexion();
		return $consulta;
	}
	
	//Contar prospectos para paginacion
	
	public function calcularCantidadProspectos() {
		$sql = "SELECT COUNT(*)  AS num FROM Prospecto";
		$rs = $this->acceso->ejecutarSQL($sql);
		while(odbc_fetch_row($rs)){
			$cantidad = odbc_result($rs,"num");
		}
		$this->acceso->cerrarConexion();
		return $cantidad;
	
	}
	
	
	public function buscarProspectoPorContacto($id_contacto) {
		$sql = "SELECT * from Prospecto INNER JOIN contacto ON contacto.id_prospecto = Prospecto.id_prospecto where contacto.id_contacto = $id_contacto";
		$rs = $this->acceso->ejecutarSQL($sql);
		
		while(odbc_fetch_row($rs)){
			$id_prospecto=odbc_result($rs,"id_prospecto");
			$nombre=odbc_result($rs,"nombre");
			$apellido1=odbc_result($rs,"apellido1");
			$apellido2=odbc_result($rs,"apellido2");
			$identificacion=odbc_result($rs,"numero_identificacion");
			$telefono1=odbc_result($rs,"telefono_1");
			$telefono2=odbc_result($rs,"telefono_2");
			$telefono3=odbc_result($rs,"telefono_3");
			$correo=odbc_result($rs,"correo_electronico");
			$colegioProcedencia=odbc_result($rs,"colegio_procedencia");
			$idEstado=odbc_result($rs,"idestado");
			$consulta = array($id_prospecto,$nombre,$apellido1,$apellido2,$identificacion,$telefono1,$telefono2,$telefono3,$correo, $colegioProcedencia,$idEstado);	
		}
		$this->acceso->cerrarConexion();
		return $consulta;
	}
	
	public function buscarPrimerID() {
		$sql = "SELECT min(id_prospecto) AS idMenor from Prospecto";
		$rs = $this->acceso->ejecutarSQL($sql);
		while(odbc_fetch_row($rs)){
			$cantidad = odbc_result($rs,"idMenor");
		}
		$this->acceso->cerrarConexion();
		return $cantidad;

	}
	
	public function cargarProspectosEntreFilas($filaInicial, $filaFinal) {
		$sql = "SELECT * FROM Prospecto where id_prospecto between $filaInicial and $filaFinal ORDER BY id_prospecto ASC";
		$rs = $this->acceso->ejecutarSQL($sql);
		
		while( $row = odbc_fetch_array($rs) ) { 
				
		} 
		
		while(odbc_fetch_row($rs)){
			$id_prospecto=odbc_result($rs,"id_prospecto");
			
			$nombre=odbc_result($rs,"nombre");
			$apellido1=odbc_result($rs,"apellido1");
			$apellido2=odbc_result($rs,"apellido2");
			$identificacion=odbc_result($rs,"numero_identificacion");
			$telefono1=odbc_result($rs,"telefono_1");
			$telefono2=odbc_result($rs,"telefono_2");
			$telefono3=odbc_result($rs,"telefono_3");
			$correo=odbc_result($rs,"correo_electronico");
			$colegioProcedencia=odbc_result($rs,"colegio_procedencia");
			$idEstado=odbc_result($rs,"idestado");
			$registro = array($id_prospecto=>array($id_prospecto,$nombre,$apellido1,$apellido2,$identificacion,$telefono1,$telefono2,$telefono3,$correo, $colegioProcedencia,$idEstado));
			$consulta = array_merge($consulta, $registro);	
			
		}
		$this->acceso->cerrarConexion();
		return $consulta;
	}
	
	//Buscar contacto por ID - Jose

	public function buscarContactoPorID($id_contacto){
				
		$sql = "SELECT * FROM contacto WHERE id_contacto=".$id_contacto;
		$rs = $this->acceso->ejecutarSQL($sql);
		
		if (odbc_fetch_row($rs)){
			$id_contacto=odbc_result($rs,"id_contacto");
			$fecha=odbc_result($rs,"fecha");
			$comentarios=odbc_result($rs,"comentarios");
			$id_carrera=odbc_result($rs,"id_carrera");
			$id_prospecto=odbc_result($rs,"id_prospecto");
			$idusuario=odbc_result($rs,"idusuario");
			$id_medio=odbc_result($rs,"id_medio");
			$consulta = array($id_contacto, $fecha, $comentarios, $id_carrera, $id_prospecto, $idusuario, $id_medio);
		}
		$this->acceso->cerrarConexion();
		return $consulta;
	}
	
	
	//Buscar medio por ID - Jose
	
	public function buscarMedioPorID($id_medio){
				
		$sql = "SELECT * FROM Medio_comunicacion WHERE id_Medio=".$id_medio;
		$rs = $this->acceso->ejecutarSQL($sql);
		
		if (odbc_fetch_row($rs)){
			$id_medio=odbc_result($rs,"id_Medio");
			$nombre=odbc_result($rs,"medio_nombre");
			$consulta = array($id_medio, $nombre);
		}
		$this->acceso->cerrarConexion();
		return $consulta;
	}
	
	//Modificar contacto - Jose
	
	public function modificarContacto($id_contacto, $comentarios){
		$sql="UPDATE contacto SET comentarios=" ."'". $comentarios . "'" . " WHERE id_contacto=$id_contacto";		
		$this->acceso->ejecutarSQL($sql);
		$this->acceso->cerrarConexion();
	}
	
	//Buscar ultimo contacto de prospecto - Jose
	public function buscarUltimoContactoDeProspecto($id_prospecto) {
		$sql="SELECT * FROM contacto WHERE contacto.fecha = (SELECT max(fecha) from contacto where id_prospecto =" .  $id_prospecto . ")";
		$rs = $this->acceso->ejecutarSQL($sql);
		
		if (odbc_fetch_row($rs)){
			$id_contacto=odbc_result($rs,"id_contacto");
			$fecha=odbc_result($rs,"fecha");
			$comentarios=odbc_result($rs,"comentarios");
			$id_carrera=odbc_result($rs,"id_carrera");
			$id_prospecto=odbc_result($rs,"id_prospecto");
			$idusuario=odbc_result($rs,"idusuario");
			$id_medio=odbc_result($rs,"id_medio");
			$consulta = array($id_contacto, $fecha, $comentarios, $id_carrera, $id_prospecto, $idusuario, $id_medio);
		}
		
		$this->acceso->cerrarConexion();
		return $consulta;
	}
	
	//Eliminar contacto - Jose
	
	public function eliminarContacto($id_contacto) {
		$sql = "DELETE FROM contacto WHERE id_contacto = " .$id_contacto . ';';
		$this->acceso->ejecutarSQL($sql);
		$this->acceso->cerrarConexion();
	}
	
	// ============================================================================================
	// Buscar usuario - Melvin
	// ============================================================================================
	public function buscarUsuario($nombreusuario, $contrasenna){
		// ========================================================================================
		// VARIABLES>>
		// ========================================================================================
		$sql = "";
		$rs = false;
		//$sql = "
			//SELECT usuario.idusuario, usuario.nombre, usuario.apellido1, usuario.apellido2, usuario.nombreusuario, usuario.contrasenna, usuario.idestado
			//FROM usuario
			//WHERE nombreusuario = ".$nombreusuario." AND contrasenna = ".$contrasenna.";
		//";
		
		$sql = "SELECT usuario.idusuario, usuario.nombre, usuario.apellido1, usuario.apellido2, usuario.nombreusuario, usuario.contrasenna, usuario.idestado
FROM usuario
WHERE nombreusuario = djhv AND contrasenna = 123;";
		
		$rs = $this->acceso->ejecutarSQL($sql);

		while(odbc_fetch_row($rs)){
		
			$idusuario = odbc_result($rs,"idusuario");
			$nombre = odbc_result($rs,"nombre");
			$apellido1 = odbc_result($rs,"apellido1");
			$apellido2 = odbc_result($rs,"apellido2");
			$nombreusuario = odbc_result($rs,"nombreusuario");
			$contrasenna = odbc_result($rs,"contrasenna");
			$idestado = odbc_result($rs,"idestado");
			
			$consulta = array($idusuario, $nombre, $apellido1, $apellido2, $nombreusuario, $contrasenna, $idestado);
		}
		$this->acceso->cerrarConexion();

		return $consulta;
	}
	
}


?>