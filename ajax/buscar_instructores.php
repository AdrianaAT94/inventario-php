<?php
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
    include("../funciones.php");
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$inst_id=intval($_GET['id']);
	    $n=nombre_instructor($inst_id);
	    $user_id=$_SESSION['user_id'];
	    $firstname=$_SESSION['firstname'];
	    $fecha=date("Y-m-d H:i:s");
		$query=mysqli_query($con, "select * from instructores where inst_id='".$inst_id."'");
		$rw_inst=mysqli_fetch_array($query);
		$count=$rw_inst['inst_id'];
		if ($delete1=mysqli_query($con,"UPDATE instructores SET inactivo=1 WHERE inst_id='".$inst_id."'")){
	          $nota="$firstname eliminó el instructor $n del inventario";
	          guardar_historial_instructores($inst_id,$user_id,$fecha,$nota);
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
    $inst_id=intval($_GET['activar_id']);    
    $n=nombre_instructor($inst_id);
    $user_id=$_SESSION['user_id'];
    $firstname=$_SESSION['firstname'];
    $fecha=date("Y-m-d H:i:s");
      if ($delete1=mysqli_query($con,"UPDATE instructores SET inactivo=0 WHERE inst_id='".$inst_id."'")){
          $nota="$firstname volvió añadir el instructor $n al inventario";
          guardar_historial_instructores($inst_id,$user_id,$fecha,$nota);
      ?>
      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Aviso!</strong> Instructor añadido.
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
		 $aColumns = array('firstname', 'lastname');//Columnas de busqueda
		 $sTable = "instructores";
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
		$sWhere.=" order by firstname";
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
		$reload = './instructores.php';
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
					<th>Provincia</th>
					<th>Agregado</th>
					<th><span class="pull-right">Acciones</span></th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$inst_id=$row['inst_id'];
						$fullname=$row['firstname']." ".$row["lastname"];
						$inst_email=$row['inst_email'];
						$inst_telefono=$row['inst_telefono'];
						$inst_direccion=$row['inst_direccion'];
						$date_added= date('d/m/Y', strtotime($row['date_added']));
						
					?>
					
					<input type="hidden" value="<?php echo $row['firstname'];?>" id="nombres<?php echo $inst_id;?>">
					<input type="hidden" value="<?php echo $row['lastname'];?>" id="apellidos<?php echo $inst_id;?>">
					<input type="hidden" value="<?php echo $inst_email;?>" id="email<?php echo $inst_id;?>">
					<input type="hidden" value="<?php echo $inst_telefono;?>" id="telefono<?php echo $inst_id;?>">
					<input type="hidden" value="<?php echo $inst_direccion;?>" id="direccion<?php echo $inst_id;?>">
				
					<tr>
						<td><?php echo $fullname; ?></td>
						<?php if (!empty($inst_email)) { ?>
						<td><a style="color: inherit; text-decoration: none;" href="mailto:<?php echo $inst_email; ?>"><?php echo $inst_email; ?></a></td>
						<?php }
						else { ?>
						<td ></td>
						<?php }
						if (!empty($inst_telefono)) { ?>
						<td><a style="color: inherit; text-decoration: none;" href="tel:<?php echo $inst_telefono; ?>"><?php echo $inst_telefono; ?></a></td>
						<?php }
						else { ?>
						<td></td>
						<?php } ?>
						<td><?php echo $inst_direccion; ?></td>
						<td><?php echo $date_added;?></td>
						
					<td><span class="pull-right">
					<a href="#" class='btn btn-default' title='Editar instructor' onclick="obtener_datos('<?php echo $inst_id;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a> 
         			<?php if ($_SESSION['admin'] == 1) { ?>
          			<a href="#" class='btn btn-default' title='Cambiar contraseña' onclick="get_user_id('<?php echo $inst_id;?>');" data-toggle="modal" data-target="#myModal3"><i class="glyphicon glyphicon-cog"></i></a>
         			<?php } ?>
					<a href="#" class='btn btn-default' title='Borrar instructor' onclick="eliminar('<?php echo $inst_id;?>');"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=9><span class="pull-right">
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