		$(document).ready(function(){
			carga(1);
		});

		function load(page){
			var q= $("#q").val();
			var id_categoria= $("#id_categoria").val();
			var parametros={'action':'ajax','page':page,'q':q,'id_categoria':id_categoria};
			$("#loader").fadeIn('slow');
			$.ajax({
				data: parametros,
				url:'./ajax/buscar_productos_eliminados.php',
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}

		function carga(page){
			var q= $("#q").val();
			var id_categoria= $("#id_categoria").val();
			var cat = getParameterByName('cat');
			var parametros={'action':'ajax','page':page,'q':q,'id_categoria':id_categoria, 'cat':cat};
			$("#loader").fadeIn('slow');
			$.ajax({
				data: parametros,
				url:'./ajax/buscar_productos_eliminados.php',
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}
	
		function getParameterByName(name) {
		    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		    results = regex.exec(location.search);
		    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
		}
		
		
		
		
		
		
		

