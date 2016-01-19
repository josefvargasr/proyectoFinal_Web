$( 'document' ).ready(iniciar);

function iniciar()
{	
  iniPusher();
	$( "#btnreservar" ).on('click',reservar);
	$( "#btneditar" ).on('click',editar);
	$( "#btneliminar" ).on('click',eliminar);
  $( "#btninformes" ).on('click',informes);
  document.getElementById("cc").disabled = true;

	$( "#dialog_reservaExitosa" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 500
      },
      hide: {
        effect: "explode",
        duration: 500
      }
    });

    $( "#dialog_reservaExistente" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 500
      },
      hide: {
        effect: "explode",
        duration: 500
      }
    });

    $( "#dialog_reservaExistenteBloque" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 500
      },
      hide: {
        effect: "explode",
        duration: 500
      }
    });

    $( "#dialog_noPuedeReservar" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 500
      },
      hide: {
        effect: "explode",
        duration: 500
      }
    });

    $( "#dialog_reservaEliminada" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 500
      },
      hide: {
        effect: "explode",
        duration: 500
      }
    });

    $( "#dialog_reservaNoEliminada" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 500
      },
      hide: {
        effect: "explode",
        duration: 500
      }
    });

    $( "#dialog_reservaEditada" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 500
      },
      hide: {
        effect: "explode",
        duration: 500
      }
    });

    $( "#dialog_reservaNoEditada" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 500
      },
      hide: {
        effect: "explode",
        duration: 500
      }
    });

    $( "#dialog_reservaNoEditadaCuarto" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 500
      },
      hide: {
        effect: "explode",
        duration: 500
      }
    });

    $( "#dialog_estudiante" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 500
      },
      hide: {
        effect: "explode",
        duration: 500
      }
    });
}

function reservar()
{
	var dia=$("#dia2").val();
    $("#dia2").val('');
    var mes=$("#mes2").val();
    $("#mes2").val('');
    var año=$("#año2").val();
    $("#año2").val('');
    var hora=$("#hora2").val();
    $("#hora2").val('');
    var profe=$("#profesor").val();
    $("#profesor").val('');
    var cc=$("#cc").val();
    $("#cc").val('');
    var aula=$("#aula").val();
   	$("#aula").val('');
    var curso=$("#curso").val();
	$("#curso").val('');
    var fecha=aula+"_"+hora+"_"+dia+"-"+mes+"-"+año+"_"+curso+"_"+profe+"_"+cc;
	$.ajax(
		{
			url:'/proyectoFinal/auth/reservas/'+fecha,
			type:'post',
			dataType:'json',
		}
	)
	.done(
		function(rpta)
		{
			console.log(rpta);
      if (rpta.existe == 2) {
        $( "#dialog_reservaExistenteBloque" ).dialog("open");
      }else if(rpta.existe == 1){
				$( "#dialog_reservaExistente" ).dialog("open");
			}else if(rpta.existe == 0){
				$( "#dialog_reservaExitosa" ).dialog("open");
			}
		}
	)
	.fail(
		function(xhr,textStatus)
		{
			console.log(textStatus);
		}
	);
}

function editar()
{
	var dia=$("#dia2").val();
    $("#dia2").val('');
    var mes=$("#mes2").val();
    $("#mes2").val('');
    var año=$("#año2").val();
    $("#año2").val('');
    var hora=$("#hora2").val();
    $("#hora2").val('');
    var profe=$("#profesor").val();
    $("#profesor").val('');
    var cc=$("#cc").val();
    $("#cc").val('');
    var aula=$("#aula").val();
   	$("#aula").val('');
    var curso=$("#curso").val();
	$("#curso").val('');
    var fecha=aula+"_"+hora+"_"+dia+"-"+mes+"-"+año+"_"+curso+"_"+profe+"_"+cc;
	$.ajax(
		{
			url:'/proyectoFinal/auth/editar/'+fecha,
			type:'post',
			dataType:'json',
		}
	)
	.done(
		function(rpta)
		{
			console.log(rpta);
			if(rpta.existe == 0){
				$( "#dialog_reservaNoEditada" ).dialog("open");
			}else if(rpta.existe == 11){
				$( "#dialog_reservaNoEditadaCuarto" ).dialog("open");
			}else if(rpta.existe > 0){
				$( "#dialog_reservaEditada" ).dialog("open");
			}
			
		}
	)
	.fail(
		function(xhr,textStatus)
		{
			console.log(textStatus);
		}
	);
}

function eliminar()
{
	var dia=$("#dia2").val();
    $("#dia2").val('');
    var mes=$("#mes2").val();
    $("#mes2").val('');
    var año=$("#año2").val();
    $("#año2").val('');
    var hora=$("#hora2").val();
    $("#hora2").val('');
    var profe=$("#profesor").val();
    $("#profesor").val('');
    var cc=$("#cc").val();
    $("#cc").val('');
    var aula=$("#aula").val();
   	$("#aula").val('');
    var curso=$("#curso").val();
	$("#curso").val('');
    var fecha=aula+"_"+hora+"_"+dia+"-"+mes+"-"+año+"_"+curso+"_"+profe+"_"+cc;
	$.ajax(
		{
			url:'/proyectoFinal/auth/eliminar/'+fecha,
			type:'post',
			dataType:'json',
		}
	)
	.done(
		function(rpta)
		{
			console.log(rpta);
			if(rpta.existe > 0){
				$( "#dialog_reservaEliminada" ).dialog("open");
			}else if(rpta.existe == 0){
				$( "#dialog_reservaNoEliminada" ).dialog("open");
			}
			
		}
	)
	.fail(
		function(xhr,textStatus)
		{
			console.log(textStatus);
		}
	);
}

function iniPusher()
{
  var pusher = new Pusher('95d1a690031f3d3ae951');
  var channel = pusher.subscribe('rtch3');
  channel.bind('actualizar', function(data) {
                                    recibirPusher(data);
                                }
                );
}

function recibirPusher(data){

    var dat=data.valor;
    var d = dat.split('_');
    console.log(d);
    console.log(d[2]);

    if(parseInt(d[2]) == 1){
      $("#cc").val(d[1]);
    }else{
      $( "#dialog_estudiante" ).dialog("open");
    }
    
}

function informes()
{

  window.location = '/proyectoFinal/grafico/usoAulas/1/2015';

}