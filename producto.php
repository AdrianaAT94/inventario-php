<?php
  session_start();
  if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
    exit;
        }

  /* Connect To Database*/
  require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
  include("funciones.php");
  
  $active_productos="active";
  $active_categoria="";
  $active_reportes="";  
  $active_historico="";
  $active_instructores="";
  $active_aulas="";
  $active_campos="";
  $active_convocatorias="";
  $active_elem_con="";
  $active_usuarios="";
  $title="Producto | Aerocamaras";
  
  if (isset($_POST['reference']) and isset($_POST['quantity'])){
    $quantity=intval($_POST['quantity']);
    $reference=mysqli_real_escape_string($con,(strip_tags($_POST["reference"],ENT_QUOTES)));
    $id_producto=intval($_GET['id']);
    $user_id=$_SESSION['user_id'];
    $firstname=$_SESSION['firstname'];
    $n=nombre_producto($id_producto);
    $nota_stock="$firstname agregó $quantity unidad(es) del producto $n al inventario";
    $fecha=date("Y-m-d H:i:s");
    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
    $update=agregar_stock($id_producto,$quantity);
    if ($update==1){
      $message=1;
    } else {
      $error=1;
    }
  }
  
  if (isset($_POST['reference_remove']) and isset($_POST['quantity_remove'])){
    $quantity=intval($_POST['quantity_remove']);
    $reference=mysqli_real_escape_string($con,(strip_tags($_POST["reference_remove"],ENT_QUOTES)));
    $id_producto=intval($_GET['id']);
    $user_id=$_SESSION['user_id'];
    $firstname=$_SESSION['firstname'];
    $n=nombre_producto($id_producto);
    $nota_stock="$firstname eliminó $quantity unidad(es) del producto $n del inventario";
    $fecha=date("Y-m-d H:i:s");
    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
    $update=eliminar_stock($id_producto,$quantity);
    if ($update==1){
      $message=1;
    } else {
      $error=1;
    }
  }

  //NAVES

  if (isset($_POST['reference_nave']) and isset($_POST['numserie'])){
    $numserie=mysqli_real_escape_string($con,(strip_tags($_POST["numserie"],ENT_QUOTES)));
    $reference_nave=mysqli_real_escape_string($con,(strip_tags($_POST["reference_nave"],ENT_QUOTES)));
    $id_producto=intval($_GET['id']);
    $user_id=$_SESSION['user_id'];
    $firstname=$_SESSION['firstname'];
    $n=nombre_producto($id_producto);
    $nota_stock="$firstname agregó el elemento $numserie al producto $n";
    $fecha=date("Y-m-d H:i:s");
    $quantity = 1;
    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference_nave,$quantity);
    $update=agregar_stock_nave($id_producto,$numserie);
    if ($update==1){
      $message=1;
    } else {
      $error=1;
    }
  }
  
  if (isset($_POST['reference_remove_nave']) and isset($_POST['numserie'])){
    $aero_id =intval($_REQUEST['numserie']);
    $sss = mysqli_query($con, "SELECT aero_serie FROM aeronaves WHERE aero_id='".$aero_id."'");
    $sssrow= mysqli_fetch_array($sss);
    $numserie = $sssrow['aero_serie'];
    $reference_remove_nave=mysqli_real_escape_string($con,(strip_tags($_POST["reference_remove_nave"],ENT_QUOTES)));
    $id_producto=intval($_GET['id']);
    $user_id=$_SESSION['user_id'];
    $firstname=$_SESSION['firstname'];
    $n=nombre_producto($id_producto);
    $nota_stock="$firstname eliminó el elemento $numserie del producto $n";
    $fecha=date("Y-m-d H:i:s");
    $quantity = 1;
    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference_remove_nave,$quantity);
    $update=eliminar_stock_nave($aero_id);
    if ($update==1){
      $message=1;
    } else {
      $error=1;
    }
  }

  //SIMULADOR

  if (isset($_POST['reference_simulador']) and isset($_POST['nombre'])){
    $nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
    $reference_simulador=mysqli_real_escape_string($con,(strip_tags($_POST["reference_simulador"],ENT_QUOTES)));
    $id_producto=intval($_GET['id']);
    $user_id=$_SESSION['user_id'];
    $firstname=$_SESSION['firstname'];
    $n=nombre_producto($id_producto);
    $nota_stock="$firstname agregó el elemento $nombre al producto $n";
    $fecha=date("Y-m-d H:i:s");
    $quantity = 1;
    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference_simulador,$quantity);
    $update=agregar_stock_simulador($id_producto,$nombre);
    if ($update==1){
      $message=1;
    } else {
      $error=1;
    }
  }
  
  if (isset($_POST['reference_remove_simulador']) and isset($_POST['nombre'])){
    $simulador_id =intval($_REQUEST['nombre']);
    $sss = mysqli_query($con, "SELECT simulador_ref FROM simulador WHERE simulador_id='".$simulador_id."'");
    $sssrow= mysqli_fetch_array($sss);
    $nombre = $sssrow['simulador_ref'];
    $reference_remove_simulador=mysqli_real_escape_string($con,(strip_tags($_POST["reference_remove_simulador"],ENT_QUOTES)));
    $id_producto=intval($_GET['id']);
    $user_id=$_SESSION['user_id'];
    $firstname=$_SESSION['firstname'];
    $n=nombre_producto($id_producto);
    $nota_stock="$firstname eliminó el elemento $nombre del producto $n";
    $fecha=date("Y-m-d H:i:s");
    $quantity = 1;
    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference_remove_simulador,$quantity);
    $update=eliminar_stock_simulador($simulador_id);
    if ($update==1){
      $message=1;
    } else {
      $error=1;
    }
  }

  //PROYECTOR

  if (isset($_POST['reference_proyector']) and isset($_POST['nombre'])){
    $nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
    $reference_proyector=mysqli_real_escape_string($con,(strip_tags($_POST["reference_proyector"],ENT_QUOTES)));
    $id_producto=intval($_GET['id']);
    $user_id=$_SESSION['user_id'];
    $firstname=$_SESSION['firstname'];
    $n=nombre_producto($id_producto);
    $nota_stock="$firstname agregó el elemento $nombre al producto $n";
    $fecha=date("Y-m-d H:i:s");
    $quantity = 1;
    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference_proyector,$quantity);
    $update=agregar_stock_proyector($id_producto,$nombre);
    if ($update==1){
      $message=1;
    } else {
      $error=1;
    }
  }
  
  if (isset($_POST['reference_remove_proyector']) and isset($_POST['nombre'])){
    $proyector_id =intval($_REQUEST['nombre']);
    $sss = mysqli_query($con, "SELECT proyector_serie FROM proyector WHERE proyector_id='".$proyector_id."'");
    $sssrow= mysqli_fetch_array($sss);
    $nombre = $sssrow['proyector_serie'];
    $reference_remove_proyector=mysqli_real_escape_string($con,(strip_tags($_POST["reference_remove_proyector"],ENT_QUOTES)));
    $id_producto=intval($_GET['id']);
    $user_id=$_SESSION['user_id'];
    $firstname=$_SESSION['firstname'];
    $n=nombre_producto($id_producto);
    $nota_stock="$firstname eliminó el elemento $nombre del producto $n";
    $fecha=date("Y-m-d H:i:s");
    $quantity = 1;
    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference_remove_proyector,$quantity);
    $update=eliminar_stock_proyector($proyector_id);
    if ($update==1){
      $message=1;
    } else {
      $error=1;
    }
  }

  //EMISORAS

  if (isset($_POST['reference_emisora']) and isset($_POST['numserie'])){
    $numserie=mysqli_real_escape_string($con,(strip_tags($_POST["numserie"],ENT_QUOTES)));
    $reference_emisora=mysqli_real_escape_string($con,(strip_tags($_POST["reference_emisora"],ENT_QUOTES)));
    $id_producto=intval($_GET['id']);
    $user_id=$_SESSION['user_id'];
    $firstname=$_SESSION['firstname'];
    $n=nombre_producto($id_producto);
    $nota_stock="$firstname agregó el elemento $numserie al producto $n";
    $fecha=date("Y-m-d H:i:s");
    $quantity = 1;
    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference_emisora,$quantity);
    $update=agregar_stock_emisora($id_producto,$numserie);
    if ($update==1){
      $message=1;
    } else {
      $error=1;
    }
  }
  
  if (isset($_POST['reference_remove_emisora']) and isset($_POST['numserie'])){
    $emi_id =intval($_REQUEST['numserie']);
    $sss = mysqli_query($con, "SELECT emi_serie FROM emisoras WHERE emi_id='".$emi_id."'");
    $sssrow= mysqli_fetch_array($sss);
    $numserie = $sssrow['emi_serie'];
    $reference_remove_emisora=mysqli_real_escape_string($con,(strip_tags($_POST["reference_remove_emisora"],ENT_QUOTES)));
    $id_producto=intval($_GET['id']);
    $user_id=$_SESSION['user_id'];
    $firstname=$_SESSION['firstname'];
    $n=nombre_producto($id_producto);
    $nota_stock="$firstname eliminó el elemento $numserie del producto $n";
    $fecha=date("Y-m-d H:i:s");
    $quantity = 1;
    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference_remove_emisora,$quantity);
    $update=eliminar_stock_emisora($emi_id);
    if ($update==1){
      $message=1;
    } else {
      $error=1;
    }
  }

  //HÉLICES

  if (isset($_POST['reference_helices']) and isset($_POST['numserie'])){
    $numserie=mysqli_real_escape_string($con,(strip_tags($_POST["numserie"],ENT_QUOTES)));
    $reference_helices=mysqli_real_escape_string($con,(strip_tags($_POST["reference_helices"],ENT_QUOTES)));
    $id_producto=intval($_GET['id']);
    $user_id=$_SESSION['user_id'];
    $firstname=$_SESSION['firstname'];
    $n=nombre_producto($id_producto);
    $nota_stock="$firstname agregó el elemento $numserie al producto $n";
    $fecha=date("Y-m-d H:i:s");
    $quantity = 1;
    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference_helices,$quantity);
    $update=agregar_stock_helices($id_producto,$numserie);
    if ($update==1){
      $message=1;
    } else {
      $error=1;
    }
  }
  
  if (isset($_POST['reference_remove_helices']) and isset($_POST['numserie'])){
    $heli_id =intval($_REQUEST['numserie']);
    $sss = mysqli_query($con, "SELECT heli_serie FROM helices WHERE heli_id='".$heli_id."'");
    $sssrow= mysqli_fetch_array($sss);
    $numserie = $sssrow['heli_serie'];
    $reference_remove_helices=mysqli_real_escape_string($con,(strip_tags($_POST["reference_remove_helices"],ENT_QUOTES)));
    $id_producto=intval($_GET['id']);
    $user_id=$_SESSION['user_id'];
    $firstname=$_SESSION['firstname'];
    $n=nombre_producto($id_producto);
    $nota_stock="$firstname eliminó el elemento $numserie del producto $n";
    $fecha=date("Y-m-d H:i:s");
    $quantity = 1;
    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference_remove_helices,$quantity);
    $update=eliminar_stock_helices($heli_id);
    if ($update==1){
      $message=1;
    } else {
      $error=1;
    }
  }

  //BATERÍAS

  if (isset($_POST['reference_bateria']) and isset($_POST['numserie'])){
    $numserie=mysqli_real_escape_string($con,(strip_tags($_POST["numserie"],ENT_QUOTES)));
    $reference_bateria=mysqli_real_escape_string($con,(strip_tags($_POST["reference_bateria"],ENT_QUOTES)));
    $id_producto=intval($_GET['id']);
    $user_id=$_SESSION['user_id'];
    $firstname=$_SESSION['firstname'];
    $n=nombre_producto($id_producto);
    $nota_stock="$firstname agregó el elemento $numserie al producto $n";
    $fecha=date("Y-m-d H:i:s");
    $quantity = 1;
    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference_bateria,$quantity);
    $update=agregar_stock_baterias($id_producto,$numserie);
    if ($update==1){
      $message=1;
    } else {
      $error=1;
    }
  }
  
  if (isset($_POST['reference_remove_bateria']) and isset($_POST['numserie'])){
    $bat_id =intval($_REQUEST['numserie']);
    $sss = mysqli_query($con, "SELECT bat_serie FROM baterias WHERE bat_id='".$bat_id."'");
    $sssrow= mysqli_fetch_array($sss);
    $numserie = $sssrow['bat_serie'];
    $reference_remove_bateria=mysqli_real_escape_string($con,(strip_tags($_POST["reference_remove_bateria"],ENT_QUOTES)));
    $id_producto=intval($_GET['id']);
    $user_id=$_SESSION['user_id'];
    $firstname=$_SESSION['firstname'];
    $n=nombre_producto($id_producto);
    $nota_stock="$firstname eliminó el elemento $numserie del producto $n";
    $fecha=date("Y-m-d H:i:s");
    $quantity = 1;
    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference_remove_bateria,$quantity);
    $update=eliminar_stock_baterias($bat_id);
    if ($update==1){
      $message=1;
    } else {
      $error=1;
    }
  }

  //CARGADORES

  if (isset($_POST['reference_cargadores']) and isset($_POST['numserie'])){
    $numserie=mysqli_real_escape_string($con,(strip_tags($_POST["numserie"],ENT_QUOTES)));
    $reference_cargadores=mysqli_real_escape_string($con,(strip_tags($_POST["reference_cargadores"],ENT_QUOTES)));
    $id_producto=intval($_GET['id']);
    $user_id=$_SESSION['user_id'];
    $firstname=$_SESSION['firstname'];
    $n=nombre_producto($id_producto);
    $nota_stock="$firstname agregó el elemento $numserie al producto $n";
    $fecha=date("Y-m-d H:i:s");
    $quantity = 1;
    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference_cargadores,$quantity);
    $update=agregar_stock_cargadores($id_producto,$numserie);
    if ($update==1){
      $message=1;
    } else {
      $error=1;
    }
  }
  
  if (isset($_POST['reference_remove_cargadores']) and isset($_POST['nombre'])){
    $car_id =intval($_REQUEST['nombre']);
    $sss = mysqli_query($con, "SELECT car_serie FROM cargadores WHERE car_id='".$car_id."'");
    $sssrow= mysqli_fetch_array($sss);
    $nombre = $sssrow['car_serie'];
    $reference_remove_cargadores=mysqli_real_escape_string($con,(strip_tags($_POST["reference_remove_cargadores"],ENT_QUOTES)));
    $id_producto=intval($_GET['id']);
    $user_id=$_SESSION['user_id'];
    $firstname=$_SESSION['firstname'];
    $n=nombre_producto($id_producto);
    $nota_stock="$firstname eliminó el elemento $nombre del producto $n";
    $fecha=date("Y-m-d H:i:s");
    $quantity = 1;
    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference_remove_cargadores,$quantity);
    $update=eliminar_stock_cargadores($car_id);
    if ($update==1){
      $message=1;
    } else {
      $error=1;
    }
  }

  //HUBS

  if (isset($_POST['reference_hubs']) and isset($_POST['numserie'])){
    $numserie=mysqli_real_escape_string($con,(strip_tags($_POST["numserie"],ENT_QUOTES)));
    $reference_hubs=mysqli_real_escape_string($con,(strip_tags($_POST["reference_hubs"],ENT_QUOTES)));
    $id_producto=intval($_GET['id']);
    $user_id=$_SESSION['user_id'];
    $firstname=$_SESSION['firstname'];
    $n=nombre_producto($id_producto);
    $nota_stock="$firstname agregó el elemento $numserie al producto $n";
    $fecha=date("Y-m-d H:i:s");
    $quantity = 1;
    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference_hubs,$quantity);
    $update=agregar_stock_hub($id_producto,$numserie);
    if ($update==1){
      $message=1;
    } else {
      $error=1;
    }
  }
  
  if (isset($_POST['reference_remove_hub']) and isset($_POST['numserie'])){
    $hub_id =intval($_REQUEST['numserie']);
    $sss = mysqli_query($con, "SELECT hub_serie FROM hubs WHERE hub_id='".$hub_id."'");
    $sssrow= mysqli_fetch_array($sss);
    $numserie = $sssrow['hub_serie'];
    $reference_remove_hub=mysqli_real_escape_string($con,(strip_tags($_POST["reference_remove_hub"],ENT_QUOTES)));
    $id_producto=intval($_GET['id']);
    $user_id=$_SESSION['user_id'];
    $firstname=$_SESSION['firstname'];
    $n=nombre_producto($id_producto);
    $nota_stock="$firstname eliminó el elemento $numserie del producto $n";
    $fecha=date("Y-m-d H:i:s");
    $quantity = 1;
    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference_remove_hub,$quantity);
    $update=eliminar_stock_hub($hub_id);
    if ($update==1){
      $message=1;
    } else {
      $error=1;
    }
  }
  
  if (isset($_GET['id'])){
    $id_producto=intval($_GET['id']);
    $query=mysqli_query($con,"select * from products where id_producto='$id_producto'");
    $row=mysqli_fetch_array($query);
    $nombre_producto = $row['nombre_producto'];
    $stock_total = $row['stock'];
    $stock_actual = $row['stock_actual'];
    $stock_fuera = $row['stock_fuera'];
    $catego = $row['id_categoria'];
    $inactivo = $row['inactivo'];
    if($inactivo==1 && $_SESSION['admin'] != 1) {
        header("location: stock.php");
    }
    $control = "";

            if (stripos($nombre_producto, "aeronave") !== false) {   
                $control = "nave";             
                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM aeronaves WHERE aero_casa=1 AND id_producto='".$id_producto."'");
                $row3= mysqli_fetch_array($query3);
                $stock_actual=$row3['numrows'];    

                $query4 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM aeronaves WHERE id_producto='".$id_producto."'");
                $row4= mysqli_fetch_array($query4);
                $stock_total=$row4['numrows'];

                $query5 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM aeronaves WHERE aero_casa=0 AND id_producto='".$id_producto."'");
                $row5= mysqli_fetch_array($query5);
                $stock_fuera=$row5['numrows'];
            }

            else if (stripos($nombre_producto, "simulador") !== false) {               
                $control = "simulador";  
                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM simulador WHERE simulador_casa=1 AND id_producto='".$id_producto."'");
                $row3= mysqli_fetch_array($query3);
                $stock_actual=$row3['numrows'];    

                $query4 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM simulador WHERE id_producto='".$id_producto."'");
                $row4= mysqli_fetch_array($query4);
                $stock_total=$row4['numrows'];     

                $query5 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM simulador WHERE simulador_casa=0 AND id_producto='".$id_producto."'");
                $row5= mysqli_fetch_array($query5);
                $stock_fuera=$row5['numrows']; 
            }

            else if (stripos($nombre_producto, "proyector") !== false) {               
                $control = "proyector";  
                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM proyector WHERE proyector_casa=1 AND id_producto='".$id_producto."'");
                $row3= mysqli_fetch_array($query3);
                $stock_actual=$row3['numrows'];    

                $query4 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM proyector WHERE id_producto='".$id_producto."'");
                $row4= mysqli_fetch_array($query4);
                $stock_total=$row4['numrows'];     

                $query5 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM proyector WHERE proyector_casa=0 AND id_producto='".$id_producto."'");
                $row5= mysqli_fetch_array($query5);
                $stock_fuera=$row5['numrows']; 
            }

            else if (stripos($nombre_producto, "emisora") !== false && stripos($nombre_producto, "cargador") === false) {          
                $control = "emisora";              
                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM emisoras WHERE emi_casa=1 AND id_producto='".$id_producto."'");
                $row3= mysqli_fetch_array($query3);
                $stock_actual=$row3['numrows'];    

                $query4 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM emisoras WHERE id_producto='".$id_producto."'");
                $row4= mysqli_fetch_array($query4);
                $stock_total=$row4['numrows'];

                $query5 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM emisoras WHERE emi_casa=0 AND id_producto='".$id_producto."'");
                $row5= mysqli_fetch_array($query5);
                $stock_fuera=$row5['numrows']; 
            }

            else if (stripos($nombre_producto, "hélice") !== false) {          
                $control = "helice";              
                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM helices WHERE heli_casa=1 AND id_producto='".$id_producto."'");
                $row3= mysqli_fetch_array($query3);
                $stock_actual=$row3['numrows'];    

                $query4 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM helices WHERE id_producto='".$id_producto."'");
                $row4= mysqli_fetch_array($query4);
                $stock_total=$row4['numrows'];

                $query5 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM helices WHERE heli_casa=0 AND id_producto='".$id_producto."'");
                $row5= mysqli_fetch_array($query5);
                $stock_fuera=$row5['numrows']; 
            }

            else if (stripos($nombre_producto, "batería") !== false && stripos($nombre_producto, "cargador") === false) {                
                $control = "bateria";        
                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM baterias WHERE bat_casa=1 AND id_producto='".$id_producto."'");
                $row3= mysqli_fetch_array($query3);
                $stock_actual=$row3['numrows'];    

                $query4 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM baterias WHERE id_producto='".$id_producto."'");
                $row4= mysqli_fetch_array($query4);
                $stock_total=$row4['numrows'];

                $query5 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM baterias WHERE bat_casa=0 AND id_producto='".$id_producto."'");
                $row5= mysqli_fetch_array($query5);
                $stock_fuera=$row5['numrows']; 
            }

            else if (stripos($nombre_producto, "cargador") !== false) {         
                $control = "cargador";               
                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM cargadores WHERE car_casa=1 AND id_producto='".$id_producto."'");
                $row3= mysqli_fetch_array($query3);
                $stock_actual=$row3['numrows'];    

                $query4 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM cargadores WHERE id_producto='".$id_producto."'");
                $row4= mysqli_fetch_array($query4);
                $stock_total=$row4['numrows'];

                $query5 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM cargadores WHERE car_casa=0 AND id_producto='".$id_producto."'");
                $row5= mysqli_fetch_array($query5);
                $stock_fuera=$row5['numrows']; 
            }

            else if (stripos($nombre_producto, "hub") !== false) {          
                $control = "hub";              
                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM hubs WHERE hub_casa=1 AND id_producto='".$id_producto."'");
                $row3= mysqli_fetch_array($query3);
                $stock_actual=$row3['numrows'];    

                $query4 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM hubs WHERE id_producto='".$id_producto."'");
                $row4= mysqli_fetch_array($query4);
                $stock_total=$row4['numrows'];

                $query5 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM hubs WHERE hub_casa=0 AND id_producto='".$id_producto."'");
                $row5= mysqli_fetch_array($query5);
                $stock_fuera=$row5['numrows']; 
            }
    
  } else {
    die("Producto no existe");
  }
  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
  </head>
  <body>
  <?php
  include("navbar.php");
  include("modal/agregar_stock.php");
  include("modal/eliminar_stock.php");
  include("modal/editar_productos.php");
  
  ?>
  
  <div class="container">

