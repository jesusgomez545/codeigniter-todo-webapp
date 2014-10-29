<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
	
	001_initial.php
	~~~~~~~~~~~~~~~
	Migracion inicial del esquema de base de datos

*/
	class Migration_Initial extends CI_Migration {
	    public function up(){

	    	 $this->dbforge->add_field(array(
	    	    'id' => array(
	    	        'type' => 'INT',
	    	        'constraint' => 10, 
	    	        'unsigned' => TRUE,
	    	        'null' => FALSE,
	    	        'auto_increment' => TRUE
	    	    ),
	    	    'email' => array(
	    	        'type' => 'VARCHAR',
	    	        'constraint' => 255, 
	    	        'null' => FALSE,
	    	        'default' => ''
	    	    ),
	    	    'password' => array(
	    	        'type' => 'VARCHAR',
	    	        'constraint' => 255, 
	    	        'null' => FALSE,
	    	        'default' => ''
	    	    ),
	    	    'apellido' => array(
	    	        'type' => 'VARCHAR',
	    	        'constraint' => 100, 
	    	        'null' => TRUE,
	    	        'default' => ''
	    	    ),
	    	    'nombre' => array(
	    	        'type' => 'VARCHAR',
	    	        'constraint' => 100, 
	    	        'null' => TRUE,
	    	        'default' => ''
	    	    ),
	    	));
	        $this->dbforge->add_key('id', TRUE);
	        $this->dbforge->create_table('usuario', TRUE);
	        $this->db->query('ALTER TABLE todo_usuario ADD CONSTRAINT email_unico UNIQUE (email);');

	       	$this->dbforge->add_field(array(
	       		'id' => array(
	       		    'type' => 'INT',
	       		    'constraint' => 10, 
	       		    'unsigned' => TRUE,
	       		    'null' => FALSE,
	       		    'auto_increment' => TRUE
	       		),
	    	    'pendiente' => array(
	    	        'type' => 'BOOLEAN',
	    	        'default' => 'TRUE',
	    	        'null' => FALSE
	    	    ),
	    	    'titulo' => array(
	    	        'type' => 'VARCHAR',
	    	        'constraint' => 255, 
	    	        'null' => FALSE,
	    	        'default' => ''
	    	    ),
	    	    'observaciones' => array(
	    	        'type' => 'TEXT',
	    	        'null' => TRUE,
	    	        'default' => 'Ninguna'
	    	    ),
	    	    'fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
	    	));
	        $this->dbforge->add_key('id', TRUE);
	        $this->dbforge->create_table('tarea', TRUE);

	       	$this->dbforge->add_field(array(
	       		'id' => array(
	       		    'type' => 'INT',
	       		    'constraint' => 10, 
	       		    'unsigned' => TRUE,
	       		    'null' => FALSE,
	       		    'auto_increment' => TRUE
	       		),
	       		'usuario' => array(
	       		    'type' => 'INT',
	       		    'constraint' => 10, 
	       		    'unsigned' => TRUE,
	       		    'null' => FALSE,
	       		    'auto_increment' => TRUE
	       		),
	       		'tarea' => array(
	       		    'type' => 'INT',
	       		    'constraint' => 10, 
	       		    'unsigned' => TRUE,
	       		    'null' => FALSE,
	       		    'auto_increment' => TRUE
	       		),
	    	));
	        $this->dbforge->add_key('id', TRUE);
	        $this->dbforge->create_table('usuario_tarea', TRUE);
	        $this->db->query('ALTER TABLE todo_usuario_tarea ADD CONSTRAINT fk_usuario FOREIGN KEY (usuario) REFERENCES todo_usuario (id) MATCH FULL;');
	        $this->db->query('ALTER TABLE todo_usuario_tarea ADD CONSTRAINT fk_tarea FOREIGN KEY (tarea) REFERENCES todo_tarea (id) MATCH FULL;');
	    }
	 
	    public function down(){
	        $this->dbforge->drop_table('todo_usuario');
	        $this->dbforge->drop_table('todo_tarea');
	        $this->dbforge->drop_table('todo_usuario_tarea');

	    }
	}

?>