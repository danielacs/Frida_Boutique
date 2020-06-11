<?php
	$server = "localhost";
	$user = "root";
	$pass = "";
	$bd = "pasillodefrida";

	$conexion = @mysqli_connect($server,$user,$pass,$bd);

	if (!$conexion) {
		die('<strong>No pudo conectarse:</strong> '. mysqli_error());
	}
	else{
		
	}

?>



