<?php

class Aulas extends MY_CI_Controller 
{

	public function piso($strpos)
	{
		$pos=explode('-',$strpos);
		$this->load->model('aulas_model','aumodel');
		$pos1=$this->aumodel->atacar($pos[1]);

		$result['aula']=$pos1;
		
		print json_encode($result);
	
	}

}