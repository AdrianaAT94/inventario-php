  <?php
    if (isset($con))
    {
  ?>
  <!-- Modal -->
  <div class="modal fade" id="nuevoProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo producto</h4>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" method="post" id="guardar_producto" name="guardar_producto">
      <div id="resultados_ajax_productos"></div>
        
        <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Nombre</label>
        <div class="col-sm-8">
          <textarea class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto" required maxlength="255" ></textarea>
          
        </div>
        </div>
        
        <div class="form-group">
        <label for="categoria" class="col-sm-3 control-label">Categoría</label>
        <div class="col-sm-8">
          <select class='form-control' name='categoria' id='categoria' required>
            <option value="">Selecciona una categoría</option>
              <?php 
              $query_categoria=mysqli_query($con,"select * from categorias order by nombre_categoria");
              while($rw=mysqli_fetch_array($query_categoria)) {
                ?>
              <option value="<?php echo $rw['id_categoria'];?>"><?php echo $rw['nombre_categoria'];?></option>      
                <?php
              }
              ?>
          </select>       
        </div>
        </div>
            
          
      <div class="form-group">
        <label for="imagen" class="col-sm-3 control-label">Imagen</label>
        <div class="col-sm-8">
          <input type="file" class="form-control" id="imagen" name="imagen">
        </div>
      </div>
       
       
      
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
      </div>
      </form>
    </div>
    </div>
  </div>
  <?php
    }
  ?>