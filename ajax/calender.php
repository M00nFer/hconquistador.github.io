<?php
//Variables de uso global
$enviar = "";
$nDias = 0;
session_start();

	// include Database connection file 
	include("db_connection.php");
	// calcular el numero de dias de la reserva
	function dias_Reservados($num_habi, $fecha_inn)
	{
		include("db_connection.php");
		$fecha_salida = "";
		$fecha_entrada = $fecha_inn;
		$diasReservados = "";
		$query = "SELECT * FROM reservaciones where num_habi = '$num_habi' and entrada = '$fecha_inn'";

		if (!$result = mysqli_query($con, $query)) {
	        exit(mysqli_error($con));
	    }

	    // if query results contains rows then featch those rows 
	    if(mysqli_num_rows($result) > 0)
	    {
	    	while($row = mysqli_fetch_assoc($result))
    		{
    			$fecha_salida = $row['salida'];
    		}
		}
		$fecha_entrada = str_replace("-", "/", $fecha_entrada);
		$fecha_salida = str_replace("-", "/", $fecha_salida);
		$diasReservados = (strtotime($fecha_entrada)-strtotime($fecha_salida))/86400;
		$diasReservados = abs($diasReservados); $diasReservados = floor($diasReservados);
		return $diasReservados;
	}

  // obener la fecha de salida
  function fechaSalida($num_habi, $fecha_inn)
  {
    include("db_connection.php");
    $fecha_salida = "";
    $fecha_entrada = $fecha_inn;
    $diasReservados = "";
    $query = "SELECT salida FROM reservaciones where num_habi = '$num_habi' and entrada = '$fecha_inn'";

    if (!$result = mysqli_query($con, $query)) {
          exit(mysqli_error($con));
      }

      // if query results contains rows then featch those rows 
      if(mysqli_num_rows($result) > 0)
      {
        while($row = mysqli_fetch_assoc($result))
        {
          $fecha_salida = $row['salida'];
        }
    }
    //quitamos los - por / para las operaciones con fechas en php
    //$fecha_salida = str_replace("-", "/", $fecha_salida);
    return $fecha_salida;
  }

	//Verificar la fecha de reservacion y obtener un falso o verdadero
	function VerificarRes($num_habi, $fecha_inn)
	{
		include("db_connection.php");
		$query = "SELECT * FROM reservaciones where num_habi = '$num_habi' and entrada = '$fecha_inn'";

		if (!$result = mysqli_query($con, $query)) {
	        exit(mysqli_error($con));
	    }

	    // if query results contains rows then featch those rows 
	    if(mysqli_num_rows($result) > 0)
	    {
	    	return true;
		}
	}

  //Verificar la fecha de reservacion y obtener un falso o verdadero
  function VerificarSal($num_habi, $fecha_inn)
  {
    include("db_connection.php");
    $query = "SELECT salida FROM reservaciones where num_habi = '$num_habi' and entrada = '$fecha_inn'";

    if (!$result = mysqli_query($con, $query)) {
          exit(mysqli_error($con));
      }

      // if query results contains rows then featch those rows 
      if(mysqli_num_rows($result) > 0)
      {
        return true;
    }
  }

  //Obtener el id de la reserva
  function añoCalender()
  {
    //nombre para mostrar las reservas
    $yearRes = ""; 
    $archivo = fopen('../fechas.txt','r');
    while ($linea = fgets($archivo)) {
      $porciones = explode("-", $linea);
      $yearRes = $porciones[0];
    }
    fclose($archivo);
    return $yearRes;
  }

  //Obtener el id de la reserva
  function fechaDeHoy($linea)
  {
    $hoy = date("Y-m-d");
    $hoy = strtotime($hoy);
    $linea = strtotime($linea);
    $colorido = " bgcolor='yellow' ";
    $colorido2 = " bgcolor='#FFF7E5' ";
    if ($hoy == $linea) {
      return $colorido;
    }else{
      return $colorido2;
    }
  }

	function nombreReserva($num_habi, $fecha_inn)
	{
		//nombre para mostrar las reservas
		$nombre_reserva = "";	
		include("db_connection.php");
		$query = "SELECT * FROM reservaciones where num_habi = '$num_habi' and entrada = '$fecha_inn'";

		if (!$result = mysqli_query($con, $query)) {
	        exit(mysqli_error($con));
	    }

	    // if query results contains rows then featch those rows 
	    if(mysqli_num_rows($result) > 0)
	    {
	    	while($row = mysqli_fetch_assoc($result))
    		{
    			$nombre_reserva = $row['nombre_hues'];
    		}
		}
		return $nombre_reserva;
	}

  //Obtener estado de la reserva
  function verificarEstado($num_habi, $fecha_inn)
  {
    $estado = 0;
    $color = 0;
    include("db_connection.php");
    $query = "SELECT estado FROM reservaciones where num_habi = '$num_habi' and entrada = '$fecha_inn'";

    if (!$result = mysqli_query($con, $query)) {
          exit(mysqli_error($con));
      }

      if(mysqli_num_rows($result) > 0)
      {
        while($row = mysqli_fetch_assoc($result))
        {
          $estado = $row['estado'];
        }
      }

      if ($estado != 1) {
        $color = "success";
      }else{
        $color = "primary";
      }

      return $color;
  }

    //variables globales para la fecha
  $dia = $_SESSION['dia_vista'];
  $mes = $_SESSION['mes_vista'];
  $year = $_SESSION['year_vista'];
	$desemana= ["D","L","M", "MI","J","V", "S"];
  $fecha_vista =[];
	$hoy = "";
  $file = fopen("../fechas.txt", "r") or exit("Unable to open file!");
  

  //echo $_SESSION["dia_vista"]."/".$_SESSION["mes_vista"]."/".$_SESSION["year_vista"];
  //creamos la vista del calendario
	echo "<div class='text-center'>
        <table class='table table-sm'>";
	echo "<thead>";
	echo "<th colspan=16>".añoCalender()." </th>";
	echo "</thead>";
	echo "<tr>";
	echo "<th>Hab</th>";
  //Output a line of the file until the end is reached
  // while(!feof($file))
  // {
  // echo "<td>".fgets($file). "</td>";
  // $fecha_vista[$colum] = fgets($file);
  // echo "col-".$colum;
  // $colum++;

  // }
  // fclose($file);
  //echo count($fecha_vista);

  $archivo = fopen('../fechas.txt','r');
  while ($linea = fgets($archivo)) {
    $fecha_vista[] = $linea;
    $porciones = explode("-", $linea);
    $lineas = $porciones[0]."-".$porciones[1]."-".$porciones[2];
    echo "<th".fechaDeHoy($lineas).">".$porciones[1]."<br>".$porciones[2]."<br>".$desemana[date("w",strtotime($linea))]."</th>";

  }
  fclose($archivo);


  // echo '<pre>';
  // print_r($fecha_vista);
  // echo '</pre>';
 //  for ($i=1; $i <= 15; $i++) { 
	// 	if ($diade > 6) {
	// 		$diade = 0;
	// 	}
	// 	echo "<td>";
	// 	if ($dia == 31) {
	// 		$dia = 1;
	// 		$mes++;
	// 	}
 //    $fecha_vista[$i]= $year."-".$mes."-".$dia;

	// 	echo $dia."<br>".$mes."<br>".$desemana[$diade];
	// 	echo "</td>";
	// 	$dia++;
	// 	$diade++;
	// }
	// $dia = date("d");
	echo "</tr>";
	$query = "SELECT * FROM habitacion";

	if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }

    // if query results contains rows then featch those rows 
    if(mysqli_num_rows($result) > 0)
    {
    	while($row = mysqli_fetch_assoc($result))
    	{
        echo "<tr>";
  			echo "<th style='color:#456789;font-size:60%;'>".$row['num']."<br>".$row['tipo']."</th>";
  			$cmes = date("m");
        //$count = 0;
        $fechaSal = ""; //fecha de salida en fecha de inicio
        $fechaEn = ""; //fecha de salida en fecha de inicio
  			for ($i=0; $i <= 15; $i++) {
  				
  				// if ($dia == 31) {
  				// 	$dia = 1;
  				// 	$cmes = $cmes + 1;
  				// }

  				$hoy = $fecha_vista[$i];
          // dividimos la fecha de $hoy 
          $porciones = explode("-", $hoy);
          //enviar se quedara con la ultma fecha del recorrido
          $enviar = $hoy;
  				$reserva = "";
  				
  				if (!VerificarRes($row['num'],$hoy)){
            if ($nDias > 0) {
              $reserva = " ";
              $nDias--;
            }else{
              if ($hoy < date("Y-m-d")) {
                $reserva = "<td> </td>";
              }else{
                $reserva = "<td".fechaDeHoy($hoy)."><button type='button' class='btn btn-block btn-sm' id='btnnewres' onclick='addReservacionFecha(".$row['num'].",".$porciones[0].",".$porciones[1].",".$porciones[2].",".$row['precio'].")'> &nbsp</button></td>";
              }
              

            }
            
            // $fechaEn = strtotime ( '-1 day' , strtotime ( $fechaEn ) ) ;
            // $fechaEn = date ( 'Y-m-j' , $fechaEn );
            // $dteStart = new DateTime($fechaEn);
            // $dteEnd   = new DateTime($fechaSal);

            // $dtToday = new DateTime($hoy);
            // // //verificamos que fecha no esta dentro de la reserva

            // if ($dtToday <= $dteEnd) 
            //   $reserva = " ";
            // else{
            //   $reserva = "<td><button type='button' class='btn btn-default bg-info  btn-block' id='reservarFecha' onclick='addReservacionFecha(".$row['num'].",".$porciones[0].",".$porciones[1].",".$porciones[2].",".$row['precio'].")'>-</button></td>";
            // }
  				}else{ 
            $fechaSal = fechaSalida($row['num'],$hoy);
            $fechaEn = $hoy;
            // if($hoy < $fechaSal){
            //   $reserva = "";
            // }else{
            $nDias = dias_Reservados($row['num'],$hoy);
            $nDias--;
            // $count = ($count - 1) + $nDias;
              $reserva = "<td ".fechaDeHoy($hoy)." colspan='".dias_Reservados($row['num'],$hoy)."'><button type='button' class='btn btn-".verificarEstado($row['num'],$hoy)." btn-block btn-sm' id='verReservacion' onclick='verReservacion(".$row['num'].",".$porciones[0].",".$porciones[1].",".$porciones[2].")'><i class='fas fa-address-card'></i></button></td>";
  				}

  				echo $reserva;
  			}
  			//$dia = date("d");
  			echo "</tr>";

      	}
      }
    //   $nuevafecha = $enviar;
    //   for ($i=0; $i < 14 ; $i++) { 
    // $nuevafecha = strtotime ( '+1 day' , strtotime ( $nuevafecha ) ) ;
    // $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
    // echo ">>".$nuevafecha."\n";
  //}
 ?>

 <div class="row">
   <div class="col">
     <button type="button" class="btn btn-default  btn-block" onclick="DiasPorVer(
        <?php
          $porciones = explode("-", $enviar);
          echo $porciones[0].",".$porciones[1].",".$porciones[2]; 
          ?>
       )">
          <i class="fas fa-chevron-left"></i>
        </button>
   </div>
    <div class="col">
     <button type="button" class="btn btn-default  btn-block" onclick="SetDias(
        <?php
          echo date("Y").",".date("m").",".date("d"); 
          ?>
       )">
         HOY
        </button>
   </div>
   <div class="col">
     <button type="button" class="btn btn-default  btn-block" onclick="DiasVistos(
        <?php
          $porciones = explode("-", $enviar);
          echo $porciones[0].",".$porciones[1].",".$porciones[2]; 
          ?>
       )">
          <i class="fas fa-chevron-right"></i>
        </button>
   </div>
 </div>
 </table>
