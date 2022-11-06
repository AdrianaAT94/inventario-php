<?php
  include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
  /* Connect To Database*/
  require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
  //Archivo de funciones PHP
  include("../funciones.php");
$con2 = mysqli_connect("31.193.227.98", "cursoded_encuest", "ZKD,Ey8EzqgQ", "cursoded_encuesta");
mysqli_set_charset($con2, 'utf8');

  require_once '../vendor/html2pdf/vendor/autoload.php';

  use Spipu\Html2Pdf\Html2Pdf;
  use Spipu\Html2Pdf\Exception\Html2PdfException;
  use Spipu\Html2Pdf\Exception\ExceptionFormatter;

    // escaping, additionally removing everything that could be (html/javascript-) code
    $sql="SELECT * FROM  convocatorias order by convocatoria";
    $query = mysqli_query($con2, $sql);

	$content = '<h2>CONVOCATORIAS EN LA APLICACIÓN</h2>';

    $content .= '
	  <table>
		<tr>
			<th style="width: 300px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Convocatoria</th>
			<th style="width: 150px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Fecha Presencial</th>
			<th style="width: 150px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Agregado</th>
			
		</tr>';
		while ($row=mysqli_fetch_array($query)){
            $con_id=$row['id'];
            $nombre=$row['convocatoria'];
            $fecha_p=$row['fecha_presencial'];
            $date_added= date('d/m/Y', strtotime($row['fecha_subida']));

            $content .='		
			<tr>
				<td style="width: 300px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">'.$nombre.'</td>
				<td style="width: 150px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">'.$fecha_p.'</td>
				<td style="width: 150px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">'.$date_added.'</td>				
			</tr>';
		}
            $content .='	
			  </table>';

        $pdf = "pdf/"."convocatorias-".date('dmYHis').".pdf";
	    $html2pdf = new Html2Pdf('P', 'A4', 'es');
	    $html2pdf->setDefaultFont('Arial');
	    $html2pdf->writeHTML($content);
	    $html2pdf->output(URL_BASE.$pdf, 'F');	
        header("Location: ../".$pdf);

		
?>