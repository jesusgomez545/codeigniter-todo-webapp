<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	Tarea Model
	~~~~~~~~~~~~~
	Abstraccion de las tareas del sistema
*/

	class Tarea_model extends CI_model
	{
		const DBTABLE = 'todo_tarea';

		public function __construct(){
		  $this->load->database(); 
		}

		public function all(){
			$this->db->order_by("pendiente","desc");
			$this->db->order_by("fecha_creacion");
			$q = $this->db->get(self::DBTABLE);
			return $q;
		}

		public function eliminar($id){
			$this->load->model('relacion_model');
			$this->relacion_model->eliminar_tarea($id);
			return $this->db->delete(self::DBTABLE, array('id' => $id));
		}

		public function cambiar_estatus($id, $v){
			$d = array('pendiente' =>  $v);
			$this->db->update(self::DBTABLE, $d, array('id' => $id));
		}

		public function insertar($t, $o)
		{
			$d = array(
			   'titulo' => $t ,
			   'observaciones' => $o
			);

			$this->db->insert(self::DBTABLE, $d); 
		}
	}
?>