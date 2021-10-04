<?php
	if(isset($_POST['num_habi']) && isset($_POST['nom_hues']))
	{
		// include Database connection file 
		include("../db_connection.php");

		// get values 
		$num_habi = $_POST['num_habi'];
		$nom_hues = $_POST['nom_hues'];
		if (isset($_POST['nvo_nombre']) && ($_POST['nvo_nombre'] != "")) {
			$nvo_nombre 	= $_POST['nvo_nombre'];
			$nvo_apellidos 	= $_POST['nvo_apellidos'];
			$nvo_telefono 	= $_POST['nvo_telefono'];
			$nom_hues 		= $nvo_nombre.' '.$nvo_apellidos;
			$query = "INSERT INTO huesped (nombre, apellidos, telefono) values ('$nvo_nombre','$nvo_apellidos', '$nvo_telefono')";
			if (!$result = mysqli_query($con, $query)) {
		        exit(mysqli_error($con));
		    }
		    echo "1 Huesped Agregado!!!";
		}
		$dia_inn = $_POST['dia_inn'];
		$mes_inn = $_POST['mes_inn'];
		$ano_inn = $_POST['ano_inn'];
		$dia_out = $_POST['dia_out'];
		$mes_out = $_POST['mes_out'];
		$ano_out = $_POST['ano_out'];
		$precio_habi = $_POST['precio_habi'];
		$personex = $_POST['personex'];
		$control_1 = $_POST['control_1'];
		$control_2 = $_POST['control_2'];
		$estado = $_POST['estado'];
		$recepcionista = $_POST['recepcionista'];
		$observaciones = $_POST['observaciones'];


		$fecha_inn = $ano_inn."-".$mes_inn."-".$dia_inn;
		$fecha_out = $ano_out."-".$mes_out."-".$dia_out;

		$query = "INSERT INTO reservaciones (
		num_habi, 
		nombre_hues, 
		entrada, 
		salida,
		personas,
		precio_habi,
		control_1,
		control_2,
		estado,
		recepcionista,
		observaciones
	) VALUES(
	'$num_habi', 
	'$nom_hues', 
	'$fecha_inn',
	'$fecha_out',
	'$personex',
	'$precio_habi',
	'$control_1',
	'$control_2',
	'$estado',
	'$recepcionista',
	'$observaciones'
)";
		if (!$result = mysqli_query($con, $query)) {
	        exit(mysqli_error($con));
	    }
	    echo "1 Record Added!";
	}
?>