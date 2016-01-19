$( 'document' ).ready(opciones);

function opciones()
{	
	$( "#btnenviar1" ).on('click',acUsoAulas);
	$( "#btnenviar2" ).on('click',acPorcOcup);
	$( "#btnenviar3" ).on('click',acEvenAulas);
	$( "#btnenviar4" ).on('click',acEvenUser);

	$( "#btninsert" ).on('click',acInsertInv);
	$( "#btnedit" ).on('click',acEditInv);
	$( "#btndelete" ).on('click',acDeletInv);
}

function acUsoAulas()
{
	var aula=$("#aula1").val();
	var year=$("#año1").val();

	window.location = '/proyectoFinal/grafico/usoAulas/'+aula+'/'+year;
}

function acPorcOcup()
{
	var year=$("#año2").val();

	window.location = '/proyectoFinal/grafico/porcOcup/'+year;
}

function acEvenAulas()
{
	var aula=$("#aula3").val();
	var year=$("#año3").val();

	window.location = '/proyectoFinal/grafico/evenAulas/'+aula+'/'+year;
}

function acEvenUser()
{
	var tip=$("#tip").val();
	var year=$("#año4").val();

	window.location = '/proyectoFinal/grafico/evenUser/'+tip+'/'+year;
}

function acInsertInv()
{
	var aula=$("#aula").val();
	var equ=$("#equipo").val();
	var state=$("#state").val();

	var num = 2;

	var bueno1 = 'Bueno';
	var bueno2 = 'bueno';

	var malo1 = 'Malo';
	var malo2 = 'malo';

	if (state.localeCompare(bueno1) == 0 || state.localeCompare(bueno2) == 0) {
	    num = 0;
	} else if (state.localeCompare(malo1) == 0 || state.localeCompare(malo2) == 0) {
	    num = 1;
	}

	console.log('Insertar');

	window.location = '/proyectoFinal/grafico/InsertInv/'+aula+'/'+equ+'/'+num+'/1';
}

function acEditInv()
{
	var aula=$("#aula").val();
	var equ=$("#equipo").val();
	var state=$("#state").val();

	var num = 2;

	var bueno1 = 'Bueno';
	var bueno2 = 'bueno';

	var malo1 = 'Malo';
	var malo2 = 'malo';

	if (state.localeCompare(bueno1) == 0 || state.localeCompare(bueno2) == 0) {
	    num = 0;
	} else if (state.localeCompare(malo1) == 0 || state.localeCompare(malo2) == 0) {
	    num = 1;
	}

	window.location = '/proyectoFinal/grafico/InsertInv/'+aula+'/'+equ+'/'+num+'/2';
}

function acDeletInv()
{
	var aula=$("#aula").val();
	var equ=$("#equipo").val();
	var state=$("#state").val();

	var num = 2;

	var bueno1 = 'Bueno';
	var bueno2 = 'bueno';

	var malo1 = 'Malo';
	var malo2 = 'malo';

	if (state.localeCompare(bueno1) == 0 || state.localeCompare(bueno2) == 0) {
	    num = 0;
	} else if (state.localeCompare(malo1) == 0 || state.localeCompare(malo2) == 0) {
	    num = 1;
	}

	window.location = '/proyectoFinal/grafico/InsertInv/'+aula+'/'+equ+'/'+num+'/3';
}