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
    $sql="SELECT * FROM  aulas WHERE inactivo=0 order by aula_name";
    $query = mysqli_query($con, $sql);

	$content = '<h2>AULAS EN LA APLICACIÓN</h2>';

    $content .= '
	  <table>
		<tr>
			<th style="width: 160px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Nombre</th>
			<th style="width: 220px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Email</th>
			<th style="width: 50px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Teléfono</th>
			<th style="width: 50px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Población</th>
      <th style="width: 20px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Maps</th>
      <th style="width: 60px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Agregado</th>
			
		</tr>';
		while ($row=mysqli_fetch_array($query)){
            $aula_id=$row['aula_id'];
            $aula_name=$row['aula_name'];
            $aula_email=$row['aula_email'];
            if (empty($aula_email)) { 
                $aula_email='';
            }
            $aula_telefono=$row['aula_telefono'];
            if (empty($aula_telefono)) { 
                $aula_telefono='';
            }
            $aula_poblacion=$row['aula_poblacion'];
            $aula_maps=$row['aula_maps'];
            $a="Enl.";
            if (empty($aula_maps)) { 
                $a='';
            }
            $date_added= date('d/m/Y', strtotime($row['date_added']));
            $content .='		
			<tr>
				<td style="width: 160px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">'.$aula_name.'</td>
				<td style="width: 220px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;"><a style="font-weight: bold; text-decoration: none; color: inherit;" href="mailto:'.$aula_email.'">'.$aula_email.'</a></td>
				<td style="width: 50px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; text-align: center;"><a style="font-weight: bold; text-decoration: none; color: inherit;" href="tel:'.$aula_telefono.'">'.$aula_telefono.'</a></td>
				<td style="width: 50px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; text-align: center;">'.$aula_poblacion.'</td>	
        <td style="width: 20px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; text-align: center;"><a style="font-weight: bold; text-decoration: none; color: inherit;" href="'.$aula_maps.'">'.$a.'</a></td> 
        <td style="width: 60px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; text-align: center;">'.$date_added.'</td>  			
			</tr>';
		}
            $content .='	
			  </table>';

        $pdf = "pdf/"."aulas-".date('dmYHis').".pdf";
	    $html2pdf = new Html2Pdf('P', 'A4', 'es');
	    $html2pdf->setDefaultFont('Arial');
	    $html2pdf->writeHTML($content);
	    $html2pdf->output(URL_BASE.$pdf, 'F');	
        header("Location: ../".$pdf);

		
?>