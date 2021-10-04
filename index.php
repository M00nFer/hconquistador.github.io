<?php 
session_start();
if(!isset($_SESSION["user"])){
  header("location:login.php");
}

 ?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>CONTROL HC</title>

<!-- Bootstrap core CSS -->
<link href="dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="assets/sticky-footer-navbar.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
<link rel="stylesheet" href="css/font-awesome.min.css">
<!-- Latest compiled and minified CSS -->
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<!-- Custom CSS 
    <link href="css/main.css" rel="stylesheet">
 Scroll Menu 
    <link href="css/sweetalert.css" rel="stylesheet">
Custom functions file 
    <script src="js/functions.js"></script>
   
    <script src="js/sweetalert.min.js"></script> Sweet Alert Script -->

    
</head>

<body>
<header> 
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark"> <a class="navbar-brand" href="#">HC</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active"> <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a> </li>
        
      </ul>
      <form class="form-inline mt-2 mt-md-0">
        <div class="btn-group dropleft">
          <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php 
            echo $_SESSION["user"];
             ?>
          </a>

          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="#">Corte de turno</a>
            <a class="dropdown-item" href="logout.php">Cerrar Sesion</a>
          </div>
        </div>
      </form>
    </div>
  </nav>
</header>

<!-- Begin page content -->

<div class="container">
  <div class="row">
    <div class="col-sm">
      <h3 class="mt-5">Hotel Conquistador</h3>
    </div>
    <div class="col-sm">
    </div>
    <div class="col-sm">
    </div>
    <div class="col-sm">
      <h6 class="mt-5"><?php $Fecha = date("F j  Y"); echo $Fecha; ?></h6><br>
      <div class="clock">
                <span id="hours" class="hours"></span> :
                <span id="minutes" class="minutes"></span> :
                <span id="seconds" class="seconds"></span>
            </div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-12 col-md-12"> 
      <!-- Contenido -->
      
      
      
