<?php
  session_start();
  if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1 AND $_SESSION['admin'] == 1) {
        header("location: login.php");
    exit;
        }

  /* Connect To Database*/
  require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
  
  $active_productos="active";
  $active_categoria="";
  $active_reportes="";  
  $active_historico="";
  $active_instructores="";
  $active_aulas="";
  $active_campos="";
  $active_convocatorias="";
  $active_elem_con="";
  $active_usuarios="";
  $title="Inventario | Aerocamaras";
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
        <button type='button' class="btn btn-success" onclick="inventario()">Inventario</button>
      </div>
      <h4><i class='glyphicon glyphicon-search'></i> Consultar inventario eliminado</h4>
    </div>
    <div class="panel-body">
    
      
      
      <?php
      ?>
      <form class="form-horizontal" role="form" id="datos">
      
            
        <div class="row">
          <div class='col-md-4'>
            <label>Filtrar por código o nombre</label>
            <input type="text" class="form-control" id="q" placeholder="Código o nombre del producto" onkeyup='load(1);'>
          </div>
          
          <div class='col-md-4'>
            <label>Filtrar por categoría</label>
            <select class='form-control' name='id_categoria' id='id_categoria' onchange="load(1);">
              <option value="">Selecciona una categoría</option>
              <?php 
              $query_categoria=mysqli_query($con,"select * from categorias order by nombre_categoria");
              while($rw=mysqli_fetch_array($query_categoria)) {
                if (isset($_GET['cat'])) {
                  if ($rw['id_categoria'] == $_GET['cat']) { ?>
                    <option value="<?php echo $rw['id_categoria'];?>" selected><?php echo $rw['nombre_categoria'];?></option> 
                  <?php 
                  } else { ?>
                      <option value="<?php echo $rw['id_categoria'];?>"><?php echo $rw['nombre_categoria'];?></option> 
                  <?php } 
                }
                else { ?>
                    <option value="<?php echo $rw['id_categoria'];?>"><?php echo $rw['nombre_categoria'];?></option> 
                <?php } 
              }
              ?>
            </select>
          </div>
          <div class='col-md-12 text-center'>
            <span id="loader"></span>
          </div>
        </div>
        <hr>
        <div class='row-fluid'>
          <div id="resultados"></div><!-- Carga los datos ajax -->
        </div>  
        <div class='row'>
          <div class='outer_div'></div><!-- Carga los datos ajax -->
        </div>
      </form>
        
      
    
  
      
      
      
  </div>
</div>
     
  </div>
  <hr>
  <?php
  include("footer.php");
  ?>
  <script type="text/javascript" src="js/productos_eliminados.js"></script>
  </body>
</html>
<script>
function inventario (){
    window.location.href="stock.php";
  } 
</script>