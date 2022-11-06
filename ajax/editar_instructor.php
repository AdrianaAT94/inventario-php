<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("../libraries/password_compatibility_library.php");
}		
		if (empty($_POST['firstname2'])){
			$errors[] = "Nombres vacíos";
		} elseif (empty($_POST['lastname2'])){
			$errors[] = "Apellidos vacíos";
		}  elseif (empty($_POST['direccion2'])) {
            $errors[] = "Dirección vacía";
        }  elseif (empty($_POST['telefono2'])) {
            $errors[] = "Teléfono vacío";
        } elseif (empty($_POST['instructor_email2'])) {
            $errors[] = "El correo electrónico no puede estar vacío";
        } elseif (strlen($_POST['instructor_email2']) > 64) {
            $errors[] = "El correo electrónico no puede ser superior a 64 caracteres";
        } elseif (!filter_var($_POST['instructor_email2'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Su dirección de correo electrónico no está en un formato de correo electrónico válida";
        } elseif (
			!empty($_POST['direccion2'])
			&& !empty($_POST['firstname2'])
			&& !empty($_POST['lastname2'])
			&& !empty($_POST['telefono2'])
            && !empty($_POST['instructor_email2'])
            && strlen($_POST['instructor_email2']) <= 64
            && filter_var($_POST['instructor_email2'], FILTER_VALIDATE_EMAIL)
          )
         {
            require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		    //Archivo de funciones PHP
		    include("../funciones.php");  
			
				// escaping, additionally removing everything that could be (html/javascript-) code
                $firstname = mysqli_real_escape_string($con,(strip_tags($_POST["firstname2"],ENT_QUOTES)));
				$lastname = mysqli_real_escape_string($con,(strip_tags($_POST["lastname2"],ENT_QUOTES)));
				$inst_direccion = mysqli_real_escape_string($con,(strip_tags($_POST["direccion2"],ENT_QUOTES)));
                $inst_telefono = mysqli_real_escape_string($con,(strip_tags($_POST["telefono2"],ENT_QUOTES)));
                $inst_email = mysqli_real_escape_string($con,(strip_tags($_POST["instructor_email2"],ENT_QUOTES)));
				
				$inst_id=intval($_POST['mod_id']);
			    $n=nombre_instructor($inst_id);
			    $user_id=$_SESSION['user_id'];
			    $nuser=$_SESSION['firstname']." ".$_SESSION['lastname'];
			    $fecha=date("Y-m-d H:i:s");
					
               
					// write new instructor's data into database
                    $sql = "UPDATE instructores SET firstname='".$firstname."', lastname='".$lastname."', inst_email='".$inst_email."', inst_telefono='".$inst_telefono."', inst_direccion='".$inst_direccion."' WHERE inst_id='".$inst_id."';";
                    $query_update = mysqli_query($con,$sql);

                    // if instructor has been added successfully
                    if ($query_update) {
                        $messages[] = "El instructor ha sido modificado con éxito.";
				        $nota="$nuser modificó el instructor $n";
				        guardar_historial_instructores($inst_id,$user_id,$fecha,$nota);
                    } else {
                        $errors[] = "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
                    }
                
            
        } else {
            $errors[] = "Un error desconocido ocurrió.";
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