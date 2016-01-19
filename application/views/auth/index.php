<link rel="stylesheet" href='<?php echo base_url()?>css/jquery-ui.css'>
<script src='<?php echo base_url()?>js/jquery.min.js'></script>

<script src='<?php echo base_url()?>js/jquery.js'></script>
<script src='<?php echo base_url()?>js/jquery-ui.js'></script>
<script src='<?php echo base_url()?>js/pusher.min.js'></script>
<script src='<?php echo base_url()?>js/admin.js'></script>



<h1><?php echo lang('index_heading');?></h1>

<div id='calendar' class='calendar col-md-1'>
	<h3>Reservas</h3>
	Aula: <input id='aula' list="aula" name="aula">
	Curso: <input id='curso' list="curso" name="curso">
	Profesor: <input id='profesor' list="profesor" name="profesor">
	C.C.: <input id='cc' list="cc" name="cc"><br><br>
	Hora: <input id='hora2' list="hora" name="hora">
	  <datalist id="hora">
	    <option value="6:00-8:00">
	    <option value="8:00-10:00">
	    <option value="10:00-12:00">
	    <option value="12:00-14:00">
	    <option value="14:00-16:00">
	    <option value="16:00-18 :00">
	    <option value="18:00-20:00">
	    <option value="20:00-22:00">
	  </datalist>		
	Dia: <input id='dia2' list="dia" name="dia">
	  <datalist id="dia">
	    <option value="1">
	    <option value="2">
	    <option value="3">
	    <option value="4">
	    <option value="5">
	    <option value="6">
	    <option value="7">
	    <option value="8">
	    <option value="9">
	    <option value="10">
	    <option value="11">
	    <option value="12">
	    <option value="13">
	    <option value="14">
	    <option value="15">
<!-- 	    <option value="16">
	    <option value="17">
	    <option value="18">
	    <option value="19">
	    <option value="20">
	    <option value="21">
	    <option value="22">
	    <option value="23">
	    <option value="24">
	    <option value="25">
	    <option value="26">
	    <option value="27">
	    <option value="28">
	    <option value="29">
	    <option value="30">
	    <option value="31"> -->
	  </datalist>
	Mes: <input id="mes2" list="mes" name="mes">
	  <datalist id="mes">
	  	<option value="1">
	    <option value="2">
	    <option value="3">
	    <option value="4">
	    <option value="5">
	    <option value="6">
	    <option value="7">
	    <option value="8">
	    <option value="9">
	    <option value="10">
	    <option value="11">
	    <option value="12">
	  </datalist>
	Año: <input id="año2" list="año" name="año">
	  <datalist id="año">
	    <option value="2015">
	    <option value="2016">
	    <option value="2017">
	  </datalist>
	  <div class="btnpeso2">
	  	<br><input id='btnreservar' type="button" value="Reservar"><input id='btneditar' type="button" value="Editar"><input id='btneliminar' type="button" value="Eliminar"><br>
	  </div>

  	<form action="http://localhost/proyectoFinal/index.php/inicio" method="post" accept-charset="utf-8">
		<input class type='submit' name='submit' value='Ver Aulas'>
	</form>
</div>

<br><input id='btninformes' type="button" value="Generar Informes"><br>

<p><?php echo lang('index_subheading');?></p>
<div id="infoMessage"><?php echo $message;?></div>

<table cellpadding=0 cellspacing=10>
	<tr>
		<th><?php echo lang('index_fname_th');?></th>
		<th><?php echo lang('index_lname_th');?></th>
		<th><?php echo lang('index_email_th');?></th>
		<th><?php echo lang('index_groups_th');?></th>
		<th><?php echo lang('index_status_th');?></th>
		<th><?php echo lang('index_action_th');?></th>

	</tr>

	<?php foreach ($users as $user):?>
		<tr>
            <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
			<td>
				<?php foreach ($user->groups as $group):?>
					<?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
                <?php endforeach?>
			</td>
			<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
			<td><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?><br/>
				<?php echo anchor("auth/delete/".$user->id, 'Delete') ;?></td>
		</tr>
	<?php endforeach;?>
</table>

<table cellpadding=0 cellspacing=10>
	 <?php 
	// 	$datos=$this->dataview['datos'];
	// 	echo "<br>";
	// 		echo "<tr><th>Usuario</th><th>Juegos</th><th>Ganados</th><th>Perdidos</th></tr>";

	// 		for ($i=0; $i < sizeof($datos) ; $i++) {
	// 			 $d=$datos[$i];
	// 			 $user=$d['user'];
	// 			 $jegos=$d['jegos'];
	// 			 $ganados=$d['ganados'];
	// 			 $perdidos=$d['perdidos'];
	// 			echo "<tr><td>$user</td><td>$jegos</td><td>$ganados</td><td>$perdidos</td></tr>";	
	// 		}	
	?>
</table>

<p><?php echo anchor('auth/create_user', lang('index_create_user_link'))?> | <?php echo anchor('auth/create_group', lang('index_create_group_link'))?></p>


<div>
	<form action="http://localhost/proyectoFinal/index.php/auth/logout" method="post" accept-charset="utf-8">
		<input class type='submit' name='submit' value='Logout'>
	</form>
</div>

<div id="dialog_reservaExitosa" title="Alerta">
  	<p>Reserva exitosa.</p>
</div>

<div id="dialog_reservaExistente" title="Alerta">
  	<p>El aula se encuentra reservada.</p>
</div>

<div id="dialog_reservaExistenteBloque" title="Alerta">
  	<p>El profesor tiene otra aula reservada en este bloque.</p>
</div>

<div id="dialog_noPuedeReservar" title="Alerta">
  	<p>El profesor ya tiene otra reserva.</p>
</div>

<div id="dialog_reservaEliminada" title="Alerta">
  	<p>Reserva eliminada exitosamente.</p>
</div>

<div id="dialog_reservaNoEliminada" title="Alerta">
  	<p>Reserva NO existente.</p>
</div>

<div id="dialog_reservaEditada" title="Alerta">
  	<p>Reserva editada exitosamente.</p>
</div>

<div id="dialog_reservaNoEditada" title="Alerta">
  	<p>Reserva NO existente.</p>
</div>

<div id="dialog_reservaNoEditadaCuarto" title="Alerta">
  	<p>No ha pasado la ley del cuarto, no se puede editar la reserva.</p>
</div>

<div id="dialog_estudiante" title="Alerta">
  	<p>La TIP puesta es de un estudiante.</p>
</div>
