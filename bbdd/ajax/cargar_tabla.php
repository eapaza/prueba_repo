<?php
	require('../usuarios_gus.php');
	
	$datos = consultar("SELECT * FROM usuarios");
	$tablaDetalle = '';
	foreach($datos as $row){
		$codigo1 = '"' . "{$row['codigo']}" . '"';
		$nombre1 = '"' . "{$row['nombre']}" . '"';
		$apellido1 = '"' . "{$row['apellido']}" . '"';
		$tablaDetalle .= "<tr><td>{$row['id']}</td><td>{$row['codigo']}</td><td>{$row['nombre']}</td><td>{$row['apellido']}</td><td><a href='jquery.html?id={$row['id']}&ope=upd'>editar</a><a href='#' onClick='confirmar({$row['id']},{$codigo1},{$nombre1},{$apellido1})'> eliminar</a></td><tr>";
	}
	$tabla =  '<table class="table"> 
			<thead class="thead-dark">
				<tr>
					<td>ID</td>
					<td>CODIGO</td>
					<td>NOMBRE</td>
					<td>APELLIDO</td>
					<td>ACCIONES</td>
				</tr>
			</thead>
			<tbody>
				' . $tablaDetalle . '
			</tbody>
		  </table>';
	
	echo $tabla;
	
?>