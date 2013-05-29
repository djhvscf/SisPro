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
		$sql="INSERT INTO Prospecto(nombre, apellido_1, apellido_2, numero_identificacion, telefono_1, telefono_2, telefono_3, correo_electronico, colegio_procedencia, id_estado) 
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
			$apellido1=odbc_result($rs,"apellido_1");
			$apellido2=odbc_result($rs,"apellido_2");
			$identificacion=odbc_result($rs,"numero_identificacion");
			$telefono=odbc_result($rs,"telefono_1");
			$telefonoO=odbc_result($rs,"telefono_2");
			$celular=odbc_result($rs,"telefono_3");
			$email=odbc_result($rs,"correo_electronico");
			$colegio=odbc_result($rs,"colegio_procedencia");
			$estadoProspecto=odbc_result($rs,"id_estado");
			$consulta = array($id_prospecto,$nombre,$apellido1,$apellido2,$identificacion,$telefono,$telefonoO,$celular,$email,$colegio,$estadoProspecto);
		}
		$this->acceso->cerrarConexion();
		return $consulta;
			
	}
	//Modificar Prospectos
		public function modificarProspecto($id_prospecto, $pnombre, $papellido1, $papellido2, $pidentificacion, $ptelefono, $ptelefonoO, $pcelular, $pemail, $pcolegio, $pestadoProspecto){	
		$sql="UPDATE Prospecto SET nombre='".$pnombre."', apellido_1='".$papellido1."',apellido_2='".$papellido2."',numero_identificacion='".$pidentificacion."',telefono_1='".$ptelefono."',telefono_2='".$ptelefonoO."',telefono_3='".$pcelular."',correo_electronico='".$pemail."',colegio_procedencia='".$pcolegio."', id_estado='".$pestadoProspecto."' WHERE id_prospecto=".$id_prospecto."";
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
			$apellido1=odbc_result($rs,"apellido_1");
			$apellido2=odbc_result($rs,"apellido_2");
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
		OR apellido_1 LIKE '%".$buscar."%'
		OR apellido_2 LIKE '%".$buscar."%'
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
			$apellido1=odbc_result($rs,"apellido_1");
			$apellido2=odbc_result($rs,"apellido_2");
			$identificacion=odbc_result($rs,"numero_identificacion");
			$telefono1=odbc_result($rs,"telefono_1");
			$telefono2=odbc_result($rs,"telefono_2");
			$telefono3=odbc_result($rs,"telefono_3");
			$correo=odbc_result($rs,"correo_electronico");
			$colegioProcedencia=odbc_result($rs,"colegio_procedencia");
			$idEstado=odbc_result($rs,"id_estado");
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
		$sql="SELECT Prospecto.id_prospecto, Prospecto.nombre, Prospecto.apellido_1, Prospecto.apellido_2 FROM Prospecto WHERE id_prospecto = ".$id_prospecto.";";
		$rs = $this->acceso->ejecutarSQL($sql);
		
		while(odbc_fetch_row($rs)){
			$nombre = odbc_result($rs, "nombre");
			$apellido_1 = odbc_result($rs, "apellido_1");
			$apellido_2 = odbc_result($rs, "apellido_2");
			
			$id_prospecto = odbc_result($rs, "id_prospecto");
			$nombre_prospecto = $nombre." ".$apellido_1." ".$apellido_2;
			
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
		
		$sql="INSERT INTO contacto(fecha, comentarios, id_carrera, id_prospecto, id_usuario, id_medio) VALUES ('".$fecha."', '".$comentario."', ".$id_carrera.", ".$id_prospecto.", ".$id_usuarios.", ".$id_medio.");";
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
		SELECT Contacto.id_contacto, Contacto.fecha, Medio_comunicacion.medio_nombre 
		FROM Medio_comunicacion INNER JOIN Contacto ON Medio_comunicacion.id_Medio = Contacto.id_medio 
		WHERE Contacto.id_prospecto = ".$idprospecto."
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
		SELECT Contacto.id_contacto, Contacto.fecha, Medio_comunicacion.medio_nombre 
		FROM Medio_comunicacion INNER JOIN Contacto ON Medio_comunicacion.id_Medio = Contacto.id_medio 
		WHERE Contacto.id_prospecto = ".$idprospecto."
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
		$sql="INSERT INTO Usuario(nombre, apellido_1, apellido_2, numero_cedula, nombre_usuario, contrasena, id_estado) VALUES ('".$pnombre."','".$papellido_1."','".$papellido_2."','".$pnumero_cedula."','".$pnombre_usuario."','".$pcontrasena."','".$pid_estado."')";
		$this->acceso->ejecutarSQL($sql);
		$this->acceso->cerrarConexion();
	}

	//Listar Usuarios - Dennis
	public function listarUsuarios(){
		$sql="";
		$rs=false;
		$registro=array();
		$consulta=array();
		
		$sql = "SELECT * FROM Usuario";
		$rs = $this->acceso->ejecutarSQL($sql);
		
		while(odbc_fetch_row($rs)){
			$id_usuario=odbc_result($rs,"id_usuario");//0
			$nombre=odbc_result($rs,"nombre");//1
			$apellido_1=odbc_result($rs,"apellido_1");//2
			$apellido_2=odbc_result($rs,"apellido_2");//3
			$numero_cedula=odbc_result($rs,"numero_cedula");//4
			$nombre_usuario=odbc_result($rs,"nombre_usuario");//5
			$contrasena=odbc_result($rs,"contrasena");//6
			$id_estado=odbc_result($rs,"id_estado");//7
			$registro = array($id_usuario=>array($id_usuario,$nombre,$apellido_1,$apellido_2,$numero_cedula, $nombre_usuario, $contrasena, $id_estado));
			$consulta = array_merge($consulta, $registro);			
		}
		$this->acceso->cerrarConexion();
		return $consulta;
	}
	
	//Buscar Usuarios Por ID - Dennis
	public function buscarUsuarioPorID($id_usuario){
				
		$sql = "SELECT * FROM usuario WHERE Id_usuario=".$id_usuario;
		$rs = $this->acceso->ejecutarSQL($sql);
		
		if (odbc_fetch_row($rs)){
			$id_usuario=odbc_result($rs,"id_usuario");
			$nombre=odbc_result($rs,"nombre");
			$apellido_1=odbc_result($rs,"apellido_1");
			$apellido_2=odbc_result($rs,"apellido_2");
			$numero_cedula=odbc_result($rs,"numero_cedula");
			$nombre_usuario=odbc_result($rs,"nombre_usuario");
			$contrasena=odbc_result($rs,"contrasena");
			$id_estado=odbc_result($rs,"id_estado");
			$consulta = array($id_usuario, $nombre, $apellido_1, $apellido_2, $numero_cedula, $nombre_usuario, $contrasena, $id_estado);
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
		
		$sql= "SELECT * FROM usuario WHERE nombre_usuario='".$buscar."';";
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
		$contrasena;
		
		$sql= "SELECT contrasena FROM usuario WHERE id_usuario=".$buscar;
		$rs = $this->acceso->ejecutarSQL($sql);
		while(odbc_fetch_row($rs)){
			$contrasena=odbc_result($rs,"contrasena");
		}
		$this->acceso->cerrarConexion();
		return $contrasena;
	}
	
	public function verificaUsuarioModificar($nombre_usuario){
	
		$consulta=0;
		
		$sql = "SELECT COUNT (*) AS nombre_usuario FROM Usuario WHERE nombre_usuario='".$nombre_usuario."';";
		$rs = $this->acceso->ejecutarSQL($sql);
		$existe = odbc_result($rs,"nombre_usuario");
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
		
		$sql= "SELECT * FROM Usuario
				WHERE nombre LIKE '%".$buscar."%'
				OR apellido_1 LIKE '%".$buscar."%'
				OR apellido_2 LIKE '%".$buscar."%'
				OR nombre_usuario LIKE '%".$buscar."%'
				OR numero_cedula LIKE '%".$buscar."%';";
				
		$rs = $this->acceso->ejecutarSQL($sql);
		
		while(odbc_fetch_row($rs)){
			$id_usuario=odbc_result($rs,"id_usuario");//0
			$nombre=odbc_result($rs,"nombre");//1
			$apellido_1=odbc_result($rs,"apellido_1");//2
			$apellido_2=odbc_result($rs,"apellido_2");//3
			$numero_cedula=odbc_result($rs,"numero_cedula");//4
			$nombre_usuario=odbc_result($rs,"nombre_usuario");//5
			$contrasena=odbc_result($rs,"contrasena");//6
			$id_estado=odbc_result($rs,"id_estado");//7
			$registro = array($id_usuario=>array($id_usuario,$nombre,$apellido_1,$apellido_2,$numero_cedula, $nombre_usuario, $contrasena, $id_estado));
			$consulta = array_merge($consulta, $registro);			
		}
		$this->acceso->cerrarConexion();
		return $consulta;
	}
	
	//Modificar Usuarios - Dennis
	public function modificarUsuario($id_usuario, $pnombre, $papellido_1, $papellido_2, $pnumero_cedula, $pnombre_usuario, $pcontrasena, $pid_estado){
		$sql="UPDATE Usuario SET nombre=" ."'". $pnombre . "'" . ", apellido_1=" . "'"  . $papellido_1 . "'" .", apellido_2=" ."'" .$papellido_2 . "'"  . ", numero_cedula=". "'" .$pnumero_cedula. "'" . ",nombre_usuario=". "'" .$pnombre_usuario."'" . ",contrasena="."'".$pcontrasena."'".",id_estado="."'".$pid_estado. "'". "WHERE id_usuario=$id_usuario";		
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
		
		$sql = "SELECT Prospecto.id_prospecto, Prospecto.nombre, Prospecto.apellido_1, Prospecto.apellido_2, Prospecto.numero_identificacion, Prospecto.telefono_1, Prospecto.correo_electronico, Contacto.fecha FROM Prospecto INNER JOIN Contacto ON Contacto.id_prospecto = Prospecto.id_prospecto WHERE Contacto.fecha = (SELECT max(fecha) from Contacto where Contacto.id_prospecto = Prospecto.id_prospecto) UNION SELECT Prospecto.id_prospecto, Prospecto.nombre, Prospecto.apellido_1, Prospecto.apellido_2, Prospecto.numero_identificacion, Prospecto.telefono_1, Prospecto.correo_electronico, null FROM Prospecto WHERE id_prospecto NOT IN (SELECT Prospecto.id_prospecto FROM Prospecto INNER JOIN Contacto ON Contacto.id_prospecto = Prospecto.id_prospecto) ORDER BY Contacto.fecha DESC";
		$rs = $this->acceso->ejecutarSQL($sql);
		
		while(odbc_fetch_row($rs)){
			$id_prospecto=odbc_result($rs,"id_prospecto");
			$nombre=odbc_result($rs,"nombre");
			$apellido1=odbc_result($rs,"apellido_1");
			$apellido2=odbc_result($rs,"apellido_2");
			$identificacion=odbc_result($rs,"numero_identificacion");
			$telefono1=odbc_result($rs,"telefono_1");
			$telefono2=odbc_result($rs,"telefono_2");
			$telefono3=odbc_result($rs,"telefono_3");
			$correo=odbc_result($rs,"correo_electronico");
			$colegioProcedencia=odbc_result($rs,"colegio_procedencia");
			$idEstado=odbc_result($rs,"id_estado");
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
		$sql = "SELECT * from Prospecto INNER JOIN Contacto ON Contacto.id_prospecto = Prospecto.id_prospecto where Contacto.id_contacto = $id_contacto";
		$rs = $this->acceso->ejecutarSQL($sql);
		
		while(odbc_fetch_row($rs)){
			$id_prospecto=odbc_result($rs,"id_prospecto");
			$nombre=odbc_result($rs,"nombre");
			$apellido1=odbc_result($rs,"apellido_1");
			$apellido2=odbc_result($rs,"apellido_2");
			$identificacion=odbc_result($rs,"numero_identificacion");
			$telefono1=odbc_result($rs,"telefono_1");
			$telefono2=odbc_result($rs,"telefono_2");
			$telefono3=odbc_result($rs,"telefono_3");
			$correo=odbc_result($rs,"correo_electronico");
			$colegioProcedencia=odbc_result($rs,"colegio_procedencia");
			$idEstado=odbc_result($rs,"id_estado");
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
			$apellido1=odbc_result($rs,"apellido_1");
			$apellido2=odbc_result($rs,"apellido_2");
			$identificacion=odbc_result($rs,"numero_identificacion");
			$telefono1=odbc_result($rs,"telefono_1");
			$telefono2=odbc_result($rs,"telefono_2");
			$telefono3=odbc_result($rs,"telefono_3");
			$correo=odbc_result($rs,"correo_electronico");
			$colegioProcedencia=odbc_result($rs,"colegio_procedencia");
			$idEstado=odbc_result($rs,"id_estado");
			$registro = array($id_prospecto=>array($id_prospecto,$nombre,$apellido1,$apellido2,$identificacion,$telefono1,$telefono2,$telefono3,$correo, $colegioProcedencia,$idEstado));
			$consulta = array_merge($consulta, $registro);	
			
		}
		$this->acceso->cerrarConexion();
		return $consulta;
	}
	
	//Buscar Contacto por ID - Jose

	public function buscarContactoPorID($id_contacto){
				
		$sql = "SELECT * FROM Contacto WHERE id_contacto=".$id_contacto;
		$rs = $this->acceso->ejecutarSQL($sql);
		
		if (odbc_fetch_row($rs)){
			$id_contacto=odbc_result($rs,"id_contacto");
			$fecha=odbc_result($rs,"fecha");
			$comentarios=odbc_result($rs,"comentarios");
			$id_carrera=odbc_result($rs,"id_carrera");
			$id_prospecto=odbc_result($rs,"id_prospecto");
			$id_usuario=odbc_result($rs,"id_usuario");
			$id_medio=odbc_result($rs,"id_medio");
			$consulta = array($id_contacto, $fecha, $comentarios, $id_carrera, $id_prospecto, $id_usuario, $id_medio);
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
		$sql="UPDATE Contacto SET comentarios=" ."'". $comentarios . "'" . " WHERE id_contacto=$id_contacto";		
		$this->acceso->ejecutarSQL($sql);
		$this->acceso->cerrarConexion();
	}
	
	//Buscar ultimo contacto de prospecto - Jose
	public function buscarUltimoContactoDeProspecto($id_prospecto) {
		$sql="SELECT * FROM Contacto WHERE Contacto.fecha = (SELECT max(fecha) from Contacto where id_prospecto =" .  $id_prospecto . ")";
		$rs = $this->acceso->ejecutarSQL($sql);
		
		if (odbc_fetch_row($rs)){
			$id_contacto=odbc_result($rs,"id_contacto");
			$fecha=odbc_result($rs,"fecha");
			$comentarios=odbc_result($rs,"comentarios");
			$id_carrera=odbc_result($rs,"id_carrera");
			$id_prospecto=odbc_result($rs,"id_prospecto");
			$id_usuario=odbc_result($rs,"id_usuario");
			$id_medio=odbc_result($rs,"id_medio");
			$consulta = array($id_contacto, $fecha, $comentarios, $id_carrera, $id_prospecto, $id_usuario, $id_medio);
		}
		
		$this->acceso->cerrarConexion();
		return $consulta;
	}
	
	//Eliminar contacto - Jose
	
	public function eliminarContacto($id_contacto) {
		$sql = "DELETE FROM CONTACTO WHERE id_contacto = " .$id_contacto . ';';
		$this->acceso->ejecutarSQL($sql);
		$this->acceso->cerrarConexion();
	}
	
	// ============================================================================================
	// Buscar Usuario - Melvin
	// ============================================================================================
	public function buscarUsuario($nombre_usuario, $contrasena){
		// ========================================================================================
		// VARIABLES>>
		// ========================================================================================
		$sql = "";
		$rs = false;
		$sql = "
			SELECT Usuario.Id_usuario, Usuario.nombre, Usuario.apellido_1, Usuario.apellido_2, Usuario.nombre_usuario, Usuario.contrasena, Usuario.id_estado
			FROM Usuario
			WHERE nombre_usuario = '".$nombre_usuario."' AND contrasena = '".$contrasena."';
		";
		
		$rs = $this->acceso->ejecutarSQL($sql);

		while(odbc_fetch_row($rs)){
		
			$Id_usuario = odbc_result($rs,"Id_usuario");
			$nombre = odbc_result($rs,"nombre");
			$apellido_1 = odbc_result($rs,"apellido_1");
			$apellido_2 = odbc_result($rs,"apellido_2");
			$nombre_usuario = odbc_result($rs,"nombre_usuario");
			$contrasena = odbc_result($rs,"contrasena");
			$id_estado = odbc_result($rs,"id_estado");
			
			$consulta = array($Id_usuario, $nombre, $apellido_1, $apellido_2, $nombre_usuario, $contrasena, $id_estado);
		}
		$this->acceso->cerrarConexion();

		return $consulta;
	}
	
}


?>