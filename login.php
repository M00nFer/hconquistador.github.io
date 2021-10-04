<?php
session_start();
if (isset($_SESSION["user"])) {
  header("location:index.php");
}
//abrimos el archivo fechas.txt
$fh = fopen('fechas.txt', 'a');
fclose($fh);
//se destruye el archivo fechas.txt
unlink('fechas.txt');
//se declara el archivo de fechas.txt
$nombre_archivo = "fechas.txt";
//se reviza si el archivo existe
if(file_exists($nombre_archivo))
{
  $mensaje = "El Archivo $nombre_archivo se ha modificado";
}
else
  {
    $mensaje = "El Archivo $nombre_archivo se ha creado";
  }
  //se obtiene el dia de hoy para marcar el inicio de las fechas
  $fecha = date("Y-m-j");
  //se deja la fecha de hoy en medio para visualizar los dias de habitaciones cubiertas 
  $fecha = strtotime ( '-7 day' , strtotime ( $fecha ) ) ;//suma de un dia por fehca
  $fecha = date ( 'Y-m-j' , $fecha );
  $fecha .= "\n";// se agrega un salto de linea en el primer registro
  if($archivo = fopen($nombre_archivo, "a"))
  {
    for ($i=0; $i < 16; $i++) {
      if(!fwrite($archivo, $fecha))
      {
        echo "Ha habido un problema al crear el archivo";
      }
      $fecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;//suma de un dia por fehca
      $fecha = date ( 'Y-m-j' , $fecha );
      $fecha .= "\n"; 
    }
    fclose($archivo);
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <script src="js/jquery-1.12.3.min.js" charset="utf-8"></script>
    <script src="bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

 <script type="text/javascript" src="js/script.js"></script>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
 <link rel="stylesheet" href="css/bootstrap.min.css">
 <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
 <script src="js/bootstrap.min.js"></script>
  </head>
  <body style="background-color:#ffff99;">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3" style="background-color:#ccffcc;">
          <form method="post">
            <br><br>
            <h1><p class="text-center">Inicio de sesion</p></h1>
            <br><br>
            <div class="form-group">
              <label for="user">Usuario</label>
              <input type="text" name="user" id="user" class="form-control">
            </div>
            <div class="form-group">
              <label for="pass">Contraseña</label>
              <input type="password" name="pass" id="pass" class="form-control">
            </div>
            <br><br>
            <div class="form-group">
              <input type="button" name="login" id="login" value="Login" class="btn btn-success">
            </div>
            <br>
            <span id="result"></span>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>

<script>
  $(document).ready(function() {
    $('#login').click(function(){
      var user = $('#user').val();
      var pass = $('#pass').val();
      if($.trim(user).length > 0 && $.trim(pass).length > 0){
        $.ajax({
          url:"logueame.php",
          method:"POST",
          data:{user:user, pass:pass},
          cache:"false",
          beforeSend:function() {
            $('#login').val("Conectando...");
          },
          success:function(data) {
            $('#login').val("Login");
            if (data=="1") {
              $(location).attr('href','index.php');
            } else {
              $("#result").html("<div class='alert alert-dismissible alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>¡Error!</strong> las credenciales son incorrectas.</div>");
            }
          }
        });
      };
    });
  });
</script>
