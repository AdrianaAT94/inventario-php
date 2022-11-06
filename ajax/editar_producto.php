<?php
  include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
  /*Inicia validacion del lado del servidor*/
  if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        } else if (empty($_POST['mod_nombre'])){
      $errors[] = "Nombre del producto vacío";
    } else if ($_POST['mod_categoria']==""){
      $errors[] = "Selecciona la categoría del producto";
    } else if (
      !empty($_POST['mod_id']) &&
      !empty($_POST['mod_nombre']) &&
      $_POST['mod_categoria']!=""
    ){
    /* Connect To Database*/
    require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
    // escaping, additionally removing everything that could be (html/javascript-) code
    //Archivo de funciones PHP
    include("../funciones.php");  
    $nombre=mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombre"],ENT_QUOTES)));
    $categoria=intval($_POST['mod_categoria']);
    $stock=intval($_POST['mod_stock']);
    $id_producto=$_POST['mod_id'];
    $n=nombre_producto($id_producto);
    $user_id=$_SESSION['user_id'];
    $firstname=$_SESSION['firstname']." ".$_SESSION['lastname'];
    $fecha=date("Y-m-d H:i:s");
    if (empty($_FILES['imagen']['type'])) {
    $sql="UPDATE products SET nombre_producto='".$nombre."', id_categoria='".$categoria."', stock='".$stock."' WHERE id_producto='".$id_producto."'";
    $query_update = mysqli_query($con,$sql);
      if ($query_update){
        $messages[] = "Producto ha sido actualizado satisfactoriamente.";
        $nota="$firstname modificó el producto $n";
        guardar_historial($id_producto,$user_id,$fecha,$nota,$n,0);
      } else{
        $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
      }
    }
    else {
      $fileName = date("Y-m-d-").$_FILES['imagen']['name'];
      $valid_extensions = array("jpeg", "jpg", "png");
      $temporary = explode(".", $_FILES["imagen"]["name"]);
      $file_extension = end($temporary);
      if((($_FILES["imagen"]["type"] != "image/png") || ($_FILES["imagen"]["type"] != "image/jpg") || ($_FILES["imagen"]["type"] != "image/jpeg")) && !in_array($file_extension, $valid_extensions)){
          $errors[] = "Formato de imagen no permitida, solo JPEG, JPG o PNG";
      }
      else {
          $sourcePath = $_FILES['imagen']['tmp_name'];
          $targetPath = "../img_inventario/".$fileName;
          if(move_uploaded_file($sourcePath,$targetPath)){
              $uploadedFile = $fileName;
          }

          $sql="UPDATE products SET nombre_producto='".$nombre."', id_categoria='".$categoria."', stock='".$stock."', url_foto='".$fileName."' WHERE id_producto='".$id_producto."'";
          $query_update = mysqli_query($con,$sql);
            if ($query_update){
              $messages[] = "Producto ha sido actualizado satisfactoriamente.";
              $nota="$firstname modificó el producto $n";
              guardar_historial($id_producto,$user_id,$fecha,$nota,$n,0);
            } else{
              $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
            }
      }

    }
    } else {
      $errors []= "Error desconocido.";
    }
    
    if (isset($errors)){
      
      ?>
      <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Error!</strong> 
          <?php
            foreach ($errors as $error) {
                echo $error;
              }
            ?>
      </div>
      <?php
      }
      if (isset($messages)){
        
        ?>
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>¡Bien hecho!</strong>
            <?php
              foreach ($messages as $message) {
                  echo $message;
                }
              ?>
        </div>
        <?php
      }

?>