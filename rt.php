<?php
require('Pusher.php');

$key="95d1a690031f3d3ae951";
$secret="4b9e059630e4ba28ee4d";
$app_id="160372";

$valor=(isset($_POST['valor']))?$_POST['valor']:0;
$dato=(isset($_POST['dato']))?$_POST['dato']:0;
$channel=(isset($_POST['channel']))?$_POST['channel']:0;
$pusher = new Pusher($key, $secret, $app_id);

if($channel!=0){
	$pusher->trigger('rtch'.$channel, 'actualizar', array('valor' => $dato) );
	exit;
}
else{
	$pusher->trigger('rtch1', 'actualizar', array('valor' => $valor) );	
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sensor 1</title>
		<meta charset="UTF-8" />	
	</head>
	<body>
		<div class='centrado'>
			<form method='post'>
				<input name='valor' type='text' size='4' maxlength='4'>&nbsp;<input type='submit' value='Enviar'>
			</form>
	  	</div>
	</body>
</html>