<?php
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
    include("../funciones.php");
	$con2 = mysqli_connect("31.193.227.98", "cursoded_encuest", "ZKD,Ey8EzqgQ", "cursoded_encuesta");
	mysqli_set_charset($con2, 'utf8');
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con2,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('convocatoria');//Columnas de busqueda
		 $sTable = "convocatorias";
     	 $sWhere = "";
		if ( $_GET['q'] != "" )
		{
			$sWhere = " WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" order by convocatoria";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con2, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './convocatorias.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con2, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="success">
					<th>Convocatoria</th>
					<th>Fecha Presencial</th>
					<th>Agregado</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$con_id=$row['id'];
						$nombre=$row['convocatoria'];
						$fecha_p=date('d/m/Y', strtotime($row['fecha_presencial']));
						$date_added= date('d/m/Y', strtotime($row['fecha_subida']));
						
					?>
									
					<tr>
						<td><?php echo $nombre; ?></td>
						<td><?php echo $fecha_p; ?></td>
						<td><?php echo $date_added;?></td>
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=3><span class="pull-right">
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