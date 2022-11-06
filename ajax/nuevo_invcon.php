<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado

require_once '../vendor/html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
	
		if (empty($_POST['convocatoria'])){
			$errors[] = "Convocatoria vacía";
		} elseif (empty($_POST['instructor'])){
			$errors[] = "instructor vacío";
		}  elseif (empty($_POST['aula'])) {
            $errors[] = "Aula vacía";
        }  elseif (
			!empty($_POST['convocatoria'])
			&& !empty($_POST['instructor'])
			&& !empty($_POST['aula'])
        ) {
            require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
    		include("../funciones.php");
			
				// escaping, additionally removing everything that could be (html/javascript-) code
                $id_convocatoria = mysqli_real_escape_string($con,(strip_tags($_POST["convocatoria"],ENT_QUOTES)));
	            $con2 = mysqli_connect("31.193.227.98", "cursoded_encuest", "ZKD,Ey8EzqgQ", "cursoded_encuesta");
	            mysqli_set_charset($con2, 'utf8');
	            $sql_convocatoria="SELECT * FROM  convocatorias WHERE id ='".$id_convocatoria."'";
	            $query_convocatoria = mysqli_query($con2, $sql_convocatoria);
	            while ($row_convocatoria=mysqli_fetch_array($query_convocatoria)){
	              $n_convocatoria=$row_convocatoria['convocatoria'];
	              $fecha_p=$row_convocatoria['fecha_presencial'];
	            }
				$instructor = mysqli_real_escape_string($con,(strip_tags($_POST["instructor"],ENT_QUOTES)));
				$aula = mysqli_real_escape_string($con,(strip_tags($_POST["aula"],ENT_QUOTES)));
                if(isset($_POST["campo"]) && !empty($_POST["campo"])) {
                	$campo = mysqli_real_escape_string($con,(strip_tags($_POST["campo"],ENT_QUOTES)));
                }
                else {
                	$campo="";
                }
                if(isset($_POST["chalecos"]) && !empty($_POST["chalecos"])) {
                	$chalecos = mysqli_real_escape_string($con,(strip_tags($_POST["chalecos"],ENT_QUOTES)));
                }
                else {
                	$chalecos="0";
                }
                if(isset($_POST["boligrafos"]) && !empty($_POST["boligrafos"])) {
                	$boligrafos = mysqli_real_escape_string($con,(strip_tags($_POST["boligrafos"],ENT_QUOTES)));
                }
                else {
                	$boligrafos="0";
                }
                if(isset($_POST["regletas"]) && !empty($_POST["regletas"])) {
                	$regletas = mysqli_real_escape_string($con,(strip_tags($_POST["regletas"],ENT_QUOTES)));
                }
                else {
                	$regletas="0";
                }
                if(isset($_POST["proyector"]) && !empty($_POST["proyector"])) {
                    $proyector="";
                    foreach($_POST['proyector'] as $valor) {
                        $proyector .= $valor.", ";
                    }
                }
                else {
                    $proyector="";
                }
                if(isset($_POST["bandaaerea"]) && !empty($_POST["bandaaerea"])) {
                	foreach($_POST['bandaaerea'] as $valor) {
                		$bandaaerea = $valor.", ";
					}
                }
                else {
                	$bandaaerea="";
                }
                if(isset($_POST["aeronave"]) && !empty($_POST["aeronave"])) {
                	$aeronave = mysqli_real_escape_string($con,(strip_tags($_POST["aeronave"],ENT_QUOTES)));
                }
                else {
                	$aeronave="";
                }
                if(isset($_POST["aeronaveserie"]) && !empty($_POST["aeronaveserie"])) {
                	$aeronaveserie="";
                	foreach($_POST['aeronaveserie'] as $valor) {
                		$aeronaveserie .= $valor.", ";
					}
                }
                else {
                	$aeronaveserie="";
                }
                if(isset($_POST["emisora"]) && !empty($_POST["emisora"])) {
                	$emisora="";
                	foreach($_POST['emisora'] as $valor) {
                		$emisora .= $valor.", ";
					}
                }
                else {
                	$emisora="";
                }
                if(isset($_POST["caremisora"]) && !empty($_POST["caremisora"])) {
                	$caremisora="";
                	foreach($_POST['caremisora'] as $valor) {
                		$caremisora .= $valor.", ";
					}
                }
                else {
                	$caremisora="";
                }
                if(isset($_POST["helices"]) && !empty($_POST["helices"])) {
                	$helices="";
                	foreach($_POST['helices'] as $valor) {
                		$helices .= $valor.", ";
					}
                }
                else {
                	$helices="";
                }
                if(isset($_POST["baterias"]) && !empty($_POST["baterias"])) {
                	$baterias="";
                	foreach($_POST['baterias'] as $valor) {
                		$baterias .= $valor.", ";
					}
                }
                else {
                	$baterias="";
                }
                if(isset($_POST["carbaterias"]) && !empty($_POST["carbaterias"])) {
                	foreach($_POST['carbaterias'] as $valor) {
                		$carbaterias = $valor.", ";
					}
                }
                else {
                	$carbaterias="";
                }
                if(isset($_POST["hub"]) && !empty($_POST["hub"])) {
                	$hub="";
                	foreach($_POST['hub'] as $valor) {
                		$hub .= $valor.", ";
					}
                }
                else {
                	$hub="";
                }
                if(isset($_POST["alimentacion"]) && !empty($_POST["alimentacion"])) {
                	$alimentacion = mysqli_real_escape_string($con,(strip_tags($_POST["alimentacion"],ENT_QUOTES)));
                }
                else {
                	$alimentacion="0";
                }
                if(isset($_POST["otg"]) && !empty($_POST["otg"])) {
                	$otg = mysqli_real_escape_string($con,(strip_tags($_POST["otg"],ENT_QUOTES)));
                }
                else {
                	$otg="0";
                }
                if(isset($_POST["usb"]) && !empty($_POST["usb"])) {
                	$usb = mysqli_real_escape_string($con,(strip_tags($_POST["usb"],ENT_QUOTES)));
                }
                else {
                	$usb="0";
                }
                if(isset($_POST["c"]) && !empty($_POST["c"])) {
                	$c = mysqli_real_escape_string($con,(strip_tags($_POST["c"],ENT_QUOTES)));
                }
                else {
                	$c="0";
                }
                if(isset($_POST["lightning"]) && !empty($_POST["lightning"])) {
                	$lightning = mysqli_real_escape_string($con,(strip_tags($_POST["lightning"],ENT_QUOTES)));
                }
                else {
                	$lightning="0";
                }
                if(isset($_POST["memoria32"]) && !empty($_POST["memoria32"])) {
                	$memoria32 = mysqli_real_escape_string($con,(strip_tags($_POST["memoria32"],ENT_QUOTES)));
                }
                else {
                	$memoria32="0";
                }
                if(isset($_POST["memoria64"]) && !empty($_POST["memoria64"])) {
                	$memoria64 = mysqli_real_escape_string($con,(strip_tags($_POST["memoria64"],ENT_QUOTES)));
                }
                else {
                	$memoria64="0";
                }
                if(isset($_POST["memoria128"]) && !empty($_POST["memoria128"])) {
                	$memoria128 = mysqli_real_escape_string($con,(strip_tags($_POST["memoria128"],ENT_QUOTES)));
                }
                else {
                	$memoria128="0";
                }
                if(isset($_POST["pcsimulador"]) && !empty($_POST["pcsimulador"])) {
                	$pcsimulador="";
                	foreach($_POST['pcsimulador'] as $valor) {
                		$pcsimulador .= $valor.", ";
					}
                }
                else {
                	$pcsimulador="";
                }
                if(isset($_POST["emisorasimulador"]) && !empty($_POST["emisorasimulador"])) {
                	$emisorasimulador="";
                	foreach($_POST['emisorasimulador'] as $valor) {
                		$emisorasimulador .= $valor.", ";
					}
                }
                else {
                	$emisorasimulador="";
                }
                if(isset($_POST["botiquin"]) && !empty($_POST["botiquin"])) {
                	$botiquin = mysqli_real_escape_string($con,(strip_tags($_POST["botiquin"],ENT_QUOTES)));
                }
                else {
                	$botiquin="0";
                }
                if(isset($_POST["arnes"]) && !empty($_POST["arnes"])) {
                	$arnes = mysqli_real_escape_string($con,(strip_tags($_POST["arnes"],ENT_QUOTES)));
                }
                else {
                	$arnes="0";
                }
                if(isset($_POST["horasdron"]) && !empty($_POST["horasdron"])) {
                    $horasdron = mysqli_real_escape_string($con,(strip_tags($_POST["horasdron"],ENT_QUOTES)));
                }
                else {
                    $horasdron="0";
                }

				if (isset($_POST['firma1'])) { 
					$firma1 = 'firma1-'.$_SESSION['firstname'].' '.$_SESSION['lastname'].'-'.date('dmYHis').'-convocatoria.png';
					uploadImgBase64($_POST['firma1'], $firma1);
				} else {
					$firma1 = "";
				}

                if(isset($_POST["tipo_convocatoria"])) {
                	$tipo_convocatoria = mysqli_real_escape_string($con,(strip_tags($_POST["tipo_convocatoria"],ENT_QUOTES)));
                }
                else {
                	$tipo_convocatoria="";
                }

				$date_added=date("Y-m-d H:i:s");
		        $pdf = "pdf/"."inventario-convocatoria-".$n_convocatoria."-".date('dmYHis').".pdf";
				$url_pdf=URL_DIR.$pdf;
		        $user_id=$_SESSION['user_id'];

				$content = '<h2 style="text-align:center;">INVENTARIO PARA CONVOCATORIA</h2>
				<div style="width:100%;"">
					<img style="width:50%; float: left;" src="../img/logo2.png">
					<table style="width:40%; margin-left:10px; margin-top:25px; float: right;">
					<tr>
						<td style="width:300px; border:1px solid; text-align: center;">'.$n_convocatoria.'</td>
					</tr>
					<tr>
						<td style="width:300px; border:1px solid; text-align: center;">'.date('d/m/Y', strtotime($fecha_p)).'</td>
					</tr>
					<tr>
						<td style="width:300px; border:1px solid; text-align: center;">SALIDA</td>
					</tr>
					<tr>
						<td style="width:300px; border:1px solid; text-align: center;">'.date('d/m/Y', strtotime($date_added)).'</td>
					</tr>
                    <tr>
                        <td style="width:300px; border:1px solid; text-align: left; margin-left:20px;">ENTREGADO: </td>
                    </tr>
                    <tr>
                        <td style="width:300px; border:1px solid; text-align: left; margin-left:20px;">DEVUELTO: </td>
                    </tr>
					</table>
				</div>

				<table style="width:100%; margin-top:50px;">
					<tr>
						<td style="width:100%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">INSTRUCTOR</td>
					</tr>
					<tr>
        				<td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.nombre_instructor($instructor).'</td> 
					</tr>
				</table>

				<table style="width:100%; margin-top:10px;">
					<tr>
						<td style="width:100%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">AULA</td>
					</tr>
					<tr>
        				<td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.nombre_aula($aula).'</td> 
					</tr>
				</table>';

				if($tipo_convocatoria == "oficial") {
					$content .= '<table style="width:100%; margin-top:10px;">
						<tr>
							<td style="width:100%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">CAMPO DE VUELO</td>
						</tr>
						<tr>
	        				<td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.nombre_campo($campo).'</td> 
						</tr>
					</table>';

                    $content .= '<table style="width:100%; margin-top:10px;">
                        <tr>
                            <td style="width:100%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">AERONAVE</td>
                        </tr>';
                            if(!empty($aeronaveserie)) {
                                $eee = explode(',',$aeronaveserie); 
                                foreach($eee as $e){
                                    if(!empty(trim($e))) {
                                        $content .='
                        <tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.nombre_categoria($_POST['aeronave']).' '.get_row("aeronaves","aero_serie", "aero_id", $e).'</td></tr>';
                                    }
                                }
                            }
                            else {
                                $content .='<tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;"></td></tr>';
                            }
                    $content .='</table>';

                    $content .= '<table style="width:100%; margin-top:10px;">
                        <tr>
                            <td style="width:100%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">EMISORA</td>
                        </tr>';
                            if(!empty($emisora)) {
                                $eee = explode(',',$emisora); 
                                foreach($eee as $e){
                                    if(!empty(trim($e))) {
                                        $content .='<tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.get_row("emisoras","emi_serie", "emi_id", $e).'</td></tr>';
                                    }
                                }
                            }
                            else {
                                $content .='<tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;"></td></tr>';
                            }
                    $content .='</table>';

                    $content .= '<table style="width:100%; margin-top:10px;">
                        <tr>
                            <td style="width:100%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">CARGADOR DE EMISORA</td>
                        </tr>';
                            if(!empty($caremisora)) {
                                $eee = explode(',',$caremisora); 
                                foreach($eee as $e){
                                    if(!empty(trim($e))) {
                                        $content .='<tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.get_row("cargadores","car_serie", "car_id", $e).'</td></tr>';
                                    }
                                }
                            }
                            else {
                                $content .='<tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;"></td></tr>';
                            }
                    $content .='</table>';

                    $content .= '<table style="width:100%; margin-top:10px;">
                        <tr>
                            <td style="width:100%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">HÉLICES</td>
                        </tr>';
                            if(!empty($helices)) {
                                $eee = explode(',',$helices); 
                                foreach($eee as $e){
                                    if(!empty(trim($e))) {
                                        $content .='<tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.get_row("helices","heli_serie", "heli_id", $e).'</td></tr>';
                                    }
                                }
                            }
                            else {
                                $content .='<tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;"></td></tr>';
                            }
                    $content .='</table>';

                    $content .= '<table style="width:100%; margin-top:10px;">
                        <tr>
                            <td style="width:100%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">BATERÍAS</td>
                        </tr>';
                            if(!empty($baterias)) {
                                $eee = explode(',',$baterias); 
                                foreach($eee as $e){
                                    if(!empty(trim($e))) {
                                        $content .='<tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.get_row("baterias","bat_serie", "bat_id", $e).'</td></tr>';
                                    }
                                }
                            }
                            else {
                                $content .='<tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;"></td></tr>';
                            }
                    $content .='</table>';

                    $content .= '<table style="width:100%; margin-top:10px;">
                        <tr>
                            <td style="width:100%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">CARGADOR DE BATERÍAS</td>
                        </tr>';
                            if(!empty($carbaterias)) {
                                $eee = explode(',',$carbaterias); 
                                foreach($eee as $e){
                                    if(!empty(trim($e))) {
                                        $content .='<tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.get_row("cargadores","car_serie", "car_id", $e).'</td></tr>';
                                    }
                                }
                            }
                            else {
                                $content .='<tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;"></td></tr>';
                            }
                    $content .='</table>';

                    $content .= '<table style="width:100%; margin-top:10px;">
                        <tr>
                            <td style="width:100%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">HUB</td>
                        </tr>';
                            if(!empty($hub)) {
                                $eee = explode(',',$hub); 
                                foreach($eee as $e){
                                    if(!empty(trim($e))) {
                                        $content .='<tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.get_row("hubs","hub_serie", "hub_id", $e).'</td></tr>';
                                    }
                                }
                            }
                            else {
                                $content .='<tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;"></td></tr>';
                            }
                    $content .='</table>';

                    $content .='<table style="width:100%; margin-top:10px;">
                        <tr>
                            <td style="width:90%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">CABLES DE ALIMENTACIÓN</td>
                            <td style="text-align:center; width:10%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.$alimentacion.'</td>
                        </tr>
                    </table>

                    <table style="width:100%; margin-top:10px;">
                        <tr>
                            <td style="width:90%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">CABLES OTG</td>
                            <td style="text-align:center; width:10%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.$otg.'</td>
                        </tr>
                    </table>

                    <table style="width:100%; margin-top:10px;">
                        <tr>
                            <td style="width:90%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">CABLES USB</td>
                            <td style="text-align:center; width:10%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.$usb.'</td>
                        </tr>
                    </table>

                    <table style="width:100%; margin-top:10px;">
                        <tr>
                            <td style="width:90%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">CABLES TYPE-C</td>
                            <td style="text-align:center; width:10%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.$c.'</td>
                        </tr>
                    </table>

                    <table style="width:100%; margin-top:10px;">
                        <tr>
                            <td style="width:90%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">CABLES LIGHTNING</td>
                            <td style="text-align:center; width:10%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.$lightning.'</td>
                        </tr>
                    </table>

                    <table style="width:100%; margin-top:10px;">
                        <tr>
                            <td style="width:90%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">TARJETAS MICROSD 32GB</td>
                            <td style="text-align:center; width:10%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.$memoria32.'</td>
                        </tr>
                    </table>

                    <table style="width:100%; margin-top:10px;">
                        <tr>
                            <td style="width:90%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">TARJETAS MICROSD 64GB</td>
                            <td style="text-align:center; width:10%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.$memoria64.'</td>
                        </tr>
                    </table>

                    <table style="width:100%; margin-top:10px;">
                        <tr>
                            <td style="width:90%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">TARJETAS MICROSD 128GB</td>
                            <td style="text-align:center; width:10%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.$memoria128.'</td>
                        </tr>
                    </table>';

                    $content .= '<table style="width:100%; margin-top:10px;">
                        <tr>
                            <td style="width:100%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">PC SIMULADOR</td>
                        </tr>';
                            if(!empty($pcsimulador)) {
                                $eee = explode(',',$pcsimulador); 
                                foreach($eee as $e){
                                    if(!empty(trim($e))) {
                                        $content .='<tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.get_row("simulador","simulador_ref", "simulador_id", $e).'</td></tr>';
                                    }
                                }
                            }
                            else {
                                $content .='<tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;"></td></tr>';
                            }
                    $content .='</table>';

                    $content .= '<table style="width:100%; margin-top:10px;">
                        <tr>
                            <td style="width:100%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">EMISORA SIMULADOR</td>
                        </tr>';
                            if(!empty($emisorasimulador)) {
                                $eee = explode(',',$emisorasimulador); 
                                foreach($eee as $e){
                                    if(!empty(trim($e))) {
                                        $content .='<tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.get_row("simulador","simulador_ref", "simulador_id", $e).'</td></tr>';
                                    }
                                }
                            }
                            else {
                                $content .='<tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;"></td></tr>';
                            }
                    $content .='</table>';
                
                    $content .= '<table style="width:100%; margin-top:10px;">
                        <tr>
                            <td style="width:90%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">BOTIQUINES</td>
                            <td style="text-align:center; width:10%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.$botiquin.'</td>
                        </tr>
                    </table>

                    <table style="width:100%; margin-top:10px;">
                        <tr>
                            <td style="width:90%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">ARNESES</td>
                            <td style="text-align:center; width:10%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.$arnes.'</td>
                        </tr>
                    </table>';

				}
				else {
					$content .= '<table style="width:100%; margin-top:10px;">
						<tr>
							<td style="width:100%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">EMISORA DE BANDA AÉREA</td>
						</tr>';
                            if(!empty($bandaaerea)) {
                                $eee = explode(',',$bandaaerea); 
                                foreach($eee as $e){
                                    if(!empty(trim($e))) {
                                        $content .='<tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.get_row("emisoras","emi_serie", "emi_id", $e).'</td></tr>';
                                    }
                                }
                            }
                            else {
                                $content .='<tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;"></td></tr>';
                            }
					$content .='</table>';
				}
				
				$content .= '<table style="width:100%; margin-top:10px;">
					<tr>
						<td style="width:90%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">CHALECOS</td>
						<td style="text-align:center; width:10%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.$chalecos.'</td>
					</tr>
				</table>

				<table style="width:100%; margin-top:10px;">
					<tr>
						<td style="width:90%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">BOLÍGRAFOS</td>
						<td style="text-align:center; width:10%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.$boligrafos.'</td>
					</tr>
				</table>

				<table style="width:100%; margin-top:10px;">
					<tr>
						<td style="width:90%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">REGLETAS</td>
						<td style="text-align:center; width:10%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.$regletas.'</td>
					</tr>
				</table>';
				
                $content .= '<table style="width:100%; margin-top:10px;">
                    <tr>
                        <td style="width:100%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">PROYECTORES</td>
                    </tr>';
                        if(!empty($proyector)) {
                            $eee = explode(',',$proyector); 
                            foreach($eee as $e){
                                if(!empty(trim($e))) {
                                    $content .='<tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.get_row("proyector","proyector_serie", "proyector_id", $e).'</td></tr>';
                                }
                            }
                        }
                        else {
                            $content .='<tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;"></td></tr>';
                        }
                $content .='</table>';

                $content .= '<table style="width:100%; text-align: center; margin:0 auto; margin-top:20px;">
                    <tr>
                        <td style="width:30%;"></td>
                        <td style="width:40%; text-align: center;">FIRMA: '.$_SESSION['firstname'].' '.$_SESSION['lastname'].'</td>
                        <td style="width:30%;"></td>
                    </tr>
                    <tr>
                        <td style="width:30%;"></td>
                        <td style="width:40%; text-align: center; padding: 10px;"><img style="width:100%;" src="../firmas/'.$firma1.'" />
                        </td>
                        <td style="width:30%;"></td>
                    </tr>
                </table>';

			    $sql="INSERT INTO invcon(n_convocatoria, fecha_convocatoria, id_instructor, id_aula, id_campo, aeronave, banda_aerea, emisora, car_emisora, helices, bateria, car_baterias, hub, cable_alimentacion, cable_otg, cable_usb, cable_c, cable_light, sd_32, sd_64, sd_128, pc_simulador, emi_simulador, botiquin, arnes, chaleco, boligrafo, regleta, proyector, id_user, horas_aeronave, url_pdf, firma, fecha, entregado, devuelto) VALUES ('$n_convocatoria', '$fecha_p', '$instructor', '$aula', '$campo', '$aeronaveserie', '$bandaaerea', '$emisora', '$caremisora', '$helices', '$baterias', '$carbaterias', '$hub', '$alimentacion', '$otg', '$usb', '$c', '$lightning', '$memoria32', '$memoria64', '$memoria128', '$pcsimulador', '$emisorasimulador', '$botiquin', '$arnes', '$chalecos', '$boligrafos', '$regletas', '$proyector', '$user_id', '$horasdron', '$url_pdf', '$firma1', '$date_added', 0, 0)";
			    $query_new_insert = mysqli_query($con,$sql);
			      if ($query_new_insert){
			        $messages[] = "Inventario para convocatoria ha sido ingresada satisfactoriamente.";
			        $id_invcon=get_row('invcon','invcon_id', 'n_convocatoria', $n_convocatoria);
			        $user_id=$_SESSION['user_id'];
			        $firstname=$_SESSION['firstname']." ".$_SESSION['lastname'];
                    $n_aula = nombre_aula($aula);
                    $n_instructor = nombre_instructor($instructor);
                    $c_instructor = correo_instructor($instructor);
			        $nota="$firstname agregó inventario a la convocatoria $n_convocatoria";
                    $nota_aula="$firstname seleccionó el aula $n_aula para la convocatoria $n_convocatoria";
                    $nota_instructor="$firstname seleccionó el instructor $n_instructor para la convocatoria $n_convocatoria";
			        echo guardar_historial_invcon($id_invcon,$user_id,$date_added,$nota);
                    echo guardar_historial_aulas($aula,$user_id,$date_added,$nota_aula);
                    if (isset($campo) && !empty($campo)) {
                        $n_campo = nombre_aula($campo);
                        $nota_campo="$firstname seleccionó el campo de vuelo $n_campo para la convocatoria $n_convocatoria";
                        echo guardar_historial_campos($campo,$user_id,$date_added,$nota_campo);
                    }
                    echo guardar_historial_instructores($instructor,$user_id,$date_added,$nota_instructor);
                    envioMail_selec($c_instructor, $n_instructor, $n_convocatoria);
				    $html2pdf = new Html2Pdf('P', 'A4', 'es');
				    $html2pdf->setDefaultFont('Arial');
				    $html2pdf->writeHTML($content);
				    $html2pdf->output(URL_BASE.$pdf, 'F');
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