<?php

class AccesoDatos{	

	var $enlace;
	
	/**
	 * Establece la conexi�n a la base de datos
	 */
	public function AccesoDatos(){
		$enlace = mysql_connect("mysql.hostinger.es", "u615313996_sispr", "cemeja07");
		if  (!$enlace) {
			die('No pudo conectarse: ' . mysql_error());
		}
		mysql_select_db("u615313996_sispr", $enlace);
	}
	
	/**
	 * Ejecuta una consulta a la base de datos
	 * @return resultSet resultado de la consulta
	 */
	public function ejecutarSQL($psql){	
		return mysql_query($psql);
	}
	
	/**
	 * Cierra la conexi�n con la base de datos
	 */
	public function cerrarConexion(){
		mysql_close($enlace);
	}
	
}

?>