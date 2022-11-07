		$(document).ready(function(){
			load(1);
		});

		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/buscar_invcon_ins.php?action=ajax&page='+page+'&q='+q,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}

		function funcionEntregado(id) {
			if (confirm("¿Realmente confirma que se ha entregado el inventario de esta convocatoria?")){	
		      $('#myModal3_entre').modal('show');
		      $("#entregar_id").val(id);
			}
		}

	    $( "#obs_entre" ).submit(function( event ) {
	      $('#actualizar_datos_entre3').attr("disabled", true);
	      
	     var parametros = $(this).serialize();
	       $.ajax({
	          type: "POST",
	          url: "ajax/actualizar_invcon_ins.php",
	          data: parametros,
	           beforeSend: function(objeto){
	            $("#resultados").html("Mensaje: Cargando...");
	            },
	          success: function(datos){
	          $("#resultados").html(datos);
	          $('#actualizar_datos_entre3').attr("disabled", false);
	          window.location.href = 'convoc_inst.php';
	          }
	      });
	      event.preventDefault();
	    })

    function ver_obs(id) {
      var obs_entre = $("#t_entre"+id).val();
      var obs_devue = $("#t_devue"+id).val();
      
      $("#t_entre").html(obs_entre);
      $("#t_devue").html(obs_devue);
      $('#observaciones').modal('show');
    }