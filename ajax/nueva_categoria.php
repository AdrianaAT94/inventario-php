<?php
  include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
  /*Inicia validacion del lado del servidor*/
  if (empty($_POST['nombre'])) {
           $errors[] = "Nombre vacío";
        } else if (!empty($_POST['nombre'])){
    /* Connect To Database*/
    require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
    include("../funciones.php");
    // escaping, additionally removing everything that could be (html/javascript-) code
    $nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
    $descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));
    $date_added=date("Y-m-d H:i:s");
    $sql="INSERT INTO categorias (nombre_categoria, descripcion_categoria,date_added) VALUES ('$nombre','$descripcion','$date_added')";
    $query_new_insert = mysqli_query($con,$sql);
      if ($query_new_insert){
        $messages[] = "Categoría ha sido ingresada satisfactoriamente.";
        $id_categoria=get_row('categorias','id_categoria', 'nombre_categoria', $nombre);
        $user_id=$_SESSION['user_id'];
        $firstname=$_SESSION['firstname']." ".$_SESSION['lastname'];
        $nota="$firstname agregó la categoría $nombre al inventario";
        echo guardar_historial_categorias($id_categoria,$user_id,$date_added,$nota);
      } else{
        $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
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