<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends MY_CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function index()
	{
		$this->load->model('aulas_model','aumodel');
		$data['content']=$this->load->view('inicio.html','',TRUE);
		$this->load->view($this->layout,$data);
	}
	
	public function actualizarPisos($date)
	{
		$this->load->model('aulas_model','aumodel');

		$data=explode('_',$date);
		//$result['hora']=$data[0];
		//$result['fecha']=$data[1];
		//$result['todo']=$date;
		$result['valor']=$this->aumodel->getValues($data);

		//$result['holi']="holi";
		print json_encode($result);
	}
	
	public function actualizarPisosPorPusher($dato)
	{
		$this->load->model('aulas_model','aumodel');

		$datos=explode('_',$dato);
		$data=$this->aumodel->alertas($datos);



		$result['aula']=$data[0];
		$result['tipo']=$data[1];
		$result['tip']=$data[2];
		$result['vinculacion']=$data[3];
		//$result['dato']=$dato;
		$result['datos']=$datos;
		$result['data']=$data;

		print json_encode($result);
	}
}