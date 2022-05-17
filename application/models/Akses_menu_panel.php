<?php

class Akses_menu_panel extends CI_Model {

public function __construct()
    {
        parent::__construct();
        $this->load->database();

    }
public function getmenuakses($id){
$this->db->select('*');
$this->db->from('aksesmenu');
return $this->db->get()->result_array();
}

}