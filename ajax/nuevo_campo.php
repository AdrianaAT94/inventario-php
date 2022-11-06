<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
		
		if (empty($_POST['name'])){
			$errors[] = "Nombres vacíos";
		} elseif (empty($_POST['poblacion'])){
            $errors[] = "Población vacía";
		}  elseif (empty($_POST['mapa'])) {
            $errors[] = "Enlace Google Maps vacío";
        }  elseif (empty($_POST['telefono'])) {
            $errors[] = "Teléfono vacío";
        } elseif (empty($_POST['email'])) {
            $errors[] = "El correo electrónico no puede estar vacío";
        } elseif (strlen($_POST['email']) > 64) {
            $errors[] = "El correo electrónico no puede ser superior a 64 caracteres";
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Su dirección de correo electrónico no está en un formato de correo electrónico válida";
        } elseif (
			!empty($_POST['poblacion'])
			&& !empty($_POST['name'])
			&& !empty($_POST['mapa'])
            && !empty($_POST['telefono'])
            && !empty($_POST['email'])
            && strlen($_POST['email']) <= 64
            && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
        ) {
            require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
    		include("../funciones.php");
			
				// escaping, additionally removing everything that could be (html/javascript-) code
                $campo_name = mysqli_real_escape_string($con,(strip_tags($_POST["name"],ENT_QUOTES)));
				$campo_mapa = mysqli_real_escape_string($con,(strip_tags($_POST["mapa"],ENT_QUOTES)));
				$campo_poblacion = mysqli_real_escape_string($con,(strip_tags($_POST["poblacion"],ENT_QUOTES)));
                $campo_telefono = mysqli_real_escape_string($con,(strip_tags($_POST["telefono"],ENT_QUOTES)));
                $campo_email = mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
				$date_added=date("Y-m-d H:i:s");
					
                // check if campo or email address already exists
                $sql = "SELECT * FROM camposvuelo WHERE campo_telefono = '" . $campo_telefono . "' OR campo_email = '" . $campo_email . "';";
                $query_check_campo_email = mysqli_query($con,$sql);
				$query_check_campo=mysqli_num_rows($query_check_campo_email);
                if ($query_check_campo == 1) {
                    $errors[] = "Lo sentimos, el teléfono del campo de vuelo ó la dirección de correo electrónico ya está en uso.";
                } else {
					// write new campo's data into database
                    $sql = "INSERT INTO camposvuelo (campo_name, campo_email, campo_telefono, campo_poblacion, campo_maps, date_added)
                            VALUES('".$campo_name."','".$campo_email."','" . $campo_telefono . "', '" . $campo_poblacion . "', '" . $campo_mapa . "','".$date_added."');";
                    $query_new_user_insert = mysqli_query($con,$sql);

                    // if campo has been added successfully
                    if ($query_new_user_insert) {
                        $messages[] = "El campo de vuelo ha sido creada con éxito.";
				        $campo_id=get_row('camposvuelo','campo_id', 'campo_name', $campo_name);
				        $user_id=$_SESSION['user_id'];
        				$firstname=$_SESSION['firstname']." ".$_SESSION['lastname'];
				        $nota="$firstname agregó el campo de vuelos $campo_name al inventario";
				        echo guardar_historial_campos($campo_id,$user_id,$date_added,$nota);
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