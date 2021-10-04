<?php
// include Database connection file
include("../db_connection.php");

// check request
if(isset($_POST))
{
    // get values
    $id = $_POST['id'];
	$nombre=$_POST['nombre'];
	$apellidos=$_POST['apellidos'];
    $sexo=$_POST['sexo'];
    $email=$_POST['email'];
    $fecha_n=$_POST['fecha_n'];


    // Updaste User details
    $query = "UPDATE huesped SET nombre='$nombre', apellidos='$apellidos', sexo = '$sexo', email='$email', fecha_n = '$fecha_n' WHERE id = '$id'";
    if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }
}