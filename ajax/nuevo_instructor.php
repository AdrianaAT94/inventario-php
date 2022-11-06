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
	
		if (empty($_POST['firstname'])){
			$errors[] = "Nombres vacíos";
		} elseif (empty($_POST['lastname'])){
			$errors[] = "Apellidos vacíos";
		}  elseif (empty($_POST['direccion'])) {
            $errors[] = "Dirección vacía";
        }  elseif (empty($_POST['telefono'])) {
            $errors[] = "Teléfono vacío";
        } elseif (empty($_POST['instructor_email'])) {
            $errors[] = "El correo electrónico no puede estar vacío";
        } elseif (strlen($_POST['instructor_email']) > 64) {
            $errors[] = "El correo electrónico no puede ser superior a 64 caracteres";
        } elseif (!filter_var($_POST['instructor_email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Su dirección de correo electrónico no está en un formato de correo electrónico válida";
        } elseif (
			!empty($_POST['direccion'])
			&& !empty($_POST['firstname'])
			&& !empty($_POST['lastname'])
            && !empty($_POST['telefono'])
            && !empty($_POST['instructor_email'])
            && strlen($_POST['instructor_email']) <= 64
            && filter_var($_POST['instructor_email'], FILTER_VALIDATE_EMAIL)
        ) {
            require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
    		include("../funciones.php");
			
				// escaping, additionally removing everything that could be (html/javascript-) code
                $firstname = mysqli_real_escape_string($con,(strip_tags($_POST["firstname"],ENT_QUOTES)));
				$lastname = mysqli_real_escape_string($con,(strip_tags($_POST["lastname"],ENT_QUOTES)));
				$inst_direccion = mysqli_real_escape_string($con,(strip_tags($_POST["direccion"],ENT_QUOTES)));
                $inst_telefono = mysqli_real_escape_string($con,(strip_tags($_POST["telefono"],ENT_QUOTES)));
                $inst_email = mysqli_real_escape_string($con,(strip_tags($_POST["instructor_email"],ENT_QUOTES)));
		        $inst_password = $_POST['user_password_new'];
		        $clave = $inst_password;
				$date_added=date("Y-m-d H:i:s");
                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
        $inst_password_hash = password_hash($inst_password, PASSWORD_DEFAULT);
					
                // check if instructor or email address already exists
                $sql = "SELECT * FROM instructores WHERE inst_telefono = '" . $inst_telefono . "' OR inst_email = '" . $inst_email . "';";
                $query_check_inst_email = mysqli_query($con,$sql);
				$query_check_inst=mysqli_num_rows($query_check_inst_email);
                if ($query_check_inst == 1) {
                    $errors[] = "Lo sentimos, el teléfono del instructor ó la dirección de correo electrónico ya está en uso.";
                } else {
					// write new instructor's data into database
                    $sql = "INSERT INTO instructores (firstname, lastname, inst_email, inst_telefono, inst_direccion, date_added, inst_password_hash)
                            VALUES('".$firstname."','".$lastname."','" . $inst_email . "', '" . $inst_telefono . "', '" . $inst_direccion . "','".$date_added."', '" . $inst_password_hash."');";
                    $query_new_user_insert = mysqli_query($con,$sql);

                    // if instructor has been added successfully
                    if ($query_new_user_insert) {
                        $messages[] = "El instructor ha sido creado con éxito.";
				        $inst_id=get_row('instructores','inst_id', 'firstname', $firstname);
				        $user_id=$_SESSION['user_id'];
				        $nuser=$_SESSION['firstname']." ".$_SESSION['lastname'];
                        $hola = $firstname." ".$lastname;
				        $nota="$nuser añadó el instructor $hola al inventario";
				        echo guardar_historial_instructores($inst_id,$user_id,$date_added,$nota);
                        envioMail_regis($inst_email,$hola,$clave);
                    } else {
                        $errors[] = "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
                    }
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