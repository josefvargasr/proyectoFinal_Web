$( 'document' ).ready(iniciar2);

function iniciar2()
{
	iniPusher();
	//iniGrafica();
	$( "#tblmachine" ).on('click','.btnmachine',jugar);

	$( "#tbluser" ).on('click','.btnuser',miJuego);
	//$( "#tblmachine" ).on('click','.btnmachine',jugar);
	
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

    $( "#dialog2" ).dialog({
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

    $( "#dialog3" ).dialog({
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

    $( "#dialog4" ).dialog({
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

    $( "#dialog5" ).dialog({
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

function jugar(event)
{
	enviarDato();
	var id=event.target.id;
	$.ajax(
		{
			url:'/Batalla_Naval/juego2/atacar/'+id,
			type:'post',
			dataType:'json',
		}
	)
	.done(
		function(rpta)
		{
			console.log(rpta);
			
			$( "#"+id).removeClass('btn-warning');
			if(rpta.pos_vec==1){				
				$( "#"+id).addClass('btn-danger');
			}else{
				$( "#"+id).addClass('btn-primary');
			}
			$( "#"+id).prop('disabled','disabled');

			$(".btnmachine").prop('disabled','disabled');
			$( "#dialog2" ).dialog("open");

			if(rpta.win==2){
				$( "#dialog4" ).dialog("open");
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

function miJuego(event)
{

	var id=event.target.id;
	console.log(id);
	$.ajax(
		{
			url:'/Batalla_Naval/adicionarPosicion2/'+id,
			type:'post',
			dataType:'json',
		}
	)
	.done(
		function(rpta)
		{
			console.log(rpta);
			

			if(rpta.estado<6){
				if (rpta.cambio==1){
					$( "#"+id).removeClass('btn-success');
				 	$( "#"+id).addClass('btn-info');
				}
				if(rpta.cambio==0){
					$( "#"+id).removeClass('btn-info');
				 	$( "#"+id).addClass('btn-success');
				} 
			}

			if(rpta.estado==6){
				//$( ".btnmachine").prop('disabled','');	
				$( "#dialog2" ).dialog("open");
			}else{
				$( ".btnmachine").prop('disabled','disabled');	
			}

			if (rpta.estado==6 && rpta.cambio==0 && rpta.valor==1){
				$( "#"+id).removeClass('btn-info');
			 	$( "#"+id).addClass('btn-success');
			}

			if (rpta.estado==6 && rpta.cambio==1 && rpta.valor==0){
				$( "#"+id).removeClass('btn-success');
			 	$( "#"+id).addClass('btn-info');
			}

			if(rpta.estado==6 && rpta.cambio==0 && rpta.valor==0){
				$( "#dialog" ).dialog("open");
				//alert("Puede iniciar el juego");
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

//----------------------------------------------------------------------------------

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
    var vdato=parseInt(data.valor);
    //chart.series[0].addPoint(vdato);
    console.log("funcion recibir");
    $.ajax(
		{
			url:'/Batalla_Naval/juego2/ataque/'+vdato,
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

			if(rpta.win==1){
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

function iniGrafica()
{
	chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            defaultSeriesType: 'line'
        }, 
        plotOptions:{
        	line:{
        		pointInterval:1
        	}
        },       
        title: {
            text: 'Datos RTC ejemplo'
        },
        xAxis: {
            type: 'linear',
            floor:0,
            tickPixelInterval: 150,
            maxZoom: 2 * 10
        },
        yAxis: {
            minPadding: 0.2,
            maxPadding: 0.2,
            title: {
                text: 'Valor',
                margin: 80
            }
        },
        series: [{
            name: 'Mis datos',
            data: []
        }]
    });
}
