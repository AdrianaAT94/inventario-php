<?php 
function get_row($table,$row, $id, $equal){
  global $con;
  $query=mysqli_query($con,"select $row from $table where $id='$equal'");
  $rw=mysqli_fetch_array($query);
  $value=$rw[$row];
  return $value;
}

function devuelve_categoria($id) {
  global $con;
  $query=mysqli_query($con,"select * from aeronaves where aero_id='$id'");
  $rw=mysqli_fetch_array($query);
  $id_producto=$rw['id_producto'];
  $query2=mysqli_query($con,"select * from products where id_producto='$id_producto'");
  $rw2=mysqli_fetch_array($query2);
  $value=$rw2['id_categoria'];
  return $value;
}

function nombre_producto($id){
  global $con;
  $query=mysqli_query($con,"select * from products where id_producto='$id'");
  $rw=mysqli_fetch_array($query);
  $value=$rw['nombre_producto'];
  return $value;
}
function nombre_categoria($id){
  global $con;
  $query=mysqli_query($con,"select * from categorias where id_categoria='$id'");
  $rw=mysqli_fetch_array($query);
  $value=$rw['nombre_categoria'];
  return $value;
}
function nombre_usuario($id){
  global $con;
  $query=mysqli_query($con,"select * from users where user_id='$id'");
  $rw=mysqli_fetch_array($query);
  $value=$rw['firstname']." ".$rw['lastname'];
  return $value;
}
function nombre_instructor($id){
  global $con;
  $query=mysqli_query($con,"select * from instructores where inst_id='$id'");
  $rw=mysqli_fetch_array($query);
  $value=$rw['firstname']." ".$rw['lastname'];
  return $value;
}
function correo_instructor($id){
  global $con;
  $query=mysqli_query($con,"select * from instructores where inst_id='$id'");
  $rw=mysqli_fetch_array($query);
  $value=$rw['inst_email'];
  return $value;
}
function nombre_aula($id){
  global $con;
  $query=mysqli_query($con,"select * from aulas where aula_id='$id'");
  $rw=mysqli_fetch_array($query);
  $value=$rw['aula_name'];
  return $value;
}
function nombre_campo($id){
  global $con;
  $query=mysqli_query($con,"select * from camposvuelo where campo_id='$id'");
  $rw=mysqli_fetch_array($query);
  $value=$rw['campo_name'];
  return $value;
}
function guardar_historial($id_producto,$user_id,$fecha,$nota,$reference,$quantity){
  global $con;
  $sql="INSERT INTO historial (id_historial, id_producto, user_id, fecha, nota, referencia, cantidad)
  VALUES (NULL, '$id_producto', '$user_id', '$fecha', '$nota', '$reference', '$quantity');";
  $query=mysqli_query($con,$sql);  
}
function guardar_historial_categorias($id_cat,$user_id,$fecha,$nota){
  global $con;
  $sql="INSERT INTO historial_cat (id_historial, id_cat, user_id, fecha, nota)
  VALUES (NULL, '$id_cat', '$user_id', '$fecha', '$nota');";
  $query=mysqli_query($con,$sql);  
}
function guardar_historial_users($id_user, $user_id,$fecha,$nota){
  global $con;
  $sql="INSERT INTO historial_users (id_historial, id_user, user_id, fecha, nota)
  VALUES (NULL, '$id_user', '$user_id', '$fecha', '$nota');";
  $query=mysqli_query($con,$sql);  
}
function guardar_historial_aulas($id_aula,$user_id,$fecha,$nota){
  global $con;
  $sql="INSERT INTO historial_aulas (id_historial, id_aula, user_id, fecha, nota)
  VALUES (NULL, '$id_aula', '$user_id', '$fecha', '$nota');";
  $query=mysqli_query($con,$sql);  
}
function guardar_historial_campos($id_campo,$user_id,$fecha,$nota){
  global $con;
  $sql="INSERT INTO historial_campos (id_historial, id_campo, user_id, fecha, nota)
  VALUES (NULL, '$id_campo', '$user_id', '$fecha', '$nota');";
  $query=mysqli_query($con,$sql);  
}
function guardar_historial_instructores($id_instr,$user_id,$fecha,$nota){
  global $con;
  $sql="INSERT INTO historial_inst (id_historial, id_instr, user_id, fecha, nota)
  VALUES (NULL, '$id_instr', '$user_id', '$fecha', '$nota');";
  $query=mysqli_query($con,$sql);  
}
function guardar_historial_invcon($id_invcon,$user_id,$fecha,$nota){
  global $con;
  $sql="INSERT INTO historial_invcon (id_historial_invcon, id_invcon, user_id, fecha, nota)
  VALUES (NULL, '$id_invcon', '$user_id', '$fecha', '$nota');";
  $query=mysqli_query($con,$sql);  
}
function agregar_stock($id_producto,$quantity){
  global $con;
  $update=mysqli_query($con,"update products set stock=stock+'$quantity', stock_actual=stock_actual+'$quantity' where id_producto='$id_producto'");
  if ($update){
      return 1;
  } else {
    return 0;
  } 
    
}
function eliminar_stock($id_producto,$quantity){
  global $con;
  $update=mysqli_query($con,"update products set stock=stock-'$quantity', stock_actual=stock_actual-'$quantity' where id_producto='$id_producto'");
  if ($update){
      return 1;
  } else {
    return 0;
  }     
}

