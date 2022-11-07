<?php
  session_start();
  if (!isset($_SESSION['inst_login_status']) AND $_SESSION['inst_login_status'] != 1) {
        header("location: login.php");
    exit;
        }
  
  /* Connect To Database*/
  require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos$active_productos="";
  
  $active_instructores="";
  $active_elem_con="active";
  $title="Convocatorias | Aerocamaras";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
  </head>
  <body>
  <?php
  include("navbar_inst.php");
  include("modal/obs_entre.php");
  include("modal/observaciones.php");
  ?>
  
    <div class="container">
  <div class="panel panel-success">
    <div class="panel-heading">
        <div class="btn-group pull-right">
        <button style="margin-right:20px;" type="button" class="btn btn-success" onclick="leer_qr();"><span class="glyphicon glyphicon-download-alt"></span> Leer QR</button>
      </div>
      <h4>Convocatorias</h4>
    </div>
    <div class="panel-body">
    
      
      
      <?php
        include("modal/registro_inv_con.php");
      ?>
      <form class="form-horizontal" role="form" id="datos_cotizacion">
        
            <div class="form-group row">
              <label for="q" class="col-md-2 control-label">Convocatoria</label>
              <div class="col-md-5">
                <input type="text" class="form-control" id="q" placeholder="Nombre de la convocatoria" onkeyup='load(1);'>
              </div>
              <div class="col-md-3">
                <button type="button" class="btn btn-default" onclick='load(1);'>
                  <span class="glyphicon glyphicon-search" ></span> Buscar</button>
                <span id="loader"></span>
              </div>
              
            </div>
        
        
        
      </form>
        <div id="resultados"></div><!-- Carga los datos ajax -->
        <div class='outer_div'></div><!-- Carga los datos ajax -->
      
    
  
      
      
      
  </div>
</div>
     
  </div>
  <hr>
  <?php
  include("footer.php");
  ?>
  <script type="text/javascript" src="js/inv_convocatorias_ins.js"></script>
  </body>
</html>
<script>
function leer_qr (){
    location.href="leer_qr.php";
  } 
</script>