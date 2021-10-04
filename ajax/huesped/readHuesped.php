<?php
	// include Database connection file 
	include("../db_connection.php");

	// Design initial table header 
	$data = '<table class="table table-bordered table-striped">
						<tr>
							<th>Nombre</th>
							<th>apellidos</th>
							<th>telefono</th>
							<th>email</th>
							<th></th>
							<th></th>
						</tr>';

	$query = "SELECT * FROM huesped";

	if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }

    // if query results contains rows then featch those rows 
    if(mysqli_num_rows($result) > 0)
    {
    	while($row = mysqli_fetch_assoc($result))
    	{
    		
    		$data .= '<tr>
				<td>'.$row['nombre'].'</td>
				<td>'.$row['apellidos'].'</td>
				<td>'.$row['telefono'].'</td>
				<td>'.$row['email'].'</td>
				<td>
					<button onclick="GetHueDetails('.$row['id'].')" class="btn btn-warning"><i class="fas fa-edit"></i></button>
				</td>
				<td>
					<button onclick="DeleteHuesped('.$row['id'].')" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
				</td>
    		</tr>';
    	}
    }
    else
    {
    	// records now found 
    	$data .= '<tr><td colspan="6">No hay registros!</td></tr>';
    }

    $data .= '</table>';

    echo $data;
?>