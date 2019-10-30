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
	

	function insertar($id, $codigo, $nombre, $apellido)
	{
		$conn = getConexion();
		$stmt = $conn->query("insert into usuarios (id,codigo,nombre,apellido) values (null,'{$codigo}','{$nombre}','{$apellido}')");
		if ( !$stmt ) {
			return false;
		}
		return true;
	}
	
	function modificar($id, $codigo, $nombre, $apellido)
	{
		$conn = getConexion();
		$stmt = $conn->query("update usuarios set nombre = '{$nombre}', apellido = '{$apellido}' where id = {$id}");
		if ( !$stmt ) {
			return false;
		}
		return true;
	}
	
	function eliminar($id)
	{
		$conn = getConexion();
		$stmt = $conn->query("delete from usuarios where id = {$id}");
		if ( !$stmt ) {
			return false;
		}
		return true;
	}
	
?>