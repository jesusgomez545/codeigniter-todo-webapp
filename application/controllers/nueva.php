<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nueva extends CI_Controller {

	public function index()
	{
		$this->load->view('nueva');
	}

	public function crear(){
		$this->load->helper('url');
		$this->load->model('tarea_model');
		if( isset($_POST['titulo']) && isset($_POST['observaciones']) )
		{
			$t = $_POST["titulo"];
			$o = $_POST["observaciones"];
			$this->tarea_model->insertar($t,$o);
			redirect('/', 'refresh');
		}else{
			return 403;
		}
	}
}

?>