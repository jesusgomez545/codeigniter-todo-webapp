<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	Usuario Model
	~~~~~~~~~~~~~
	Abstraccion del usuario del sistema
*/

	class Usuario_model extends CI_model
	{
		const DBTABLE = 'todo_usuario';

		public function __construct(){
		  $this->load->database(); 
		}

		public function all(){
			$q = $this->db->get(self::DBTABLE);
			return $q;
		}
	}
?>