  <?php
    if (isset($con))
    {
  ?>
  <!-- Modal -->
  <div class="modal fade" id="observaciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Observaciones</h4>
      </div>
      <div class="modal-body">
      <div id="resultados_ajax3"></div>
       
        <table class="table">
        <tr class="success">   
          <th>Observaciones al Entregar</th>   
        </tr>
        <tr>
          <td id="t_entre"></td>
        </tr>
        <tr class="success">   
          <th>Observaciones al Devolver</th>   
        </tr>
        <tr>
          <td id="t_devue"></td>
        </tr>
      </table>
      
      </div>
    </div>
    </div>
  </div>
  <?php
    }
  ?>  