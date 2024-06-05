<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function list()
	{
        $this->load->dbforge();

        print_r($this->db->list_fields('images'));

        $fields = array(
            'url' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'after' => 'type',
            ),
        );
        $this->dbforge->add_column('images', $fields);        

        print_r($this->db->list_fields('images'));

    }
}