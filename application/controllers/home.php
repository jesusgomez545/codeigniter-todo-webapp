<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->model('tarea_model');
		$data['rows'] = $this->tarea_model->all();  
		$this->load->view('home', $data);
	}

	public function eliminar()
	{
		$this->load->model('tarea_model');
		if( isset($_POST['id']) )
		{
			$id = (int)$_POST["id"];
			$this->tarea_model->eliminar($id);
			return 200;
		}else{
			return 403;
		}
	}

	public function cambiar_estatus()
	{
		$this->load->model('tarea_model');
		if( isset($_POST['id']) && isset($_POST['pendiente']) )
		{
			$id = (int)$_POST["id"];
			$v = $_POST["pendiente"];
			$this->tarea_model->cambiar_estatus($id,$v);
			return 200;
		}else{
			return 403;
		}
	}
}	
 ?>