<form class="form-horizontal"  method="post" name="add_stock">
  <!-- Modal -->
  <div id="add-stock" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Agregar Stock</h4>
        </div>
        <div class="modal-body">
          
            <div class="form-group">
              <label for="quantity" class="col-sm-2 control-label">Cantidad</label>
              <div class="col-sm-6">
                <input type="number" min="1" name="quantity" class="form-control" id="quantity" value="" placeholder="Cantidad" required="">
              </div>
            </div>
            <div class="form-group">
              <label for="reference" class="col-sm-2 control-label">Referencia</label>
              <div class="col-sm-6">
                <input type="text" name="reference" class="form-control" id="reference" value="" placeholder="Referencia">
              </div>
            </div>
            
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
  		<button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </div>

    </div>
  </div> 
</form>

<form class="form-horizontal"  method="post" name="add_stock">
  <!-- Modal -->
  <div id="add-product-stock" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Agregar Stock</h4>
        </div>
      
        <?php //NAVES
        if (stripos($nombre_producto, "nave")  !== false) { ?>  
          <div class="modal-body">
             <div class="form-group">
              <label for="numserie" class="col-sm-2 control-label">Número de serie</label>
              <div class="col-sm-6">
                <input type="text" name="numserie" class="form-control" id="numserie" value="" placeholder="Número de serie">
              </div>
            </div>
            <div class="form-group">
              <label for="reference_nave" class="col-sm-2 control-label">Referencia</label>
              <div class="col-sm-6">
                <input type="text" name="reference_nave" class="form-control" id="reference_nave" value="" placeholder="Referencia">
              </div>
            </div>
        </div>
        <?php } //SIMULADOR
        else if (stripos($nombre_producto, "simulador")  !== false) { ?>
          <div class="modal-body">   
              <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Número de serie</label>
                <div class="col-sm-6">
                  <input type="text" name="nombre" class="form-control" id="nombre" value="" placeholder="Nombre">
                </div>
              </div>
              <div class="form-group">
                <label for="reference_simulador" class="col-sm-2 control-label">Referencia</label>
                <div class="col-sm-6">
                  <input type="text" name="reference_simulador" class="form-control" id="reference_simulador" value="" placeholder="Referencia">
                </div>
              </div>
          </div>
        <?php } //PROTECTOR
        else if (stripos($nombre_producto, "proyector")  !== false) { ?>
          <div class="modal-body">   
              <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Número de serie</label>
                <div class="col-sm-6">
                  <input type="text" name="nombre" class="form-control" id="nombre" value="" placeholder="Nombre">
                </div>
              </div>
              <div class="form-group">
                <label for="reference_proyector" class="col-sm-2 control-label">Referencia</label>
                <div class="col-sm-6">
                  <input type="text" name="reference_proyector" class="form-control" id="reference_proyector" value="" placeholder="Referencia">
                </div>
              </div>
          </div>
        <?php } //EMISORAS
        else if (stripos($nombre_producto, "emisora") !== false && stripos($nombre_producto, "cargador") === false) { ?>  
          <div class="modal-body">
             <div class="form-group">
              <label for="numserie" class="col-sm-2 control-label">Número de serie</label>
              <div class="col-sm-6">
                <input type="text" name="numserie" class="form-control" id="numserie" value="" placeholder="Número de serie">
              </div>
            </div>
            <div class="form-group">
              <label for="reference_emisora" class="col-sm-2 control-label">Referencia</label>
              <div class="col-sm-6">
                <input type="text" name="reference_emisora" class="form-control" id="reference_emisora" value="" placeholder="Referencia">
              </div>
            </div>
        </div>
        <?php } //HÉLICES
        else if (stripos($nombre_producto, "hélice") !== false) { ?>  
          <div class="modal-body">
             <div class="form-group">
              <label for="numserie" class="col-sm-2 control-label">Número de serie</label>
              <div class="col-sm-6">
                <input type="text" name="numserie" class="form-control" id="numserie" value="" placeholder="Número de serie">
              </div>
            </div>
            <div class="form-group">
              <label for="reference_helices" class="col-sm-2 control-label">Referencia</label>
              <div class="col-sm-6">
                <input type="text" name="reference_helices" class="form-control" id="reference_helices" value="" placeholder="Referencia">
              </div>
            </div>
        </div>
        <?php } //BATERÍAS
        else if (stripos($nombre_producto, "batería") !== false && stripos($nombre_producto, "cargador") === false) { ?>  
          <div class="modal-body">
             <div class="form-group">
              <label for="numserie" class="col-sm-2 control-label">Número de serie</label>
              <div class="col-sm-6">
                <input type="text" name="numserie" class="form-control" id="numserie" value="" placeholder="Número de serie">
              </div>
            </div>
            <div class="form-group">
              <label for="reference_bateria" class="col-sm-2 control-label">Referencia</label>
              <div class="col-sm-6">
                <input type="text" name="reference_bateria" class="form-control" id="reference_bateria" value="" placeholder="Referencia">
              </div>
            </div>
        </div>
        <?php } //CARGADORES
        else if (stripos($nombre_producto, "cargador") !== false) { ?>  
          <div class="modal-body">
             <div class="form-group">
              <label for="numserie" class="col-sm-2 control-label">Número de serie</label>
              <div class="col-sm-6">
                <input type="text" name="numserie" class="form-control" id="numserie" value="" placeholder="Número de serie">
              </div>
            </div>
            <div class="form-group">
              <label for="reference_cargadores" class="col-sm-2 control-label">Referencia</label>
              <div class="col-sm-6">
                <input type="text" name="reference_cargadores" class="form-control" id="reference_cargadores" value="" placeholder="Referencia">
              </div>
            </div>
        </div>
        <?php } //HUBS
        else if (stripos($nombre_producto, "hub") !== false) { ?>  
          <div class="modal-body">
             <div class="form-group">
              <label for="numserie" class="col-sm-2 control-label">Número de serie</label>
              <div class="col-sm-6">
                <input type="text" name="numserie" class="form-control" id="numserie" value="" placeholder="Número de serie">
              </div>
            </div>
            <div class="form-group">
              <label for="reference_hubs" class="col-sm-2 control-label">Referencia</label>
              <div class="col-sm-6">
                <input type="text" name="reference_hubs" class="form-control" id="reference_hubs" value="" placeholder="Referencia">
              </div>
            </div>
        </div>
        <?php } ?>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </div>

    </div>
  </div> 
</form>

