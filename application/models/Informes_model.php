<?php

class Informes_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function consultas($table,$cond,$data){
		
        $this->db->select($data)->from($table)->where($cond);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
            return $query->result();

        else return FALSE;
	}

	public function uso_aulas($aula,$year){
		//crear result para juntar datos por mes y por dia

		for ($i=2015; $i < 2018; $i++) {	//Inicializamos
			for ($j=1; $j <= 12; $j++) { 
				$infoResPerMonth[$i][$j] = 0;
	 		}
 		}

 		$infoOcPerMonth = $infoResPerMonth;

		$colum = array('estado', 'fecha');
		$cond = array('aula' => $aula);

		$info = $this->consultas('reservas',$cond,$colum);	//Consultamos uso del aula requerida

		if (!$info == FALSE) {
			$tam_info = count($info);
		
			for ($i=0; $i < $tam_info; $i++) {
				list($d, $m, $y) = explode("-", $info[$i]->fecha);	//extraemos la fecha

				if ($info[$i]->estado > 1)		//Si se usó la reserva se registra por mes
					$infoOcPerMonth[$y][$m]++; 

				$infoResPerMonth[$y][$m]++;		//Registramos la reserva por mes
			}
		}

		for ($i=2015; $i < 2018; $i++) {	//se contabilizan los datos por año
			$infoOcPerYear[$i] = array_sum($infoOcPerMonth[$i]); 
			$infoResPerYear[$i] = array_sum($infoResPerMonth[$i]);
		}

		$result = array('res_year' => $infoResPerYear, 'ocup_year' => $infoOcPerYear, 
						'res_mes' => $infoResPerMonth[$year], 'ocup_mes' => $infoOcPerMonth[$year],
						'aula' => $aula, 'year' => $year);

		return $result;
	}

	public function porcOcup($year){
		$totalAulas = 36;

		for ($i=2015; $i < 2018; $i++) {	//Inicializamos
			for ($j=1; $j <= 12; $j++) { 
				if ($i%4 == 0 and $j == 2)
					$dayOfMonth2 = 29;
				elseif ($j == 2) 
					$dayOfMonth2 = 28;
				elseif ($j == 1 or $j == 3 or $j == 5 or $j == 7
						 or $j == 8 or $j == 10 or $j == 12) 
					$dayOfMonth2 = 31;
				else
					$dayOfMonth2 = 30;

				for ($k=1; $k <= $dayOfMonth2; $k++) { 
					$ocupDay[$i][$j][$k] = 0;
	 			}	
 			}
 		}

 		$colum = array('fecha');
		$cond = array('estado' => 2);

		$ocupadas = $this->consultas('reservas',$cond,$colum);	//Consultamos aulas que esten ocupadas

		$cond = array('estado' => 3); 

		$libres = $this->consultas('reservas',$cond,$colum);		//Aulas cuya reserva fue usada

		$l = 0;
		$data = $ocupadas;

		while ($l <= 1) {
			$tam_data = count($data);
			
			for ($i=0; $i < $tam_data; $i++) { 
				list($dia, $mes, $año) = explode("-", $data[$i]->fecha);
				//Aumentamos numero de ocupaciones en ese dia
				++$ocupDay[$año][$mes][$dia];		//Contabilizamos y separamos por dia
			}

			$data = $libres;
			$l++;
		}

		for ($i=2015; $i < 2018; $i++) {
			for ($j=1; $j <= 12; $j++) { 
				if ($i%4 == 0 and $j == 2)
					$dayOfMonth2 = 29;
				elseif ($j == 2) 
					$dayOfMonth2 = 28;
				elseif ($j == 1 or $j == 3 or $j == 5 or $j == 7
						 or $j == 8 or $j == 10 or $j == 12) 
					$dayOfMonth2 = 31;
				else
					$dayOfMonth2 = 30;

				for ($k=1; $k <= $dayOfMonth2; $k++) { 
					$porcOcDay[$i][$j][$k] = $ocupDay[$i][$j][$k]*100/$totalAulas;		//Calculamos porcentaje por dia
	 			}

	 			$porcOcMonth[$i][$j] = array_sum($porcOcDay[$i][$j])/$dayOfMonth2;		//Calculamos porcentaje promedio mensual

	 			if ($i == $year) {
	 				$porMonth[$i][$j] = number_format($porcOcMonth[$i][$j], 3);		
	 			}
 			}

 			$porcOcYear[$i] = number_format((array_sum($porcOcMonth[$i])/count($porcOcMonth[$i])), 3);		//Calculamos porcentaje promedio anual
 		}

 		$result = array('porc_mes' => $porMonth[$year], 'porc_year' => $porcOcYear, 'year' => $year);

		return $result;
	}

	public function infEventos($aula,$year){
		/*	51='p_op': puerta abierta, 52='lc_on': luces encendidas, 53='w_acc': acceso incorrecto,
			54='pc_m': pc malo, 55='pc_on': pc encendido, 56='sol_per': Solicit. de personal
		*/

		for ($i=51; $i <= 56; $i++) {	//Inicializamos
			for ($j=1; $j <= 12; $j++) {
				$evento[$i][$j] = 0;
	 		}
	 	}

		$colum = array('tipo', 'fecha');
		$cond = array('aula' => $aula);

		$info = $this->consultas('eventos',$cond,$colum);	//Consultamos los eventos en el aula solicitada

		if (!$info == FALSE) {
			$tam_info = count($info);
		
			for ($i=0; $i < $tam_info; $i++) {
				list($d, $m, $y) = explode("-", $info[$i]->fecha);

				if ($y == $year and $info[$i]->tipo > 50) {
					$evento[$info[$i]->tipo][$m]++;			//Contamos los eventos ocurridos por mes si es del año solicitado
				}
			}
		}

		$result = array('p_op' => $evento[51], 'lc_on' => $evento[52], 'w_acc' => $evento[53], 
						'pc_m' => $evento[54], 'pc_on' => $evento[55], 'sol_per' => $evento[56],
						'aula' => $aula, 'year' => $year);

		return $result;
	}

	public function infUser($tip,$year){
		//	1=Reservo, 2=Ocupo, 6=Elimino, 7=Edito

		for ($i=1; $i <= 7; $i++) {
			if (!($i>2 and $i<6)) {		//solo eventos 1,2,6,7
				for ($j=1; $j <= 12; $j++) { 
					$infoPerMonth[$i][$j] = 0;
		 		}
			}	
 		}

		$colum = array('tipo', 'fecha');
		$cond = array('tip' => $tip);

		$info = $this->consultas('eventos',$cond,$colum);

		if (!$info == FALSE) {
			$tam_info = count($info);
		
			for ($i=0; $i < $tam_info; $i++) {
				list($d, $m, $y) = explode("-", $info[$i]->fecha);

				if ($y == $year and $info[$i]->tipo < 10) {
					if ($info[$i]->tipo != 3)
						$infoPerMonth[$info[$i]->tipo][$m]++;			//Contamos los eventos ocurridos por mes si es del año solicitado
				}

			}
		}

		$result = array('res' => $infoPerMonth[1], 'ocup' => $infoPerMonth[2], 
						'delet' => $infoPerMonth[6], 'edit' => $infoPerMonth[7],
						'tip' => $tip, 'year' => $year);

		return $result;
	}

	public function invent(){
		$this->db->select()->from('inventario')->order_by('aula');
		$query = $this->db->get();
        
        if($query->num_rows() > 0 )
            return $query->result();
        else return FALSE;
	}

	public function loadInvent($data1, $data2)
	{
		$this->db->select('estado');
		$this->db->from('inventario');
		$this->db->where('equipo', $data1);
		$this->db->where('aula', $data2);
		$cons = $this->db->get();
		$res = $cons->result_array();

		return $res;
	}

	public function insInv($aula,$eq,$st,$action){
		$colum = array('estado');
		$cond = array('aula' => $aula, 'equipo' => $eq);

		$exist = $this->consultas('inventario',$cond,$colum);	//Consultamos el equipo requerido
		$e = $this->loadInvent($eq, $aula);

		if ($st < 2) {

			switch ((int)$action) {
				case 1:
					if (sizeof($e) == 0) {
						$datos = array('aula' => $aula, 'equipo' => $eq, 'estado' => $st);
						$this->db->insert('inventario', $datos);
					}
					
					break;
				case 2:
					if (sizeof($e) > 0) {
						$datos = array('estado' => $st);
						$this->db->where($cond);
				        $this->db->update('inventario', $datos);
				    }
					break;
				case 3:
					if (sizeof($e) > 0) {
						$this->db->where($cond);
				        $this->db->delete('inventario');
				    }
					break;
				default:
					break;
			}
		}

		return $this->invent();
	}

}




?>