//NAVES
function agregar_stock_nave($id_producto,$numserie){
  global $con;
  $update=mysqli_query($con,"insert into aeronaves (aero_serie, aero_casa, id_producto) values ('$numserie', '1', '$id_producto')");
  if ($update){
      return 1;
  } else {
    return 0;
  } 
    
}
function eliminar_stock_nave($aero_id){
  global $con;
  $update=mysqli_query($con,"delete from aeronaves where aero_id='$aero_id'");
  if ($update){
      return 1;
  } else {
    return 0;
  }     
}

//SIMULADOR
function agregar_stock_simulador($id_producto,$referencia){
  global $con;
  $update=mysqli_query($con,"insert into simulador (simulador_ref, simulador_casa, id_producto) values ('$referencia', '1', '$id_producto')");
  if ($update){
      return 1;
  } else {
    return 0;
  } 
    
}
function eliminar_stock_simulador($simulador_id){
  global $con;
  $update=mysqli_query($con,"delete from simulador where simulador_id='$simulador_id'");
  if ($update){
      return 1;
  } else {
    return 0;
  }     
}

//PROYECTOR
function agregar_stock_proyector($id_producto,$referencia){
  global $con;
  $update=mysqli_query($con,"insert into proyector (proyector_serie, proyector_casa, id_producto) values ('$referencia', '1', '$id_producto')");
  if ($update){
      return 1;
  } else {
    return 0;
  } 
    
}
function eliminar_stock_proyector($proyector_id){
  global $con;
  $update=mysqli_query($con,"delete from proyector where proyector_id='$proyector_id'");
  if ($update){
      return 1;
  } else {
    return 0;
  }     
}

//EMISORA
function agregar_stock_emisora($id_producto,$numserie){
  global $con;
  $update=mysqli_query($con,"insert into emisoras (emi_serie, emi_casa, id_producto) values ('$numserie', '1', '$id_producto')");
  if ($update){
      return 1;
  } else {
    return 0;
  } 
    
}
function eliminar_stock_emisora($emi_id){
  global $con;
  $update=mysqli_query($con,"delete from emisoras where emi_id='$emi_id'");
  if ($update){
      return 1;
  } else {
    return 0;
  }     
}

//HÉLICES
function agregar_stock_helices($id_producto,$numserie){
  global $con;
  $update=mysqli_query($con,"insert into helices (heli_serie, heli_casa, id_producto) values ('$numserie', '1', '$id_producto')");
  if ($update){
      return 1;
  } else {
    return 0;
  } 
    
}
function eliminar_stock_helices($heli_id){
  global $con;
  $update=mysqli_query($con,"delete from helices where heli_id='$heli_id'");
  if ($update){
      return 1;
  } else {
    return 0;
  }     
}

//BATERIAS
function agregar_stock_baterias($id_producto,$numserie){
  global $con;
  $update=mysqli_query($con,"insert into baterias (bat_serie, bat_casa, id_producto) values ('$numserie', '1', '$id_producto')");
  if ($update){
      return 1;
  } else {
    return 0;
  } 
    
}
function eliminar_stock_baterias($bat_id){
  global $con;
  $update=mysqli_query($con,"delete from baterias where bat_id='$bat_id'");
  if ($update){
      return 1;
  } else {
    return 0;
  }     
}

