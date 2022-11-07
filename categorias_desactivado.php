<?php
  session_start();
  if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1 AND $_SESSION['admin'] == 1) {
        header("location: login.php");
    exit;
        }
  
  /* Connect To Database*/
  require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos$active_productos="";
  
  $active_categoria="active";
  $active_reportes="";  
  $active_historico="";
  $active_instructores="";
  $active_aulas=""; 
  $active_campos="";
  $active_convocatorias="";
  $active_elem_con="";
  $active_usuarios="";
  $title="Categorías | Aerocamaras";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
  </head>
  <body>
  <?php
  include("navbar.php");
  ?>
  
    <div class="container">
  <div class="panel panel-success">
    <div class="panel-heading">
        <div class="btn-group pull-right">
        <button style="margin-right:20px;" type="button" class="btn btn-success" onclick="exportar_pdf();"><span class="glyphicon glyphicon-download-alt"></span> Descargar pdf</button>
        <button type='button' class="btn btn-success" onclick="categorias()">Categorías</button>
      </div>
      <h4><i class='glyphicon glyphicon-search'></i> Buscar Categorías eliminadas</h4>
    </div>
    <div class="panel-body">
    
      
      
      <?php
        include("modal/registro_categorias.php");
        include("modal/editar_categorias.php");
      ?>
      <form class="form-horizontal" role="form" id="datos_cotizacion">
        
            <div class="form-group row">
              <label for="q" class="col-md-2 control-label">Nombre</label>
              <div class="col-md-5">
                <input type="text" class="form-control" id="q" placeholder="Nombre de la categoría" onkeyup='load(1);'>
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
  <script type="text/javascript" src="js/categorias_eliminadas.js"></script>
  </body>
</html>

<script>
function categorias (){
    window.location.href="categorias.php";
  } 
function exportar_pdf (){
    window.open("ajax/pdf_categorias_eliminadas.php", "_blank");
  } 
</script>