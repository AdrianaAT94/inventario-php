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
     $id_categoria =intval($_REQUEST['id_categoria']);
     if(isset($_REQUEST['cat'])) {
        $id_categoria =$_REQUEST['cat'];
     }
     $aColumns = array('nombre_producto');//Columnas de busqueda
     $sTable = "products";
     $sWhere = "";
    
      $sWhere = "WHERE inactivo=1 and (";
      for ( $i=0 ; $i<count($aColumns) ; $i++ )
      {
        $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
      }
      $sWhere = substr_replace( $sWhere, "", -3 );
      $sWhere .= ')';
    
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
    $reload = './productos.php';
    //main query to fetch the data
    $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
    $query = mysqli_query($con, $sql);
    //loop through fetched data
    if ($numrows>0){
      
      ?>
        
        <?php
        $nums=1;
        while ($row=mysqli_fetch_array($query)){
            $id_producto=$row['id_producto'];
            $nombre_producto=$row['nombre_producto'];
            $foto_producto=$row['url_foto'];
            $stock=$row['stock_actual'];
            $catego=$row['id_categoria'];
                
            if (stripos($nombre_producto, "aeronave") !== false) {                
                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM aeronaves WHERE aero_casa=1 AND id_producto='".$id_producto."'");
                $row3= mysqli_fetch_array($query3);
                $stock=$row3['numrows'];
            }
                
            else if (stripos($nombre_producto, "simulador") !== false) {                
                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM simulador WHERE simulador_casa=1 AND id_producto='".$id_producto."'");
                $row3= mysqli_fetch_array($query3);
                $stock=$row3['numrows'];
            }
                
            else if (stripos($nombre_producto, "proyector") !== false) {                
                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM proyector WHERE proyector_casa=1 AND id_producto='".$id_producto."'");
                $row3= mysqli_fetch_array($query3);
                $stock=$row3['numrows'];
            }

            else if (stripos($nombre_producto, "emisora") !== false && stripos($nombre_producto, "cargador") === false) {                
                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM emisoras WHERE emi_casa=1 AND id_producto='".$id_producto."'");
                $row3= mysqli_fetch_array($query3);
                $stock=$row3['numrows'];
            }

            else if (stripos($nombre_producto, "hélice") !== false) {                
                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM helices WHERE heli_casa=1 AND id_producto='".$id_producto."'");
                $row3= mysqli_fetch_array($query3);
                $stock=$row3['numrows'];
            }

            else if (stripos($nombre_producto, "batería") !== false && stripos($nombre_producto, "cargador") === false) {                
                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM baterias WHERE bat_casa=1 AND id_producto='".$id_producto."'");
                $row3= mysqli_fetch_array($query3);
                $stock=$row3['numrows'];
            }

            else if (stripos($nombre_producto, "cargador") !== false) {                
                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM cargadores WHERE car_casa=1 AND id_producto='".$id_producto."'");
                $row3= mysqli_fetch_array($query3);
                $stock=$row3['numrows'];
            }

            else if (stripos($nombre_producto, "hub") !== false) {                
                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM hubs WHERE hub_casa=1 AND id_producto='".$id_producto."'");
                $row3= mysqli_fetch_array($query3);
                $stock=$row3['numrows'];
            }

          ?>
          
          <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 thumb text-center ng-scope" ng-repeat="item in records">
              <a class="thumbnail" href="producto.php?id=<?php echo $id_producto;?>">
                <span title="Current quantity" class="badge badge-default stock-counter ng-binding"><?php echo $stock; ?></span>
                <span title="Low stock" class="low-stock-alert ng-hide" ng-show="item.current_quantity <= item.low_stock_threshold"><i class="fa fa-exclamation-triangle"></i></span>
                <?php if (empty($foto_producto)) { ?>
                  <img style="width: 150px; height: 120px;" class="img-responsive" src="img/stock.png" alt="<?php echo $nombre_producto;?>">
                <?php } else { ?>
                  <img style="width: 150px; height: 120px;" class="img-responsive" src="img_inventario/<?php echo $foto_producto;?>" alt="<?php echo $nombre_producto;?>">
              <?php } ?>
              </a>
              <span class="thumb-name"><strong><?php echo $nombre_producto;?></strong></span>
          </div>
          
         <?php 

          if ($nums%6==0){
            echo "<div class='clearfix'></div>";
          }
          $nums++;
        }
        ?>
        <div class="clearfix"></div>
        <div class='row text-center'>
          <div ><?php
           echo paginate($reload, $page, $total_pages, $adjacents);
          ?></div>
        </div>
      
      <?php
    }
  }
?>
