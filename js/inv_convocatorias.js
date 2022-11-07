		$(document).ready(function(){
			load(1);
		});

		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/buscar_invcon.php?action=ajax&page='+page+'&q='+q,
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
          url: "ajax/actualizar_invcon.php",
          data: parametros,
           beforeSend: function(objeto){
            $("#resultados").html("Mensaje: Cargando...");
            },
          success: function(datos){
          $("#resultados").html(datos);
          $('#actualizar_datos_entre3').attr("disabled", false);
          window.location.href = 'elem_convoc.php';
          }
      });
      event.preventDefault();
    })


		function funcionDevuelto(id) {
		if (confirm("¿Realmente confirma que se ha devuelo el inventario de esta convocatoria?")){	
      $('#myModal3_devue').modal('show');
      $("#devolver_id").val(id);
			}
		}

    $( "#obs_devue" ).submit(function( event ) {
      $('#actualizar_datos_devue3').attr("disabled", true);
      
     var parametros = $(this).serialize();
       $.ajax({
          type: "POST",
          url: "ajax/actualizar_invcon.php",
          data: parametros,
           beforeSend: function(objeto){
            $("#resultados").html("Mensaje: Cargando...");
            },
          success: function(datos){
          $("#resultados").html(datos);
          $('#actualizar_datos_devue3').attr("disabled", false);
          window.location.href = 'elem_convoc.php';
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
		
		
	
$( "#guardar_inv_con" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_invcon.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
			$('#guardar_datos').attr("disabled", false);
      window.location.href = 'elem_convoc.php';
		  }
	});
  event.preventDefault();
})
	


    /**** CANVAS1 ****/
    /* Variables de Configuracion */
    var idCanvas='canvas1';
    var idForm='guardar_inv_con';
    var inputImagen='firma1';
    var estiloDelCursor='pointer';
    var colorDelTrazo='#555';
    var colorDeFondo='#fff';
    var grosorDelTrazo=2;

    /* Variables necesarias */
    var contexto=null;
    var valX=0;
    var valY=0;
    var flag=false;
    var imagen=document.getElementById(inputImagen); 
    var anchoCanvas=document.getElementById(idCanvas).offsetWidth;
    var altoCanvas=document.getElementById(idCanvas).offsetHeight;
    var pizarraCanvas=document.getElementById(idCanvas);

    /* Esperamos el evento load */
    window.addEventListener('load',IniciarDibujo,false);

    function IniciarDibujo(){
      /* Creamos la pizarra */
      pizarraCanvas.style.cursor=estiloDelCursor;
      contexto=pizarraCanvas.getContext('2d');
      contexto.fillStyle=colorDeFondo;
      contexto.fillRect(0,0,anchoCanvas,altoCanvas);
      contexto.strokeStyle=colorDelTrazo;
      contexto.lineWidth=grosorDelTrazo;
      contexto.lineJoin='round';
      contexto.lineCap='round';
      /* Capturamos los diferentes eventos */
      pizarraCanvas.addEventListener('mousedown',MouseDown,false);// Click pc
      pizarraCanvas.addEventListener('mouseup',MouseUp,false);// fin click pc
      pizarraCanvas.addEventListener('mousemove',MouseMove,false);// arrastrar pc

      pizarraCanvas.addEventListener('touchstart',TouchStart,false);// tocar pantalla tactil
      pizarraCanvas.addEventListener('touchmove',TouchMove,false);// arrastras pantalla tactil
      pizarraCanvas.addEventListener('touchend',TouchEnd,false);// fin tocar pantalla dentro de la pizarra
      pizarraCanvas.addEventListener('touchleave',TouchEnd,false);// fin tocar pantalla fuera de la pizarra
    }

    function MouseDown(e){
      flag=true;
      contexto.beginPath();
      valX=e.pageX-posicionX(pizarraCanvas); valY=e.pageY-posicionY(pizarraCanvas);
      contexto.moveTo(valX,valY);
    }

    function MouseUp(e){
      contexto.closePath();
      flag=false;
    }

    function MouseMove(e){
      if(flag){
        contexto.beginPath();
        contexto.moveTo(valX,valY);
        valX=e.pageX-posicionX(pizarraCanvas); valY=e.pageY-posicionY(pizarraCanvas);
        contexto.lineTo(valX,valY);
        contexto.closePath();
        contexto.stroke();
      }
    }

    function TouchMove(e){
      e.preventDefault();
      if (e.targetTouches.length == 1) { 
        var touch = e.targetTouches[0]; 
        MouseMove(touch);
      }
    }

    function TouchStart(e){
      if (e.targetTouches.length == 1) { 
        var touch = e.targetTouches[0]; 
        MouseDown(touch);
      }
    }

    function TouchEnd(e){
      if (e.targetTouches.length == 1) { 
        var touch = e.targetTouches[0]; 
        MouseUp(touch);
      }
    }

    function posicionY(obj) {
      var valor = obj.offsetTop;
      if (obj.offsetParent) valor += posicionY(obj.offsetParent);
      return valor;
    }

    function posicionX(obj) {
      var valor = obj.offsetLeft;
      if (obj.offsetParent) valor += posicionX(obj.offsetParent);
      return valor;
    }

    /* Limpiar pizarra */
    function LimpiarTrazado(){
      var pizarraCanvas = document.getElementById("canvas1");
      var contexto = pizarraCanvas.getContext("2d");
      var anchoCanvas=document.getElementById("canvas1").offsetWidth;
      var altoCanvas=document.getElementById("canvas1").offsetHeight;
      contexto.fillStyle=colorDeFondo;
      contexto.fillRect(0,0,anchoCanvas,altoCanvas);
    }

    /* Enviar el trazado */
    function GuardarTrazado(){
      imagen.value=document.getElementById(idCanvas).toDataURL('image/png');
    }

