<?php
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
    include("../funciones.php");
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $aColumns = array('firstname', 'lastname');//Columnas de busqueda
         $sTable = "instructores";
         $sWhere = "WHERE";
        
        $sWhere.=" inst_id='".$_SESSION['inst_id']."' order by firstname";
        //Count the total number of row in your table*/
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $reload = './perfil_ins.php';
        //main query to fetch the data
        $sql="SELECT * FROM  $sTable $sWhere";
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
						<td><?php echo $inst_email; ?></td>
						<?php }
						else { ?>
						<td ></td>
						<?php }
						if (!empty($inst_telefono)) { ?>
						<td><?php echo $inst_telefono; ?></td>
						<?php }
						else { ?>
						<td></td>
						<?php } ?>
						<td><?php echo $inst_direccion; ?></td>
						<td><?php echo $date_added;?></td>
						
					<td><span class="pull-right">
			          <a href="#" class='btn btn-default' title='Editar instructor' onclick="obtener_datos('<?php echo $inst_id;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a> 
			          <a href="#" class='btn btn-default' title='Cambiar contraseña' onclick="get_user_id('<?php echo $inst_id;?>');" data-toggle="modal" data-target="#myModal3"><i class="glyphicon glyphicon-cog"></i></a></span></td>
						
					</tr>
					<?php
				}
				?>
			  </table>
			</div>
			<?php
		}
	}
?>