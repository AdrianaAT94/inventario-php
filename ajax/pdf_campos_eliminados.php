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
    $sql="SELECT * FROM  camposvuelo WHERE inactivo=1 order by campo_name";
    $query = mysqli_query($con, $sql);

	$content = '<h2>CAMPOS DE VUELO ELIMINADOS EN LA APLICACIÓN</h2>';

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
            $campo_id=$row['campo_id'];
            $campo_name=$row['campo_name'];
            $campo_email=$row['campo_email'];
            if (empty($campo_email)) { 
                $campo_email='';
            }
            $campo_telefono=$row['campo_telefono'];
            if (empty($campo_telefono)) { 
                $campo_telefono='';
            }
            $campo_poblacion=$row['campo_poblacion'];
            $campo_maps=$row['campo_maps'];
            $a="Enl.";
            if (empty($campo_maps)) { 
                $a='';
            }
            $date_added= date('d/m/Y', strtotime($row['date_added']));

            $content .='		
			<tr>
				<td style="width: 160px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">'.$campo_name.'</td>
				<td style="width: 220px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;"><a style="font-weight: bold; text-decoration: none; color: inherit;" href="mailto:'.$campo_email.'">'.$campo_email.'</a></td>
				<td style="width: 50px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; text-align: center;"><a style="font-weight: bold; text-decoration: none; color: inherit;" href="tel:'.$campo_telefono.'">'.$campo_telefono.'</a></td>
				<td style="width: 50px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; text-align: center;">'.$campo_poblacion.'</td>	
        <td style="width: 20px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; text-align: center;"><a style="font-weight: bold; text-decoration: none; color: inherit;" href="'.$campo_maps.'">'.$a.'</a></td> 
        <td style="width: 60px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; text-align: center;">'.$date_added.'</td>  			
			</tr>';
		}
            $content .='	
			  </table>';

        $pdf = "pdf/"."campos-eliminados-".date('dmYHis').".pdf";
	    $html2pdf = new Html2Pdf('P', 'A4', 'es');
	    $html2pdf->setDefaultFont('Arial');
	    $html2pdf->writeHTML($content);
	    $html2pdf->output(URL_BASE.$pdf, 'F');	
        header("Location: ../".$pdf);

		
?>