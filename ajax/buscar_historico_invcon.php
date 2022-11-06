<?php
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';	
	if($action == 'ajax'){
	    if ($_SESSION['admin'] == 1) {
			// escaping, additionally removing everything that could be (html/javascript-) code
	         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
			 $aColumns = array('nota');//Columnas de busqueda
			 $sTable = "historial_invcon";
			 $sWhere = "";
			if ( $_GET['q'] != "" )
			{
				$sWhere = "WHERE (";
				for ( $i=0 ; $i<count($aColumns) ; $i++ )
				{
					$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
				}
				$sWhere = substr_replace( $sWhere, "", -3 );
				$sWhere .= ')';
			}
			$sWhere.=" order by id_historial_invcon desc";
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
			$reload = './historico_invcon.php';
			//main query to fetch the data
			$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
			$query = mysqli_query($con, $sql);
			//loop through fetched data
		}
		else {
	        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
			$aColumns = array('nota');//Columnas de busqueda
			$sTable = "historial_invcon";
			$sWhere = "WHERE user_id=".$_SESSION['user_id'];
			if ( $_GET['q'] != "" )
			{
				$sWhere .= " AND (";
				for ( $i=0 ; $i<count($aColumns) ; $i++ )
				{
					$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
				}
				$sWhere = substr_replace( $sWhere, "", -3 );
				$sWhere .= ')';
			}

			$sWhere.=" order by id_historial_invcon desc";
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
			$reload = './historico_invcon.php';
			//main query to fetch the data
			$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
			$query = mysqli_query($con, $sql);
			
		}
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr class="success">
	              <td>Fecha</td>
	              <td>Hora</td>
	              <td>Descripción</td>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$fecha=date('d/m/Y', strtotime($row['fecha']));
						$hora=date('H:i:s', strtotime($row['fecha']));;
						$desc=$row['nota'];
						
					?>
					
				
					<tr>
						<td><?php echo $fecha; ?></td>
						<td><?php echo $hora; ?></td>
						<td><?php echo $desc; ?></td>
						
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