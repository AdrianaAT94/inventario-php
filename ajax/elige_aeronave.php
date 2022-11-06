<?php
  include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
  /* Connect To Database*/
  require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
  //Archivo de funciones PHP
  include("../funciones.php");  

  if(isset($_POST['aeronave'])) {
	$id_categoria = $_POST['aeronave'];

	$sql="SELECT * FROM  products WHERE id_categoria='".$id_categoria."'";
	$query = mysqli_query($con, $sql);
	while($rw=mysqli_fetch_array($query)) {
		$nombre_producto =$rw['nombre_producto'];
		if (stripos($rw['nombre_producto'], "aeronave") !== false) {
			$id_producto_nave = $rw['id_producto'];
		}
		else if (stripos($nombre_producto, "emisora") !== false && stripos($nombre_producto, "cargador") === false) {
			$id_producto_emisora = $rw['id_producto'];
		}
		else if (stripos($nombre_producto, "hélice") !== false) {   
			$id_producto_helice = $rw['id_producto'];
		}
		else if (stripos($nombre_producto, "batería") !== false && stripos($nombre_producto, "cargador") === false) {   
			$id_producto_bateria = $rw['id_producto'];             
	    }
	    else if (stripos($nombre_producto, "cargador") !== false && stripos($nombre_producto, "emisora") !== false) {   
			$id_producto_cargador_emi = $rw['id_producto'];
	    }
	    else if (stripos($nombre_producto, "cargador") !== false && stripos($nombre_producto, "batería") !== false) {   
			$id_producto_cargador_bat = $rw['id_producto'];
	    }
	    else if (stripos($nombre_producto, "hub") !== false) {    
			$id_producto_hub = $rw['id_producto'];
	    } 
	    else if (stripos($nombre_producto, "alimentación") !== false) {    
			$id_producto_alimentacion = $rw['id_producto'];
	    } 
	    else if (stripos($nombre_producto, "otg") !== false) {    
			$id_producto_otg = $rw['id_producto'];
	    } 
	    else if (stripos($nombre_producto, "usb") !== false) {    
			$id_producto_usb = $rw['id_producto'];
	    } 
	    else if (stripos($nombre_producto, "type") !== false) {    
			$id_producto_c = $rw['id_producto'];
	    } 
	    else if (stripos($nombre_producto, "lightning") !== false) {    
			$id_producto_lightning = $rw['id_producto'];
	    } 
	}
	
	echo '
		<div class="form-group row">
        <label for="aeronaveserie" class="col-sm-3 control-label">Serie</label>
		<div class="col-sm-8">';
			$sql="SELECT * FROM products WHERE inactivo=0 AND id_producto='".$id_producto_nave."'";
			$query = mysqli_query($con, $sql);
	      	$count=mysqli_num_rows($query);
		    if($count==0) {
		        echo 'No hay aeronaves disponibles';
		    }
		    else {
				$sql2="SELECT * FROM  aeronaves WHERE aero_casa=1 AND id_producto='".$id_producto_nave."'";
				$query2 = mysqli_query($con, $sql2);
			      $count=mysqli_num_rows($query2);
			      if($count==0) {
			        echo 'No hay aeronaves disponibles';
			      }
				while($rw2=mysqli_fetch_array($query2)) {  
	              	echo '<p  class="col-sm-6"><input type="checkbox" name="aeronaveserie[]" value="'.$rw2['aero_id'].'">'.$rw2['aero_serie'].'</p>';
	              }
	        }
  	echo '      
	</div>
	</div>';

	echo '
		<div class="form-group row">
        <label for="horasdron" class="col-sm-3 control-label">Horas Dron</label>
        <div class="col-sm-8">
        	<input type="time" class="form-control" name="horasdron" id="horasdron" required>    
        </div>
        </div>';

	echo '
		<div class="form-group row">
        <label for="emisora" class="col-sm-3 control-label">Emisora</label>
        <div class="col-sm-8">';
			$sql="SELECT * FROM products WHERE inactivo=0 AND id_producto='".$id_producto_emisora."'";
			$query = mysqli_query($con, $sql);
	      	$count=mysqli_num_rows($query);
		    if($count==0) {
		        echo 'No hay emisoras disponibles';
		    }
		    else {
				$sql2="SELECT * FROM  emisoras WHERE emi_casa=1 AND id_producto='".$id_producto_emisora."'";
				$query2 = mysqli_query($con, $sql2);
			      $count=mysqli_num_rows($query2);
			      if($count==0) {
			        echo 'No hay emisoras disponibles';
			      }
				while($rw2=mysqli_fetch_array($query2)) {     
	              	echo '<p  class="col-sm-6"><input type="checkbox" name="emisora[]" value="'.$rw2['emi_id'].'">'.$rw2['emi_serie'].'</p>';
	              }
	        }
          echo '       
        </div>
        </div>';

	echo '
		<div class="form-group row">
        <label for="caremisora" class="col-sm-3 control-label">Cargadores de emisora</label>
        <div class="col-sm-8">';
			$sql="SELECT * FROM products WHERE inactivo=0 AND id_producto='".$id_producto_cargador_emi."'";
			$query = mysqli_query($con, $sql);
	      	$count=mysqli_num_rows($query);
		    if($count==0) {
		        echo 'No hay cargadores de emisoras disponibles';
		    }
		    else {
				$sql2="SELECT * FROM  cargadores WHERE car_casa=1 AND id_producto='".$id_producto_cargador_emi."'";
				$query2 = mysqli_query($con, $sql2);
			      $count=mysqli_num_rows($query2);
			      if($count==0) {
			        echo 'No hay cargadores de emisoras disponibles';
			      }
				while($rw2=mysqli_fetch_array($query2)) {
	              	echo '<p  class="col-sm-6"><input type="checkbox" name="caremisora[]" value="'.$rw2['car_id'].'">'.$rw2['car_serie'].'</p>';
	              }
	        }
          echo '      
        </div>
        </div>';

	echo '
		<div class="form-group row">
        <label for="helices" class="col-sm-3 control-label">Hélices</label>
        <div class="col-sm-8">';
			$sql="SELECT * FROM products WHERE inactivo=0 AND id_producto='".$id_producto_helice."'";
			$query = mysqli_query($con, $sql);
	      	$count=mysqli_num_rows($query);
		    if($count==0) {
		        echo 'No hay hélices disponibles';
		    }
		    else {
				$sql2="SELECT * FROM  helices WHERE heli_casa=1 AND id_producto='".$id_producto_helice."'";
				$query2 = mysqli_query($con, $sql2);
			      $count=mysqli_num_rows($query2);
			      if($count==0) {
			        echo 'No hay hélices disponibles';
			      }
				while($rw2=mysqli_fetch_array($query2)) {
	              	echo '<p  class="col-sm-6"><input type="checkbox" name="helices[]" value="'.$rw2['heli_id'].'">'.$rw2['heli_serie'].'</p>';
	              }
	        }
          echo '      
        </div>
        </div>';

	echo '
		<div class="form-group row">
        <label for="baterias" class="col-sm-3 control-label">Baterías</label>
        <div class="col-sm-8">';
			$sql="SELECT * FROM products WHERE inactivo=0 AND id_producto='".$id_producto_bateria."'";
			$query = mysqli_query($con, $sql);
	      	$count=mysqli_num_rows($query);
		    if($count==0) {
		        echo 'No hay baterías disponibles';
		    }
		    else {
				$sql2="SELECT * FROM  baterias WHERE bat_casa=1 AND id_producto='".$id_producto_bateria."'";
				$query2 = mysqli_query($con, $sql2);
			      $count=mysqli_num_rows($query2);
			      if($count==0) {
			        echo 'No hay baterías disponibles';
			      }
				while($rw2=mysqli_fetch_array($query2)) {
	              	echo '<p  class="col-sm-6"><input type="checkbox" name="baterias[]" value="'.$rw2['bat_id'].'">'.$rw2['bat_serie'].'</p>';
	              }
	        }
          echo '      
        </div>
        </div>';

	echo '
		<div class="form-group row">
        <label for="carbaterias" class="col-sm-3 control-label">Cargadores de baterías</label>
        <div class="col-sm-8">';
			$sql="SELECT * FROM products WHERE inactivo=0 AND id_producto='".$id_producto_cargador_bat."'";
			$query = mysqli_query($con, $sql);
	      	$count=mysqli_num_rows($query);
		    if($count==0) {
		        echo 'No hay cargadores de baterías disponibles';
		    }
		    else {
				$sql2="SELECT * FROM  cargadores WHERE car_casa=1 AND id_producto='".$id_producto_cargador_bat."'";
				$query2 = mysqli_query($con, $sql2);
			      $count=mysqli_num_rows($query2);
			      if($count==0) {
			        echo 'No hay cargadores de baterías disponibles';
			      }
				while($rw2=mysqli_fetch_array($query2)) {
	              	echo '<p  class="col-sm-6"><input type="checkbox" name="carbaterias[]" value="'.$rw2['car_id'].'">'.$rw2['car_serie'].'</p>';
	              }
	        }
          echo '      
        </div>
        </div>';

	echo '
		<div class="form-group row">
        <label for="hub" class="col-sm-3 control-label">Hub</label>
        <div class="col-sm-8">';
			$sql="SELECT * FROM products WHERE inactivo=0 AND id_producto='".$id_producto_hub."'";
			$query = mysqli_query($con, $sql);
	      	$count=mysqli_num_rows($query);
		    if($count==0) {
		        echo 'No hay hubs disponibles';
		    }
		    else {
				$sql2="SELECT * FROM  hubs WHERE hub_casa=1 AND id_producto='".$id_producto_hub."'";
				$query2 = mysqli_query($con, $sql2);
			      $count=mysqli_num_rows($query2);
			      if($count==0) {
			        echo 'No hay hubs disponibles';
			      }
				while($rw2=mysqli_fetch_array($query2)) {
	              	echo '<p  class="col-sm-6"><input type="checkbox" name="hub[]" value="'.$rw2['hub_id'].'">'.$rw2['hub_serie'].'</p>';
	              }
	        }
          echo '      
        </div>
        </div>';

	echo '
		<div class="form-group row">
        <label for="alimentacion" class="col-sm-3 control-label">Cable de alimentación</label>
        <div class="col-sm-8">';
			$sql2="SELECT * FROM  products WHERE inactivo=0 AND stock_actual>0 AND id_producto='".$id_producto_alimentacion."'";
			$query2 = mysqli_query($con, $sql2);
		      $count=mysqli_num_rows($query2);
		      if($count==0) {
		        echo 'No hay cables de alimentación disponibles';
		      }
			while($rw2=mysqli_fetch_array($query2)) {
				echo '<input type="number" max="'.$rw2['stock_actual'].'" class="form-control" name="alimentacion" id="alimentacion" placeholder="Cantidad">';
              }
          echo '      
        </div>
        </div>';

	echo '
		<div class="form-group row">
        <label for="otg" class="col-sm-3 control-label">Cable OTG</label>
        <div class="col-sm-8">';
			$sql2="SELECT * FROM  products WHERE inactivo=0 AND stock_actual>0 AND id_producto='".$id_producto_otg."'";
			$query2 = mysqli_query($con, $sql2);
		      $count=mysqli_num_rows($query2);
		      if($count==0) {
		        echo 'No hay cables OTG disponibles';
		      }
			while($rw2=mysqli_fetch_array($query2)) {
				echo '<input type="number" max="'.$rw2['stock_actual'].'" class="form-control" name="otg" id="otg" placeholder="Cantidad">';
              }
          echo '      
        </div>
        </div>';

	echo '
		<div class="form-group row">
        <label for="usb" class="col-sm-3 control-label">Cable USB</label>
        <div class="col-sm-8">';
			$sql2="SELECT * FROM  products WHERE inactivo=0 AND stock_actual>0 AND id_producto='".$id_producto_usb."'";
			$query2 = mysqli_query($con, $sql2);
		      $count=mysqli_num_rows($query2);
		      if($count==0) {
		        echo 'No hay cables USB disponibles';
		      }
			while($rw2=mysqli_fetch_array($query2)) {
				echo '<input type="number" max="'.$rw2['stock_actual'].'" class="form-control" name="usb" id="usb" placeholder="Cantidad">';
              }
          echo '      
        </div>
        </div>';

	echo '
		<div class="form-group row">
        <label for="c" class="col-sm-3 control-label">Cable Type-C</label>
        <div class="col-sm-8">';
			$sql2="SELECT * FROM  products WHERE inactivo=0 AND stock_actual>0 AND id_producto='".$id_producto_c."'";
			$query2 = mysqli_query($con, $sql2);
		      $count=mysqli_num_rows($query2);
		      if($count==0) {
		        echo 'No hay cables Type-C disponibles';
		      }
			while($rw2=mysqli_fetch_array($query2)) {
				echo '<input type="number" max="'.$rw2['stock_actual'].'" class="form-control" name="c" id="c" placeholder="Cantidad">';
              }
          echo '      
        </div>
        </div>';

	echo '
		<div class="form-group row">
        <label for="lightning" class="col-sm-3 control-label">Cable Lightning</label>
        <div class="col-sm-8">';
			$sql2="SELECT * FROM  products WHERE inactivo=0 AND stock_actual>0 AND id_producto='".$id_producto_lightning."'";
			$query2 = mysqli_query($con, $sql2);
		      $count=mysqli_num_rows($query2);
		      if($count==0) {
		        echo 'No hay cables lightning disponibles';
		      }
			while($rw2=mysqli_fetch_array($query2)) {
				echo '<input type="number" max="'.$rw2['stock_actual'].'" class="form-control" name="lightning" id="lightning" placeholder="Cantidad">';
              }
          echo '      
        </div>
        </div>';

	echo '
		<div class="form-group row">
        <label for="memoria32" class="col-sm-3 control-label">Tarjeta MicroSD 32GB</label>
        <div class="col-sm-8">';
			$sql2="SELECT * FROM  products WHERE inactivo=0 AND stock_actual>0 AND id_producto='10'";
			$query2 = mysqli_query($con, $sql2);
		      $count=mysqli_num_rows($query2);
		      if($count==0) {
		        echo 'No hay Tarjeta SD 32GB disponibles';
		      }
			while($rw2=mysqli_fetch_array($query2)) {
				echo '<input type="number" max="'.$rw2['stock_actual'].'" class="form-control" name="memoria32" id="memoria32" placeholder="Cantidad">';
              }
          echo '      
        </div>
        </div>';

	echo '
		<div class="form-group row">
        <label for="memoria64" class="col-sm-3 control-label">Tarjeta MicroSD 64GB</label>
        <div class="col-sm-8">';
			$sql2="SELECT * FROM  products WHERE inactivo=0 AND stock_actual>0 AND id_producto='11'";
			$query2 = mysqli_query($con, $sql2);
		      $count=mysqli_num_rows($query2);
		      if($count==0) {
		        echo 'No hay Tarjeta SD 64GB disponibles';
		      }
			while($rw2=mysqli_fetch_array($query2)) {
				echo '<input type="number" max="'.$rw2['stock_actual'].'" class="form-control" name="memoria64" id="memoria64" placeholder="Cantidad">';
              }
          echo '      
        </div>
        </div>';

	echo '
		<div class="form-group row">
        <label for="memoria128" class="col-sm-3 control-label">Tarjeta MicroSD 128GB</label>
        <div class="col-sm-8">';
			$sql2="SELECT * FROM  products WHERE inactivo=0 AND stock_actual>0 AND id_producto='12'";
			$query2 = mysqli_query($con, $sql2);
		      $count=mysqli_num_rows($query2);
		      if($count==0) {
		        echo 'No hay Tarjeta SD 128GB disponibles';
		      }
			while($rw2=mysqli_fetch_array($query2)) {
				echo '<input type="number" max="'.$rw2['stock_actual'].'" class="form-control" name="memoria128" id="memoria128" placeholder="Cantidad">';
              }
          echo '      
        </div>
        </div>';

	echo '
		<div class="form-group row">
        <label for="pcsimulador" class="col-sm-3 control-label">PC Simulador</label>
        <div class="col-sm-8">';
			$sql="SELECT * FROM products WHERE inactivo=0 AND id_producto='66'";
			$query = mysqli_query($con, $sql);
	      	$count=mysqli_num_rows($query);
		    if($count==0) {
		        echo 'No hay PC Simulador disponibles';
		    }
		    else {
				$sql2="SELECT * FROM  simulador WHERE simulador_casa=1 AND id_producto='66'";
				$query2 = mysqli_query($con, $sql2);
			      $count=mysqli_num_rows($query2);
			      if($count==0) {
			        echo 'No hay PC Simulador disponibles';
			      }
				while($rw2=mysqli_fetch_array($query2)) {
	              	echo '<p  class="col-sm-6"><input type="checkbox" name="pcsimulador[]" value="'.$rw2['simulador_id'].'">'.$rw2['simulador_ref'].'</p>';
	              }
	        }
          echo '      
        </div>
        </div>';

	echo '
		<div class="form-group row">
        <label for="emisorasimulador" class="col-sm-3 control-label">Emisora Simulador</label>
        <div class="col-sm-8">';
			$sql="SELECT * FROM products WHERE inactivo=0 AND id_producto='65'";
			$query = mysqli_query($con, $sql);
	      	$count=mysqli_num_rows($query);
		    if($count==0) {
		        echo 'No hay Emisoras Simulador disponibles';
		    }
		    else {
				$sql2="SELECT * FROM  simulador WHERE simulador_casa=1 AND id_producto='65'";
				$query2 = mysqli_query($con, $sql2);
			      $count=mysqli_num_rows($query2);
			      if($count==0) {
			        echo 'No hay Emisoras Simulador disponibles';
			      }
				while($rw2=mysqli_fetch_array($query2)) {
	              	echo '<p  class="col-sm-6"><input type="checkbox" name="emisorasimulador[]" value="'.$rw2['simulador_id'].'">'.$rw2['simulador_ref'].'</p>';
	              }
	        }
          echo '      
        </div>
        </div>';

	echo '
		<div class="form-group row">
        <label for="botiquin" class="col-sm-3 control-label">Botiquines</label>
        <div class="col-sm-8">';
			$sql2="SELECT * FROM  products WHERE inactivo=0 AND stock_actual>0 AND id_producto='70'";
			$query2 = mysqli_query($con, $sql2);
		      $count=mysqli_num_rows($query2);
		      if($count==0) {
		        echo 'No hay botiquines disponibles';
		      }
			while($rw2=mysqli_fetch_array($query2)) {
				echo '<input type="number" max="'.$rw2['stock_actual'].'" class="form-control" name="botiquin" id="botiquin" placeholder="Cantidad">';
              }
          echo '      
        </div>
        </div>';

	echo '
		<div class="form-group row">
        <label for="arnes" class="col-sm-3 control-label">Arneses</label>
        <div class="col-sm-8">';
			$sql2="SELECT * FROM  products WHERE inactivo=0 AND stock_actual>0 AND id_producto='67'";
			$query2 = mysqli_query($con, $sql2);
		      $count=mysqli_num_rows($query2);
		      if($count==0) {
		        echo 'No hay arneses disponibles';
		      }
			while($rw2=mysqli_fetch_array($query2)) {
				echo '<input type="number" max="'.$rw2['stock_actual'].'" class="form-control" name="arnes" id="arnes" placeholder="Cantidad">';
              }
          echo '      
        </div>
        </div>';
}