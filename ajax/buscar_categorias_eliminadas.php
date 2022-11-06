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
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
     $aColumns = array('nombre_categoria');//Columnas de busqueda
     $sTable = "categorias";
     $sWhere = "WHERE inactivo=1";
    if ( $_GET['q'] != "" )
    {
      $sWhere .= " and (";
      for ( $i=0 ; $i<count($aColumns) ; $i++ )
      {
        $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
      }
      $sWhere = substr_replace( $sWhere, "", -3 );
      $sWhere .= ') ';
    }
    $sWhere.=" order by nombre_categoria";
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
    $reload = './categorias_desactivado.php';
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
          <th>Descripción</th>
          <th>Agregado</th>
          <th class='text-right'>Acciones</th>
          
        </tr>
        <?php
        while ($row=mysqli_fetch_array($query)){
            $id_categoria=$row['id_categoria'];
            $nombre_categoria=$row['nombre_categoria'];
            $descripcion_categoria=$row['descripcion_categoria'];
            $date_added= date('d/m/Y', strtotime($row['date_added']));
            
          ?>
          <tr>
            
            <td><a style="text-decoration: none; color: inherit;" href="stock.php?cat=<?php echo $id_categoria; ?>"><?php echo $nombre_categoria; ?></a></td>
            <td ><?php echo $descripcion_categoria; ?></td>
            <td><?php echo $date_added;?></td>
            
          <td class='text-right'>
            <a href="#" class='btn btn-default' title='Editar categoría' data-nombre='<?php echo $nombre_categoria;?>' data-descripcion='<?php echo $descripcion_categoria?>' data-id='<?php echo $id_categoria;?>' data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a> 
            <a href="#" class='btn btn-default' title='Activar categoría' onclick="activar('<?php echo $id_categoria;?>');"><i class="glyphicon glyphicon-check"></i> </a></span>
          </td>
            
          </tr>
          <?php
        }
        ?>
        <tr>
          <td colspan=4><span class="pull-right">
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