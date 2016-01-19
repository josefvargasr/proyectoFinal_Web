<?php

class Servidor extends MY_CI_Controller 
{
	public function index($aula,$tipo,$tip,$vinculacion)
	{
		echo "<link rel='stylesheet' href='http://localhost/proyectoFinal/css/jquery-ui.css'>
			<script src='http://localhost/proyectoFinal/js/jquery.min.js'></script>
			<script src='http://localhost/proyectoFinal/js/jquery.js'></script>
			<script src='http://localhost/proyectoFinal/js/jquery-ui.js'></script>
			<script src='http://localhost/proyectoFinal/js/pusher.min.js'></script>
			<script src='http://localhost/proyectoFinal/js/servidor.js'></script>";

		echo "<script type='text/javascript'>
			    iniciar($aula,$tipo,$tip,$vinculacion);
    		</script>";

		// echo "<br>$aula<br>";
		// echo "$tipo<br>";
		// echo "$tip<br>";
		// echo "$vinculacion";

    	echo "Se envio la informacion desde el embebido al servidor";
	}

	public function index2($tip,$vinculacion)
	{
		echo "<link rel='stylesheet' href='http://localhost/proyectoFinal/css/jquery-ui.css'>
			<script src='http://localhost/proyectoFinal/js/jquery.min.js'></script>
			<script src='http://localhost/proyectoFinal/js/jquery.js'></script>
			<script src='http://localhost/proyectoFinal/js/jquery-ui.js'></script>
			<script src='http://localhost/proyectoFinal/js/pusher.min.js'></script>
			<script src='http://localhost/proyectoFinal/js/servidor.js'></script>";

		echo "<script type='text/javascript'>
			    reservarTip($tip,$vinculacion);
    		</script>";

    	
		echo "<br>$tip<br>";
		echo "$vinculacion<br>";

    	echo "Se envio la informacion de la tip desde el embebido al servidor";
	}
	
}