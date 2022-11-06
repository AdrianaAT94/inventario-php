<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
//Archivo de funciones PHP
include("../funciones.php");

require_once '../vendor/html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
  
if (isset($_POST['entregar_id'])){
    $id_invcon=intval($_POST['entregar_id']); 
    $user_id=$_SESSION['user_id'];
    $firstname=$_SESSION['firstname'];
    $fecha=date("Y-m-d H:i:s");
    $query=mysqli_query($con, "select * from invcon where invcon_id='".$id_invcon."'");
    $count=mysqli_num_rows($query);
    if ($count>=0){        
        while ($row=mysqli_fetch_array($query)){
            $observaciones=$_POST['observaciones_entre'];
            $fecha_entregado=date("Y-m-d H:i:s");
            $id_invcon=$row['invcon_id'];
            $n_convocatoria=$row['n_convocatoria'];
            $fecha_p=date('d/m/Y', strtotime($row['fecha_convocatoria']));
            $id_instructor=$row['id_instructor'];
            $n_instructor=nombre_instructor($id_instructor);
            $id_aula=$row['id_aula'];
            $n_aula=nombre_aula($id_aula);
            $id_campo=$row['id_campo'];
            if(!empty($id_campo)) {
                $n_campo=nombre_campo($id_campo);
            }
            else {
                $n_campo="";
            }
            $fecha = $row['fecha'];
            $date_added= date('d/m/Y', strtotime($fecha));
            $fecha_d = $row['fecha_devuelto'];
            if(!empty($fecha_e)) {
                $fecha_devuelto=date('d/m/Y', strtotime($fecha_d));
            }
            else {
                $fecha_devuelto="";
            }
            $firma1=$row['firma'];
            $bandaaerea=$row['banda_aerea'];
            $chalecos=$row['chaleco'];
            $boligrafos=$row['boligrafo'];
            $regletas=$row['regleta'];
            $proyector=$row['proyector'];
            $aeronaveserie=$row['aeronave'];
            $emisora=$row['emisora'];
            $caremisora=$row['car_emisora'];
            $helices=$row['helices'];
            $baterias=$row['bateria'];
            $carbaterias=$row['car_baterias'];
            $alimentacion=$row['cable_alimentacion'];
            $otg=$row['cable_otg'];
            $usb=$row['cable_usb'];
            $c=$row['cable_c'];
            $lightning=$row['cable_light'];
            $memoria32=$row['sd_32'];
            $memoria64=$row['sd_64'];
            $memoria128=$row['sd_128'];
            $pcsimulador=$row['pc_simulador'];
            $emisorasimulador=$row['emi_simulador'];
            $arnes=$row['arnes'];
            $botiquin=$row['botiquin'];


            $content = '<h2 style="text-align:center;">INVENTARIO PARA CONVOCATORIA</h2>
            <div style="width:100%;"">
                <img style="width:50%; float: left;" src="../img/logo2.png">
                <table style="width:40%; margin-left:10px; margin-top:25px; float: right;">
                <tr>
                    <td style="width:300px; border:1px solid; text-align: center;">'.$n_convocatoria.'</td>
                </tr>
                <tr>
                    <td style="width:300px; border:1px solid; text-align: center;">'.$fecha_p.'</td>
                </tr>
                <tr>
                    <td style="width:300px; border:1px solid; text-align: center;">SALIDA</td>
                </tr>
                <tr>
                    <td style="width:300px; border:1px solid; text-align: center;">'.$date_added.'</td>
                </tr>
                <tr>
                    <td style="width:300px; border:1px solid; text-align: left; margin-left:20px;">ENTREGADO: '.date('d/m/Y', strtotime($fecha_entregado)).'</td>
                </tr>
                <tr>
                    <td style="width:300px; border:1px solid; text-align: left; margin-left:20px;">DEVUELTO: '.$fecha_devuelto.'</td>
                </tr>
                </table>
            </div>

            <table style="width:100%; margin-top:50px;">
                <tr>
                    <td style="width:100%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">INSTRUCTOR</td>
                </tr>
                <tr>
                    <td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.$n_instructor.'</td> 
                </tr>
            </table>

            <table style="width:100%; margin-top:10px;">
                <tr>
                    <td style="width:100%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">AULA</td>
                </tr>
                <tr>
                    <td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.$n_aula.'</td> 
                </tr>
            </table>';

            if ((substr($n_convocatoria,-1)=='R')) {
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
            else {
                    $content .= '<table style="width:100%; margin-top:10px;">
                        <tr>
                            <td style="width:100%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">CAMPO DE VUELO</td>
                        </tr>
                        <tr>
                            <td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.$n_campo.'</td> 
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
                        <tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.devuelve_categoria(nombre_categoria($e)).' '.get_row("aeronaves","aero_serie", "aero_id", $e).'</td></tr>';
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
                                    $content .='<tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.get_row("proyector","proyector_serie", "proyector_id", $e).'</td></tr>';                                }
                            }
                        }
                        else {
                            $content .='<tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;"></td></tr>';
                        }
                $content .='</table>';            

                $content .= '<table style="width:100%; margin-top:10px;">
                    <tr>
                        <td style="width:100%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">OBSERVACIONES EN EL MOMENTO DE LA ENTREGA</td>
                    </tr>
                    <tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.$observaciones.'</td></tr>
                    </table>';

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

        }
        if ($act=mysqli_query($con,"UPDATE invcon SET entregado=1, obs_entre='".$observaciones."', fecha_entregado='".$fecha_entregado."' WHERE invcon_id='".$id_invcon."'")) {
            $user_id=$_SESSION['user_id'];
            $firstname=$_SESSION['firstname']." ".$_SESSION['lastname'];
            $nota="$firstname marcó como entregados los productos de inventario en la convocatoria $n_convocatoria";
            echo guardar_historial_invcon($id_invcon,$user_id,$fecha_entregado,$nota);
            $html2pdf = new Html2Pdf('P', 'A4', 'es');
            $html2pdf->setDefaultFont('Arial');
            $html2pdf->writeHTML($content);
            $pdf = "pdf/"."inventario-convocatoria-".$n_convocatoria."-".date('dmYHis', strtotime($fecha)).".pdf";
            $url_pdf=URL_BASE.$pdf;
            $html2pdf->output($url_pdf, 'F');

            if(isset($bandaaerea) && !empty($bandaaerea)) { 
                $quantity=0;              
                $reference=$n_convocatoria;
                $fecha=$fecha_entregado;
                $eee = explode(',',$bandaaerea); 
                foreach($eee as $e){
                    if(!empty(trim($e))) {
                        mysqli_query($con,"UPDATE emisoras SET emi_casa=0 WHERE emi_id='".$e."'");
                        $quantity=$quantity+1;
                        $id_producto=get_row("emisoras","id_producto", "emi_id", $e);
                        $n_produto= nombre_producto($id_producto);
                        $nota_stock="$firstname marcó como entregados elementos del producto $n_produto a la convocatoria $n_convocatoria";
                    }
                }
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($chalecos) && !empty($chalecos)) {
                mysqli_query($con,"UPDATE products SET stock_actual=stock_actual-'$chalecos', stock_fuera=stock_fuera+'$chalecos' WHERE id_producto='69'");  
                $quantity=$chalecos;   
                $reference=$n_convocatoria;
                $fecha=$fecha_entregado;
                $id_producto=get_row("products","id_producto", "id_producto", "69");
                $n_produto= nombre_producto($id_producto);
                $nota_stock="$firstname marcó como entregados $quantity unidad(es) del producto $n_produto a la convocatoria $n_convocatoria";
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($boligrafos) && !empty($boligrafos)) {
                mysqli_query($con,"UPDATE products SET stock_actual=stock_actual-'$boligrafos', stock_fuera=stock_fuera+'$boligrafos' WHERE id_producto='68'");
                $quantity=$boligrafos;   
                $reference=$n_convocatoria;
                $fecha=$fecha_entregado;
                $id_producto=get_row("products","id_producto", "id_producto", "68");
                $n_produto= nombre_producto($id_producto);
                $nota_stock="$firstname marcó como entregados $quantity unidad(es) del producto $n_produto a la convocatoria $n_convocatoria";                
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($regletas) && !empty($regletas)) {
                mysqli_query($con,"UPDATE products SET stock_actual=stock_actual-'$regletas', stock_fuera=stock_fuera+'$regletas' WHERE id_producto='73'");
                $quantity=$regletas;   
                $reference=$n_convocatoria;
                $fecha=$fecha_entregado;
                $id_producto=get_row("products","id_producto", "id_producto", "73");
                $n_produto= nombre_producto($id_producto);
                $nota_stock="$firstname marcó como entregados $quantity unidad(es) del producto $n_produto a la convocatoria $n_convocatoria";                
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($proyector) && !empty($proyector)) { 
                $quantity=0;              
                $reference=$n_convocatoria;
                $fecha=$fecha_entregado;
                $eee = explode(',',$proyector); 
                foreach($eee as $e){
                    if(!empty(trim($e))) {
                        mysqli_query($con,"UPDATE proyector SET proyector_casa=0 WHERE proyector_id='".$e."'");
                        $quantity=$quantity+1;
                        $id_producto=get_row("proyector","id_producto", "proyector_id", $e);
                        $n_produto= nombre_producto($id_producto);
                        $nota_stock="$firstname marcó como entregados elementos del producto $n_produto a la convocatoria $n_convocatoria";
                    }
                }
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($aeronaveserie) && !empty($aeronaveserie)) {  
                $quantity=0;              
                $reference=$n_convocatoria;
                $fecha=$fecha_entregado;
                $eee = explode(',',$aeronaveserie); 
                foreach($eee as $e){
                    if(!empty(trim($e))) {
                        $id_categoria=devuelve_categoria($e);
                        mysqli_query($con,"UPDATE aeronaves SET aero_casa=0 WHERE aero_id='".$e."'");
                        $quantity=$quantity+1;
                        $id_producto=get_row("aeronaves","id_producto", "aero_id", $e);
                        $n_produto= nombre_producto($id_producto);
                        $nota_stock="$firstname marcó como entregados elementos del producto $n_produto a la convocatoria $n_convocatoria";
                    }
                }
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($emisora) && !empty($emisora)) {     
                $quantity=0;              
                $reference=$n_convocatoria;
                $fecha=$fecha_entregado;          
                $eee = explode(',',$emisora); 
                foreach($eee as $e){
                    if(!empty(trim($e))) {
                        mysqli_query($con,"UPDATE emisoras SET emi_casa=0 WHERE emi_id='".$e."'");
                        $quantity=$quantity+1;
                        $id_producto=get_row("emisoras","id_producto", "emi_id", $e);
                        $n_produto= nombre_producto($id_producto);
                        $nota_stock="$firstname marcó como entregados elementos del producto $n_produto a la convocatoria $n_convocatoria";
                    }
                }
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($caremisora) && !empty($caremisora)) {  
                $quantity=0;              
                $reference=$n_convocatoria;
                $fecha=$fecha_entregado;           
                $eee = explode(',',$caremisora); 
                foreach($eee as $e){
                    if(!empty(trim($e))) {
                        mysqli_query($con,"UPDATE cargadores SET car_casa=0 WHERE car_id='".$e."'");
                        $quantity=$quantity+1;
                        $id_producto=get_row("cargadores","id_producto", "car_id", $e);
                        $n_produto= nombre_producto($id_producto);
                        $nota_stock="$firstname marcó como entregados elementos del producto $n_produto a la convocatoria $n_convocatoria";
                    }
                }
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($helices) && !empty($helices)) { 
                $quantity=0;              
                $reference=$n_convocatoria;
                $fecha=$fecha_entregado; 
                $eee = explode(',',$helices); 
                foreach($eee as $e){
                    if(!empty(trim($e))) {
                        mysqli_query($con,"UPDATE helices SET heli_casa=0 WHERE heli_id='".$e."'");
                        $quantity=$quantity+1;
                        $id_producto=get_row("helices","id_producto", "heli_id", $e);
                        $n_produto= nombre_producto($id_producto);
                        $nota_stock="$firstname marcó como entregados elementos del producto $n_produto a la convocatoria $n_convocatoria";
                    }
                }
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($baterias) && !empty($baterias)) {
                $quantity=0;              
                $reference=$n_convocatoria;
                $fecha=$fecha_entregado;
                $eee = explode(',',$baterias); 
                foreach($eee as $e){
                    if(!empty(trim($e))) {
                        mysqli_query($con,"UPDATE baterias SET bat_casa=0 WHERE bat_id='".$e."'");
                        $quantity=$quantity+1;
                        $id_producto=get_row("baterias","id_producto", "bat_id", $e);
                        $n_produto= nombre_producto($id_producto);
                        $nota_stock="$firstname marcó como entregados elementos del producto $n_produto a la convocatoria $n_convocatoria";
                    }
                }
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($carbaterias) && !empty($carbaterias)) {
                $quantity=0;              
                $reference=$n_convocatoria;
                $fecha=$fecha_entregado;
                $eee = explode(',',$carbaterias); 
                foreach($eee as $e){
                    if(!empty(trim($e))) {
                        mysqli_query($con,"UPDATE cargadores SET car_casa=0 WHERE car_id='".$e."'");
                        $quantity=$quantity+1;
                        $id_producto=get_row("cargadores","id_producto", "car_id", $e);
                        $n_produto= nombre_producto($id_producto);
                        $nota_stock="$firstname marcó como entregados elementos del producto $n_produto a la convocatoria $n_convocatoria";
                    }
                }
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($alimentacion) && !empty($alimentacion)) {
                mysqli_query($con,"UPDATE products SET stock_actual=stock_actual-'$alimentacion', stock_fuera=stock_fuera+'$alimentacion' WHERE nombre_producto LIKE '%Alimentación%' AND id_categoria='$id_categoria'");
                $quantity=$alimentacion;   
                $reference=$n_convocatoria;
                $fecha=$fecha_entregado;
                $query=mysqli_query($con,"select * from products where nombre_producto LIKE '%Alimentación%' AND id_categoria='$id_categoria'");
                $rw=mysqli_fetch_array($query);
                $id_producto=$rw['id_producto'];
                $n_produto= nombre_producto($id_producto);
                $nota_stock="$firstname marcó como entregados $quantity unidad(es) del producto $n_produto a la convocatoria $n_convocatoria";
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($otg) && !empty($otg)) {
                mysqli_query($con,"UPDATE products SET stock_actual=stock_actual-'$otg', stock_fuera=stock_fuera+'$otg' WHERE nombre_producto LIKE '%OTG%' AND id_categoria='$id_categoria'");
                $quantity=$otg;   
                $reference=$n_convocatoria;
                $fecha=$fecha_entregado;
                $query=mysqli_query($con,"select * from products where nombre_producto LIKE '%OTG%' AND id_categoria='$id_categoria'");
                $rw=mysqli_fetch_array($query);
                $id_producto=$rw['id_producto'];
                $n_produto= nombre_producto($id_producto);
                $nota_stock="$firstname marcó como entregados $quantity unidad(es) del producto $n_produto a la convocatoria $n_convocatoria";
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($usb) && !empty($usb)) {
                mysqli_query($con,"UPDATE products SET stock_actual=stock_actual-'$usb', stock_fuera=stock_fuera+'$usb' WHERE nombre_producto LIKE '%USB%' AND id_categoria='$id_categoria'");
                $quantity=$usb;   
                $reference=$n_convocatoria;
                $fecha=$fecha_entregado;
                $query=mysqli_query($con,"select * from products where nombre_producto LIKE '%USB%' AND id_categoria='$id_categoria'");
                $rw=mysqli_fetch_array($query);
                $id_producto=$rw['id_producto'];
                $n_produto= nombre_producto($id_producto);
                $nota_stock="$firstname marcó como entregados $quantity unidad(es) del producto $n_produto a la convocatoria $n_convocatoria";
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($c) && !empty($c)) {
                mysqli_query($con,"UPDATE products SET stock_actual=stock_actual-'$c', stock_fuera=stock_fuera+'$c' WHERE nombre_producto LIKE '%Type-C%' AND id_categoria='$id_categoria'");
                $quantity=$c;   
                $reference=$n_convocatoria;
                $fecha=$fecha_entregado;
                $query=mysqli_query($con,"select * from products where nombre_producto LIKE '%Type-C%' AND id_categoria='$id_categoria'");
                $rw=mysqli_fetch_array($query);
                $id_producto=$rw['id_producto'];
                $n_produto= nombre_producto($id_producto);
                $nota_stock="$firstname marcó como entregados $quantity unidad(es) del producto $n_produto a la convocatoria $n_convocatoria";
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($lightning) && !empty($lightning)) {
                mysqli_query($con,"UPDATE products SET stock_actual=stock_actual-'$lightning', stock_fuera=stock_fuera+'$lightning' WHERE nombre_producto LIKE '%Lightning%' AND id_categoria='$id_categoria'");
                $quantity=$lightning;   
                $reference=$n_convocatoria;
                $fecha=$fecha_entregado;
                $query=mysqli_query($con,"select * from products where nombre_producto LIKE '%Lightning%' AND id_categoria='$id_categoria'");
                $rw=mysqli_fetch_array($query);
                $id_producto=$rw['id_producto'];
                $n_produto= nombre_producto($id_producto);
                $nota_stock="$firstname marcó como entregados $quantity unidad(es) del producto $n_produto a la convocatoria $n_convocatoria";
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($memoria32) && !empty($memoria32)) {
                mysqli_query($con,"UPDATE products SET stock_actual=stock_actual-'$memoria32', stock_fuera=stock_fuera+'$memoria32' WHERE id_producto='10'");
                $quantity=$memoria32;   
                $reference=$n_convocatoria;
                $fecha=$fecha_entregado;
                $id_producto=get_row("products","id_producto", "id_producto", "10");
                $n_produto= nombre_producto($id_producto);
                $nota_stock="$firstname marcó como entregados $quantity unidad(es) del producto $n_produto a la convocatoria $n_convocatoria";
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($memoria64) && !empty($memoria64)) {
                mysqli_query($con,"UPDATE products SET stock_actual=stock_actual-'$memoria64', stock_fuera=stock_fuera+'$memoria64' WHERE id_producto='11'");
                $quantity=$memoria64;   
                $reference=$n_convocatoria;
                $fecha=$fecha_entregado;
                $id_producto=get_row("products","id_producto", "id_producto", "11");
                $n_produto= nombre_producto($id_producto);
                $nota_stock="$firstname marcó como entregados $quantity unidad(es) del producto $n_produto a la convocatoria $n_convocatoria";
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($memoria128) && !empty($memoria128)) {
                mysqli_query($con,"UPDATE products SET stock_actual=stock_actual-'$memoria128', stock_fuera=stock_fuera+'$memoria128' WHERE id_producto='12'");
                $quantity=$memoria128;   
                $reference=$n_convocatoria;
                $fecha=$fecha_entregado;
                $id_producto=get_row("products","id_producto", "id_producto", "12");
                $n_produto= nombre_producto($id_producto);
                $nota_stock="$firstname marcó como entregados $quantity unidad(es) del producto $n_produto a la convocatoria $n_convocatoria";
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($pcsimulador) && !empty($pcsimulador)) {
                $quantity=0;              
                $reference=$n_convocatoria;
                $fecha=$fecha_entregado;
                $eee = explode(',',$pcsimulador); 
                foreach($eee as $e){
                    if(!empty(trim($e))) {
                        mysqli_query($con,"UPDATE simulador SET simulador_casa=0 WHERE simulador_ref='".$e."'");
                        $quantity=$quantity+1;
                        $id_producto=get_row("simulador","id_producto", "simulador_id", $e);
                        $n_produto= nombre_producto($id_producto);
                        $nota_stock="$firstname marcó como entregados elementos del producto $n_produto a la convocatoria $n_convocatoria";
                    }
                }
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($emisorasimulador) && !empty($emisorasimulador)) {
                $quantity=0;              
                $reference=$n_convocatoria;
                $fecha=$fecha_entregado;
                $eee = explode(',',$emisorasimulador); 
                foreach($eee as $e){
                    if(!empty(trim($e))) {
                        mysqli_query($con,"UPDATE simulador SET simulador_casa=0 WHERE simulador_ref='".$e."'");
                        $quantity=$quantity+1;
                        $id_producto=get_row("simulador","id_producto", "simulador_id", $e);
                        $n_produto= nombre_producto($id_producto);
                        $nota_stock="$firstname marcó como entregados elementos del producto $n_produto a la convocatoria $n_convocatoria";
                    }
                }
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($arnes) && !empty($arnes)) {
                mysqli_query($con,"UPDATE products SET stock_actual=stock_actual-'$arnes', stock_fuera=stock_fuera+'$arnes' WHERE id_producto='67'");
                $quantity=$arnes;   
                $reference=$n_convocatoria;
                $fecha=$fecha_entregado;
                $id_producto=get_row("products","id_producto", "id_producto", "67");
                $n_produto= nombre_producto($id_producto);
                $nota_stock="$firstname marcó como entregados $quantity unidad(es) del producto $n_produto a la convocatoria $n_convocatoria";
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($botiquin) && !empty($botiquin)) {
                mysqli_query($con,"UPDATE products SET stock_actual=stock_actual-'$botiquin', stock_fuera=stock_fuera+'$botiquin' WHERE id_producto='70'");
                $quantity=$botiquin;   
                $reference=$n_convocatoria;
                $fecha=$fecha_entregado;
                $id_producto=get_row("products","id_producto", "id_producto", "70");
                $n_produto= nombre_producto($id_producto);
                $nota_stock="$firstname marcó como entregados $quantity unidad(es) del producto $n_produto a la convocatoria $n_convocatoria";
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }

            ?>
              <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Aviso!</strong> Datos actualizados exitosamente.
              </div>
        <?php 
        } else { ?>
              <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
              </div>
        <?php
        }
    } else { ?>
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> No se pudo actualizar este inventario para convocatoria. 
          </div>
          <?php
    }
}
if (isset($_POST['devolver_id'])){
    $id_invcon=intval($_POST['devolver_id']); 
    $user_id=$_SESSION['user_id'];
    $firstname=$_SESSION['firstname'];
    $fecha=date("Y-m-d H:i:s");
    $query=mysqli_query($con, "select * from invcon where invcon_id='".$id_invcon."'");
    $count=mysqli_num_rows($query);
    if ($count>=0){        
        while ($row=mysqli_fetch_array($query)){
            $observaciones=$_POST["observaciones_devue"];
            $fecha_devuelto=date("Y-m-d H:i:s");
            $id_invcon=$row['invcon_id'];
            $observaciones_entre=$row['obs_entre'];
            $n_convocatoria=$row['n_convocatoria'];
            $fecha_p=date('d/m/Y', strtotime($row['fecha_convocatoria']));
            $id_instructor=$row['id_instructor'];
            $n_instructor=nombre_instructor($id_instructor);
            $id_aula=$row['id_aula'];
            $n_aula=nombre_aula($id_aula);
            $id_campo=$row['id_campo'];
            if(!empty($id_campo)) {
                $n_campo=nombre_campo($id_campo);
            }
            else {
                $n_campo="";
            }
            $fecha = $row['fecha'];
            $date_added= date('d/m/Y', strtotime($fecha));
            $fecha_e = $row['fecha_entregado'];
            if(!empty($fecha_e)) {
                $fecha_entregado=date('d/m/Y', strtotime($fecha_e));
            }
            else {
                $fecha_entregado="";
            }
            $date_added= date('d/m/Y', strtotime($fecha));
            $firma1=$row['firma'];
            $bandaaerea=$row['banda_aerea'];
            $chalecos=$row['chaleco'];
            $boligrafos=$row['boligrafo'];
            $regletas=$row['regleta'];
            $proyector=$row['proyector'];
            $aeronaveserie=$row['aeronave'];
            $emisora=$row['emisora'];
            $caremisora=$row['car_emisora'];
            $helices=$row['helices'];
            $baterias=$row['bateria'];
            $carbaterias=$row['car_baterias'];
            $alimentacion=$row['cable_alimentacion'];
            $otg=$row['cable_otg'];
            $usb=$row['cable_usb'];
            $c=$row['cable_c'];
            $lightning=$row['cable_light'];
            $memoria32=$row['sd_32'];
            $memoria64=$row['sd_64'];
            $memoria128=$row['sd_128'];
            $pcsimulador=$row['pc_simulador'];
            $emisorasimulador=$row['emi_simulador'];
            $arnes=$row['arnes'];
            $botiquin=$row['botiquin'];
            $horas=$row['horas_aeronave'];


            $content = '<h2 style="text-align:center;">INVENTARIO PARA CONVOCATORIA</h2>
            <div style="width:100%;"">
                <img style="width:50%; float: left;" src="../img/logo2.png">
                <table style="width:40%; margin-left:10px; margin-top:25px; float: right;">
                <tr>
                    <td style="width:300px; border:1px solid; text-align: center;">'.$n_convocatoria.'</td>
                </tr>
                <tr>
                    <td style="width:300px; border:1px solid; text-align: center;">'.$fecha_p.'</td>
                </tr>
                <tr>
                    <td style="width:300px; border:1px solid; text-align: center;">SALIDA</td>
                </tr>
                <tr>
                    <td style="width:300px; border:1px solid; text-align: center;">'.$date_added.'</td>
                </tr>
                <tr>
                    <td style="width:300px; border:1px solid; text-align: left; margin-left:20px;">ENTREGADO: '.$fecha_entregado.'</td>
                </tr>
                <tr>
                    <td style="width:300px; border:1px solid; text-align: left; margin-left:20px;">DEVUELTO: '.date('d/m/Y', strtotime($fecha_devuelto)).'</td>
                </tr>
                </table>
            </div>

            <table style="width:100%; margin-top:50px;">
                <tr>
                    <td style="width:100%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">INSTRUCTOR</td>
                </tr>
                <tr>
                    <td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.$n_instructor.'</td> 
                </tr>
            </table>

            <table style="width:100%; margin-top:10px;">
                <tr>
                    <td style="width:100%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">AULA</td>
                </tr>
                <tr>
                    <td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.$n_aula.'</td> 
                </tr>
            </table>';

            if ((substr($n_convocatoria,-1)=='R')) {
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
            else {
                    $content .= '<table style="width:100%; margin-top:10px;">
                        <tr>
                            <td style="width:100%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">CAMPO DE VUELO</td>
                        </tr>
                        <tr>
                            <td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.$n_campo.'</td> 
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
                        <tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.devuelve_categoria(nombre_categoria($e)).' '.get_row("aeronaves","aero_serie", "aero_id", $e).'</td></tr>';
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
                                    $content .='<tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.get_row("proyector","proyector_serie", "proyector_id", $e).'</td></tr>';                                }
                            }
                        }
                        else {
                            $content .='<tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;"></td></tr>';
                        }
                $content .='</table>';          

                $content .= '<table style="width:100%; margin-top:10px;">
                    <tr>
                        <td style="width:100%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">OBSERVACIONES EN EL MOMENTO DE LA ENTREGA</td>
                    </tr>
                    <tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.$observaciones_entre.'</td></tr>
                    </table>';          

                $content .= '<table style="width:100%; margin-top:10px;">
                    <tr>
                        <td style="width:100%; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">OBSERVACIONES EN EL MOMENTO DE LA DEVOLUCIÓN</td>
                    </tr>
                    <tr><td style="width:100%; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd;">'.$observaciones.'</td></tr>
                    </table>';

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

        }
        if ($act=mysqli_query($con,"UPDATE invcon SET devuelto=1, obs_devue='".$observaciones."', fecha_devuelto='".$fecha_devuelto."' WHERE invcon_id='".$id_invcon."'")) {
            $user_id=$_SESSION['user_id'];
            $firstname=$_SESSION['firstname']." ".$_SESSION['lastname'];
            $nota="$firstname marcó como devueltos los productos de inventario en la convocatoria $n_convocatoria";
            echo guardar_historial_invcon($id_invcon,$user_id,$fecha_devuelto,$nota);
            $html2pdf = new Html2Pdf('P', 'A4', 'es');
            $html2pdf->setDefaultFont('Arial');
            $html2pdf->writeHTML($content);
            $pdf = "pdf/"."inventario-convocatoria-".$n_convocatoria."-".date('dmYHis', strtotime($fecha)).".pdf";
            $url_pdf=URL_BASE.$pdf;
            $html2pdf->output($url_pdf, 'F');

            if(!empty($aeronaveserie)) {
                $con_convocatorias = mysqli_connect("31.193.227.98", "cursoded_encuest", "ZKD,Ey8EzqgQ", "cursoded_encuesta");
                mysqli_set_charset($con_convocatorias, 'utf8');
                $query_convocatorias=mysqli_query($con_convocatorias,"SELECT * FROM convocatorias WHERE convocatoria='".$n_convocatoria."'");
                $rw_convocatorias=mysqli_fetch_array($query_convocatorias);
                $fecha_convocatoria=$rw_convocatorias['fecha_presencial'];   
                $eee = explode(',',$aeronaveserie); 
                foreach($eee as $e){
                    if(!empty(trim($e))) {
                        $serie_dron = get_row("aeronaves","aero_serie", "aero_id", $e);
                        $con_misiones = mysqli_connect("31.193.227.98", "aerocama_mision", "dhHkgi0l25", "aerocama_mision");
                        mysqli_set_charset($con_misiones, 'utf8');
                        mysqli_query($con_misiones,"INSERT INTO cursos (cursos_fecha, cursos_convocatoria, cursos_horas, cursos_incidencias, cursos_instructor, cursos_aeronave) VALUES ('".$fecha_convocatoria."', '".$n_convocatoria."', '".$horas."', '', '".$n_instructor."', '".$serie_dron."')");
                    }
                }
            }



            if(isset($bandaaerea) && !empty($bandaaerea)) {    
                $quantity=0;              
                $reference=$n_convocatoria;
                $fecha=$fecha_devuelto;            
                $eee = explode(',',$bandaaerea); 
                foreach($eee as $e){
                    if(!empty(trim($e))) {
                        mysqli_query($con,"UPDATE emisoras SET emi_casa=1 WHERE emi_id='".$e."'");
                        $quantity=$quantity+1;
                        $id_producto=get_row("emisoras","id_producto", "emi_id", $e);
                        $n_produto= nombre_producto($id_producto);
                        $nota_stock="$firstname marcó como devueltos los elementos del producto $n_produto de la convocatoria $n_convocatoria";
                    }
                }
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($chalecos) && !empty($chalecos)) {
                mysqli_query($con,"UPDATE products SET stock_actual=stock_actual+'$chalecos', stock_fuera=stock_fuera-'$chalecos' WHERE id_producto='69'");
                $quantity=$chalecos;   
                $reference=$n_convocatoria;
                $fecha=$fecha_devuelto;
                $id_producto=get_row("products","id_producto", "id_producto", "69");
                $n_produto= nombre_producto($id_producto);
                $nota_stock="$firstname marcó como devueltos $quantity unidad(es) del producto $n_produto de la convocatoria $n_convocatoria";
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($boligrafos) && !empty($boligrafos)) {
                mysqli_query($con,"UPDATE products SET stock_actual=stock_actual+'$boligrafos', stock_fuera=stock_fuera-'$boligrafos' WHERE id_producto='68'");
                $quantity=$boligrafos;   
                $reference=$n_convocatoria;
                $fecha=$fecha_devuelto;
                $id_producto=get_row("products","id_producto", "id_producto", "68");
                $n_produto= nombre_producto($id_producto);
                $nota_stock="$firstname marcó como devueltos $quantity unidad(es) del producto $n_produto de la convocatoria $n_convocatoria";
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($regletas) && !empty($regletas)) {
                mysqli_query($con,"UPDATE products SET stock_actual=stock_actual+'$regletas', stock_fuera=stock_fuera-'$regletas' WHERE id_producto='73'");
                $quantity=$regletas;   
                $reference=$n_convocatoria;
                $fecha=$fecha_devuelto;
                $id_producto=get_row("products","id_producto", "id_producto", "73");
                $n_produto= nombre_producto($id_producto);
                $nota_stock="$firstname marcó como devueltos $quantity unidad(es) del producto $n_produto de la convocatoria $n_convocatoria";
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($proyector) && !empty($proyector)) { 
                $quantity=0;              
                $reference=$n_convocatoria;
                $fecha=$fecha_devuelto;
                $eee = explode(',',$proyector); 
                foreach($eee as $e){
                    if(!empty(trim($e))) {
                        mysqli_query($con,"UPDATE proyector SET proyector_casa=1 WHERE proyector_id='".$e."'");
                        $quantity=$quantity+1;
                        $id_producto=get_row("proyector","id_producto", "proyector_id", $e);
                        $n_produto= nombre_producto($id_producto);
                        $nota_stock="$firstname marcó como devueltos elementos del producto $n_produto a la convocatoria $n_convocatoria";
                    }
                }
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($aeronaveserie) && !empty($aeronaveserie)) { 
                $quantity=0;              
                $reference=$n_convocatoria;
                $fecha=$fecha_devuelto;                          
                $eee = explode(',',$aeronaveserie); 
                foreach($eee as $e){
                    if(!empty(trim($e))) {
                        $id_categoria=devuelve_categoria($e);
                        mysqli_query($con,"UPDATE aeronaves SET aero_casa=1 WHERE aero_id='".$e."'");
                        $quantity=$quantity+1;
                        $id_producto=get_row("aeronaves","id_producto", "aero_id", $e);
                        $n_produto= nombre_producto($id_producto);
                        $nota_stock="$firstname marcó como devueltos los elementos del producto $n_produto de la convocatoria $n_convocatoria";
                    }
                }
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($emisora) && !empty($emisora)) {        
                $quantity=0;              
                $reference=$n_convocatoria;
                $fecha=$fecha_devuelto;                   
                $eee = explode(',',$emisora); 
                foreach($eee as $e){
                    if(!empty(trim($e))) {
                        mysqli_query($con,"UPDATE emisoras SET emi_casa=1 WHERE emi_id='".$e."'");
                        $quantity=$quantity+1;
                        $id_producto=get_row("emisoras","id_producto", "emi_id", $e);
                        $n_produto= nombre_producto($id_producto);
                        $nota_stock="$firstname marcó como devueltos los elementos del producto $n_produto de la convocatoria $n_convocatoria";
                    }
                }
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($caremisora) && !empty($caremisora)) {    
                $quantity=0;              
                $reference=$n_convocatoria;
                $fecha=$fecha_devuelto;                     
                $eee = explode(',',$caremisora); 
                foreach($eee as $e){
                    if(!empty(trim($e))) {
                        mysqli_query($con,"UPDATE cargadores SET car_casa=1 WHERE car_id='".$e."'");
                        $quantity=$quantity+1;
                        $id_producto=get_row("cargadores","id_producto", "car_id", $e);
                        $n_produto= nombre_producto($id_producto);
                        $nota_stock="$firstname marcó como devueltos los elementos del producto $n_produto de la convocatoria $n_convocatoria";
                    }
                }
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($helices) && !empty($helices)) { 
                $quantity=0;              
                $reference=$n_convocatoria;
                $fecha=$fecha_devuelto;             
                $eee = explode(',',$helices); 
                foreach($eee as $e){
                    if(!empty(trim($e))) {
                        mysqli_query($con,"UPDATE helices SET heli_casa=1 WHERE heli_id='".$e."'");
                        $quantity=$quantity+1;
                        $id_producto=get_row("helices","id_producto", "heli_id", $e);
                        $n_produto= nombre_producto($id_producto);
                        $nota_stock="$firstname marcó como devueltos los elementos del producto $n_produto de la convocatoria $n_convocatoria";
                    }
                }
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($baterias) && !empty($baterias)) {
                $quantity=0;              
                $reference=$n_convocatoria;
                $fecha=$fecha_devuelto;            
                $eee = explode(',',$baterias); 
                foreach($eee as $e){
                    if(!empty(trim($e))) {
                        mysqli_query($con,"UPDATE baterias SET bat_casa=1 WHERE bat_id='".$e."'");
                        $quantity=$quantity+1;
                        $id_producto=get_row("baterias","id_producto", "bat_id", $e);
                        $n_produto= nombre_producto($id_producto);
                        $nota_stock="$firstname marcó como devueltos los elementos del producto $n_produto de la convocatoria $n_convocatoria";
                    }
                }
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($carbaterias) && !empty($carbaterias)) {
                $quantity=0;              
                $reference=$n_convocatoria;
                $fecha=$fecha_devuelto;            
                $eee = explode(',',$carbaterias); 
                foreach($eee as $e){
                    if(!empty(trim($e))) {
                        mysqli_query($con,"UPDATE cargadores SET car_casa=1 WHERE car_id='".$e."'");
                        $quantity=$quantity+1;
                        $id_producto=get_row("cargadores","id_producto", "car_id", $e);
                        $n_produto= nombre_producto($id_producto);
                        $nota_stock="$firstname marcó como devueltos los elementos del producto $n_produto de la convocatoria $n_convocatoria";
                    }
                }
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($alimentacion) && !empty($alimentacion)) {
                mysqli_query($con,"UPDATE products SET stock_actual=stock_actual+'$alimentacion', stock_fuera=stock_fuera-'$alimentacion' WHERE nombre_producto LIKE '%Alimentación%' AND id_categoria='$id_categoria'");
                $quantity=$alimentacion;   
                $reference=$n_convocatoria;
                $fecha=$fecha_devuelto;
                $query=mysqli_query($con,"select * from products where nombre_producto LIKE '%Alimentación%' AND id_categoria='$id_categoria'");
                $rw=mysqli_fetch_array($query);
                $id_producto=$rw['id_producto'];
                $n_produto= nombre_producto($id_producto);           
                $nota_stock="$firstname marcó como devueltos $quantity unidad(es) del producto $n_produto de la convocatoria $n_convocatoria";
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($otg) && !empty($otg)) {
                mysqli_query($con,"UPDATE products SET stock_actual=stock_actual+'$otg', stock_fuera=stock_fuera-'$otg' WHERE nombre_producto LIKE '%OTG%' AND id_categoria='$id_categoria'");
                $quantity=$otg;   
                $reference=$n_convocatoria;
                $fecha=$fecha_devuelto;
                $query=mysqli_query($con,"select * from products where nombre_producto LIKE '%OTG%' AND id_categoria='$id_categoria'");
                $rw=mysqli_fetch_array($query);
                $id_producto=$rw['id_producto'];
                $n_produto= nombre_producto($id_producto);
                $nota_stock="$firstname marcó como devueltos $quantity unidad(es) del producto $n_produto de la convocatoria $n_convocatoria";
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($usb) && !empty($usb)) {
                mysqli_query($con,"UPDATE products SET stock_actual=stock_actual+'$usb', stock_fuera=stock_fuera-'$usb' WHERE nombre_producto LIKE '%USB%' AND id_categoria='$id_categoria'");
                $quantity=$usb;   
                $reference=$n_convocatoria;
                $fecha=$fecha_devuelto;
                $query=mysqli_query($con,"select * from products where nombre_producto LIKE '%USB%' AND id_categoria='$id_categoria'");
                $rw=mysqli_fetch_array($query);
                $id_producto=$rw['id_producto'];
                $n_produto= nombre_producto($id_producto);
                $nota_stock="$firstname marcó como devueltos $quantity unidad(es) del producto $n_produto de la convocatoria $n_convocatoria";
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($c) && !empty($c)) {
                mysqli_query($con,"UPDATE products SET stock_actual=stock_actual+'$c', stock_fuera=stock_fuera-'$c' WHERE nombre_producto LIKE '%Type-C%' AND id_categoria='$id_categoria'");
                $quantity=$c;   
                $reference=$n_convocatoria;
                $fecha=$fecha_devuelto;
                $query=mysqli_query($con,"select * from products where nombre_producto LIKE '%Type-C%' AND id_categoria='$id_categoria'");
                $rw=mysqli_fetch_array($query);
                $id_producto=$rw['id_producto'];
                $n_produto= nombre_producto($id_producto);
                $nota_stock="$firstname marcó como devueltos $quantity unidad(es) del producto $n_produto de la convocatoria $n_convocatoria";
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($lightning) && !empty($lightning)) {
                mysqli_query($con,"UPDATE products SET stock_actual=stock_actual+'$lightning', stock_fuera=stock_fuera-'$lightning' WHERE nombre_producto LIKE '%Lightning%' AND id_categoria='$id_categoria'");
                $quantity=$lightning;   
                $reference=$n_convocatoria;
                $fecha=$fecha_devuelto;
                $query=mysqli_query($con,"select * from products where nombre_producto LIKE '%lightning%' AND id_categoria='$id_categoria'");
                $rw=mysqli_fetch_array($query);
                $id_producto=$rw['id_producto'];
                $n_produto= nombre_producto($id_producto);
                $nota_stock="$firstname marcó como devueltos $quantity unidad(es) del producto $n_produto de la convocatoria $n_convocatoria";
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($memoria32) && !empty($memoria32)) {
                mysqli_query($con,"UPDATE products SET stock_actual=stock_actual+'$memoria32', stock_fuera=stock_fuera-'$memoria32' WHERE id_producto='10'");
                $quantity=$memoria32;   
                $reference=$n_convocatoria;
                $fecha=$fecha_devuelto;
                $id_producto=get_row("products","id_producto", "id_producto", "10");
                $n_produto= nombre_producto($id_producto);
                $nota_stock="$firstname marcó como devueltos $quantity unidad(es) del producto $n_produto de la convocatoria $n_convocatoria";
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($memoria64) && !empty($memoria64)) {
                mysqli_query($con,"UPDATE products SET stock_actual=stock_actual+'$memoria64', stock_fuera=stock_fuera-'$memoria64' WHERE id_producto='11'");
                $quantity=$memoria64;   
                $reference=$n_convocatoria;
                $fecha=$fecha_devuelto;
                $id_producto=get_row("products","id_producto", "id_producto", "11");
                $n_produto= nombre_producto($id_producto);
                $nota_stock="$firstname marcó como devueltos $quantity unidad(es) del producto $n_produto de la convocatoria $n_convocatoria";
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($memoria128) && !empty($memoria128)) {
                mysqli_query($con,"UPDATE products SET stock_actual=stock_actual+'$memoria128', stock_fuera=stock_fuera-'$memoria128' WHERE id_producto='12'");
                $quantity=$memoria128;   
                $reference=$n_convocatoria;
                $fecha=$fecha_devuelto;
                $id_producto=get_row("products","id_producto", "id_producto", "12");
                $n_produto= nombre_producto($id_producto);
                $nota_stock="$firstname marcó como devueltos $quantity unidad(es) del producto $n_produto de la convocatoria $n_convocatoria";
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($pcsimulador) && !empty($pcsimulador)) {
                $quantity=0;              
                $reference=$n_convocatoria;
                $fecha=$fecha_devuelto;            
                $eee = explode(',',$pcsimulador); 
                foreach($eee as $e){
                    if(!empty(trim($e))) {
                        mysqli_query($con,"UPDATE simulador SET simulador_casa=1 WHERE simulador_ref='".$e."'");
                        $quantity=$quantity+1;
                        $id_producto=get_row("simulador","id_producto", "simulador_id", $e);
                        $n_produto= nombre_producto($id_producto);
                        $nota_stock="$firstname marcó como devueltos los elementos del producto $n_produto de la convocatoria $n_convocatoria";
                    }
                }
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($emisorasimulador) && !empty($emisorasimulador)) {
                $quantity=0;              
                $reference=$n_convocatoria;
                $fecha=$fecha_devuelto;            
                $eee = explode(',',$emisorasimulador); 
                foreach($eee as $e){
                    if(!empty(trim($e))) {
                        mysqli_query($con,"UPDATE simulador SET simulador_casa=1 WHERE simulador_ref='".$e."'");
                        $quantity=$quantity+1;
                        $id_producto=get_row("simulador","id_producto", "simulador_id", $e);
                        $n_produto= nombre_producto($id_producto);
                        $nota_stock="$firstname marcó como devueltos los elementos del producto $n_produto de la convocatoria $n_convocatoria";
                    }
                }
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($arnes) && !empty($arnes)) {
                mysqli_query($con,"UPDATE products SET stock_actual=stock_actual+'$arnes', stock_fuera=stock_fuera-'$arnes' WHERE id_producto='67'");
                $quantity=$arnes;   
                $reference=$n_convocatoria;
                $fecha=$fecha_devuelto;
                $id_producto=get_row("products","id_producto", "id_producto", "67");
                $n_produto= nombre_producto($id_producto);
                $nota_stock="$firstname marcó como devueltos $quantity unidad(es) del producto $n_produto de la convocatoria $n_convocatoria";
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            if(isset($botiquin) && !empty($botiquin)) {
                mysqli_query($con,"UPDATE products SET stock_actual=stock_actual+'$botiquin', stock_fuera=stock_fuera-'$botiquin' WHERE id_producto='70'");
                $quantity=$botiquin;   
                $reference=$n_convocatoria;
                $fecha=$fecha_devuelto;
                $id_producto=get_row("products","id_producto", "id_producto", "70");
                $n_produto= nombre_producto($id_producto);
                $nota_stock="$firstname marcó como devueltos $quantity unidad(es) del producto $n_produto de la convocatoria $n_convocatoria";
                if ($quantity!=0) {
                    guardar_historial($id_producto,$user_id,$fecha,$nota_stock,$reference,$quantity);
                }
            }
            ?>
              <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Aviso!</strong> Datos actualizados exitosamente.
              </div>
        <?php 
        } else { ?>
              <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
              </div>
        <?php
        }
    } else { ?>
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> No se pudo actualizar este inventario para convocatoria. 
          </div>
          <?php
    }
}
?>	
		
			
				
			    