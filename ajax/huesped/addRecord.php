<?php
	if(isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['email']))
	{
		// include Database connection file 
		include("../db_connection.php");

		// get values 
		//04/10/2021 se elimino sexo y fecha de naciento estos resultan irrelevantes para el sistema
		$nombre = $_POST['nombre'];
		$apellidos = $_POST['apellidos'];
		$telefono = $_POST['telefono'];
		$email = $_POST['email'];
		$query = "INSERT INTO huesped (nombre, apellidos,telefono, email) VALUES('$nombre', '$apellidos', '$sexo', '$email', '$fecha_n')";
		if (!$result = mysqli_query($con, $query)) {
	        exit(mysqli_error($con));
	    }
	    echo "1 Record Added!";
	}
?>