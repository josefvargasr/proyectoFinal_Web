<?php

class Grafico extends MY_CI_Controller 
{

	public function usoAulas($aula,$year)
	{
		$this->load->model('Informes_model','inmodel');
		$result['usoAulas'] = $this->inmodel->uso_aulas((int)$aula,(int)$year);
		$data['content']=$this->load->view('grafico1.html',$result,TRUE);
		$this->load->view('layouts/graficos.html',$data);
	}

	public function porcOcup($year)
	{
		$this->load->model('Informes_model','inmodel');
		$result['porcOcup'] = $this->inmodel->porcOcup((int)$year);
		//$data['content']=$this->load->view('grafico2.html',$result,TRUE);
		//$this->load->view('layouts/graficos.html',$data);

		print_r($result['porcOcup']);
	}

	public function evenAulas($aula,$year)
	{
		$this->load->model('Informes_model','inmodel');
		$result['evenAulas'] = $this->inmodel->infEventos((int)$aula,(int)$year);
		$data['content']=$this->load->view('grafico3.html',$result,TRUE);
		$this->load->view('layouts/graficos.html',$data);
	}

	public function evenUser($tip,$year)
	{
		$this->load->model('Informes_model','inmodel');
		$result['evenUser'] = $this->inmodel->infUser((int)$tip,(int)$year);
		$data['content']=$this->load->view('grafico4.html',$result,TRUE);
		$this->load->view('layouts/graficos.html',$data);
	}

	public function Inventario()
	{
		$this->load->model('Informes_model','inmodel');
		$result['invent'] = $this->inmodel->invent();
		$data['content']=$this->load->view('inventario.html',$result,TRUE);
		$this->load->view('layouts/graficos.html',$data);

		//print_r($result['invent']);
	}

	public function InsertInv($aula,$equip,$state,$act)
	{
		$this->load->model('Informes_model','inmodel');
		$result['invent'] = $this->inmodel->insInv((int)$aula,(int)$equip,(int)$state,(int)$act);
		$data['content']=$this->load->view('inventario.html',$result,TRUE);
		$this->load->view('layouts/graficos.html',$data);
	}

}

?>