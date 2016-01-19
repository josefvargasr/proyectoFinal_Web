$( 'document' ).ready(iniciar);

function iniciar()
{	
	iniPusher();
	//iniGrafica();
    //$( "#piso1" ).on('click','.btnpiso1',piso);
	//$( "#piso2" ).on('click','.btnpiso2',piso);

	$( "#btnfechaUser" ).on('click',calendarUser);
	
	$( "#dialog" ).dialog({
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

function calendarUser()
{
	var dia=$("#dia1").val();
    //$("#dia1").val('');
    var mes=$("#mes1").val();
    //$("#mes1").val('');
    var año=$("#año1").val();
    //$("#año1").val('');
    var hora=$("#hora1").val();
    //$("#hora1").val('');
    var fecha=hora+"_"+dia+"-"+mes+"-"+año;
	$.ajax(
		{
			url:'/proyectoFinal/inicio/actualizarPisos/'+fecha,
			type:'post',
			dataType:'json',
		}
	)
	.done(
		function(rpta)
		{
			console.log(rpta);
			var data = rpta.valor;
			for (i=1; i < 37 ; i++) {
				$( "#aula-"+i).removeClass('btn-reservada');
				$( "#aula-"+i).removeClass('btn-ocupada');
				$( "#aula-"+i).removeClass('btn-nodisponible');
				$( "#aula-"+i).removeClass('btn-alerta');
				$( "#aula-"+i).addClass('btn-libre');
				document.getElementById("aula-"+i).title="Aula: "+i+"\n"+"Estado: Libre";
				//document.getElementById("aula-"+i).innerHTML = i;
			}

			for (i=0; i < data.length ; i++) {
				d=data[i];
				fecha=hora+"_"+dia+"-"+mes+"-"+año;
				aula=parseInt(d['aula']);
				estado=parseInt(d['estado']);
				profesor=d['profesor'];
				curso=d['curso'];
				// console.log(aula);
				// console.log(estado);
				// console.log(profesor);
				// console.log(curso);
				// console.log("#aula-"+aula);
				switch(estado){
				 	case 1: 
				 		$( "#aula-"+aula).addClass('btn-reservada');
				 		document.getElementById("aula-"+aula).title="Aula: "+aula+"\n"+"Estado: Reservada"+"\n"+"Profesor: "+profesor+"\n"+"Curso: "+curso;
				 		//document.getElementById("aula-"+aula).innerHTML = aula+"<br>"+profesor+"<br>"+curso; 
				 		break;
				 	case 2: 
				 		$( "#aula-"+aula).addClass('btn-ocupada');
				 		document.getElementById("aula-"+aula).title="Aula: "+aula+"\n"+"Estado: Ocupada"+"\n"+"Profesor: "+profesor+"\n"+"Curso: "+curso;
				 		break;
				 	case 3: 
				 		$( "#aula-"+aula).addClass('btn-libre');
				 		document.getElementById("aula-"+aula).title="Aula: "+aula+"\n"+"Estado: Libre"+"\n";
				 		break;
				 	case 4: 
				 		$( "#aula-"+aula).addClass('btn-nodisponible');
				 		document.getElementById("aula-"+aula).title="Aula: "+aula+"\n"+"Estado: No disponible"+"\n";
				 		break;
				 	case 5: 
				 		$( "#aula-"+aula).addClass('btn-alerta');
				 		document.getElementById("aula-"+aula).title="Aula: "+aula+"\n"+"Estado: Alerta"+"\n";
				 		break;
				 	default:
				 		break;
				}
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

function piso(event)
{
	var id=event.target.id;
	var aula=id.split('-');
	//console.log(id);	
	//console.log(aula);	
	$.ajax(
		{
			url:'/proyectoFinal/aulas/piso/'+id,
			type:'post',
			dataType:'json',
		}
	)
	.done(
		function(rpta)
		{
			console.log(id);	
			$( "#"+id).addClass('btn-reservada');
			$( "#"+id).InnerHTML = 'label text';
			document.getElementById(id).innerHTML = 'id'; 
			//$( "#"+id).html($( "#"+id).data("text-original"));
			//$( "#"+id).value="curso";
		}
	)
	.fail(
		function(xhr,textStatus)
		{
			console.log(textStatus);
		}
	);
}
//----------------------------------------------------------------------------------------------

function enviarDato()
{
    var id=event.target.id;
    var midato = id;
    var pos=midato.split('-');
    console.log(pos[1]);

    $.ajax(
        {
            url:'/rtc/rt.php',
            type:'post',
            data:{"dato":pos[1],"channel":"1"},
        }
    );
}

function iniPusher()
{
	var pusher = new Pusher('95d1a690031f3d3ae951');
	var channel = pusher.subscribe('rtch2');
	channel.bind('actualizar', function(data) {
                                    recibirPusher(data);
                                }
                );
}

function recibirPusher(data){

    //console.log(data.valor);

    $.ajax(
		{
			url:'/proyectoFinal/inicio/actualizarPisosPorPusher/'+data.valor,
			type:'post',
			dataType:'json',
		}
	)
	.done(
		function(rpta)
		{
			aula = rpta.aula;
			estado = parseInt(rpta.tipo);
			console.log(rpta);

			$( "#aula-"+aula).removeClass('btn-reservada');
			$( "#aula-"+aula).removeClass('btn-ocupada');
			$( "#aula-"+aula).removeClass('btn-nodisponible');
			$( "#aula-"+aula).removeClass('btn-alerta');
			$( "#aula-"+aula).removeClass('btn-libre');

			switch(estado){
				case 1: 
			 		$( "#aula-"+aula).addClass('btn-reservada');
			 		break;
				case 2: 
			 		$( "#aula-"+aula).addClass('btn-ocupada');
			 		document.getElementById("aula-"+aula).title="Aula: "+aula+"\n"+"Estado: Ocupada";
			 		break;
			 	case 3:
			 		$( "#aula-"+aula).addClass('btn-libre');
			 		document.getElementById("aula-"+aula).title="Aula: "+aula+"\n"+"Estado: Libre"+"\n";
			 		break;
			 	case 51: 
			 		$( "#aula-"+aula).addClass('btn-alerta');
			 		document.getElementById("aula-"+aula).title="Aula: "+aula+"\n"+"Estado: Puerta abierta"+"\n"; 
			 		break;
			 	case 52: 
			 		$( "#aula-"+aula).addClass('btn-alerta');
			 		document.getElementById("aula-"+aula).title="Aula: "+aula+"\n"+"Estado: Luces encendidas"+"\n";
			 		break;
			 	case 53: 
			 		$( "#aula-"+aula).addClass('btn-alerta');
			 		document.getElementById("aula-"+aula).title="Aula: "+aula+"\n"+"Estado: Acceso incorrecto"+"\n";
			 		break;
			 	case 54: 
			 		$( "#aula-"+aula).addClass('btn-alerta');
			 		document.getElementById("aula-"+aula).title="Aula: "+aula+"\n"+"Estado: Computador Malo"+"\n";
			 		break;
			 	case 55: 
			 		$( "#aula-"+aula).addClass('btn-alerta');
			 		document.getElementById("aula-"+aula).title="Aula: "+aula+"\n"+"Estado: Computador encendido"+"\n";
			 		break;
			 	case 56: 
			 		$( "#aula-"+aula).addClass('btn-alerta');
			 		document.getElementById("aula-"+aula).title="Aula: "+aula+"\n"+"Estado: Solicitud de personal"+"\n";
			 		break;
			 	default:
			 		break;
			}
		}
	)
	.fail(
		function(xhr,textStatus)
		{
			console.log("recibio mal");
			console.log(textStatus);
		}
	);
}

function blinking(aula, action) {

	console.log(action);

	if (action == 1) {
		$( "#aula-"+aula).animate({
	    opacity: '0'
	    }, function(){
	        $(this).animate({
	            opacity: '1'
	        });
	    });
	}else{
		$( "#aula-"+aula).animate({
	    opacity: '0'
	    }, function(){
	        $(this).animate({
	            opacity: '1'
	        }, blinking(aula, action));
	    });
	}
	
    
}

var requestId;
var aulaAnim;

function loop(time) {

    $( "#aula-"+aulaAnim).animate({
    	opacity: '0'
    }, function(){
        $(this).animate({
            opacity: '1'
        });
    });

    requestId = window.requestAnimationFrame(loop);
}

function start(aula) {
    if (!requestId) {
       loop(aula);
    }
}

function stop() {
	$( "#aula-"+aulaAnim).animate({
    	opacity: '1'
    });

    if (requestId) {
       window.cancelAnimationFrame(requestId);
       requestId = undefined;
    }
}