//RTC 2015-2
$( document ).ready(inicializar);

function inicializar()
{
	//iniPusher();
	//iniGrafica();
	//$("#btnenviar").on('click',enviarDato);
    //$( "#tblmachine" ).on('click','.btnmachine',enviarDato);
}

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
            data:{"dato":pos[1],"channel":"2"},
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
    chart.series[0].addPoint(vdato);
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