<?php
// include Database connection file
include("db_connection.php");

// check request
if(isset($_POST))
{
    // get values
    $id = $_POST['id'];
	$numhabi=$_POST['numhabi'];
	$prehabi=$_POST['prehabi'];
   
    $tipohabi = $_POST['tipohabi'];


    // Updaste User details
    $query = "UPDATE habitacion SET num='$numhabi', precio='$prehabi', tipo = '$tipohabi' WHERE id = '$id'";
    if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }
}