<!-- Nav pills -->
  <ul class="nav nav-pills" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="pill" href="#inicio">Inicio</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#habi">Habitaciones</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#hues">Huespedes</a>
    </li>
    <?php 
    if ($_SESSION["user"] == 'admin') {
       ?>
       <li class="nav-item">
          <a class="nav-link" data-toggle="pill" href="#hues">Administrar</a>
        </li>
    <?php      } ?>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#rese" onclick="readResHabi(); readResHues()">Reservaciones</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="inicio" class="container tab-pane active"><br>
      <div class="row">
          <div class="col-md-12">     
            <div id="records_calender"></div>
          </div>
          
        </div>
    </div>
    <div id="habi" class="container tab-pane fade"><br>
      <!-- Content Section --> 
      <!-- crud jquery-->
      <div class="da">
        <div class="row">
          <div class="col-md-12">
            <div class="pull-right">
              <button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Agregar habitacion</button>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
            <div id="records_content"></div>
          </div>
        </div>
      </div>
      <!-- /Content Section --> 

      <!-- Bootstrap Modals --> 
      <!-- Modal - Add New Habitacion -->
      <div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
         
            <div class="modal-header">
              <h5 class="modal-title">Agregar habitacion</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            
            
            <div class="modal-body">
              <div class="form-group">
                <label for="Cod ALumno">Num de Habitacion</label>
                <input type="text" id="numhabi" value=""   class="form-control"/>
              </div>
              <div class="form-group">
                <label for="CodMatri">Precio</label>
                <input type="text" id="prehabi" class="form-control" value=""/>
              </div>
              <div class="form-group">
                <label for="CodMatri">Tipo</label>
                <select id="tipohabi" class="form-control">
                  <option value="Sencilla">Sencilla</option>
                  <option value="Doble">Doble</option>
                  <option value="Junior">Junior</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" onclick="addRecord()">Agregar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- // Modal --> 

      <!-- Modal - Update habitacion details -->
      <div class="modal fade" id="update_habi_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
         
            <div class="modal-header">
              <h5 class="modal-title">Actualizar</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> 
            
            
            <div class="modal-body">
              <div class="form-group">
                <label for="update_numhabi">Numero de Habitacion</label>
                <input type="text" id="update_numhabi" value="" class="form-control"/>
              </div>
              <div class="form-group">
                <label for="update_prehabi">Precio</label>
                <input type="text" id="update_prehabi" placeholder="Last Name" class="form-control"/>
              </div>
              <div class="form-group">
                <label for="update_tipohabi">Tipo</label>
                <input type="text" id="update_tipohabi" placeholder="Last Name" class="form-control"/>
                
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" onclick="UpdateUserDetails()" >Guardar Cambios</button>
              <input type="hidden" id="hidden_habi_id">
            </div>
          </div>
        </div>
      </div>
      <!-- // Modal --> 
    </div>
    <div id="hues" class="container tab-pane fade"><br>
      <!-- Content Section Huesped--> 
      <!-- crud jquery-->
      <div class="da">
        <div class="row">
          <div class="col-md-12">
            <div class="pull-right">
              <button class="btn btn-success" data-toggle="modal" data-target="#add_new_hues_modal">Agregar Huesped</button>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
            <div id="records_content_hues"></div>
          </div>
        </div>
      </div>
      <!-- /Content Section --> 

      <!-- Bootstrap Modals --> 
      <!-- Modal - Add New Huesped -->
      <div class="modal fade" id="add_new_hues_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form id="formHuesped">
            <div class="modal-header">
              <h5 class="modal-title">Agregar Huesped</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            
            
            <div class="modal-body">
              <div class="form-group">
                <label for="Nombre Huesped">Nombre:</label>
                <input type="text" id="nombre" value=""   class="form-control"/>
              </div>
              <div class="form-group">
                <label for="Apellidos">Apellidos</label>
                <input type="text" id="apellidos" class="form-control" value=""/>
              </div>

              <div class="form-group">
                        <select class="form-control" id="sexo">
                          <option>Sexo</option>
                          <option>F</option>
                          <option>M</option>
                        </select>
              </div>

              <div class="form-group">
                <label for="correo">Correo Electronico</label>
                <input type="text" id="email" class="form-control" value=""/>
              </div>
              <div class="form-group">
                <label for="fecha_n">Fecha de Nacimiento</label>
                <select class="form-control" id="dia_in">
                  <option >Dia</option>
                  <?php for ($i=1; $i <=31 ; $i++) { 
                    echo "<option>".$i."</option>";
                  } ?>
                </select>
                <select class="form-control" id="mes_in">
                  <option >Mes</option>
                  <?php for ($i=1; $i <=12 ; $i++) { 
                    echo "<option>".$i."</option>";
                  } ?>
                </select>
                <select class="form-control" id="ano_in">
                  <option >Año</option>
                  <?php for ($i=1940; $i <=2019 ; $i++) { 
                    echo "<option>".$i."</option>";
                  } ?>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" id="btHuesped" onclick="addHuesped()">Agregar</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- // Modal --> 

      <!-- Modal - Update Huesped details -->
      <div class="modal fade" id="update_hues_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
         
            <div class="modal-header">
              <h5 class="modal-title">Actualizar</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> 
            
            
            <div class="modal-body">
              <div class="form-group">
                <label for="update_numhabi">Nombre</label>
                <input type="text" id="update_nombre" value="" class="form-control"/>
              </div>
              <div class="form-group">
                <label for="update_prehabi">Apellidos</label>
                <input type="text" id="update_apellidos" placeholder="Last Name" class="form-control"/>
              </div>
              <div class="form-group">
                <label for="update_tipohabi">Sexo</label>
                <input type="text" id="update_sexo" placeholder="Last Name" class="form-control"/>
              </div>
              <div class="form-group">
                <label for="update_prehabi">Email</label>
                <input type="text" id="update_email" placeholder="Last Name" class="form-control"/>
              </div>
              <div class="form-group">
                <label for="update_tipohabi">Fecha de Nacimiento</label>
                <input type="text" id="update_fecha_n" placeholder="Last Name" class="form-control"/>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" onclick="UpdateHueDetails()" >Guardar Cambios</button>
              <input type="hidden" id="hidden_hues_id">
            </div>
          </div>
        </div>
      </div>
      <!-- // Modal --> 
    </div>
    <div id="rese" class="container tab-pane fade"><br>
      <!-- Content Section Huesped--> 
      <!-- crud jquery-->
      <div class="da">
        <div class="row">
          <div class="col-md-12">
            <div class="pull-right">
              <button class="btn btn-success" data-toggle="modal" data-target="#add_new_res_modal">Reservacion</button>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
            <div id="records_content_res"></div>
          </div>
        </div>
      </div>
      <!-- /Content Section --> 

      <!-- Bootstrap Modals --> 
      <!-- Modal - Add New Huesped -->
      <div class="modal fade" id="add_new_res_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
         
            <div class="modal-header">
              <h5 class="modal-title">Reservacion</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <form method="post" id="formprecio">
                <div class="form-group">
                  <label for="Nombre Huesped">Habitacion:</label>
                  <select class="form-control" id="num_habi">

                  </select>
                </div>
              </form>
              <div class="form-group">
                <label for="Apellidos">Huesped:</label>
                <select class="form-control" id="nom_hues">
                  
                </select>
              </div>
              
              <div class="content">
                <div class="form-group" class="col">
                  <label for="fecha_n">Entrada</label>
                  <div class="row">
                    <select class="form-control col" id="dia_inn">
                      <option >Dia</option>
                      <?php 
                      $hoy = date("d");
                      $mes = date("m");
                      $ano = date("Y");
                      for ($i=1; $i <=31 ; $i++) { 
                        if ($i == $hoy) {
                          echo "<option selected>".$i."</option>";
                        }else{
                          echo "<option>".$i."</option>";
                        }
                      } ?>
                    </select>
                    <select class="form-control col" id="mes_inn">
                      <option >Mes</option>
                      <?php for ($i=1; $i <=12 ; $i++) { 
                        if ($i == $mes) {
                          echo "<option selected>".$i."</option>";
                        }else{
                          echo "<option>".$i."</option>";
                        }
                      } ?>
                    </select>
                    <select class="form-control col" id="ano_inn">
                      <option >Año</option>
                      <?php for ($i=1940; $i <=2019 ; $i++) { 
                        if ($i == $ano) {
                          echo "<option selected>".$i."</option>";
                        }else{
                          echo "<option>".$i."</option>";
                        }
                      } ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group" class="col">
                  <label for="fecha_n">Salida</label>
                  <div class="row">
                    <select class="form-control col" id="dia_out">
                      <option >Dia</option>
                      <?php for ($i=1; $i <=31 ; $i++) { 
                        if ($i == ($hoy + 1)) {
                          echo "<option selected>".$i."</option>";
                        }else{
                          echo "<option>".$i."</option>";
                        }
                      } ?>
                    </select>
                    <select class="form-control col" id="mes_out">
                      <option >Mes</option>
                      <?php for ($i=1; $i <=12 ; $i++) { 
                        if ($i == $mes) {
                          echo "<option selected>".$i."</option>";
                        }else{
                          echo "<option>".$i."</option>";
                        }
                      } ?>
                    </select>
                    <select class="form-control col" id="ano_out">
                      <option >Año</option>
                      <?php for ($i=1940; $i <=2019 ; $i++) { 
                        if ($i == $ano) {
                          echo "<option selected>".$i."</option>";
                        }else{
                          echo "<option>".$i."</option>";
                        }
                      } ?>
                    </select>
                  </div>
                </div>

                <div class="container">
                   
                    <form>
                      <div class="form-group">
                        <label >Personas Extra</label>
                        <select class="form-control" id="personex">
                          <option>0</option>
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                        </select>
                      </div>
                      
                      <input type="hidden" id="recepcionista" value=<?php 
      echo '"'.$_SESSION["user"].'"';
       ?>>

                      <div class="form-group">
                        <label for="update_numhabi" >Precio</label>
                        <input type="text" id="precio_habi" value="" class="form-control"/>
                      </div>

                    <div class="form-check">
                        <input type="checkbox" id="control_1" class="form-check-input">Control Remoto
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" id="control_2" class="form-check-input">control Aire
                      </label>
                    </div>
                    <div class="form-group">
                        <label for="update_numhabi">observaciones</label>
                        <input type="text" id="observaciones" value="" class="form-control"/>
                      </div>
                    </form>
                  </div>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" onclick="addReservacion()">Agregar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- // Modal --> 

      <!-- Modal - Update Huesped details -->
      <div class="modal fade" id="update_hues_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
         
            <div class="modal-header">
              <h5 class="modal-title">Actualizar</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> 
            
            
            <div class="modal-body">
              <div class="form-group">
                <label for="update_numhabi">Nombre</label>
                <input type="text" id="update_nombre" value="" class="form-control"/>
              </div>
              <div class="form-group">
                <label for="update_prehabi">Apellidos</label>
                <input type="text" id="update_apellidos" placeholder="Last Name" class="form-control"/>
              </div>
              <div class="form-group">
                <label for="update_tipohabi">Sexo</label>
                <input type="text" id="update_sexo" placeholder="Last Name" class="form-control"/>
              </div>
              <div class="form-group">
                <label for="update_prehabi">Email</label>
                <input type="text" id="update_email" placeholder="Last Name" class="form-control"/>
              </div>
              <div class="form-group">
                <label for="update_tipohabi">Fecha de Nacimiento</label>
                <input type="text" id="update_fecha_n" placeholder="Last Name" class="form-control"/>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" onclick="UpdateHueDetails()" >Guardar Cambios</button>
              <input type="hidden" id="hidden_hues_id">
            </div>
          </div>
        </div>
      </div>
      <!-- // Modal --> 
    </div>
    </div>
  </div>
</div>
<!-- Jquery JS file --> 
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script> 
<!-- Bootstrap JS file --> 
<!-- Custom JS file --> 
<script type="text/javascript" src="js/script.js"></script> 
<script type="text/javascript" src="js/huesped.js"></script> 
<script type="text/javascript" src="js/reservacion.js"></script> 
<script type="text/javascript" src="js/calender.js"></script>
<script type="text/javascript" src="js/moment.js"></script>

<script src="js/clock.js"></script>

<!-- Fin crud jquery-->



      <!-- Fin Contenido --> 
    </div>
  </div>
  <!-- Fin row --> 
  
</div>
<!-- Fin container -->
<footer class="footer">
  <div class="container"> <span class="text-muted">
    <p>Códigos <a href="https://www.baulphp.com/" target="_blank">BaulPHP</a></p>
    </span> </div>
</footer>

<!-- Bootstrap core JavaScript
    ================================================== --> 
<script src="dist/js/bootstrap.min.js"></script> 
<!-- libreria de reloj
    ================================================== --> 

<!-- Placed at the end of the document so the pages load faster -->

</body>
</html>