<?php

class Aulas_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('America/Bogota');
	}

	public function getTime(){
		$hoy = getdate();
		$hora = "$hoy[hours]".":"."$hoy[minutes]";
		return $hora;
	}

	public function getDate(){
		$hoy = getdate();
		$fecha = "$hoy[mday]"."-"."$hoy[mon]"."-"."$hoy[year]";
		return $fecha;
	}


	public function reservar($data)
	{
		$datos=array('aula'=>$data[0], 'estado'=>1, 'hora'=>$data[1], 'fecha'=>$data[2], 'curso'=>$data[3], 'profesor'=>$data[4], 'cc'=>$data[5]);
		$this->db->insert('reservas', $datos);
	}

	public function editar($data)
	{
		$datos=array('aula'=>$data[0], 'estado'=>1, 'hora'=>$data[1], 'fecha'=>$data[2], 'curso'=>$data[3], 'profesor'=>$data[4], 'cc'=>$data[5]);
		$this->db->where('fecha', $data[2]);
		$this->db->where('hora', $data[1]);
		$this->db->where('aula', $data[0]);
		$this->db->update('reservas', $datos);
	}

	public function editarAlerta($data, $tipo)
	{
		$datos=array('estado'=>$tipo);
		$this->db->where('fecha', $data[2]);
		$this->db->where('hora', $data[1]);
		$this->db->where('aula', $data[0]);
		$this->db->update('reservas', $datos);
	}

	public function eliminar($data)
	{
		$datos=array('aula'=>$data[0], 'estado'=>1, 'hora'=>$data[1], 'fecha'=>$data[2], 'curso'=>$data[3], 'profesor'=>$data[4], 'cc'=>$data[5]);
		$this->db->where('fecha', $data[2]);
		$this->db->where('hora', $data[1]);
		$this->db->where('aula', $data[0]);
		$this->db->delete('reservas');
	}


	public function loadValue($data)
	{
		$this->db->select('cc');
		$this->db->from('reservas');
		$this->db->where('fecha', $data[2]);
		$this->db->where('hora', $data[1]);
		$this->db->where('aula', $data[0]);
		$cons = $this->db->get();
		$res = $cons->result_array();

		return $res;
	}

	public function loadValueBloque($data)
	{
		$this->db->select('cc');
		$this->db->from('reservas');
		$this->db->where('fecha', $data[2]);
		$this->db->where('hora', $data[1]);
		$cons = $this->db->get();
		$res = $cons->result_array();

		return $res;
	}

	public function loadState($data)
	{
		$this->db->select('estado');
		$this->db->from('reservas');
		$this->db->where('fecha', $data[2]);
		$this->db->where('hora', $data[1]);
		$this->db->where('aula', $data[0]);
		$cons = $this->db->get();
		$res = $cons->result_array();

		return $res;
	}

	public function getValues($data)
	{
		$this->db->select('*');
		$this->db->from('reservas');
		$this->db->where('fecha', $data[1]);
		$this->db->where('hora', $data[0]);
		$cons = $this->db->get();
		$res = $cons->result_array();

		return $res;
	}

	public function saveEvent($data, $tipo)
	{
		$datos=array('tipo'=>$tipo, 'hora'=>$data[1], 'fecha'=>$data[2], 'aula'=>$data[0], 'tip'=>$data[5]);
		$this->db->insert('eventos', $datos);
	}


	public function alertas($data)
	{
		$fecha[0] = 0;
		$fecha[1] = 0;
		switch((int)$data[1]){
			case 2: 
				if ($data[2]==0 && $data[3]==0) {
			 		$data[1]=2;
			 	}else{
					$fecha[2]=$this->getDate();
					$hora=$this->getTime();
					$h=explode(':',$hora);
					if ($h[0]%2 != 0){
					    $h[0]--;
					}
					$h1 = (int)$h[0];
					$h2 = (int)$h[0]+2;
					$fecha[1]=$h1.":00-".$h2.":00";
					$fecha[0]=$data[0];

			 		$existe=$this->loadValue($fecha);
			 		$state=$this->loadState($fecha);
			 		
			 		if(sizeof($existe)>0 && (int)$data[3]==1){
			 			$a=$existe[0];
			 			$b=$state[0];
			 			$data[4]=(int)$b['estado'];
			 			$data[1]=(int)$b['estado'];
			 			if ((int)$data[2]==(int)$a['cc'] && (int)$b['estado']==1) {
			 				$data[1]=2;
				 			$this->editarAlerta($fecha, 2);
							$fecha[2]=$this->getDate();
							$fecha[1]=$this->getTime();
							$fecha[4]=0;
							$fecha[5]=(int)$data[2];
							$this->saveEvent($fecha, 2);	
			 			}else{
			 				$data[1]=(int)$b['estado'];	
			 			}
			 			
					}else if(sizeof($existe)==0){
						$data[1]=3;
					}else{
						$b=$state[0];
						$data[1]=(int)$b['estado'];
					}
				}
		 		break;
		 	case 3:
			 	if ($data[2]==0 && $data[3]==0) {
			 		$data[1]=3;
			 	}else{
			 		$fecha[2]=$this->getDate();
					$hora=$this->getTime();
					$h=explode(':',$hora);
					if ($h[0]%2 != 0){
					    $h[0]--;
					}
					$h1 = (int)$h[0];
					$h2 = (int)$h[0]+2;
					$fecha[1]=$h1.":00-".$h2.":00";
					$fecha[0]=$data[0];

			 		$existe=$this->loadValue($fecha);
			 		$state=$this->loadState($fecha);
			 		
			 		if(sizeof($existe)>0 && (int)$data[3]==1){
			 			$a=$existe[0];
			 			$b=$state[0];
			 			$data[4]=(int)$b['estado'];
			 			$data[1]=(int)$b['estado'];
			 			if ((int)$data[2]==(int)$a['cc'] && (int)$b['estado']==2) {
			 				$data[1]=3;
				 			$this->editarAlerta($fecha, 3);
							$fecha[2]=$this->getDate();
							$fecha[1]=$this->getTime();
							$fecha[4]=0;
							$fecha[5]=(int)$data[2];
							$this->saveEvent($fecha, 3);	
			 			}else{
			 				$data[1]=(int)$b['estado'];
			 			}
			 			
					}else if(sizeof($existe)==0){
						$data[1]=3;
					}else{
						$b=$state[0];
						$data[1]=(int)$b['estado'];
					}
				}
		 		break;
		 	case 51: 
		 		$fecha[2]=$this->getDate();
				$fecha[1]=$this->getTime();
				$fecha[4]=0;
				$fecha[5]=(int)$data[2];
				$this->saveEvent($fecha, 51);
		 		break;
		 	case 52: 
		 		$fecha[2]=$this->getDate();
				$fecha[1]=$this->getTime();
				$fecha[4]=0;
				$fecha[5]=(int)$data[2];
				$this->saveEvent($fecha, 52);
		 		break;
		 	case 53: 
		 		$fecha[2]=$this->getDate();
				$fecha[1]=$this->getTime();
				$fecha[4]=0;
				$fecha[5]=(int)$data[2];
				$this->saveEvent($fecha, 53);
		 		break;
		 	case 54: 
		 		$fecha[2]=$this->getDate();
				$fecha[1]=$this->getTime();
				$fecha[4]=0;
				$fecha[5]=(int)$data[2];
				$this->saveEvent($fecha, 54);
		 		break;
		 	case 55: 
		 		$fecha[2]=$this->getDate();
				$fecha[1]=$this->getTime();
				$fecha[4]=0;
				$fecha[5]=(int)$data[2];
				$this->saveEvent($fecha, 55);
		 		break;
		 	case 56: 
		 		$fecha[2]=$this->getDate();
				$fecha[1]=$this->getTime();
				$fecha[4]=0;
				$fecha[5]=(int)$data[2];
				$this->saveEvent($fecha, 56);
		 		break;
		 	default:
		 		break;

		}
		return $data;
	}

	public function pruebaSel()
	{
		$sql="SELECT campo1 FROM pruebas WHERE id=?";
		$result=$this->db->query($sql, array(1));
		return $result->row()->campo1;
	}
	
	public function cargaRanking(){

		$this->db->select('*');
		$this->db->from('ranking');
		$cons = $this->db->get();
		$i=1;
		$res = $cons->result_array();

		return $res;
	}

	public function selectAllDB($table,$fields='*',$where)
	{
		$sql="SELECT $fields FROM $table WHERE $where";
		if($result=$this->mysqli->query($sql)){
			$data=array();
			if($result->num_rows>0){
				while($obj = $result->fetch_object()){
					$data[]=$obj;
				}
			}
			$result->close();
			return $data;
		}
		else{
			throw new Exception("Problemas con la consulta".$this->mysqli->error);
		}
	}

	public function pruebasDB($pos)
	{
		$datos=array('id'=>0, 'campo1'=>$pos, 'campo2'=>5, 'campo3'=>date('Y-m-d'));
		$this->db->insert('pruebas', $datos);

		$this->db->where('id', 1);
		$this->db->update('pruebas', array('campo1'=>$pos));
	}

	public function getWin1()
	{
		$sql="SELECT state_U1 FROM sesionbn WHERE id=37";
		$result=$this->db->query($sql, array(1));
		return $result->row()->state_U1;
	}

	public function getWin2()
	{
		$sql="SELECT state_U2 FROM sesionbn WHERE id=37";
		$result=$this->db->query($sql, array(1));
		return $result->row()->state_U2;
	}

	public function setWin1($val)
	{
		$this->db->where('id', 37);
		$this->db->update('sesionbn', array('state_U1'=>$val));
	}

	public function setWin2($val)
	{
		$this->db->where('id', 37);
		$this->db->update('sesionbn', array('state_U2'=>$val));
	}

	public function cleanAll()
	{
		for ($i=1; $i < 37 ; $i++) { 
			$this->db->where('id', $i);
			$this->db->update('sesionbn', array('state_U1'=>0));
		}
			
		for ($i=1; $i < 37 ; $i++) { 
			$this->db->where('id', $i);
			$this->db->update('sesionbn', array('state_U2'=>0));
		}
	}

	public function cleanU2()
	{	
		for ($i=1; $i < 38 ; $i++) { 
			$this->db->where('id', $i);
			$this->db->update('sesionbn', array('state_U2'=>0));
		}
	}

	public function cleanU1()
	{
		for ($i=1; $i < 38 ; $i++) { 
			$this->db->where('id', $i);
			$this->db->update('sesionbn', array('state_U1'=>0));
		}
	}

	public function load_U2()
	{
		for ($i=1; $i < 37; $i++) { 
			$sql="SELECT state_U2 FROM sesionbn WHERE id=$i";
			$result=$this->db->query($sql, array(1));
			$tabla[$i]=$result->row()->state_U2;
		}

		return $tabla;
	}



	public function load_U1()
	{
		for ($i=1; $i < 37; $i++) { 
			$sql="SELECT state_U1 FROM sesionbn WHERE id=$i";
			$result=$this->db->query($sql, array(1));
			$tabla[$i]=$result->row()->state_U1;
		}

		return $tabla;
	}

	public function update_U2($tabla)
	{
		for ($i=1; $i < 37; $i++) { 
			$this->db->where('id', $i);
			$this->db->update('sesionbn', array('state_U2'=>$tabla[$i]));
		}
	}

	public function update_U1($tabla)
	{
		for ($i=1; $i < 37; $i++) { 
			$this->db->where('id', $i);
			$this->db->update('sesionbn', array('state_U1'=>$tabla[$i]));
		}
	}

	public function setJuegos1()
	{ 
			$U = $this->session->user1;
			$sql="SELECT jegos FROM ranking WHERE user='$U'";
			$result=$this->db->query($sql, array(1));
			$otra = $result->row()->jegos;
			$otra++;
			$this->db->where('user', $U);
			$this->db->update('ranking', array('jegos'=>$otra));
	}

	public function setJuegos2()
	{ 
			$U = $this->session->user2;
			$sql="SELECT jegos FROM ranking WHERE user='$U'";
			$result=$this->db->query($sql, array(1));
			$otra = $result->row()->jegos;
			$otra++;
			$this->db->where('user', $U);
			$this->db->update('ranking', array('jegos'=>$otra));
	}

	public function setGanados($U)
	{ 
			$sql="SELECT ganados FROM ranking WHERE user=$U";
			$result=$this->db->query($sql, array(1));
			$otra = $result->row()->ganados;
			$otra++;
			$this->db->where('user', $U);
			$this->db->update('ranking', array('ganados'=>$otra++));
	}

	public function setPerdidos($U)
	{ 
			$sql="SELECT perdidos FROM ranking WHERE user=$U";
			$result=$this->db->query($sql, array(1));
			$otra = $result->row()->perdidos;
			$otra++;
			$this->db->where('user', $U);
			$this->db->update('ranking', array('perdidos'=>$otra++));
	}

	public function llenarTabla()
	{
		$a = 1;
		$e = 1;

		for ($i=0; $i < 180; $i++) { 
			$datos=array('aula'=>$a, 'equipo'=>$e++, 'estado'=>0);
			$this->db->insert('inventario', $datos);

			if ($e == 6) {
				$a++;
				$e = 1;
			}
		}
		
	}


	public function atacar($pos)
	{
		//implementar		
		return $pos;
	}




}