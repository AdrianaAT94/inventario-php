  <?php
    if (isset($con))
    {
  ?>
  <!-- Modal -->
  <div class="modal fade" id="nuevoInvCon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo inventario para convocatoria</h4>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" method="post" id="guardar_inv_con" name="guardar_inv_con">
      <div id="resultados_ajax"></div>    


        <div class="form-group" style="margin-top: 15px">
          <label for="usuario" class="col-sm-3 control-label">Usuario</label>
          <div class="col-sm-8">
            <input type="text" name="usuario" id="usuario" class="form-control" readonly value="<?php echo $_SESSION['firstname']; ?>" />
          </div>
        </div>
        <div class="form-group">
          <label for="canvas1" class="col-sm-3 control-label">Firma</label>
          <div class="col-sm-8">
            <canvas id='canvas1' style='width:100%; height: 200px; border: 1px solid #CCC;'>
                <p>Tu navegador no soporta canvas</p>
            </canvas>
            <button type='button' class="btn btn-primary btn-reestablecer" onclick='LimpiarTrazado()'>Reestablecer</button>
            <input type="hidden" name="firma1" id="firma1">
          </div>
        </div>   
          
        <div class="form-group">
        <label for="convocatoria" class="col-sm-3 control-label">Convocatoria</label>
        <div class="col-sm-8">
          <select class='form-control' name='convocatoria' id='convocatoria' required>
            <option value="">Selecciona una convocatoria</option>
              <?php 
              $con2 = mysqli_connect("31.193.227.98", "cursoded_encuest", "ZKD,Ey8EzqgQ", "cursoded_encuesta");
              mysqli_set_charset($con2, 'utf8');
              $sql="SELECT * FROM  convocatorias order by convocatoria";
              $query = mysqli_query($con2, $sql);
              while($rw=mysqli_fetch_array($query)) {
                ?>
              <option value="<?php echo $rw['id'];?>"><?php echo $rw['convocatoria'];?></option>      
                <?php
              }
              ?>
          </select>       
        </div>
        </div>
          
        <div class="form-group">
        <label for="instructor" class="col-sm-3 control-label">Instructor</label>
        <div class="col-sm-8">
          <select class='form-control' name='instructor' id='instructor' required>
            <option value="">Selecciona un instructor</option>
              <?php 
              $sql2="SELECT * FROM  instructores WHERE inactivo=0  order by firstname";
              $query2 = mysqli_query($con, $sql2);
              while($rw2=mysqli_fetch_array($query2)) {
                ?>
              <option value="<?php echo $rw2['inst_id'];?>"><?php echo $rw2['firstname']." ".$rw2['lastname'];?></option>      
                <?php
              }
              ?>
          </select>       
        </div>
        </div>
          
        <div class="form-group">
        <label for="aula" class="col-sm-3 control-label">Aula</label>
        <div class="col-sm-8">
          <select class='form-control' name='aula' id='aula' required>
            <option value="">Selecciona un aula</option>
              <?php 
              $sql3="SELECT * FROM  aulas WHERE inactivo=0  order by aula_name";
              $query3 = mysqli_query($con, $sql3);
              while($rw3=mysqli_fetch_array($query3)) {
                ?>
              <option value="<?php echo $rw3['aula_id'];?>"><?php echo $rw3['aula_name'];?></option>      
                <?php
              }
              ?>
          </select>       
        </div>
        </div>
          
        <div id="especifico_aeronave"></div>
      
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary" onclick="GuardarTrazado()" id="guardar_datos">Guardar datos</button>
      </div>
      </form>
    </div>
    </div>
  </div>
  <?php
    }
  ?>