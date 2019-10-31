<?php
	require('usuarios_gus.php');
	$msg = '';
	$validar = '';
	$conn = getConexion();
	$id = '';
	$codigo = '';
	$nombre = '';
	$apellido = '';
	$opeaux = '';
	$limpiar = '';
	$cantidad = '';
	$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : '';
	
	if(isset($_REQUEST['limpiar']))$limpiar=$_REQUEST['limpiar'];
	
	if ($limpiar){
	   $id = '';
	   $codigo = '';
	   $nombre = '';
	   $apellido = '';
	}
	else {
	
	// modo optimo
	if ($ope == 'upd')
	{
	   $datos = consultar("SELECT * FROM usuarios WHERE id = {$_REQUEST['id']}");
	   foreach($datos as $row)
	   {
		  $id = $row['id'];
		  $codigo = $row['codigo'];
		  $nombre = $row['nombre'];
		  $apellido = $row['apellido'];
	   }			
	   $opeaux = 'mod';

    } else {
		if (isset($_REQUEST['id'])) 
		{
			if ( $_REQUEST['codigo'] != '' &&  $_REQUEST['nombre'] != '' &&  $_REQUEST['apellido'] != '' )
			{
				if ( $_REQUEST['opeaux'] == 'mod') {
					$res = modificar($_REQUEST['id'], $_REQUEST['codigo'], $_REQUEST['nombre'], $_REQUEST['apellido']);
				} elseif ($ope == 'del') {
					$res = eliminar($_REQUEST['id']);
				} else {
					$control = consultar("SELECT count(1) cantidad FROM usuarios WHERE codigo = '{$_REQUEST['codigo']}'");
	                foreach($control as $row)
				    {
				       $cantidad = $row['cantidad'];	
					   if ($cantidad>"0")
					   {
					   	  $validar = ': Codigo Duplicado';
					   }
					   else
					   {
					   	  $validar = 'kkk';
					   }
				    }
				    if ($validar == 'kkk') {
				       $res = insertar($_REQUEST['id'], $_REQUEST['codigo'], $_REQUEST['nombre'], $_REQUEST['apellido']);										}
				    else
				    {
					   $res = false;	
					}   

				}
				
				if (!$res)
				  {
					 $msg = 'Error en el proceso'.$validar;
				  } 
				else 
				  {
					 $msg = 'proceso correcto!!';
				  }
			}      
			else 
			{
			   $msg = 'Es necesario ingresar toda la informacion';
			}
		}	        
		else 
		{
		   $msg = 'Es necesario ingresar el Id';
		} 	
	}
}
	
	
	$datos = consultar("SELECT * FROM usuarios");
	$tablaDetalle = '';
	foreach($datos as $row){
		$codigo1 = '"' . "{$row['codigo']}" . '"';
		$nombre1 = '"' . "{$row['nombre']}" . '"';
		$apellido1 = '"' . "{$row['apellido']}" . '"';
		$tablaDetalle .= "<tr><td>{$row['id']}</td><td>{$row['codigo']}</td><td>{$row['nombre']}</td><td>{$row['apellido']}</td><td><a href='procesar_usuarios_gus.php?id={$row['id']}&ope=upd'>editar</a><a href='#' onClick='confirmar({$row['id']},{$codigo1},{$nombre1},{$apellido1})'> eliminar</a></td><tr>";
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
	
	
?>

<!DOCTYPE html>
<html>
  <head>
     <meta charset="UTF-8">
     <title>CRUD</title>
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	 <link rel="stylesheet" href="custom.css">
    </head>
	<body>
		<div class="container card  col-sm-6">
			<div class="card-header">
				<h2>ABM USUARIOS</h2>
			</div>
			<div class="card-body">
				<form method="post" action="procesar_usuarios_gus.php">
					<div class="form-group">
						<small id="emailHelp" class="form-text text-danger"><?php echo $msg; ?></small>
					</div>
					<div class="form-group">
						<input type="number" name="id" readOnly="true" value="<?php echo $id; ?>" class="form-control" placeholder="Id">
					</div>
					  
					  <div class="form-group">
						  <input type="string" name="codigo" value="<?php echo $codigo; ?>" <?php echo $opeaux=='mod' ? 'readOnly' : ''?> class="form-control" placeholder="Codigo">
						  <input type="hidden" name="opeaux" value="<?php echo $opeaux; ?>">
					  </div>
					  
					  <div class="form-group"> 
						  <input type="string" name="nombre" value="<?php echo $nombre; ?>" class="form-control" placeholder="Nombre">
					  </div>
					  
					  <div class="form-group"> 
						  <input type="string" name="apellido" value="<?php echo $apellido; ?>" class="form-control" placeholder="Apellido">
					  </div>
					  <div class="form-group text-center">
						
						  <input type="submit" value="GUARDAR" class="btn btn-primary col-sm-3">
						
						  <input type="submit" name = "limpiar" class="btn btn-success col-sm-3" value="LIMPIAR">
						
					  </div>
					
				</form>
			</div>
			<?php echo $tabla; ?>
		</div>
	</body>
</html>
<script>
	function confirmar(id, cod, nombre, apellido)
	{
		res = confirm("Esta seguro de eliminar el id: " + id + " - " + cod + " - " + nombre + " - " + apellido);
		if (res)
		{
			window.location.href = "procesar_usuarios_gus.php?id=" + id + "&codigo=" + cod + "&nombre=" + nombre + cod + "&apellido=" + apellido + "&ope=del&opeaux=del";
		}
	}
</script>