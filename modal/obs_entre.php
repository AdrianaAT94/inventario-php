  <?php
    if (isset($con))
    {
  ?>
  <!-- Modal -->
  <div class="modal fade" id="myModal3_entre" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Observaciones</h4>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" method="post" id="obs_entre" name="obs_entre">
      <div id="resultados_ajax3"></div>
       
       
       
       
        <div class="form-group">
        <label for="observaciones_entre" class="col-sm-4 control-label">Observaciones</label>
        <div class="col-sm-8">
          <textarea class="form-control" id="observaciones_entre" name="observaciones_entre"></textarea>
          <input type="hidden" id="entregar_id" name="entregar_id">
        </div>
        </div>
       
        

       
       
      
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary" id="actualizar_datos_entre3">Guardar</button>
      </div>
      </form>
    </div>
    </div>
  </div>
  <?php
    }
  ?>  