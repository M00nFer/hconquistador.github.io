<?php
	// include Database connection file 
	include("../db_connection.php");

	// Design initial table header 
	$data = '<table class="table table-bordered table-striped">
						<tr>
							<th>Num</th>
							<th>Nombre</th>
							<th>Entrada</th>
							<th>Salida</th>
							<th>Precio</th>
							<th>C. Aire</th>
							<th>C. Tv</th>
							<th>Recepcionista</th>
							<th>Observaciones</th>
							<th colspan=2></th>
						</tr>';

	$query = "SELECT * FROM reservaciones";

	if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }

    // if query results contains rows then featch those rows 
    if(mysqli_num_rows($result) > 0)
    {
    	while($row = mysqli_fetch_assoc($result))
    	{
    		
    		$data .= '<tr>
				<td>'.$row['num_habi'].'</td>
				<td>'.$row['nombre_hues'].'</td>
				<td>'.$row['entrada'].'</td>
				<td>'.$row['salida'].'</td>
				<td>'.$row['precio_habi'].'</td>
				<td>'.$row['control_1'].'</td>
				<td>'.$row['control_2'].'</td>
				<td>'.$row['recepcionista'].'</td>
				<td>'.$row['observaciones'].'</td>
				<td>
					<button onclick="GetResDetails('.$row['id'].')" class="btn btn-warning"><i class="fas fa-edit"></i></button>
				</td>
				<td>
					<button onclick="DeleteReservacion('.$row['id'].')" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
				</td>
    		</tr>';
    	}
    }
    else
    {
    	// records now found 
    	$data .= '<tr><td colspan="11">No hay registros!</td></tr>';
    }

    $data .= '</table>';

    echo $data;
?>