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
    $sql="SELECT * FROM  users WHERE admin !=1 order by firstname";
    $query = mysqli_query($con, $sql);

	$content = '<h2>INSTRUCTORES EN LA APLICACIÓN</h2>';

    $content .= '
	  <table>
		<tr>
			<th style="width: 200px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Nombre</th>
      <th style="width: 50px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Usuario</th>
			<th style="width: 200px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Email</th>
      <th style="width: 100px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Agregado</th>
      <th style="width: 50px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Eliminado</th>
			
		</tr>';
		while ($row=mysqli_fetch_array($query)){
            $user_id=$row['user_id'];
            $fullname=$row['firstname']." ".$row["lastname"];
            $user_name=$row['user_name'];
            $user_email=$row['user_email'];
            $inactivo=$row['inactivo'];
            if ($inactivo==1) {
              $a="SI";
            }
            else {
              $a="NO";
            }
            $date_added= date('d/m/Y', strtotime($row['date_added']));


            $content .='		
			<tr>
				<td style="width: 200px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">'.$fullname.'</td>
        <td style="width: 50px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">'.$user_name.'</td>
				<td style="width: 200px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;"><a style="font-weight: bold; text-decoration: none; color: inherit;" href="mailto:'.$user_email.'">'.$user_email.'</a></td>
        <td style="width: 100px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; text-align: center;">'.$date_added.'</td>  		
        <td style="width: 50px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">'.$a.'</td>	
			</tr>';
		}
            $content .='	
			  </table>';

        $pdf = "pdf/"."usuarios-".date('dmYHis').".pdf";
	    $html2pdf = new Html2Pdf('P', 'A4', 'es');
	    $html2pdf->setDefaultFont('Arial');
	    $html2pdf->writeHTML($content);
	    $html2pdf->output(URL_BASE.$pdf, 'F');	
        header("Location: ../".$pdf);

		
?>