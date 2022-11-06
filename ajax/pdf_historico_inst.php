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

    // escaping, additionally removing everything that could be (html/javascript-) code
    $sql="SELECT * FROM  historial_inst order by id_historial desc";
    $query = mysqli_query($con, $sql);

	$content = '<h2>HISTÓRICO DE INSTRUCTORES</h2>';

    $content .= '
	  <table>
		<tr>
			<th style="width: 100px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Fecha</th>
			<th style="width: 100px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Hora</th>
			<th style="width: 400px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Descripción</th>
			
		</tr>';
		while ($row=mysqli_fetch_array($query)){
            $fecha=date('d/m/Y', strtotime($row['fecha']));
            $hora=date('H:i:s', strtotime($row['fecha']));;
            $desc=$row['nota'];

            $content .='		
			<tr>
				<td style="width: 100px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">'.$fecha.'</td>
				<td style="width: 100px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">'.$hora.'</td>
				<td style="width: 400px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">'.$desc.'</td>				
			</tr>';

		}
            $content .='	
			  </table>';

        $pdf = "pdf/"."historico-instructores-".date('dmYHis').".pdf";
	    $html2pdf = new Html2Pdf('P', 'A4', 'es');
	    $html2pdf->setDefaultFont('Arial');
	    $html2pdf->writeHTML($content);
	    $html2pdf->output(URL_BASE.$pdf, 'F');	
        header("Location: ../".$pdf);

		
?>