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
     $aColumns = array('n_convocatoria');//Columnas de busqueda
     $sTable = "invcon";
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
    $sWhere.=" order by n_convocatoria";
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
    $reload = './elem_convoc.php';
    //main query to fetch the data
    $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
    $query = mysqli_query($con, $sql);
    //loop through fetched data
    if ($numrows>0){
      
      ?>
      <div class="table-responsive">
        <table class="table">
        <tr  class="success">
          <th>Convocatoria</th>
          <th>Instructor</th>
          <th>Aula</th>
          <th>Campo de vuelo</th>
          <th style="text-align: center;">Fecha C.</th>
          <th style="text-align: center;">PDF</th>
          <th style="text-align: center;">Agregado</th>
          <th style="text-align: center;">Obs.</th>
          <th style="text-align: center;">Entregado</th>
          <th style="text-align: center;">Devuelto</th>
          
        </tr>
        <?php
        while ($row=mysqli_fetch_array($query)){
            $id_invcon=$row['invcon_id'];
            $n_convocatoria=$row['n_convocatoria'];
            $fecha_p=date('d/m/Y', strtotime($row['fecha_convocatoria']));
            $id_instructor=$row['id_instructor'];
            $n_instructor=nombre_instructor($id_instructor);
            $id_aula=$row['id_aula'];
            $n_aula=nombre_aula($id_aula);
            $id_campo=$row['id_campo'];
            $n_campo=nombre_campo($id_campo);
            $entregado=$row['entregado'];
            $devuelto=$row['devuelto'];
            $url_pdf=$row['url_pdf'];
            $date_added= date('d/m/Y', strtotime($row['fecha']));
            $obs_entre=$row['obs_entre'];
            $obs_devue=$row['obs_devue'];
                    
          ?>
          <input type="hidden" value="<?php echo $obs_entre;?>" id="t_entre<?php echo $id_invcon;?>">
          <input type="hidden" value="<?php echo $obs_devue;?>" id="t_devue<?php echo $id_invcon;?>">
          <tr>
            
            <td><a style="text-decoration: none; color: inherit;" href="convocatorias.php"><?php echo $n_convocatoria; ?></a></td>
            <td><a style="text-decoration: none; color: inherit;" href="instructores.php"><?php echo $n_instructor; ?></a></td>
            <td><a style="text-decoration: none; color: inherit;" href="aulas.php"><?php echo $n_aula;?></a></td>
            <td><a style="text-decoration: none; color: inherit;" href="campos.php"><?php echo $n_campo;?></a></td>
            <td style="text-align: center;"><?php echo $fecha_p;?></td>
            <?php if(!empty($url_pdf)) { ?>
              <td style="text-align: center;"><a target="_blank" style="color: inherit; text-decoration: none;" href="<?php echo $url_pdf; ?>"><strong>VER</strong></a></td>
            <?php } else { ?>
              <td style="text-align: center;"></td>
            <?php } ?>
            <td style="text-align: center;"><?php echo $date_added;?></td>
            <td onclick="ver_obs(<?php echo $id_invcon;?>)" style="cursor: pointer; text-align: center; font-size: 12px; text-decoration: none; color: inherit; font-weight: bold;">Ver</td>
            <?php if($entregado==0) { ?>
              <td style="text-align: center; font-size: 12px;"><input onclick="funcionEntregado('<?php echo $id_invcon; ?>')" type="radio" name="entregado<?php echo $id_invcon; ?>" value="1">SI
              <input type="radio" name="entregado<?php echo $id_invcon; ?>" value="0" checked disabled>NO</td>
            <?php } else { ?>
              <td style="text-align: center; font-size: 12px;"><input type="radio" name="entregado<?php echo $id_invcon; ?>" value="1" checked disabled>SI
              <input type="radio" name="entregado<?php echo $id_invcon; ?>" value="0" disabled>NO</td>
            <?php } ?>
            <?php if($entregado==1) { ?>
              <?php if($devuelto==0) { ?>
                <td style="text-align: center; font-size: 12px;"><input onclick="funcionDevuelto('<?php echo $id_invcon; ?>')" type="radio" name="devuelto<?php echo $id_invcon; ?>" value="1">SI
                <input type="radio" name="devuelto<?php echo $id_invcon; ?>" value="0" checked disabled>NO</td>
              <?php } else { ?>
                <td style="text-align: center; font-size: 12px;"><input type="radio" name="devuelto<?php echo $id_invcon; ?>" value="1" checked disabled>SI
                <input type="radio" name="devuelto<?php echo $id_invcon; ?>" value="0" disabled>NO</td>
              <?php } 
            }
            else { ?>
                <td style="text-align: center; font-size: 12px;"><input type="radio" name="devuelto<?php echo $id_invcon; ?>" value="1" disabled>SI
                <input type="radio" name="devuelto<?php echo $id_invcon; ?>" value="0" disabled>NO</td>
          <?php }
        }
        ?>
          </tr>
        <tr>
          <td colspan=10><span class="pull-right">
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