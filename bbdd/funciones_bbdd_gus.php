<?php

	function getConexion()
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$database = 'test_db';

		// Create connection
		$conn = new mysqli($servername, $username, $password, $database);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		return $conn;
	}
	
	function consultar($sql)
	{
		$conn = getConexion();
		$stmt = $conn->query($sql);	
		$resultado = array();
		while( $row = mysqli_fetch_array( $stmt, MYSQLI_ASSOC) ) {
			$resultado[] = $row;
		}
		
		return $resultado;
	}
	

	function insertar($id, $descripcion)
	{
		$conn = getConexion();
		$stmt = $conn->query("insert into prueba values ({$id}, '{$descripcion}')");
		if ( !$stmt ) {
			return false;
		}
		return true;
	}
	
	function modificar($id, $descripcion)
	{
		$conn = getConexion();
		$stmt = $conn->query("update prueba set descripcion = '{$descripcion}' where id = {$id}");
		if ( !$stmt ) {
			return false;
		}
		return true;
	}
	
	function eliminar($id)
	{
		$conn = getConexion();
		$stmt = $conn->query("delete from prueba where id = {$id}");
		if ( !$stmt ) {
			return false;
		}
		return true;
	}
	
?>