<?php
	require('funciones_bbdd_gus.php');
	$msg = '';
	$conn = getConexion();
	$id = '';
	$descripcion = '';
	$opeaux = '';
	
	// modo spagetti
/*	if (isset($_REQUEST['id'])) {
		if (isset($_REQUEST['ope'])){
			$stmt = $conn->query("SELECT * FROM prueba where id = {$_REQUEST['id']}");
			while( $row = mysqli_fetch_array( $stmt, MYSQLI_ASSOC) ) {
				$id = $row['id'];
				$descripcion = $row['descripcion'];
			}			
			$opeaux = 'mod';
		} else {
			if ($_REQUEST['opeaux'] == 'mod') {
				if (isset($_REQUEST['descripcion'])) {
					$stmt = $conn->query("update prueba set descripcion = '{$_REQUEST['descripcion']}' where id = {$_REQUEST['id']}");
					if ( !$stmt ) {
						$msg = 'Error en el update';
					}
				} else {
					$msg = 'Es necesario descripcion';
				}
			} else {
				if (isset($_REQUEST['descripcion'])) {
					$stmt = $conn->query("insert into prueba values ({$_REQUEST['id']}, '{$_REQUEST['descripcion']}')");
					if ( !$stmt ) {
						$msg = 'Error en el insert';
					}
				} else {
					$msg = 'Es necesario descripcion';
				}
			}
		}
	}
	
	$stmt = $conn->query("SELECT * FROM prueba");
	$tablaDetalle = '';
	while( $row = mysqli_fetch_array( $stmt, MYSQLI_ASSOC) ) {
		$tablaDetalle .= "<tr><td>{$row['id']}</td><td>{$row['descripcion']}</td><td><a href='procesar_bbdd?id={$row['id']}&ope=upd'>editar</a></td><tr>";
		//$tablaDetalle = $tablaDetalle . "<tr><td>{$row['id']}</td><td>{$row['descripcion']}</td><tr>";
	}
	$tabla =  "<table border='1'>
			<thead>
				<tr>
					<td>ID</td>
					<td>DESCRIPCION</td>
					<td>ACCIONES</td>
				</tr>
			</thead>
			<tbody>
				{$tablaDetalle}
			</tbody>
		  </table>";*/
	
	
	// modo optimo
	if (isset($_REQUEST['ope']))
	{
	   $datos = consultar("SELECT * FROM prueba WHERE id = {$_REQUEST['id']}");
	   foreach($datos as $row)
	   {
		  $id = $row['id'];
		  $descripcion = $row['descripcion'];
	   }			
	   $opeaux = 'mod';
    }
    		
	if (isset($_REQUEST['id'])) 
	{
		if ( $_REQUEST['descripcion'] != '' )
		{
	       $res_ins = insertar($_REQUEST['id'], $_REQUEST['descripcion']);
	       if (!$res_ins)
	          {
		         $msg = 'Error en el insert';
	          } 
	       else 
	          {
		         $msg = 'Insert correcto!!';
	          }
	    }      
	    else 
	    {
		   $msg = 'Es necesario ingresar la descripcion';
		}
    }	        
    else 
    {
	   $msg = 'Es necesario ingresar el Id';
	} 	
	
	
	$datos = consultar("SELECT * FROM prueba");
	$tablaDetalle = '';
	foreach($datos as $row){
		$tablaDetalle .= "<tr><td>{$row['id']}</td><td>{$row['descripcion']}</td><td><a href='procesar_bbdd_gus.php?id={$row['id']}&ope=upd'>editar</a><a href='procesar_bbdd_gus.php?id={$row['id']}&ope=del'> eliminar</a></td><tr>";
	}
	$tabla =  "<table border='1'> 
			<thead>
				<tr>
					<td>ID</td>
					<td>DESCRIPCION</td>
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
		<h2>ABM BASE DE DATOS</h2>
		<form method="post" action="procesar_bbdd_gus.php">
		  <br>
		     <input type="text" name="mensaje" readOnly="true" class="sinbordefondo" value="<?php echo $msg; ?>" >
		  <br>
		  ID:<br>
		  <input type="number" name="id" value="<?php echo $id; ?>" >
		  <br>
		  DESCRIPCION:<br>
		  <input type="string" name="descripcion" value="<?php echo $descripcion; ?>" >
		  <input type="string" name="opeaux" value="<?php echo $opeaux; ?>">
		  <br>
		  <input type="submit" value="GUARDAR">
		</form>
		<br>
		<br>
		<?php echo $tabla; ?>
		
	</body>
</html>