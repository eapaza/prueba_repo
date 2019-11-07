<?php
	require('../usuarios_gus.php');
	$res = insertar($_REQUEST['id'], $_REQUEST['codigo'], $_REQUEST['nombre'], $_REQUEST['apellido']);
	if ($res) {
		echo json_encode(['estado' => 0, 'mensaje' => "Insercion correcta"]);
	} else {
		echo json_encode(['estado' => 1, 'mensaje' => "Error insercion"]);
	}
?>