<form class="form-horizontal"  method="post">
  <!-- Modal -->
  <div id="remove-stock" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Eliminar Stock</h4>
        </div>
        <div class="modal-body">
          
            <div class="form-group">
              <label for="quantity" class="col-sm-2 control-label">Cantidad</label>
              <div class="col-sm-6">
                <input type="number" min="1" name="quantity_remove" class="form-control" id="quantity_remove" value="" placeholder="Cantidad" required="">
              </div>
            </div>
            <div class="form-group">
              <label for="reference_remove" class="col-sm-2 control-label">Referencia</label>
              <div class="col-sm-6">
                <input type="text" name="reference_remove" class="form-control" id="reference_remove" value="" placeholder="Referencia">
              </div>
            </div>
            
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary">Guardar datos</button>
        </div>
      </div>

    </div>
  </div>
</form>

<form class="form-horizontal"  method="post">
  <!-- Modal -->
  <div id="remove-product-stock" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Eliminar Stock</h4>
        </div>

        <?php //NAVES
        if (stripos($nombre_producto, "nave")  !== false) { ?>
          <div class="modal-body">          
              <div class="form-group">
                <label for="numserie" class="col-sm-2 control-label">Aeronave</label>
                <div class="col-sm-6">
                <select class='form-control' name='numserie' id='numserie' required>
                  <option value="">Selecciona una aeronave</option>
                    <?php 
                    $query_nave=mysqli_query($con,"select * from aeronaves where id_producto='".$id_producto."'");
                    while($rw=mysqli_fetch_array($query_nave)) {
                      ?>
                    <option value="<?php echo $rw['aero_id'];?>"><?php echo $rw['aero_serie'];?></option>      
                      <?php
                    }
                    ?>
                </select> 
                </div>
              </div>          
            <div class="form-group">
              <label for="reference_remove_nave" class="col-sm-2 control-label">Referencia</label>
              <div class="col-sm-6">
                <input type="text" name="reference_remove_nave" class="form-control" id="reference_remove_nave" value="" placeholder="Referencia">
              </div>
            </div>
        </div>
        <?php } //SIMULADOR
        else if (stripos($nombre_producto, "simulador")  !== false) { ?>
          <div class="modal-body">          
            <div class="form-group">
                <?php if (stripos($nombre_producto, "emisora")  !== false) { ?>
                <label for="nombre" class="col-sm-2 control-label">Emisora</label>
                <div class="col-sm-6">
                <select class='form-control' name='nombre' id='nombre' required>
                  <option value="">Selecciona una emisora</option>
                    <?php 
                    $query_simulador=mysqli_query($con,"select * from simulador where id_producto='".$id_producto."'");
                    while($rw=mysqli_fetch_array($query_simulador)) {
                      ?>
                    <option value="<?php echo $rw['simulador_id'];?>"><?php echo $rw['simulador_ref'];?></option>      
                      <?php
                    }
                    ?>
                </select> 
                </div>
            <?php } else { ?>
                <label for="nombre" class="col-sm-2 control-label">PC</label>
                <div class="col-sm-6">
                <select class='form-control' name='nombre' id='nombre' required>
                  <option value="">Selecciona un ordenador</option>
                    <?php 
                    $query_simulador=mysqli_query($con,"select * from simulador where id_producto='".$id_producto."'");
                    while($rw=mysqli_fetch_array($query_simulador)) {
                      ?>
                    <option value="<?php echo $rw['simulador_id'];?>"><?php echo $rw['simulador_ref'];?></option>      
                      <?php
                    }
                    ?>
                </select> 
                </div>
            <?php } ?>
            </div>          
            <div class="form-group">
              <label for="reference_remove_simulador" class="col-sm-2 control-label">Referencia</label>
              <div class="col-sm-6">
                <input type="text" name="reference_remove_simulador" class="form-control" id="reference_remove_simulador" value="" placeholder="Referencia">
              </div>
            </div>
        </div>
        <?php } //PROYECTOR
        else if (stripos($nombre_producto, "proyector")  !== false) { ?>
         <div class="modal-body">          
              <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Proyector</label>
                <div class="col-sm-6">
                <select class='form-control' name='nombre' id='nombre' required>
                  <option value="">Selecciona un proyector</option>
                    <?php 
                    $query_proyector=mysqli_query($con,"select * from proyector where id_producto='".$id_producto."'");
                    while($rw=mysqli_fetch_array($query_proyector)) {
                      ?>
                    <option value="<?php echo $rw['proyector_id'];?>"><?php echo $rw['proyector_serie'];?></option>      
                      <?php
                    }
                    ?>
                </select> 
                </div>
              </div>          
            <div class="form-group">
              <label for="reference_remove_proyector" class="col-sm-2 control-label">Referencia</label>
              <div class="col-sm-6">
                <input type="text" name="reference_remove_proyector" class="form-control" id="reference_remove_proyector" value="" placeholder="Referencia">
              </div>
            </div>
        </div>
        <?php }//EMISORAS
        else if (stripos($nombre_producto, "emisora") !== false && stripos($nombre_producto, "cargador") === false) { ?>
          <div class="modal-body">          
              <div class="form-group">
                <label for="numserie" class="col-sm-2 control-label">Emisora</label>
                <div class="col-sm-6">
                <select class='form-control' name='numserie' id='numserie' required>
                  <option value="">Selecciona una emisora</option>
                    <?php 
                    $query_emisora=mysqli_query($con,"select * from emisoras where id_producto='".$id_producto."'");
                    while($rw=mysqli_fetch_array($query_emisora)) {
                      ?>
                    <option value="<?php echo $rw['emi_id'];?>"><?php echo $rw['emi_serie'];?></option>      
                      <?php
                    }
                    ?>
                </select> 
                </div>
              </div>          
            <div class="form-group">
              <label for="reference_remove_emisora" class="col-sm-2 control-label">Referencia</label>
              <div class="col-sm-6">
                <input type="text" name="reference_remove_emisora" class="form-control" id="reference_remove_emisora" value="" placeholder="Referencia">
              </div>
            </div>
        </div>
        <?php } //HÉLICES
        if (stripos($nombre_producto, "hélice")  !== false) { ?>
          <div class="modal-body">          
              <div class="form-group">
                <label for="numserie" class="col-sm-2 control-label">Hélice</label>
                <div class="col-sm-6">
                <select class='form-control' name='numserie' id='numserie' required>
                  <option value="">Selecciona una hélice</option>
                    <?php 
                    $query_helice=mysqli_query($con,"select * from helices where id_producto='".$id_producto."'");
                    while($rw=mysqli_fetch_array($query_helice)) {
                      ?>
                    <option value="<?php echo $rw['heli_id'];?>"><?php echo $rw['heli_serie'];?></option>      
                      <?php
                    }
                    ?>
                </select> 
                </div>
              </div>          
            <div class="form-group">
              <label for="reference_remove_helices" class="col-sm-2 control-label">Referencia</label>
              <div class="col-sm-6">
                <input type="text" name="reference_remove_helices" class="form-control" id="reference_remove_helices" value="" placeholder="Referencia">
              </div>
            </div>
        </div>
        <?php } //EMISORAS
        else if (stripos($nombre_producto, "batería") !== false && stripos($nombre_producto, "cargador") === false) { ?>
          <div class="modal-body">          
              <div class="form-group">
                <label for="numserie" class="col-sm-2 control-label">Batería</label>
                <div class="col-sm-6">
                <select class='form-control' name='numserie' id='numserie' required>
                  <option value="">Selecciona una batería</option>
                    <?php 
                    $query_bateria=mysqli_query($con,"select * from baterias where id_producto='".$id_producto."'");
                    while($rw=mysqli_fetch_array($query_bateria)) {
                      ?>
                    <option value="<?php echo $rw['bat_id'];?>"><?php echo $rw['bat_serie'];?></option>      
                      <?php
                    }
                    ?>
                </select> 
                </div>
              </div>          
            <div class="form-group">
              <label for="reference_remove_bateria" class="col-sm-2 control-label">Referencia</label>
              <div class="col-sm-6">
                <input type="text" name="reference_remove_bateria" class="form-control" id="reference_remove_bateria" value="" placeholder="Referencia">
              </div>
            </div>
        </div>
        <?php } //CARGADORES
        else if (stripos($nombre_producto, "cargador")  !== false) { ?>
          <div class="modal-body">          
            <div class="form-group">
                <?php if (stripos($nombre_producto, "emisora")  !== false) { ?>
                <label for="nombre" class="col-sm-2 control-label">Cargador de emisora</label>
                <div class="col-sm-6">
                <select class='form-control' name='nombre' id='nombre' required>
                  <option value="">Selecciona un cargador de emisora</option>
                    <?php 
                    $query_cargador=mysqli_query($con,"select * from cargadores where id_producto='".$id_producto."'");
                    while($rw=mysqli_fetch_array($query_cargador)) {
                      ?>
                    <option value="<?php echo $rw['car_id'];?>"><?php echo $rw['car_serie'];?></option>      
                      <?php
                    }
                    ?>
                </select> 
                </div>
            <?php } else { ?>
                <label for="nombre" class="col-sm-2 control-label">Cargador de baterías</label>
                <div class="col-sm-6">
                <select class='form-control' name='nombre' id='nombre' required>
                  <option value="">Selecciona un cargador de baterías</option>
                    <?php 
                    $query_cargador=mysqli_query($con,"select * from cargadores where id_producto='".$id_producto."'");
                    while($rw=mysqli_fetch_array($query_cargador)) {
                      ?>
                    <option value="<?php echo $rw['car_id'];?>"><?php echo $rw['car_serie'];?></option>      
                      <?php
                    }
                    ?>
                </select> 
                </div>
            <?php } ?>
            </div>          
            <div class="form-group">
              <label for="reference_remove_cargadores" class="col-sm-2 control-label">Referencia</label>
              <div class="col-sm-6">
                <input type="text" name="reference_remove_cargadores" class="form-control" id="reference_remove_cargadores" value="" placeholder="Referencia">
              </div>
            </div>
        </div>
        <?php } //HUBS
        if (stripos($nombre_producto, "hub")  !== false) { ?>
          <div class="modal-body">          
              <div class="form-group">
                <label for="numserie" class="col-sm-2 control-label">Hub</label>
                <div class="col-sm-6">
                <select class='form-control' name='numserie' id='numserie' required>
                  <option value="">Selecciona un hub</option>
                    <?php 
                    $query_hub=mysqli_query($con,"select * from hubs where id_producto='".$id_producto."'");
                    while($rw=mysqli_fetch_array($query_hub)) {
                      ?>
                    <option value="<?php echo $rw['hub_id'];?>"><?php echo $rw['hub_serie'];?></option>      
                      <?php
                    }
                    ?>
                </select> 
                </div>
              </div>          
            <div class="form-group">
              <label for="reference_remove_hub" class="col-sm-2 control-label">Referencia</label>
              <div class="col-sm-6">
                <input type="text" name="reference_remove_hub" class="form-control" id="reference_remove_hub" value="" placeholder="Referencia">
              </div>
            </div>
        </div>
        <?php } ?>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary">Guardar datos</button>
        </div>
      </div>

    </div>
  </div>
</form>

