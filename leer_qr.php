<?php
  session_start();
  if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    if (!isset($_SESSION['inst_login_status']) AND $_SESSION['inst_login_status'] != 1) {
        header("location: login.php");
    exit;
        } }
  
  /* Connect To Database*/
  require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos$active_productos="";
  
  $active_categoria="";
  $active_reportes="";  
  $active_historico="";
  $active_instructores="";
  $active_aulas=""; 
  $active_campos="";
  $active_convocatorias="";
  $active_elem_con="active";
  $active_usuarios="";
  $title="Inventario para Convocatorias | Aerocamaras";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>

  </head>
  <body>
  <?php
  if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) { 
    include("navbar_inst.php");
  } else {
    include("navbar.php");
  }
  ?>
  
    <div class="container">
  <div class="panel panel-success">
    <div class="panel-heading">
        <div class="btn-group pull-right">
        <?php if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) { ?>
        <a href="convoc_inst.php" class="btn btn-success">Volver</a>
      <?php } else { ?>
        <a href="elem_convoc.php" class="btn btn-success">Volver</a>
      <?php } ?>
      </div>
      <h4>Lector QR</h4>
    </div>
    <div class="panel-body">
          
      <?php
      ?>
        
            <div class="form-group row">
              <label style="padding-top: 7px; margin-bottom: 0; text-align: right;" for="q" class="col-md-2 control-label">Archivo QR</label>
              <div class="col-md-5">
                <input type="file" class="form-control" id="q" nplaceholder="Archivo QR" accept="image/*" capture=environment onclick="return showQRIntro();" onchange="openQRCamera(this);" tabindex=-1>
              </div>              
            </div>
            <div class="col-md-12" id="contenido">
              
            </div>
        
        
      
  </div>
</div>
     
  </div>
  <hr>
  <?php
  include("footer.php");
  ?>
  <script type="text/javascript" src="js/qr_packed.js"></script>
  </body>
</html>

<script>
function openQRCamera(node) {
  var reader = new FileReader();
  reader.onload = function() {
    qrcode.callback = function(res) {
      if(res instanceof Error) {
        alert("No se ha encontrado ningún código QR. Por favor, asegúrate de que el código QR están entre el marco de la cámara y prueba otra vez.");
      } else {
        $('#contenido').html(res);
      }
    };
    qrcode.decode(reader.result);
  };
  reader.readAsDataURL(node.files[0]);
}

function showQRIntro() {
  return confirm("Usa tu camara para hacer una foto de la imagen QR.");
}
</script>
