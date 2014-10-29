<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	Relacion Model
	~~~~~~~~~~~~~~~~~~
	Abstraccion de la relacion de usuario y tareas del sistema
*/

	class Relacion_model extends CI_model
	{
		const DBTABLE = 'todo_usuario_tarea';

		public function __construct(){
		  $this->load->database(); 
		}

		public function all(){
			$q = $this->db->get(self::DBTABLE);
			return $q;
		}

		public function eliminar_tarea($t){
			$this->db->delete(self::DBTABLE, array('tarea' => $t));
		}

		public function eliminar_usuario($u){
			$this->db->delete(self::DBTABLE, array('tarea' => $u));
		}
	}
?>