//CARGADORES
function agregar_stock_cargadores($id_producto,$numserie){
  global $con;
  $update=mysqli_query($con,"insert into cargadores (car_serie, car_casa, id_producto) values ('$numserie', '1', '$id_producto')");
  if ($update){
      return 1;
  } else {
    return 0;
  } 
    
}
function eliminar_stock_cargadores($car_id){
  global $con;
  $update=mysqli_query($con,"delete from cargadores where car_id='$car_id'");
  if ($update){
      return 1;
  } else {
    return 0;
  }     
}

//HUBS
function agregar_stock_hub($id_producto,$numserie){
  global $con;
  $update=mysqli_query($con,"insert into hubs (hub_serie, hub_casa, id_producto) values ('$numserie', '1', '$id_producto')");
  if ($update){
      return 1;
  } else {
    return 0;
  } 
    
}
function eliminar_stock_hub($hub_id){
  global $con;
  $update=mysqli_query($con,"delete from hubs where hub_id='$hub_id'");
  if ($update){
      return 1;
  } else {
    return 0;
  }     
}


function uploadImgBase64 ($base64, $name){
    // decodificamos el base64
    $datosBase64 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64));
    
    // definimos la ruta donde se guardara en el server
    $path= '../firmas/'.$name;
    
    // guardamos la imagen en el server
    if(!file_put_contents($path, $datosBase64)){
        // retorno si falla
        return false;
    }
    else{
        // retorno si todo fue bien
        return true;
    }
}

//envio mail
function envioMail_regis($user_correo, $user_nombre, $user_pass) {
      $direccion = "http://inventario.aerocamaras.es/";
      $destinatario = $user_correo; 
      $asunto = "Inventario"; 
      $cuerpo = ' 
          <html> 
            <head> 
              <title>Usuario Activado</title> 
            </head> 
            <body>
          
          <p>Felicidades '.$user_nombre.'<b> su usuario ha sido activado</b>.</p>
          <p> Estos son sus datos de acceso:</p>
          <ul>
          <li>Email: '.$user_correo.'</li>
          <li>Pass: '.$user_pass.'</li>
          </ul>
          <p>Esperamos que disfrute de su navegación por nuestra web.</p>
          <p><a href=';
          $cuerpo .= $direccion;
          $cuerpo .= " target=_blank>Accede a la web</a></p></body></html>";

      $cuerpo = utf8_decode($cuerpo);

      //para el envío en formato HTML 
      //dirección del remitente 
      $headers = "From: Aerocamaras <info@aerocamaras.es>\r\n"; 
          //dirección de respuesta, si queremos que sea distinta que la del remitente 
      $headers .= "Reply-To: info@aerocamaras.es\r\n"; 
          $headers .= "Return-Path: info@aerocamaras.es\r\n";
          $headers .= "MIME-Version: 1.0\r\n";
          $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
          $headers .= "X-Priority: 3\r\n";

      //En localhost el envío de e-mail a veces no funciona, hay que configurar algunas cosas.
      $mail->CharSet = 'UTF-8';
      mail($destinatario,$asunto,$cuerpo,$headers);
  }

  //envio mail instructor seleccionado
function envioMail_selec($user_correo, $user_nombre, $convocatoria) {
      $direccion = "http://inventario.aerocamaras.es/";
      $destinatario = $user_correo; 
      $asunto = "Inventario"; 
      $cuerpo = ' 
          <html> 
            <head> 
              <title>Usuario Seleccionado</title> 
            </head> 
            <body>
          
          <p>'.$user_nombre.' has sido seleccionado para la convocatoria '.$convocatoria.'.</b>.</p>
          <p> En breve nos pondremos en contacto con usted.</p>';
          
          $cuerpo .= "</body></html>";

      $cuerpo = utf8_decode($cuerpo);

      //para el envío en formato HTML 
      //dirección del remitente 
      $headers = "From: Aerocamaras <info@aerocamaras.es>\r\n"; 
          //dirección de respuesta, si queremos que sea distinta que la del remitente 
      $headers .= "Reply-To: info@aerocamaras.es\r\n"; 
          $headers .= "Return-Path: info@aerocamaras.es\r\n";
          $headers .= "MIME-Version: 1.0\r\n";
          $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
          $headers .= "X-Priority: 3\r\n";

      //En localhost el envío de e-mail a veces no funciona, hay que configurar algunas cosas.
      $mail->CharSet = 'UTF-8';
      mail($destinatario,$asunto,$cuerpo,$headers);
  }



?>