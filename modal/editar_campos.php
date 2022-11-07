	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar campos de vuelo</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_campo" name="editar_campo">
			<div id="resultados_ajax2"></div>
			<div class="form-group">
				<label for="name2" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="name2" name="name2" placeholder="Nombre" required>
				  <input type="hidden" id="mod_id" name="mod_id">
				</div>
			  </div>
			  <div class="form-group">
				<label for="email2" class="col-sm-3 control-label">Email</label>
				<div class="col-sm-8">
				  <input type="email" class="form-control" id="email2" name="email2" placeholder="Correo electrónico" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="telefono2" class="col-sm-3 control-label">Teléfono</label>
				<div class="col-sm-8">
				  <input type="number" min=0 max=999999999 class="form-control" id="telefono2" name="telefono2" placeholder="Teléfono" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="poblacion2" class="col-sm-3 control-label">Población</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="poblacion2" name="poblacion2" placeholder="Población" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="mapa2" class="col-sm-3 control-label">Google Maps</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mapa2" name="mapa2" placeholder="Enlace Google Maps" required>
				</div>
			  </div>
						 	 
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>