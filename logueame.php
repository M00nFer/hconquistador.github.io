<?php
session_start();
$connect = mysqli_connect("localhost","root","","hc");


if(isset($_POST["user"]) && isset($_POST["pass"])){
  $user = mysqli_real_escape_string($connect, $_POST["user"]);
  $pass = mysqli_real_escape_string($connect, $_POST["pass"]);
  $sql = "SELECT name FROM usuarios WHERE name='$user'  AND pass='$pass'";
  $result = mysqli_query($connect, $sql);
  $num_row = mysqli_num_rows($result);
  if ($num_row == "1") {
    $data = mysqli_fetch_array($result);
    $_SESSION["user"] = $data["name"];
    $_SESSION["dia_vista"] = date("d");
    $_SESSION["mes_vista"] = date("m");
    $_SESSION["year_vista"] = date("o");

    echo "1";
  } else {
    echo "error";
  }
} else {
  echo "error";
}

?>
