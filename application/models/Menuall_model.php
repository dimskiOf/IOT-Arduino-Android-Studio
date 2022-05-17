<?php

class Menuall_model extends CI_Model {

public function __construct()
    {
        parent::__construct();
        $this->load->database();

    }
public function getDataDiri(){
    $this->db->select('*');
    $this->db->from('tbl_user');
    $this->db->where('user_id',$this->session->userdata('userid'));
    return $this->db->get()->result_array();
    }

}