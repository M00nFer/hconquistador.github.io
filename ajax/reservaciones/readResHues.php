<?php
	// include Database connection file 
	include("../db_connection.php");

	// Design initial table header 

    $data = '<option value=0>--huesped--</option>';

	$query = "SELECT * FROM huesped";

	if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }

    // if query results contains rows then featch those rows 
    if(mysqli_num_rows($result) > 0)
    {
    	while($row = mysqli_fetch_assoc($result))
    	{
    		$data .= '<option value="'.$row['nombre'].' '.$row['apellidos'].'">'.$row['nombre'].' '.$row['apellidos'].'</option>';
    	}
    }
    else
    {
    	// records now found 
    	$data .= '<tr><td colspan="6">No hay registros!</td></tr>';
    }

    $data .= '</select>';

    echo $data;
?>