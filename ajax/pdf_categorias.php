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
    $sql="SELECT * FROM  categorias WHERE inactivo=0 order by nombre_categoria";
    $query = mysqli_query($con, $sql);

	$content = '<h2>CATEGORÍAS EN LA APLICACIÓN</h2>';

    $content .= '
	  <table>
		<tr>
			<th style="width: 200px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Nombre</th>
			<th style="width: 300px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Descripción</th>
      <th style="width: 100px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Agregado</th>
			
		</tr>';
		while ($row=mysqli_fetch_array($query)){
            $id_categoria=$row['id_categoria'];
            $nombre_categoria=$row['nombre_categoria'];
            $descripcion_categoria=$row['descripcion_categoria'];
            $date_added= date('d/m/Y', strtotime($row['date_added']));

            $content .='		
			<tr>
				<td style="width: 160px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">'.$nombre_categoria.'</td>
				<td style="width: 220px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">'.$descripcion_categoria.'</td> 
        <td style="width: 60px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; text-align: center;">'.$date_added.'</td>  			
			</tr>';
		}
            $content .='	
			  </table>';

        $pdf = "pdf/"."categorias-".date('dmYHis').".pdf";
	    $html2pdf = new Html2Pdf('P', 'A4', 'es');
	    $html2pdf->setDefaultFont('Arial');
	    $html2pdf->writeHTML($content);
	    $html2pdf->output(URL_BASE.$pdf, 'F');	
        header("Location: ../".$pdf);

		
?>