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
    $sql="SELECT * FROM  instructores WHERE inactivo=1 order by firstname";
    $query = mysqli_query($con, $sql);

	$content = '<h2>INSTRUCTORES ELIMINADOS EN LA APLICACIÓN</h2>';

    $content .= '
	  <table>
		<tr>
			<th style="width: 180px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Nombre</th>
			<th style="width: 220px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Email</th>
			<th style="width: 50px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Teléfono</th>
			<th style="width: 50px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Dirección</th>
      <th style="width: 100px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Agregado</th>
			
		</tr>';
		while ($row=mysqli_fetch_array($query)){
            $inst_id=$row['inst_id'];
            $fullname=$row['firstname']." ".$row["lastname"];
            $inst_email=$row['inst_email'];
            if (empty($inst_email)) { 
                $inst_email='';
            }
            $inst_telefono=$row['inst_telefono'];
            if (empty($inst_telefono)) { 
                $inst_telefono='';
            }
            $inst_direccion=$row['inst_direccion'];
            $date_added= date('d/m/Y', strtotime($row['date_added']));


            $content .='		
			<tr>
				<td style="width: 180px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">'.$fullname.'</td>
				<td style="width: 220px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;"><a style="font-weight: bold; text-decoration: none; color: inherit;" href="mailto:'.$inst_email.'">'.$inst_email.'</a></td>
				<td style="width: 50px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; text-align: center;"><a style="font-weight: bold; text-decoration: none; color: inherit;" href="tel:'.$inst_telefono.'">'.$inst_telefono.'</a></td>
				<td style="width: 50px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; text-align: center;">'.$inst_direccion.'</td>	
        <td style="width: 100px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; text-align: center;">'.$date_added.'</td>  			
			</tr>';
		}
            $content .='	
			  </table>';

        $pdf = "pdf/"."instructores-eliminados-".date('dmYHis').".pdf";
	    $html2pdf = new Html2Pdf('P', 'A4', 'es');
	    $html2pdf->setDefaultFont('Arial');
	    $html2pdf->writeHTML($content);
	    $html2pdf->output(URL_BASE.$pdf, 'F');	
        header("Location: ../".$pdf);

		
?>