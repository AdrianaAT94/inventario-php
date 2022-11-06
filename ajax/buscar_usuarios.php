<?php
  /* Connect To Database*/
  require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
  include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
  include("../funciones.php");  
  $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
  if (isset($_GET['id'])){
    $user_id=intval($_GET['id']);
    $n=nombre_usuario($user_id);
    $admin_id=$_SESSION['user_id'];
    $firstname=$_SESSION['firstname'];
    $fecha=date("Y-m-d H:i:s");
    $query=mysqli_query($con, "select * from users where inactivo=0 and user_id='".$user_id."'");
    $rw_user=mysqli_fetch_array($query);
    $count=$rw_user['user_id'];
    $admin=$rw_user['admin'];
    if ($admin!=1){
      if ($delete1=mysqli_query($con,"UPDATE users SET inactivo=1 WHERE user_id='".$user_id."'")){
            $nota="$firstname eliminó el usuario $n de la aplicación";
            guardar_historial_users($user_id,$admin_id,$fecha,$nota);
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
      
    } else {
      ?>
      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Error!</strong> No se puede borrar el usuario administrador. 
      </div>
      <?php
    }
        
  }
  if (isset($_GET['activar_id'])){
    $user_id=intval($_GET['activar_id']);
    $n=nombre_usuario($user_id);
    $admin_id=$_SESSION['user_id'];
    $firstname=$_SESSION['firstname'];
    $fecha=date("Y-m-d H:i:s");
      if ($delete1=mysqli_query($con,"UPDATE users SET inactivo=0 WHERE user_id='".$user_id."'")){
            $nota="$firstname volvió activar al usuario $n de la aplicación";
            guardar_historial_users($user_id,$admin_id,$fecha,$nota);
      ?>
      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Aviso!</strong> Usuario activado.
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
    if ($_SESSION['admin'] == 1) {
        // escaping, additionally removing everything that could be (html/javascript-) code
             $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
         $aColumns = array('firstname', 'lastname');//Columnas de busqueda
         $sTable = "users";
         $sWhere = "";
        if ( $_GET['q'] != "" )
        {
          $sWhere = " WHERE (";
          for ( $i=0 ; $i<count($aColumns) ; $i++ )
          {
            $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
          }
          $sWhere = substr_replace( $sWhere, "", -3 );
          $sWhere .= ') AND';
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
        $reload = './usuarios.php';
        //main query to fetch the data
        $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
        $query = mysqli_query($con, $sql);
  }
  else {
        // escaping, additionally removing everything that could be (html/javascript-) code
         $aColumns = array('firstname', 'lastname');//Columnas de busqueda
         $sTable = "users";
         $sWhere = "WHERE";
        
        $sWhere.=" user_id='".$_SESSION['user_id']."' order by firstname";
        //Count the total number of row in your table*/
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $reload = './usuarios.php';
        //main query to fetch the data
        $sql="SELECT * FROM  $sTable $sWhere";
        $query = mysqli_query($con, $sql);
  }
    //loop through fetched data
    if ($numrows>0){
      
      ?>
      <div class="table-responsive">
        <table class="table">
        <tr  class="success">
          <th>Nombre</th>
          <th>Usuario</th>
          <th>Email</th>
          <th>Agregado</th>
          <?php if ($_SESSION['admin'] == 1) { ?>
          <th>Eliminado</th>
          <?php } ?>
          <th><span class="pull-right">Acciones</span></th>
          
        </tr>
        <?php
        while ($row=mysqli_fetch_array($query)){
            $user_id=$row['user_id'];
            $fullname=$row['firstname']." ".$row["lastname"];
            $user_name=$row['user_name'];
            $user_email=$row['user_email'];
            $inactivo=$row['inactivo'];
            $date_added= date('d/m/Y', strtotime($row['date_added']));
            
          ?>
          
          <input type="hidden" value="<?php echo $row['firstname'];?>" id="nombres<?php echo $user_id;?>">
          <input type="hidden" value="<?php echo $row['lastname'];?>" id="apellidos<?php echo $user_id;?>">
          <input type="hidden" value="<?php echo $user_name;?>" id="usuario<?php echo $user_id;?>">
          <input type="hidden" value="<?php echo $user_email;?>" id="email<?php echo $user_id;?>">
        
          <tr>
            <td><?php echo $fullname; ?></td>
            <td ><?php echo $user_name; ?></td>
            <td ><?php echo $user_email; ?></td>
            <td><?php echo $date_added;?></td>
            <?php if ($_SESSION['admin'] == 1) { 
              if ($inactivo==1) { ?>
                <td>SI</td>
                <?php } else { ?>
                <td>NO</td>
            <?php }
          } ?>
            
          <td ><span class="pull-right">
          <a href="#" class='btn btn-default' title='Editar usuario' onclick="obtener_datos('<?php echo $user_id;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a> 
          <a href="#" class='btn btn-default' title='Cambiar contraseña' onclick="get_user_id('<?php echo $user_id;?>');" data-toggle="modal" data-target="#myModal3"><i class="glyphicon glyphicon-cog"></i></a>
          <?php if ($_SESSION['admin'] == 1) { 
            if ($inactivo==1) { ?>
          <a href="#" class='btn btn-default' title='Activar usuario' onclick="activar('<?php echo $user_id;?>');"><i class="glyphicon glyphicon-check"></i> </a></span>
                <?php } else { ?>
          <a href="#" class='btn btn-default' title='Borrar usuario' onclick="eliminar('<?php echo $user_id;?>');"><i class="glyphicon glyphicon-trash"></i> </a></span>
          <?php } 
          } ?>
          </td>
            
          </tr>
          <?php
        }
    if ($_SESSION['admin'] == 1) {
        ?>
        <tr>
          <td colspan=6><span class="pull-right">
          <?php
           echo paginate($reload, $page, $total_pages, $adjacents);
          ?></span></td>
        </tr>
      <?php } ?>
        </table>
      </div>
      <?php
    }
  }
?>