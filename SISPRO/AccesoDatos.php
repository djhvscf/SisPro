<?php

class AccesoDatos{	

	var $cnx;
	var $cadena_conexion;


	public function AccesoDatos(){
		$this->cnx=false;
		$this->cadena_conexion='ODBCSispro'; 
		cadena_conexion = mysql_connect('u615313996_sispr', 'u615313996_sispr', 'cemeja07');
	}
	

	public function ejecutarSQL($psql){	
		//echo "ingresa a ejecutarSQL";
		$this->cnx=odbc_connect($this->cadena_conexion,'','');
		if(!$this->cnx){
			exit("Fall� la conexi�n:<br>".$this->cnx);
		}
		$rs=odbc_exec($this->cnx, $psql);
		if (!$rs){
			exit("Error al ejecutar la sentencia");
		}	
		//echo "el rs es: ".$rs;
		return $rs;
	}
	
	public function cerrarConexion(){
		odbc_close($this->cnx);
	}
	
}

?>