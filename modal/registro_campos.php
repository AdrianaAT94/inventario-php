	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo campo de vuelo</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_campo" name="guardar_campo">
			<div id="resultados_ajax"></div>
			  <div class="form-group">
				<label for="name" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="email" class="col-sm-3 control-label">Email</label>
				<div class="col-sm-8">
				  <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="telefono" class="col-sm-3 control-label">Teléfono</label>
				<div class="col-sm-8">
				  <input type="number" min=0 max=999999999 class="form-control" id="telefono" name="telefono" placeholder="Teléfono" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="poblacion" class="col-sm-3 control-label">Población</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="poblacion" name="poblacion" placeholder="Población" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="mapa" class="col-sm-3 control-label">Google Maps</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mapa" name="mapa" placeholder="Enlace Google Maps" required>
				</div>
			  </div>
			 
			  

			 
			 
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>