<?php 
$buscar=false;

$palabras = array("aeronave", "simulador", "proyector", "emisora", "hélice", "batería", "cargador", "hub");
foreach($palabras as $palabra) {
    $buscadas[] = stripos($nombre_producto, $palabra, 0);
}

foreach ($buscadas as $valor) {
  if(is_int($valor)) {
    $buscar=true;
  }
}

if (!$buscar) { ?> 

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-4 col-sm-offset-2 text-center">
                <?php if (empty($row['url_foto'])) { ?>
                  <img style="width: 350px; height: 280px;" class="img-responsive" src="img/stock.png" alt="<?php echo $nombre_producto;?>">
                <?php } else { ?>
                  <img style="width: 350px; height: 280px;" class="item-img img-responsive" src="img_inventario/<?php echo $row['url_foto'];?>" alt=""> 
                <?php } ?>
          <br>
          <?php if($inactivo==1) { ?>
          <a href="#" class="btn btn-danger" onclick="activar('<?php echo $row['id_producto'];?>')" title="Activar"> <i class="glyphicon glyphicon-check"></i> Activar </a> 
          <?php } else { ?>
          <a href="#" class="btn btn-danger" onclick="eliminar('<?php echo $row['id_producto'];?>')" title="Eliminar"> <i class="glyphicon glyphicon-trash"></i> Eliminar </a> 
          <?php } ?>
          <a href="#myModal2" data-toggle="modal" data-nombre='<?php echo $row['nombre_producto'];?>' data-categoria='<?php echo $row['id_categoria']?>' data-stock='<?php echo $stock_total;?>' data-id='<?php echo $row['id_producto'];?>' class="btn btn-info" title="Editar"> <i class="glyphicon glyphicon-pencil"></i> Editar </a>  
          
              </div>
        
              <div class="col-sm-4 text-left">
                <div class="row margin-btm-20">
                    <div class="col-sm-12">
                      <span class="item-title"> <?php echo $row['nombre_producto'];?></span>
                    </div>
                    <div class="col-sm-12 margin-btm-10">
                    </div>
                    <div class="col-sm-12">
                      <span class="current-stock">Stock total</span>
                    </div>
                    <div class="col-sm-12 margin-btm-10">
                      <span class="item-quantity"><?php echo $stock_total;?></span>
                    </div>
                    <div class="col-sm-6">
                      <span class="current-stock">Stock actual</span>
                    </div>
                    <div class="col-sm-6">
                      <span class="current-stock">Stock fuera</span>
                    </div>
                    <div class="col-sm-6 margin-btm-10">
                      <span class="item-quantity"><?php echo $stock_actual;?></span>
                    </div>
                    <div class="col-sm-6 margin-btm-10">
                      <span class="item-quantity"><?php echo $stock_fuera;?></span>
                    </div>
          
                    <div class="col-sm-12 margin-btm-10">
          </div>
                    <div class="col-sm-6 col-xs-6 col-md-4 ">
                      <a href="" data-toggle="modal" data-target="#add-stock"><img width="100px"  src="img/stock-in.png"></a>
                    </div>
                    <div class="col-sm-6 col-xs-6 col-md-4">
                      <a href="" data-toggle="modal" data-target="#remove-stock"><img width="100px"  src="img/stock-out.png"></a>
                    </div>
                    <div class="col-sm-12 margin-btm-10">
                    </div>
                    
                   
                                    </div>
              </div>

            </div>
            <br>
            <div class="row">

            <div class="col-sm-8 col-sm-offset-2 text-left">
                  <div class="row">
                    <?php
            if (isset($message)){
              ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> Datos procesados exitosamente.
            </div>  
              <?php
            }
            if (isset($error)){
              ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Error!</strong> No se pudo procesar los datos.
            </div>  
              <?php
            }
          ?>  
           <table class='table table-bordered'>
            <tr>
              <th class='text-center' colspan=5 >HISTORIAL DE INVENTARIO</th>
            </tr>
            <tr>
              <td>Fecha</td>
              <td>Hora</td>
              <td>Descripción</td>
              <td>Referencia</td>
              <td class='text-center'>Total</td>
            </tr>
            <?php
            if ($_SESSION['admin'] == 1) { 
              $query=mysqli_query($con,"select * from historial where id_producto='$id_producto' order by id_historial desc");
            }
            else {
              $query=mysqli_query($con,"select * from historial where id_producto='$id_producto' and user_id='".$_SESSION['user_id']."' order by id_historial desc");
            }
              while ($row=mysqli_fetch_array($query)){
                ?>
            <tr>
              <td><?php echo date('d/m/Y', strtotime($row['fecha']));?></td>
              <td><?php echo date('H:i:s', strtotime($row['fecha']));?></td>
              <td><?php echo $row['nota'];?></td>
              <td><?php echo $row['referencia'];?></td>
              <td class='text-center'><?php echo $row['cantidad'];?></td>
            </tr>   
                <?php
              }
            ?>
           </table>
                  </div>
                                    
                                    
        </div>
            </div>
          </div>
        </div>
    </div>
</div>

<?php } else { ?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-4 text-center">
                <?php if (empty($row['url_foto'])) { ?>
                  <img style="width: 350px; height: 280px;" class="img-responsive" src="img/stock.png" alt="<?php echo $nombre_producto;?>">
                <?php } else { ?>
                  <img style="width: 350px; height: 280px;" class="item-img img-responsive" src="img_inventario/<?php echo $row['url_foto'];?>" alt=""> 
                <?php } ?>
          <br>
          <?php if($inactivo==1) { ?>
          <a href="#" class="btn btn-danger" onclick="activar('<?php echo $row['id_producto'];?>')" title="Activar"> <i class="glyphicon glyphicon-check"></i> Activar </a> 
          <?php } else { ?>
          <a href="#" class="btn btn-danger" onclick="eliminar('<?php echo $row['id_producto'];?>')" title="Eliminar"> <i class="glyphicon glyphicon-trash"></i> Eliminar </a> 
          <?php } ?>
          <a href="#myModal2" data-toggle="modal" data-nombre='<?php echo $row['nombre_producto'];?>' data-categoria='<?php echo $row['id_categoria']?>' data-stock='<?php echo $stock_total;?>' data-id='<?php echo $row['id_producto'];?>' class="btn btn-info" title="Editar"> <i class="glyphicon glyphicon-pencil"></i> Editar </a>  
          
              </div>
        
              <div class="col-sm-4 text-left">
                <div class="row margin-btm-20">
                    <div class="col-sm-12">
                      <span class="item-title"> <?php echo $row['nombre_producto'];?></span>
                    </div>
                    <div class="col-sm-12 margin-btm-10">
                    </div>
                    <div class="col-sm-12">
                      <span class="current-stock">Stock total</span>
                    </div>
                    <div class="col-sm-12 margin-btm-10">
                      <span class="item-quantity"><?php echo $stock_total;?></span>
                    </div>
                    <div class="col-sm-6">
                      <span class="current-stock">Stock actual</span>
                    </div>
                    <div class="col-sm-6">
                      <span class="current-stock">Stock fuera</span>
                    </div>
                    <div class="col-sm-6 margin-btm-10">
                      <span class="item-quantity"><?php echo $stock_actual;?></span>
                    </div>
                    <div class="col-sm-6 margin-btm-10">
                      <span class="item-quantity"><?php echo $stock_fuera;?></span>
                    </div>
          
                    <div class="col-sm-12 margin-btm-10">
          </div>
                    <div class="col-sm-6 col-xs-6 col-md-4 ">
                      <a href="" data-toggle="modal" data-target="#add-product-stock"><img width="100px"  src="img/stock-in.png"></a>
                    </div>
                    <div class="col-sm-6 col-xs-6 col-md-4">
                      <a href="" data-toggle="modal" data-target="#remove-product-stock"><img width="100px"  src="img/stock-out.png"></a>
                    </div>
                    <div class="col-sm-12 margin-btm-10">
                    </div>
                    
                   
                                    </div>
              </div>
              <div class="col-sm-4 text-center">
               <table class='table table-bordered'>
                <tr>
                  <th class='text-center' colspan=2 >INVENTARIO</th>
                </tr>
                <tr>
                  <td>Nº serie</td>
                  <td>En curso</td>
                </tr>
                <?php
                  if ($control == "nave") {
                    $query=mysqli_query($con,"select * from aeronaves where id_producto='$id_producto'");
                  }
                  else if ($control == "simulador") {
                    $query=mysqli_query($con,"select * from simulador where id_producto='$id_producto'");
                  }
                  else if ($control == "proyector") {
                    $query=mysqli_query($con,"select * from proyector where id_producto='$id_producto'");
                  }
                  else if ($control == "emisora") {
                    $query=mysqli_query($con,"select * from emisoras where id_producto='$id_producto'");
                  }
                  else if ($control == "helice") {
                    $query=mysqli_query($con,"select * from helices where id_producto='$id_producto'");
                  }
                  else if ($control == "bateria") {
                    $query=mysqli_query($con,"select * from baterias where id_producto='$id_producto'");
                  }
                  else if ($control == "cargador") {
                    $query=mysqli_query($con,"select * from cargadores where id_producto='$id_producto'");
                  }
                  else if ($control == "hub") {
                    $query=mysqli_query($con,"select * from hubs where id_producto='$id_producto'");
                  }
                  while ($row=mysqli_fetch_array($query)){
                      $col1 = $row[1];
                      if($row[2]==1){
                        $col2 = "NO";
                      }
                      else {
                        $col2 = "SI";
                      }
                    ?>
                <tr>
                  <td><?php echo $col1;?></td>
                  <td><?php echo $col2;?></td>
                </tr>   
                    <?php
                  }
                ?>
               </table>
              </div>

            </div>
            <br>
            <div class="row">

            <div class="col-sm-12 text-left">
                  <div class="row">
                    <?php
            if (isset($message)){
              ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> Datos procesados exitosamente.
            </div>  
              <?php
            }
            if (isset($error)){
              ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Error!</strong> No se pudo procesar los datos.
            </div>  
              <?php
            }
          ?>  
           <table class='table table-bordered'>
            <tr>
              <th class='text-center' colspan=5 >HISTORIAL DE INVENTARIO</th>
            </tr>
            <tr>
              <td>Fecha</td>
              <td>Hora</td>
              <td>Descripción</td>
              <td>Referencia</td>
              <td class='text-center'>Total</td>
            </tr>
            <?php 
            if ($_SESSION['admin'] == 1) { 
              $query=mysqli_query($con,"select * from historial where id_producto='$id_producto' order by id_historial desc");
            }
            else {
              $query=mysqli_query($con,"select * from historial where id_producto='$id_producto' and user_id='".$_SESSION['user_id']."' order by id_historial desc");
            }

              while ($row=mysqli_fetch_array($query)){
                ?>
            <tr>
              <td><?php echo date('d/m/Y', strtotime($row['fecha']));?></td>
              <td><?php echo date('H:i:s', strtotime($row['fecha']));?></td>
              <td><?php echo $row['nota'];?></td>
              <td><?php echo $row['referencia'];?></td>
              <td class='text-center'><?php echo $row['cantidad'];?></td>
            </tr>   
                <?php
              }
            ?>
           </table>
                  </div>
                                    
                                    
        </div>
            </div>
          </div>
        </div>
    </div>
</div>

<?php } ?>
</div>

  
  <?php
  include("footer.php");
  ?>
  <script type="text/javascript" src="js/productos.js"></script>
  </body>
