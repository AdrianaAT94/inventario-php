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
    $sql="SELECT * FROM  invcon order by n_convocatoria";
    $query = mysqli_query($con, $sql);

	$content = '<h2>INVENTARIO PARA CONVOCATORIAS</h2>';

    $content .= '
	  <table>
		<tr>
			<th style="width: 100px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Convocatoria</th>
			<th style="width: 160px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Instructor</th>
			<th style="width: 190px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Aula</th>
			<th style="width: 190px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Campo de vuelo </th>
      <th style="text-align:center; width: 60px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Fecha C.</th>
      <th style="text-align:center; width: 20px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">PDF</th>
      <th style="text-align:center; width: 60px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Agregado</th>
      <th style="text-align:center; width: 5px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">E</th>
      <th style="text-align:center; width: 5px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">D</th>
			
		</tr>';
		while ($row=mysqli_fetch_array($query)){
            $inst_id=$row['invcon_id'];
            $n_convocatoria=$row['n_convocatoria'];
            $fecha_p=date('d/m/Y', strtotime($row['fecha_convocatoria']));
            $id_instructor=$row['id_instructor'];
            $n_instructor=nombre_instructor($id_instructor);
            $id_aula=$row['id_aula'];
            $n_aula=nombre_aula($id_aula);
            $id_campo=$row['id_campo'];
            $n_campo=nombre_campo($id_campo);
            $entregado=$row['entregado'];
            if ($entregado==1) {
              $b="SI";
            }
            else {
              $b="NO";
            }
            $devuelto=$row['devuelto'];
            if ($devuelto==1) {
              $c="SI";
            }
            else {
              $c="NO";
            }
            $url_pdf=$row['url_pdf'];
            $a="Ver";
            if (empty($url_pdf)) { 
                $a='';
            }
            $date_added= date('d/m/Y', strtotime($row['date_added']));
            $date_added= date('d/m/Y', strtotime($row['fecha']));


            $content .='		
			<tr>
				<td style="width: 100px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;"><a style="text-decoration: none; color: inherit;" href="'.URL_DIR.'convocatorias.php">'.$n_convocatoria.'</a></td>
				<td style="width: 160px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;"><a style="text-decoration: none; color: inherit;" href="'.URL_DIR.'instructores.php">'.$n_instructor.'</a></td>
        <td style="width: 190px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;"><a style="text-decoration: none; color: inherit;" href="'.URL_DIR.'aulas.php">'.$n_aula.'</a></td>
        <td style="width: 190px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;"><a style="text-decoration: none; color: inherit;" href="'.URL_DIR.'campos.php">'.$n_campo.'</a></td>
				<td style="text-align:center; width: 60px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; text-align: center;">'.$fecha_p.'</td>
        <td style="text-align:center; width: 20px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; text-align: center;"><a style="font-weight: bold; text-decoration: none; color: inherit;" href="'.$url_pdf.'">'.$a.'</a></td> 
        <td style="text-align:center; width: 60px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; text-align: center;">'.$date_added.'</td>  			
        <td style="text-align:center; width: 5px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">'.$b.'</td>  
        <td style="text-align:center; width: 5px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">'.$c.'</td>  
			</tr>';
		}
            $content .='	
			  </table>';

        $pdf = "pdf/"."inventario-convocatorias-".date('dmYHis').".pdf";
	    $html2pdf = new Html2Pdf('L', 'A4', 'es');
	    $html2pdf->setDefaultFont('Arial');
	    $html2pdf->writeHTML($content);
	    $html2pdf->output(URL_BASE.$pdf, 'F');	
        header("Location: ../".$pdf);

		
?>