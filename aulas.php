<?php
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }

	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos

  $active_productos="";
  $active_categoria="";
  $active_reportes="";  
  $active_historico="";
  $active_instructores="";
  $active_aulas="active";	
  $active_campos="";
  $active_convocatorias="";
  $active_elem_con="";
  $active_usuarios="";
  $title="Aulas | Aerocamaras";
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
          <?php if ($_SESSION['admin'] == 1) {?>
        <button style="margin-right:20px;" type='button' class="btn btn-success" onclick="desactivado()">Aulas eliminadas</button>
        <?php } ?>
				<button style="margin-right:20px;" type="button" class="btn btn-success" onclick="exportar_pdf();"><span class="glyphicon glyphicon-download-alt"></span> Descargar pdf</button>
				<button type='button' class="btn btn-success" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" ></span> Nuevo Aula</button>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Aulas</h4>
		</div>			
			<div class="panel-body">
			<?php
			include("modal/registro_aulas.php");
			include("modal/editar_aulas.php");
			?>
			<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Nombre:</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Nombre" onkeyup='load(1);'>
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
	<script type="text/javascript" src="js/aulas.js"></script>

	
	


  </body>
</html>
<script>
function desactivado (){
    window.location.href="aulas_desactivado.php";
  } 
function exportar_pdf (){
    window.open("ajax/pdf_aulas.php", "_blank");
  } 

$( "#guardar_aula" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_aula.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
			$('#guardar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

$( "#editar_aula" ).submit(function( event ) {
  $('#actualizar_datos2').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_aula.php",
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
			var nombres = $("#names"+id).val();
			var mapas = $("#mapas"+id).val();
			var poblacion = $("#poblacion"+id).val();
			var telefono = $("#telefono"+id).val();
			var email = $("#email"+id).val();
			
			$("#mod_id").val(id);
			$("#name2").val(nombres);
			$("#mapa2").val(mapas);
			$("#poblacion2").val(poblacion);
			$("#telefono2").val(telefono);
			$("#email2").val(email);
			
		}
</script>