</div>

 <!-- Modal - Add New Habitacion -->
      <div class="modal fade" id="ver_res_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
         
            <div class="modal-header">
              <h5 class="modal-title">Reservacion a nombre de</h5><br>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" style="color:#456789;font-size:70%;">
              
              <div class="row">
                <div class="col"><label id="nombre_de"></label></div>
                <div class="col">
                  <div class="form-group">
                    <label for="Cod ALumno">ID:</label>
                    <input type="text" id="ver_id" value=""    disabled/>
                  </div>
                </div>
             
                <div class="col">
                  <div class="form-group">
                    <label for="Cod ALumno">Habitacion</label>
                    <input type="text" id="ver_num" value=""    disabled/>
                  </div>
                </div>
              </div>
                 <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="CodMatri">Entrada</label>
                    <input type="text" id="ver_entrada"  value="" disabled/>
                  </div>
                </div>

                <div class="col">
                  <div class="form-group">
                    <label for="CodMatri">Salida</label>
                    <input type="text" id="ver_salida"  value=""/>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                    <div class="form-group">
                      <input type="text" id="ver_pago"  value="" disabled/><br>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <input type="text" id="ver_observaciones"  value="" placeholder="Observaciones" disabled/><br>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                    reservado por:<input type="text" id="ver_admin" value=""   class="form-control-sm" disabled/>
                  </div>
                </div>
                  </div>
                </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="EliminarReservacion()">Eliminar</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- // Modal --> 
      <!-- Modal - Add New Reservacion -->
      <div class="modal fade" id="add_res_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
         
            <div class="modal-header">
              <h5 class="modal-title">Reservacion</h5>

              <small class="modal-title">                --  <?php echo $_SESSION['user']; ?></small>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">

            	<div class="form-group">
              Habitacion:
                <label for="CodMatri" id="c_num_habi" >
                </label>
              </div>              
                <div class="container">
                  <div class="row">
                    <div class="col">
                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                          +
                        </a>
                        <div class="collapse" id="collapseExample">
                          <div class="card card-body">
                            <h5>Agregar Huesped</h5>
                            <div class="form-group">
                              <label for="Nombre Huesped">Nombre:</label>
                              <input type="text" id="nvo_nombre" value=""   class="form-control"/>
                            </div>
                            <div class="form-group">
                              <label for="Apellidos">Apellidos</label>
                              <input type="text" id="nvo_apellidos" class="form-control" value=""/>
                            </div>
                            <div class="form-group">
                              <label for="telefono">telefono</label>
                              <input type="text" id="nvo_telefono" class="form-control" value=""/>
                            </div>
                          </div>
                        </div>
                </div>
                    <div class="col">
                      <label for="Apellidos">Huesped:</label>
                      <select class="form-control-sm" id="c_nom_hues">
                      </select>
                    </div>
                  </div>
                </div>
              <div class="container">
                <div class="row">
                  <div class="col">
                      <label for="fecha_n">Entrada</label>
                      <form class="form-inline" class="col">
                        <div class="form-row align-items-center">
                          <label id="c_dia_inn">
                          </label>
                          /
                          <label  id="c_mes_inn">
                          </label>
                          /
                          <label  id="c_ano_inn">
                          </label>
                        </div>
                      </form>
                  </div>
                  <div class="col">
                    <label for="fecha_n">Salida</label><br>
                    <select class="form-control-sm-2" id="c_dia_out">
                      <option >Dia</option>
                      <?php 
                      $numero = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));  
                      for ($i=1; $i <=$numero ; $i++) { 
                        if ($i == (date("d") + 1)) {
                          echo "<option selected>".$i."</option>";
                        }else{
                          echo "<option>".$i."</option>";
                        }
                      } ?>
                    </select>
                    <select class="form-control-sm-2" id="c_mes_out">
                      <option >Mes</option>
                      <?php for ($i=1; $i <=12 ; $i++) { 
                        if ($i == $mes) {
                          echo "<option selected>".$i."</option>";
                        }else{
                          echo "<option>".$i."</option>";
                        }
                      } ?>
                    </select>
                    <select class="form-control-sm-2" id="c_ano_out">
                      <option >Año</option>
                      <?php for ($i = date("o"); $i <=2025 ; $i++) { 
                        if ($i == date("o")) {
                          echo "<option selected>".$i."</option>";
                        }else{
                          echo "<option>".$i."</option>";
                        }
                      } ?>
                    </select>
                  </div>
                </div>
              </div>
              <!-- <div class="container">
                  <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label for="update_numhabi" >Total:</label>
                          <button id="men_personas" class="btn-default" onclick="menPersona()">-</button><br>
                          <input type="text" id="c_personex" value="" class="form-control-sm-2"/>
                          <button id="mas_personas" class="btn-default" onclick="masPersona()">+</button>
                        </div>
                      </div>
                      <div class="col">
                        
                        <div class="form-group">
                          <label for="update_numhabi" >Total:</label>
                          <input type="text" id="c_precio_habi" value="" class="form-control-sm"/>
                        </div>
                      </div> 
                      <div class="form-check">
                        <input type="checkbox" id="c_control_1" class="form-check-input">Control Remoto
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" id="c_control_2" class="form-check-input">control Aire
                      </label>
                    </div>
                    </div> -->
                    <div class="form-group">
                        <label for="update_numhabi">observaciones</label>
                        <input type="text" id="c_observaciones" value="" class="form-control"/>
                      </div>
                  </div>
                  <div class="container">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">*</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">Abonar</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2">Liquidar</a>
                  </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                  <div id="home" class="container tab-pane active"><br>
                    <button type="button" class="btn btn-primary" onclick="addReserCalender(1)">Reservar</button>
                  </div>
                  <div id="menu1" class="container tab-pane fade"><br>
                    <h3>Menu 1</h3>
                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                  </div>
                  <div id="menu2" class="container tab-pane fade"><br>
                    <div class="row">
                     <!-- Columna de botones incrementales -->
                        <div class="col">
                          <div class="col"><label for="update_numhabi">Personas Extras:</label></div>
                            <div class="row">
                              
                              <div class="col"><button id="men_personas" class="btn" onclick="menPersona()">-</button>
                              </div>
                              <div class="col"><input type="text" id="c_personex" value="" class="form-control">
                              </div>
                              <div class="col"><button id="mas_personas" class="btn" onclick="masPersona()">+</button>
                              </div>
                            </div>
                          </div>
                        <!-- Columna de ratio buttons -->
                        <div class="col">
                          <div class="form-group">
                            <label for="update_numhabi" >Total:</label>
                            <input type="text" id="c_precio_habi" value="" class="form-control">
                          </div>
                          <div class="form-check">
                              <input type="checkbox" id="c_control_1" class="form-check-input">Control TV
                          </div>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="checkbox" id="c_control_2" class="form-check-input">Control Aire
                            </label>
                        </div> 
                        
                      </div>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="addReserCalender(2)">Reservar</button>
                  </div>
                </div>
              </div>
              
              <input type="hidden" id="c_recepcionista" value=<?php echo '"'.$_SESSION["user"].'"';?>>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </div>
      </div>
      
      