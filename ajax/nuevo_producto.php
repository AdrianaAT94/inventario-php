<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
  /*Inicia validacion del lado del servidor*/
  if (empty($_POST['nombre'])){
      $errors[] = "Nombre del producto vacío";
    } else if (
      !empty($_POST['nombre']) 
    ){
    /* Connect To Database*/
    require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
    include("../funciones.php");
    // escaping, additionally removing everything that could be (html/javascript-) code
    $nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
    $stock=0;
    $id_categoria=intval($_POST['categoria']);
    $date_added=date("Y-m-d H:i:s");
    if (empty($_FILES['imagen']['type'])) {
      
      $sql="INSERT INTO products (nombre_producto, date_added, stock, id_categoria) VALUES ('$nombre','$date_added','$stock','$id_categoria')";
      $query_new_insert = mysqli_query($con,$sql);
        if ($query_new_insert){
          $messages[] = "Producto ha sido ingresado satisfactoriamente.";
          $id_producto=get_row('products','id_producto', 'nombre_producto', $nombre);
          $user_id=$_SESSION['user_id'];
          $firstname=$_SESSION['firstname']." ".$_SESSION['lastname'];
          $nota="$firstname agregó el producto $nombre al inventario";
          $codigo = $nombre;
          echo guardar_historial($id_producto,$user_id,$date_added,$nota,$codigo,$stock);
          
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
      
      $sql="INSERT INTO products (nombre_producto, date_added, stock, url_foto, id_categoria) VALUES ('$nombre','$date_added','$stock','$fileName','$id_categoria')";
      $query_new_insert = mysqli_query($con,$sql);
        if ($query_new_insert){
          $messages[] = "Producto ha sido ingresado satisfactoriamente.";
          $id_producto=get_row('products','id_producto', 'nombre_producto', $nombre);
          $user_id=$_SESSION['user_id'];
          $firstname=$_SESSION['firstname']." ".$_SESSION['lastname'];
          $nota="$firstname agregó el producto al inventario";
          $codigo = $nombre;
          echo guardar_historial($id_producto,$user_id,$date_added,$nota,$codigo,$stock);
          
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