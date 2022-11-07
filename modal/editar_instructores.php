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
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar instructor</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_instructor" name="editar_instructor">
			<div id="resultados_ajax2"></div>
			<div class="form-group">
				<label for="firstname2" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="firstname2" name="firstname2" placeholder="Nombre" required>
				  <input type="hidden" id="mod_id" name="mod_id">
				</div>
			  </div>
			  <div class="form-group">
				<label for="lastname2" class="col-sm-3 control-label">Apellidos</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="lastname2" name="lastname2" placeholder="Apellidos" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="direccion2" class="col-sm-3 control-label">Dirección</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="direccion2" name="direccion2" placeholder="Dirección" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="telefono2" class="col-sm-3 control-label">Teléfono</label>
				<div class="col-sm-8">
				  <input type="number" min=0 max=999999999 class="form-control" id="telefono2" name="telefono2" placeholder="Teléfono" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="instructor_email2" class="col-sm-3 control-label">Email</label>
				<div class="col-sm-8">
				  <input type="email" class="form-control" id="instructor_email2" name="instructor_email2" placeholder="Correo electrónico" required>
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