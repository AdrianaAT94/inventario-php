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
    $sql="SELECT * FROM  products WHERE inactivo=0 order by id_producto desc";
    $query = mysqli_query($con, $sql);

	$content = '<h2>PRODUCTOS DE INVENTARIO</h2>';

    $content .= '
	  <table>
		<tr>
			<th style="width: 200px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Nombre</th>
			<th style="width: 200px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Categoría</th>
			<th style="text-align:center; width: 60px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Stock total</th>
			<th style="text-align:center; width: 70px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Stock actual</th>
            <th style="text-align:center; width: 60px; background-color: #A9D0F5; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">Stock fuera</th>
			
		</tr>';
		while ($row=mysqli_fetch_array($query)){
            $id_producto=$row['id_producto'];
            $nombre_producto=$row['nombre_producto'];
            $stock_actual=$row['stock_actual'];
            $stock_total=$row['stock'];
            $stock_fuera=$row['stock_fuera'];
            $catego=$row['id_categoria'];

		    $sql3="SELECT * FROM categorias WHERE id_categoria='".$catego."'";
		    $query3 = mysqli_query($con, $sql3);
			while ($row3=mysqli_fetch_array($query3)){
				$nombre_categoria = $row3['nombre_categoria'];
			} 

            if (stripos($nombre_producto, "aeronave") !== false) {                
                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM aeronaves WHERE aero_casa=1 AND id_producto='".$id_producto."'");
                $row3= mysqli_fetch_array($query3);
                $stock_actual=$row3['numrows'];    

                $query4 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM aeronaves WHERE id_producto='".$id_producto."'");
                $row4= mysqli_fetch_array($query4);
                $stock_total=$row4['numrows'];
            }

            else if (stripos($nombre_producto, "simulador") !== false) {                
                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM simulador WHERE simulador_casa=1 AND id_producto='".$id_producto."'");
                $row3= mysqli_fetch_array($query3);
                $stock_actual=$row3['numrows'];    

                $query4 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM simulador WHERE id_producto='".$id_producto."'");
                $row4= mysqli_fetch_array($query4);
                $stock_total=$row4['numrows'];
            }

            else if (stripos($nombre_producto, "emisora") !== false && stripos($nombre_producto, "cargador") === false) {                
                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM emisoras WHERE emi_casa=1 AND id_producto='".$id_producto."'");
                $row3= mysqli_fetch_array($query3);
                $stock_actual=$row3['numrows'];    

                $query4 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM emisoras WHERE id_producto='".$id_producto."'");
                $row4= mysqli_fetch_array($query4);
                $stock_total=$row4['numrows'];
            }

            else if (stripos($nombre_producto, "hélice") !== false) {                
                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM helices WHERE heli_casa=1 AND id_producto='".$id_producto."'");
                $row3= mysqli_fetch_array($query3);
                $stock_actual=$row3['numrows'];    

                $query4 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM helices WHERE id_producto='".$id_producto."'");
                $row4= mysqli_fetch_array($query4);
                $stock_total=$row4['numrows'];
            }

            else if (stripos($nombre_producto, "batería") !== false && stripos($nombre_producto, "cargador") === false) {                
                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM baterias WHERE bat_casa=1 AND id_producto='".$id_producto."'");
                $row3= mysqli_fetch_array($query3);
                $stock_actual=$row3['numrows'];    

                $query4 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM baterias WHERE id_producto='".$id_producto."'");
                $row4= mysqli_fetch_array($query4);
                $stock_total=$row4['numrows'];
            }

            else if (stripos($nombre_producto, "cargador") !== false) {                
                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM cargadores WHERE car_casa=1 AND id_producto='".$id_producto."'");
                $row3= mysqli_fetch_array($query3);
                $stock_actual=$row3['numrows'];    

                $query4 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM cargadores WHERE id_producto='".$id_producto."'");
                $row4= mysqli_fetch_array($query4);
                $stock_total=$row4['numrows'];
            }

            else if (stripos($nombre_producto, "hub") !== false) {                
                $query3 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM hubs WHERE hub_casa=1 AND id_producto='".$id_producto."'");
                $row3= mysqli_fetch_array($query3);
                $stock_actual=$row3['numrows'];    

                $query4 = mysqli_query($con, "SELECT COUNT(*) AS numrows FROM hubs WHERE id_producto='".$id_producto."'");
                $row4= mysqli_fetch_array($query4);
                $stock_total=$row4['numrows'];
            }
            $content .='		
			<tr>
				<td style="width: 200px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;"><a style="font-weight: bold; text-decoration: none; color: inherit;" href="'.URL_DIR.'producto.php?id='.$id_producto.'">'.$nombre_producto.'</a></td>
				<td style="width: 200px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">'.$nombre_categoria.'</td>
				<td style="text-align:center; width: 60px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; text-align: center;">'.$stock_total.'</td>
				<td style="text-align:center; width: 70px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; text-align: center;">'.$stock_actual.'</td>
                <td style="text-align:center; width: 60px; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; text-align: center;">'.$stock_fuera.'</td>				
			</tr>';
		}
            $content .='	
			  </table>';

        $pdf = "pdf/"."reportes-".date('dmYHis').".pdf";
	    $html2pdf = new Html2Pdf('P', 'A4', 'es');
	    $html2pdf->setDefaultFont('Arial');
	    $html2pdf->writeHTML($content);
	    $html2pdf->output(URL_BASE.$pdf, 'F');	
        header("Location: ../".$pdf);

		
?>