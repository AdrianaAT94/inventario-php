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
		if (empty($_POST['name2'])){
			$errors[] = "Nombres vacíos";
		}  elseif (empty($_POST['poblacion2'])) {
            $errors[] = "Población vacía";
		}  elseif (empty($_POST['mapa2'])) {
            $errors[] = "Enlace Google Maps vacío";
        }  elseif (empty($_POST['telefono2'])) {
            $errors[] = "Teléfono vacío";
        } elseif (empty($_POST['email2'])) {
            $errors[] = "El correo electrónico no puede estar vacío";
        } elseif (strlen($_POST['email2']) > 64) {
            $errors[] = "El correo electrónico no puede ser superior a 64 caracteres";
        } elseif (!filter_var($_POST['email2'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Su dirección de correo electrónico no está en un formato de correo electrónico válida";
        } elseif (
			!empty($_POST['poblacion2'])
			&& !empty($_POST['name2'])
			&& !empty($_POST['mapa2'])
			&& !empty($_POST['telefono2'])
            && !empty($_POST['email2'])
            && strlen($_POST['email2']) <= 64
            && filter_var($_POST['email2'], FILTER_VALIDATE_EMAIL)
          )
         {
            require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		    //Archivo de funciones PHP
		    include("../funciones.php");  
			
				// escaping, additionally removing everything that could be (html/javascript-) code
                $aula_name = mysqli_real_escape_string($con,(strip_tags($_POST["name2"],ENT_QUOTES)));
				$aula_mapa = mysqli_real_escape_string($con,(strip_tags($_POST["mapa2"],ENT_QUOTES)));
				$aula_poblacion = mysqli_real_escape_string($con,(strip_tags($_POST["poblacion2"],ENT_QUOTES)));
                $aula_telefono = mysqli_real_escape_string($con,(strip_tags($_POST["telefono2"],ENT_QUOTES)));
                $aula_email = mysqli_real_escape_string($con,(strip_tags($_POST["email2"],ENT_QUOTES)));
				
				$aula_id=intval($_POST['mod_id']);  
			    $n=nombre_aula($aula_id);
			    $user_id=$_SESSION['user_id'];
            	$firstname=$_SESSION['firstname']." ".$_SESSION['lastname'];
			    $fecha=date("Y-m-d H:i:s");
					
               
					// write new aula's data into database
                    $sql = "UPDATE aulas SET aula_name='".$aula_name."', aula_email='".$aula_email."', aula_telefono='".$aula_telefono."', aula_poblacion='".$aula_poblacion."', aula_maps='".$aula_mapa."' WHERE aula_id='".$aula_id."';";
                    $query_update = mysqli_query($con,$sql);

                    // if aula has been added successfully
                    if ($query_update) {
                        $messages[] = "El aula ha sido modificada con éxito.";
				        $nota="$firstname modificó el aula $n";
				        guardar_historial_aulas($aula_id,$user_id,$fecha,$nota);
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