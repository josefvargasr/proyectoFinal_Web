<?php

class BatallaNaval_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
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
		for ($i=0; $i < 36; $i++) { 
			$datos=array('state_U1'=>0, 'state_U2'=>0);
			$this->db->insert('sesionbn', $datos);
		}
		
	}

	public function iniciarJuego()
	{
		//$this->session->tbluser=array_fill(1,36,0);
		//$tblmachine=array_fill(1,36,0);
		$this->cleanU1();

		$this->session->countU=0;

		//$this->seleccionarPosiciones($tblmachine);

		//$this->update_U2($tblmachine);
		//$this->session->tblmachine=$tblmachine;

		$this->session->numpos=0;

	}

	public function iniciarJuego2()
	{
		//$this->session->tbluser=array_fill(1,36,0);
		//$tblmachine=array_fill(1,36,0);
		$this->cleanU2();

		$this->session->countM=0;

		//$this->seleccionarPosiciones($tblmachine);

		//$this->update_U2($tblmachine);
		//$this->session->tblmachine=$tblmachine;

		$this->session->numpos2=0;

	}

	public function atacar($pos)
	{
		//implementar		
		return $pos;
	}

	public function cambiarPosicion($pos)
	{
		$this->session->cambioAnterior=$pos;
		//$tbluser=$this->session->tbluser;
		$tbluser=$this->load_U1();
		if($tbluser[$pos]==0){
			$rpta=0;
		}else{
			$rpta=1;
		}	
		return $rpta;		
	}

	public function cambiarPosicion2($pos)
	{
		$this->session->cambioAnterior=$pos;
		//$tbluser=$this->session->tbluser;
		$tbluser=$this->load_U2();
		if($tbluser[$pos]==0){
			$rpta=0;
		}else{
			$rpta=1;
		}	
		return $rpta;		
	}
	public function getValue($pos)
	{
		//$tbluser=$this->session->tbluser;
		$tbluser=$this->load_U1();
		return $tbluser[$pos];
	}

	public function getValue2($pos)
	{
		//$tbluser=$this->session->tbluser;
		$tbluser=$this->load_U2();
		return $tbluser[$pos];
	}
	public function guardarPosicion($pos)
	{

		$tbluser=$this->load_U1();
		//$tbluser=$this->session->tbluser;
		if($this->session->numpos<6){
			if($tbluser[$pos]==0){
				$tbluser[$pos]=1;	
				$this->session->numpos++;
				$this->update_U1($tbluser);
				//$this->session->tbluser=$tbluser;
			}else if($tbluser[$pos]==1){
				$tbluser[$pos]=0;	
				$this->session->numpos--;
				$this->update_U1($tbluser);
				//$this->session->tbluser=$tbluser;
			}	
		}else{
			if($tbluser[$pos]==1){
				$tbluser[$pos]=0;	
				$this->session->numpos--;
				$this->update_U1($tbluser);
				//$this->session->tbluser=$tbluser;
			}
		}
		$rpta=$this->session->numpos;

		return $rpta;		
	}

	public function guardarPosicion2($pos)
	{

		$tbluser=$this->load_U2();
		//$tbluser=$this->session->tbluser;
		if($this->session->numpos2<6){
			if($tbluser[$pos]==0){
				$tbluser[$pos]=1;	
				$this->session->numpos2++;
				$this->update_U2($tbluser);
				//$this->session->tbluser=$tbluser;
			}else if($tbluser[$pos]==1){
				$tbluser[$pos]=0;	
				$this->session->numpos2--;
				$this->update_U2($tbluser);
				//$this->session->tbluser=$tbluser;
			}	
		}else{
			if($tbluser[$pos]==1){
				$tbluser[$pos]=0;	
				$this->session->numpos2--;
				$this->update_U2($tbluser);
				//$this->session->tbluser=$tbluser;
			}
		}
		$rpta=$this->session->numpos2;

		return $rpta;		
	}

	private function seleccionarPosiciones(&$tabla)
	{
		$i=0;
		while($i<6){
			$pos=mt_rand(1,36);
			if($tabla[$pos]==0){
				$i++;
				$tabla[$pos]=1;
			}
		}

	}
}