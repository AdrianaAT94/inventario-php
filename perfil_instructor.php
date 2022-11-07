<?php
  session_start();
  if (!isset($_SESSION['inst_login_status']) AND $_SESSION['inst_login_status'] != 1) {
        header("location: login.php");
    exit;
        }
  
  /* Connect To Database*/
  require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos$active_productos="";
  
  $active_instructores="active";
  $active_elem_con="";
  $title="Perfil | Aerocamaras";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <?php include("head.php");?>
  </head>
  <body>
  <?php
  include("navbar_inst.php");
  ?> 
    <div class="container">
    <div class="panel panel-success">

    <div class="panel-heading">
    </div>      
      <div class="panel-body">
      <?php
      include("modal/editar_instructores.php");
      include("modal/cambiar_password_ins.php");
      ?>

        <div id="resultados"></div><!-- Carga los datos ajax -->
        <div class='outer_div'></div><!-- Carga los datos ajax -->
            
      </div>
    </div>

  </div>
  <hr>
  <?php
  include("footer.php");
  ?>
  <script type="text/javascript" src="js/perfil_ins.js"></script>

  
  


  </body>
</html>
<script>

$( "#editar_instructor" ).submit(function( event ) {
  $('#actualizar_datos2').attr("disabled", true);
  
 var parametros = $(this).serialize();
   $.ajax({
      type: "POST",
      url: "ajax/editar_instructor_ins.php",
      data: parametros,
       beforeSend: function(objeto){
        $("#resultados_ajax2").html("Mensaje: Cargando...");
        },
      success: function(datos){
      $("#resultados_ajax2").html(datos);
      $('#actualizar_datos2').attr("disabled", false);
      load(1);
      }
  });
  event.preventDefault();
})

  function obtener_datos(id){
      var nombres = $("#nombres"+id).val();
      var apellidos = $("#apellidos"+id).val();
      var direccion = $("#direccion"+id).val();
      var telefono = $("#telefono"+id).val();
      var email = $("#email"+id).val();
      
      $("#mod_id").val(id);
      $("#firstname2").val(nombres);
      $("#lastname2").val(apellidos);
      $("#direccion2").val(direccion);
      $("#telefono2").val(telefono);
      $("#instructor_email2").val(email);
      
    }
  
  function get_user_id(id){
    $("#user_id_mod").val(id);
  }

$( "#editar_password" ).submit(function( event ) {
  $('#actualizar_datos3').attr("disabled", true);
  
 var parametros = $(this).serialize();
   $.ajax({
      type: "POST",
      url: "ajax/editar_password_ins.php",
      data: parametros,
       beforeSend: function(objeto){
        $("#resultados_ajax3").html("Mensaje: Cargando...");
        },
      success: function(datos){
      $("#resultados_ajax3").html(datos);
      $('#actualizar_datos3').attr("disabled", false);
      load(1);
      }
  });
  event.preventDefault();
})

</script>