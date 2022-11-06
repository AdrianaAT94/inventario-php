<?php
  include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
  /* Connect To Database*/
  require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
  //Archivo de funciones PHP
  include("../funciones.php");
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
    // escaping, additionally removing everything that could be (html/javascript-) code
     $id_categoria =intval($_REQUEST['id_categoria']);
	 $sTable = "products";
	 $sWhere = "WHERE inactivo=0";
	
	if ($id_categoria>0){
		$sWhere .=" and id_categoria='$id_categoria'";
	}
	$sWhere.=" order by id_producto desc";
    include 'pagination.php'; //include pagination file
    //pagination variables
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    $per_page = 18; //how much records you want to show
    $adjacents  = 4; //gap between pages after number of adjacents
    $offset = ($page - 1) * $per_page;
    //Count the total number of row in your table*/
    $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
    $row= mysqli_fetch_array($count_query);
    $numrows = $row['numrows'];
    $total_pages = ceil($numrows/$per_page);
    $reload = './reportes.php';
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
					<th>Categoría</th>
					<th style="text-align: center;">Stock total</th>
					<th style="text-align: center;">Stock actual</th>
					<th style="text-align: center;">Stock en curso</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
		            $id_producto=$row['id_producto'];
		            $nombre_producto=$row['nombre_producto'];
		            $stock_actual=$row['stock_actual'];
		            $stock_total=$row['stock'];
		            $stock_fuera=$row['stock_fuera'];
		            $catego=$row['id_categoria'];

				    $sql3="SELECT * FROM categorias WHERE id_categoria='".$catego."'";
				    $query3 = mysqli_query($con, $sql3);
					while ($row3=mysqli_fetch_array($query3)){
						$nombre_categoria = $row3['nombre_categoria'];
					} 

		            if (stripos($nombre_producto, "aeronave") !== false) {                
		                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM aeronaves WHERE aero_casa=1 AND id_producto='".$id_producto."'");
		                $row3= mysqli_fetch_array($query3);
		                $stock_actual=$row3['numrows'];    

		                $query4 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM aeronaves WHERE id_producto='".$id_producto."'");
		                $row4= mysqli_fetch_array($query4);
		                $stock_total=$row4['numrows'];
		            }

		            else if (stripos($nombre_producto, "simulador") !== false) {                
		                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM simulador WHERE simulador_casa=1 AND id_producto='".$id_producto."'");
		                $row3= mysqli_fetch_array($query3);
		                $stock_actual=$row3['numrows'];    

		                $query4 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM simulador WHERE id_producto='".$id_producto."'");
		                $row4= mysqli_fetch_array($query4);
		                $stock_total=$row4['numrows'];
		            }

		            else if (stripos($nombre_producto, "proyector") !== false) {                
		                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM proyector WHERE proyector_casa=1 AND id_producto='".$id_producto."'");
		                $row3= mysqli_fetch_array($query3);
		                $stock_actual=$row3['numrows'];    

		                $query4 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM proyector WHERE id_producto='".$id_producto."'");
		                $row4= mysqli_fetch_array($query4);
		                $stock_total=$row4['numrows'];
		            }

		            else if (stripos($nombre_producto, "emisora") !== false && stripos($nombre_producto, "cargador") === false) {                
		                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM emisoras WHERE emi_casa=1 AND id_producto='".$id_producto."'");
		                $row3= mysqli_fetch_array($query3);
		                $stock_actual=$row3['numrows'];    

		                $query4 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM emisoras WHERE id_producto='".$id_producto."'");
		                $row4= mysqli_fetch_array($query4);
		                $stock_total=$row4['numrows'];
		            }

		            else if (stripos($nombre_producto, "hélice") !== false) {                
		                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM helices WHERE heli_casa=1 AND id_producto='".$id_producto."'");
		                $row3= mysqli_fetch_array($query3);
		                $stock_actual=$row3['numrows'];    

		                $query4 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM helices WHERE id_producto='".$id_producto."'");
		                $row4= mysqli_fetch_array($query4);
		                $stock_total=$row4['numrows'];
		            }

		            else if (stripos($nombre_producto, "batería") !== false && stripos($nombre_producto, "cargador") === false) {                
		                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM baterias WHERE bat_casa=1 AND id_producto='".$id_producto."'");
		                $row3= mysqli_fetch_array($query3);
		                $stock_actual=$row3['numrows'];    

		                $query4 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM baterias WHERE id_producto='".$id_producto."'");
		                $row4= mysqli_fetch_array($query4);
		                $stock_total=$row4['numrows'];
		            }

		            else if (stripos($nombre_producto, "cargador") !== false) {                
		                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM cargadores WHERE car_casa=1 AND id_producto='".$id_producto."'");
		                $row3= mysqli_fetch_array($query3);
		                $stock_actual=$row3['numrows'];    

		                $query4 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM cargadores WHERE id_producto='".$id_producto."'");
		                $row4= mysqli_fetch_array($query4);
		                $stock_total=$row4['numrows'];
		            }

		            else if (stripos($nombre_producto, "hub") !== false) {                
		                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM hubs WHERE hub_casa=1 AND id_producto='".$id_producto."'");
		                $row3= mysqli_fetch_array($query3);
		                $stock_actual=$row3['numrows'];    

		                $query4 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM hubs WHERE id_producto='".$id_producto."'");
		                $row4= mysqli_fetch_array($query4);
		                $stock_total=$row4['numrows'];
		            }

					?>
					
				
					<tr>
						<td><a style="text-decoration: none; color: inherit;" href="producto.php?id=<?php echo $id_producto;?>"><?php echo $nombre_producto; ?></a></td>
						<td><?php echo $nombre_categoria; ?></td>
						<td style="text-align: center;"><?php echo $stock_total; ?></td>
						<td style="text-align: center;"><?php echo $stock_actual; ?></td>
						<td style="text-align: center;"><?php echo $stock_fuera; ?></td>
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=5><span class="pull-right">
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