<!-- Content Section Huesped--> 
      <!-- crud jquery-->
      <div class="da">
        <div class="row">
          <div class="col-md-12">
            <div class="pull-right">
              <button class="btn btn-success" data-toggle="modal" data-target="#add_new_hues_modal">Reservacion</button>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
            <div id="records_content_reserva"></div>
          </div>
        </div>
      </div>
      <!-- /Content Section --> 

      <!-- Bootstrap Modals --> 
      <!-- Modal - Add New Huesped -->
      <div class="modal fade" id="add_new_hues_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
         
            <div class="modal-header">
              <h5 class="modal-title">Reservacion</h5>
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
              
              <div class="form-check-inline">
                <label class="form-check-label" for="radio2">
                  <input type="radio" class="form-check-input" id="sexo" name="optradio" value="1">M
                </label>
              </div>
              <div class="form-check-inline">
                <label class="form-check-label" for="radio2">
                  <input type="radio" class="form-check-input" id="sexo" name="optradio" value="2">F
                </label>
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
              <button type="button" class="btn btn-primary" onclick="addHuesped()">Agregar</button>
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