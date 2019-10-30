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
	$tabla =  "<table border='1'> 
			<thead>
				<tr>
					<td>ID</td>
					<td>CODIGO</td>
					<td>NOMBRE</td>
					<td>APELLIDO</td>
					<td>ACCIONES</td>
				</tr>
			</thead>
			<tbody>
				{$tablaDetalle}
			</tbody>
		  </table>";
	
	
?>

<!DOCTYPE html>
<html>
  <head>
     <meta charset="UTF-8">
     <title>CRUD</title>
     <style>
        input {
        width: 250px;
        padding: 5px;
     }
     .redondeado {
       border-radius: 5px;
     }
     .confondo {
       background-color: #def;
     }
     .sinborde {
        border: 0;
     }
      .sinbordefondo {
       background-color: #eee;
       border: 0;
       size: "200";
     }
    .outlinenone {
    outline: none;
    background-color: #dfe;
    border: 0;
     }
  .redondeadonorelieve {
    border-radius: 5px;
    border: 1px solid #39c;
     }
    </style>
    </head>
	<body>
		<h2>ABM USUARIOS</h2>
		<form method="post" action="procesar_usuarios_gus.php">
		  <br>
		     <input type="text" name="mensaje" readOnly="true" class="sinbordefondo" value="<?php echo $msg; ?>" >
		  <br>
		  ID:<br>
		  <input type="number" name="id" readOnly="true" value="<?php echo $id; ?>">
		  <br>
		  
		  CODIGO USUARIO:<br>
		  <input type="string" name="codigo" value="<?php echo $codigo; ?>" <?php echo $opeaux=='mod' ? 'readOnly' : ''?>>
		  <input type="hidden" name="opeaux" value="<?php echo $opeaux; ?>">
		  <br>
		  		  
		  NOMBRE:<br>
		  <input type="string" name="nombre" value="<?php echo $nombre; ?>" >
		  <br>
		  
		  APELLIDO:<br>
		  <input type="string" name="apellido" value="<?php echo $apellido; ?>" >
		  <br>
		  
		  <input type="submit" value="GUARDAR">
		  <input type="submit" name = "limpiar" value="LIMPIAR">
		</form>
		<br>
		<br>
		<?php echo $tabla; ?>
		
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