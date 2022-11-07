		$(document).ready(function(){
			load(1);
		});

		function load(page){
			var id_categoria= $("#id_categoria").val();
			var parametros={'action':'ajax','page':page,'id_categoria':id_categoria};
			$("#loader").fadeIn('slow');
			$.ajax({
				data: parametros,
				url:'./ajax/buscar_reportes.php',
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}
