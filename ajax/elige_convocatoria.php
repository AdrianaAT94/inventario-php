<?php
  include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
  /* Connect To Database*/
  require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
  //Archivo de funciones PHP
  include("../funciones.php");  

  if(isset($_POST['convocatoria'])) {
	$id_convocatoria = $_POST['convocatoria'];

	$con2 = mysqli_connect("31.193.227.98", "cursoded_encuest", "ZKD,Ey8EzqgQ", "cursoded_encuesta");
	mysqli_set_charset($con2, 'utf8');
	$sql="SELECT * FROM  convocatorias WHERE id='".$id_convocatoria."'  order by convocatoria";
	$query = mysqli_query($con2, $sql);
	while($rw=mysqli_fetch_array($query)) {
    //CURSO RADIOFONISTA
		if((substr($rw['convocatoria'],-1)=='R')) {

  echo '
    <div class="form-group row">
        <label for="bandaaerea" class="col-sm-3 control-label">Emisora Banda Aérea</label>
        <div class="col-sm-8">';
          $aaa="SELECT * FROM products WHERE inactivo=0 AND id_producto='71'";
          $bbb = mysqli_query($con, $aaa);
          $ccc=mysqli_num_rows($bbb);
          if($ccc==0) {
              echo 'No hay emisoras de banda aérea disponibles';
          }
          else {
            $sql2="SELECT * FROM  emisoras WHERE emi_casa=1 AND id_producto='71'";
            $query2 = mysqli_query($con, $sql2);
            $count=mysqli_num_rows($query2);
            if($count==0) {
              echo 'No hay emisoras de banda aérea disponibles';
            }
            while($rw2=mysqli_fetch_array($query2)) {     
              echo '<p  class="col-sm-6"><input type="checkbox" name="bandaaerea[]" value="'.$rw2['emi_id'].'">'.$rw2['emi_serie'].'</p>';
            }
          }
          echo '       
        </div>
        <input type="hidden" name="tipo_convocatoria" id="tipo_convocatoria" value="radio">
        </div>';
		}
    //CURSO OFICIAL
		else {

      echo '
      <div class="form-group">
        <label for="campo" class="col-sm-3 control-label">Campo de vuelo</label>
        <div class="col-sm-8">
          <select class="form-control" name="campo" id="campo" required>
            <option value="">Selecciona un campo de vuelo</option>';
              $sql_campo="SELECT * FROM  camposvuelo WHERE inactivo=0 order by campo_name";
              $query_campo = mysqli_query($con, $sql_campo);
              while($rw_campo=mysqli_fetch_array($query_campo)) {
              echo '<option value="'.$rw_campo['campo_id'].'">'.$rw_campo['campo_name'].'</option>';    
              }
          echo '</select>       
        </div>
        <input type="hidden" name="tipo_convocatoria" id="tipo_convocatoria" value="oficial">
        </div>';

			echo '
			<div class="form-group">
        <label for="aeronave" class="col-sm-3 control-label">Aeronave</label>
        <div class="col-sm-8">
          <select class="form-control" name="aeronave" id="aeronave" required>
            <option value="">Selecciona una aeronave</option>';

              $sql2="SELECT * FROM  categorias WHERE inactivo=0 order by nombre_categoria";
              $query2 = mysqli_query($con, $sql2);
              while($rw2=mysqli_fetch_array($query2)) {
                  if($rw2['nombre_categoria']!="SIMULADOR" && $rw2['nombre_categoria']!="OTRO MATERIAL" && $rw2['nombre_categoria']!="MEMORIA" && $rw2['nombre_categoria']!="RADIOFONÍA") {
                  	echo '<option value="'.$rw2['id_categoria'].'">'.$rw2['nombre_categoria'].'</option>';     
                  }
              }
          echo '</select>       
        </div>
        </div>
        <div id="especifico_serie"></div>';
		}
    //COMÚN
    echo '
    <div class="form-group row">
        <label for="chalecos" class="col-sm-3 control-label">Chalecos</label>
        <div class="col-sm-8">';
      $sql2="SELECT * FROM  products WHERE inactivo=0 AND stock_actual>0 AND id_producto='69'";
      $query2 = mysqli_query($con, $sql2);
      $count=mysqli_num_rows($query2);
      if($count==0) {
        echo 'No hay chalecos disponibles';
      }
      while($rw2=mysqli_fetch_array($query2)) {
        echo '<input type="number" max="'.$rw2['stock_actual'].'" class="form-control" name="chalecos" id="chalecos" placeholder="Cantidad">';
              }
          echo '      
        </div>
        </div>';
    
    echo '
    <div class="form-group row">
        <label for="boligrafos" class="col-sm-3 control-label">Bolígrafos</label>
        <div class="col-sm-8">';
      $sql2="SELECT * FROM  products WHERE inactivo=0 AND stock_actual>0 AND id_producto='68'";
      $query2 = mysqli_query($con, $sql2);
      $count=mysqli_num_rows($query2);
      if($count==0) {
        echo 'No hay bolígrafos disponibles';
      }
      $query2 = mysqli_query($con, $sql2);
      while($rw2=mysqli_fetch_array($query2)) {
        echo '<input type="number" max="'.$rw2['stock_actual'].'" class="form-control" name="boligrafos" id="boligrafos" placeholder="Cantidad">';
              }
          echo '      
        </div>
        </div>';
    
    echo '
    <div class="form-group row">
        <label for="regletas" class="col-sm-3 control-label">Regletas</label>
        <div class="col-sm-8">';
      $sql2="SELECT * FROM  products WHERE inactivo=0 AND stock_actual>0 AND id_producto='73'";
      $query2 = mysqli_query($con, $sql2);
      $count=mysqli_num_rows($query2);
      if($count==0) {
        echo 'No hay regletas disponibles';
      }
      while($rw2=mysqli_fetch_array($query2)) {
        echo '<input type="number" max="'.$rw2['stock_actual'].'" class="form-control" name="regletas" id="regletas" placeholder="Cantidad">';
              }
          echo '      
        </div>
        </div>';

    echo '
    <div class="form-group row">
        <label for="proyector" class="col-sm-3 control-label">Proyectores</label>
        <div class="col-sm-8">';
          $aaa="SELECT * FROM products WHERE inactivo=0 AND id_producto='71'";
          $bbb = mysqli_query($con, $aaa);
          $ccc=mysqli_num_rows($bbb);
          if($ccc==0) {
              echo 'No hay proyectores disponibles';
          }
          else {
            $sql2="SELECT * FROM  proyector WHERE proyector_casa=1 AND id_producto='72'";
            $query2 = mysqli_query($con, $sql2);
            $count=mysqli_num_rows($query2);
            if($count==0) {
              echo 'No hay proyectores disponibles';
            }
            while($rw2=mysqli_fetch_array($query2)) {     
              echo '<p  class="col-sm-6"><input type="checkbox" name="proyector[]" value="'.$rw2['proyector_id'].'">'.$rw2['proyector_serie'].'</p>';
            }
          }
          echo '      
        </div>
        </div>';
  }
}
?>
<script>

$('#aeronave').change(function() {
    var valor =  $('#aeronave').val();
    
    var parametros = {
      "aeronave": valor
    };     
    
    $.ajax({
      data: parametros,
      url: 'ajax/elige_aeronave.php',
      type: 'post',
      success: function (response) {
        $("#especifico_serie").html(response);
      }
    })
    
 })
</script>