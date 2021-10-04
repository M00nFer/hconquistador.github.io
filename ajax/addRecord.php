<?php
	if(isset($_POST['numhabi']) && isset($_POST['prehabi']) && isset($_POST['tipohabi']))
	{
		// include Database connection file 
		include("db_connection.php");

		// get values 
		$numhabi = $_POST['numhabi'];
		$prehabi = $_POST['prehabi'];
		$tipohabi = $_POST['tipohabi'];

		$query = "INSERT INTO habitacion(num, precio, tipo) VALUES('$numhabi', '$prehabi', '$tipohabi')";
		if (!$result = mysqli_query($con, $query)) {
	        exit(mysqli_error($con));
	    }
	    echo "1 Record Added!";
	}
?>