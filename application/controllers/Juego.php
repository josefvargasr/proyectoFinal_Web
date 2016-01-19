<?php

class Juego extends MY_CI_Controller 
{

	public function logout()
	{
		$this->data['title'] = "Logout";

		// log the user out
		$logout = $this->ion_auth->logout();

		// redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('auth/login', 'refresh');

		//$result['valor']=1;
		//print json_encode($result);
	}

	public function atacar($strpos)
	{
		$pos=explode('-',$strpos);
		$this->load->model('BatallaNaval_model','bnmodel');
		$pos1=$this->bnmodel->atacar($pos[1]);

		//$tblmachine=$this->session->tblmachine;
		$tblmachine=$this->bnmodel->load_U2();

		$win1 = $this->bnmodel->getWin1();

		if((int)$tblmachine[$pos1]==1){
			$win1++;
			$this->bnmodel->setWin1($win1);
		}

		$result['pos_vec']=$tblmachine[$pos1];
		$result['click']=$this->bnmodel->atacar($pos[1]);

		$result['winer'] = $win1;

		if($win1 == 6){
			$result['win'] = 1;
			$this->bnmodel->setGanados(1);
		}else{
			$result['win'] = 0;
		}

		$result['user'] = $this->session->user1;
		
		// $tbluser=$this->bnmodel->load_U1();
		// $posAttac=$pos;
		// $i=0;
		
		// if($tbluser[$posAttac]==1){
		// 	$result['stateM']=1;
		// 	$countM++;
		// }else{
		// 	$result['stateM']=2;
		// }

		// $result['posM']=$posAttac;
		
		// if($countM==6){
		// 	$result['winner']="Maquina";
		// }
		// if($countU==6){
		// 	$result['winner']="Usuario";
		// }
		
		// $tbluser[$posAttac]=2;
		// //$this->session->tbluser=$tbluser;
		// $this->bnmodel->update_U1($tbluser);
		// $this->session->countU=$countU;
		// $this->session->countM=$countM;

		
		print json_encode($result);
	
}

public function ataque($pos)
	{
		$this->load->model('BatallaNaval_model','bnmodel');
		
		$tbluser=$this->bnmodel->load_U1();
		$posAttac=(int)$pos;
		$i=0;

		if($tbluser[$posAttac]==1){
			$result['stateM']=1;
		}else{
			$result['stateM']=2;
		}

		$result['posM']=$posAttac;
		
		$win2 = $this->bnmodel->getWin2();

		if($win2 == 6){
			$result['win'] = 2;
			$this->bnmodel->setPerdidos(1);
		}else{
			$result['win'] = 0;
		}
		
		$tbluser[$posAttac]=2;

		$this->bnmodel->update_U1($tbluser);
		//$this->session->countU=$countU;
		//$this->session->countM=$countM;

		//$result['result']=(int)$pos;
		//print_r($result);
		print json_encode($result);
	}

}