</html>
<script>
$( "#editar_producto" ).on('submit', function(e){
  $('#actualizar_datos').attr("disabled", true);

  e.preventDefault();
  
 var parametros = $(this).serialize();
   $.ajax({
      type: "POST",
      url: "ajax/editar_producto.php",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,
      beforeSend: function(objeto){
        $("#resultados_ajax2").html("Mensaje: Cargando...");
        },
      success: function(datos){
        $("#resultados_ajax2").html(datos);
        $('#actualizar_datos').attr("disabled", false);
        window.setTimeout(function() {
          $(".alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove();});
          location.reload();
        }, 1000);
      }
  });
})

  $('#myModal2').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var nombre = button.data('nombre')
    var categoria = button.data('categoria')
    var stock = button.data('stock')
    var id = button.data('id')
    var modal = $(this)
    modal.find('.modal-body #mod_nombre').val(nombre)
    modal.find('.modal-body #mod_categoria').val(categoria)
    modal.find('.modal-body #mod_stock').val(stock)
    modal.find('.modal-body #mod_id').val(id)
  })
  
  function eliminar (id){
    var q= $("#q").val();
    if (confirm("¿Realmente deseas eliminar el producto?")){  
      location.replace('stock.php?delete='+id);
    }
  }
  
  function activar (id){
    var q= $("#q").val();
    if (confirm("¿Realmente deseas activar el producto?")){  
      location.replace('stock.php?activar='+id);
    }
  }
</script>