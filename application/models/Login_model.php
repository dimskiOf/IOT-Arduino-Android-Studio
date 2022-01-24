<?php
 
class Login_model extends CI_Model {

 public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

public function check($usem,$password) {
 	$this->db->select('*');
 	$this->db->from('USER_LOGIN');
 	$this->db->group_start();
 	$this->db->where('USERNAME',$usem);
 	$this->db->or_where('EMAIL',$usem);
 	$this->db->group_end();
 	$this->db->where('PASSWD',$password);
 	return $this->db->get()->result_array();
 }
 public function check2($usem) {
 	$this->db->select('*');
 	$this->db->from('TBL_USER');
 	$this->db->where('USERNAME',$usem);
 	$this->db->or_where('EMAIL',$usem);
 	return $this->db->get()->result_array();
 }


}