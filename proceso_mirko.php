	<?php
	$nombre = $_GET['nombre'];
	$apellido = $_GET['apellido'];
	$edad = $_GET['edad'];
	$ci = $_GET['ci'];

	
	echo "<h2>INFORMAIÓN DEL FORMULARIOEl</h2>";
 	echo "<br/><br/>";
        echo "Nombre es: ". $nombre;
	echo"<br/>";
        echo "El Apellido es: ". $apellido;
	echo"<br/>";
        echo "La Edad es: ". $edad;
	echo"<br/>";
        echo "El CI es: ". $ci;
	echo"<br/>";
        
?>