<?php
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
    //Archivo de funciones PHP
    include("../funciones.php");  
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$aula_id=intval($_GET['id']);
	    $n=nombre_aula($aula_id);
	    $user_id=$_SESSION['user_id'];
        $firstname=$_SESSION['firstname']." ".$_SESSION['lastname'];
	    $fecha=date("Y-m-d H:i:s");
		$query=mysqli_query($con, "select * from aulas where aula_id='".$aula_id."'");
		$rw_aula=mysqli_fetch_array($query);
		$count=$rw_aula['aula_id'];
		if ($delete1=mysqli_query($con,"UPDATE aulas SET inactivo=1 WHERE aula_id='".$aula_id."'")){
	          $nota="$firstname eliminó el aula $n del inventario";
	          guardar_historial_aulas($aula_id,$user_id,$fecha,$nota);
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
	    $aula_id=intval($_GET['activar_id']);    
	    $n=nombre_aula($aula_id);
	    $user_id=$_SESSION['user_id'];
        $firstname=$_SESSION['firstname']." ".$_SESSION['lastname'];
	    $fecha=date("Y-m-d H:i:s");
	      if ($delete1=mysqli_query($con,"UPDATE aulas SET inactivo=0 WHERE aula_id='".$aula_id."'")){
	          $nota="$firstname volvió añadir el aula $n al inventario";
	          guardar_historial_aulas($aula_id,$user_id,$fecha,$nota);
	      ?>
	      <div class="alert alert-success alert-dismissible" role="alert">
	        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <strong>Aviso!</strong> Aula añadida.
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
		 $aColumns = array('aula_name', 'aula_poblacion', 'aula_email');//Columnas de busqueda
		 $sTable = "aulas";
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
		$sWhere.=" order by aula_name";
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
		$reload = './aulas.php';
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
					<th>Teléfono</th>
					<th>Población</th>
					<th>Google Maps</th>
					<th>Agregado</th>
					<th><span class="pull-right">Acciones</span></th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$aula_id=$row['aula_id'];
						$aula_name=$row['aula_name'];
						$aula_email=$row['aula_email'];
						$aula_telefono=$row['aula_telefono'];
						$aula_poblacion=$row['aula_poblacion'];
						$aula_maps=$row['aula_maps'];
						$date_added= date('d/m/Y', strtotime($row['date_added']));
						
					?>
					
					<input type="hidden" value="<?php echo $aula_name;?>" id="names<?php echo $aula_id;?>">
					<input type="hidden" value="<?php echo $aula_email;?>" id="email<?php echo $aula_id;?>">
					<input type="hidden" value="<?php echo $aula_telefono;?>" id="telefono<?php echo $aula_id;?>">
					<input type="hidden" value="<?php echo $aula_poblacion;?>" id="poblacion<?php echo $aula_id;?>">
					<input type="hidden" value="<?php echo $aula_maps;?>" id="mapas<?php echo $aula_id;?>">
				
					<tr>
						<td><?php echo $aula_name; ?></td>
						<?php if (!empty($aula_email)) { ?>
						<td><a style="color: inherit; text-decoration: none;" href="mailto:<?php echo $aula_email; ?>"><?php echo $aula_email; ?></a></td>
						<?php }
						else { ?>
						<td ></td>
						<?php }
						if (!empty($aula_telefono)) { ?>
						<td><a style="color: inherit; text-decoration: none;" href="tel:<?php echo $aula_telefono; ?>"><?php echo $aula_telefono; ?></a></td>
						<?php }
						else { ?>
						<td></td>
						<?php } ?>
						<td><?php echo $aula_poblacion; ?></td>
						<?php if (!empty($aula_maps)) { ?>
						<td><a target="_blank" style="color: inherit; text-decoration: none;" href="<?php echo $aula_maps; ?>"><strong>Enlace</strong></a></td>
						<?php }
						else { ?>
						<td></td>
						<?php } ?>
						<td><?php echo $date_added;?></td>
						
					<td><span class="pull-right">
					<a href="#" class='btn btn-default' title='Editar aula' onclick="obtener_datos('<?php echo $aula_id;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a> 
					<a href="#" class='btn btn-default' title='Borrar aula' onclick="eliminar('<?php echo $aula_id;?>');"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
						
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