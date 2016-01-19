// $( 'document' ).ready(iniciar);

function iniciar(aula, tipo, tip, vinculacion)
{	
	iniPusher();
	console.log("Se inicio pusher");
	enviarDato(aula, tipo, tip, vinculacion);
}

function reservarTip(tip, vinculacion)
{	
	iniPusher();
	console.log("Se inicio pusher");
	var name2;
	console.log(name);
	enviarDato2(tip, vinculacion);
}
//----------------------------------------------------------------------------------------------

function enviarDato(aula, tipo, tip, vinculacion)
{	

    var data = aula+"_"+tipo+"_"+tip+"_"+vinculacion;
    console.log(data);

    $.ajax(
        {
            url:'/rtc/rt.php',
            type:'post',
            data:{"dato":data,"channel":"2"},
        }
    );
}

function enviarDato2(tip, vinculacion)
{	

    var data = "Name_"+tip+"_"+vinculacion;
    console.log(data);

    $.ajax(
        {
            url:'/rtc/rt.php',
            type:'post',
            data:{"dato":data,"channel":"3"},
        }
    );
}

function iniPusher()
{
	var pusher = new Pusher('95d1a690031f3d3ae951');
	var channel = pusher.subscribe('rtch1');
	channel.bind('actualizar', function(data) {
                                    recibirPusher(data);
                                }
                );
}

function recibirPusher(data){
    var vdato=parseInt(data.valor);
    //chart.series[0].addPoint(vdato);
    console.log("funcion recibir");
    $.ajax(
		{
			url:'/proyectoFinal/aulas/recibirReserva/'+vdato,
			type:'post',
			dataType:'json',
		}
	)
	.done(
		function(rpta)
		{
			console.log("recibio bn");
			console.log(rpta);
			id22=rpta.posM;
			id2="pos-"+id22;
			//$( ".btnuser").prop('disabled','disabled');

			$( "#"+id2).removeClass('btn-info');
			if (rpta.stateM==2) {
				$( "#"+id2).addClass('btn-warning');
			}else if(rpta.stateM==1){
				$( "#"+id2).addClass('btn-danger');
			}

			$(".btnmachine").prop('disabled','');
			$( "#dialog3" ).dialog("open");

			if(rpta.win==2){
				$( "#dialog5" ).dialog("open");
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
