<?php
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
    //Archivo de funciones PHP
    include("../funciones.php");  
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$campo_id=intval($_GET['id']);
	    $n=nombre_campo($campo_id);
	    $user_id=$_SESSION['user_id'];
	    $firstname=$_SESSION['firstname'];
	    $fecha=date("Y-m-d H:i:s");
		$query=mysqli_query($con, "select * from camposvuelo where campo_id='".$campo_id."'");
		$rw_campo=mysqli_fetch_array($query);
		$count=$rw_campo['campo_id'];
		if ($delete1=mysqli_query($con,"UPDATE camposvuelo SET inactivo=1 WHERE campo_id='".$campo_id."'")){
	          $nota="$firstname eliminĂ³ el campo de vuelo $n del inventario";
	          guardar_historial_campos($campo_id,$user_id,$fecha,$nota);
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
			</div>
			<?php
			
		}
		
	}
	  if (isset($_GET['activar_id'])){
	    $campo_id=intval($_GET['activar_id']);    
	    $n=nombre_campo($campo_id);
	    $user_id=$_SESSION['user_id'];
	    $firstname=$_SESSION['firstname'];
	    $fecha=date("Y-m-d H:i:s");
	      if ($delete1=mysqli_query($con,"UPDATE camposvuelo SET inactivo=0 WHERE campo_id='".$campo_id."'")){
	          $nota="$firstname volviĂ³ aĂ±adir el campo de vuelo $n al inventario";
	          guardar_historial_campos($campo_id,$user_id,$fecha,$nota);
	      ?>
	      <div class="alert alert-success alert-dismissible" role="alert">
	        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <strong>Aviso!</strong> Campo de vuelo aĂ±adido.
	      </div>
	      <?php 
	    }else {
	      ?>
	      <div class="alert alert-danger alert-dismissible" role="alert">
	        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
	      </div>
	      <?php
	    }
	  }
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('campo_name', 'campo_poblacion', 'campo_email');//Columnas de busqueda
		 $sTable = "camposvuelo";
     	 $sWhere = "WHERE inactivo=0";
		if ( $_GET['q'] != "" )
		{
			$sWhere .= " and (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" order by campo_name";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './campos.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="success">
					<th>Nombre</th>
					<th>Email</th>
					<th>TelĂ©fono</th>
					<th>PoblaciĂ³n</th>
					<th>Google Maps</th>
					<th>Agregado</th>
					<th><span class="pull-right">Acciones</span></th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$campo_id=$row['campo_id'];
						$campo_name=$row['campo_name'];
						$campo_email=$row['campo_email'];
						$campo_telefono=$row['campo_telefono'];
						$campo_poblacion=$row['campo_poblacion'];
						$campo_maps=$row['campo_maps'];
						$date_added= date('d/m/Y', strtotime($row['date_added']));
						
					?>
					
					<input type="hidden" value="<?php echo $campo_name;?>" id="names<?php echo $campo_id;?>">
					<input type="hidden" value="<?php echo $campo_email;?>" id="email<?php echo $campo_id;?>">
					<input type="hidden" value="<?php echo $campo_telefono;?>" id="telefono<?php echo $campo_id;?>">
					<input type="hidden" value="<?php echo $campo_poblacion;?>" id="poblacion<?php echo $campo_id;?>">
					<input type="hidden" value="<?php echo $campo_maps;?>" id="mapas<?php echo $campo_id;?>">
				
					<tr>
						<td><?php echo $campo_name; ?></td>
						<?php if (!empty($campo_email)) { ?>
						<td><a style="color: inherit; text-decoration: none;" href="mailto:<?php echo $campo_email; ?>"><?php echo $campo_email; ?></a></td>
						<?php }
						else { ?>
						<td ></td>
						<?php }
						if (!empty($campo_telefono)) { ?>
						<td><a style="color: inherit; text-decoration: none;" href="tel:<?php echo $campo_telefono; ?>"><?php echo $campo_telefono; ?></a></td>
						<?php }
						else { ?>
						<td></td>
						<?php } ?>
						<td><?php echo $campo_poblacion; ?></td>
						<?php if (!empty($campo_maps)) { ?>
						<td><a target="_blank" style="color: inherit; text-decoration: none;" href="<?php echo $campo_maps; ?>"><strong>Enlace</strong></a></td>
						<?php }
						else { ?>
						<td></td>
						<?php } ?>
						<td><?php echo $date_added;?></td>
						
					<td><span class="pull-right">
					<a href="#" class='btn btn-default' title='Editar campo de vuelo' onclick="obtener_datos('<?php echo $campo_id;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a> 
					<a href="#" class='btn btn-default' title='Borrar campo de vuelo' onclick="eliminar('<?php echo $campo_id;?>');"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=7><span class="pull-right">
					<?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>