 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Login_model extends CI_Model {

 public function __construct()
    {
        parent::__construct();
      

    }

 public function check($usem,$password) {
 	$this->db->select('*');
 	$this->db->from('tbl_login');
 	$this->db->group_start();
 	$this->db->where('username',$usem);
 	$this->db->or_where('email',$usem);
 	$this->db->group_end();
 	$this->db->where('password',$password);
 	return $this->db->get()->result_array();
 }
 public function check2($usem) {
 	$this->db->select('*');
 	$this->db->from('tbl_user');
 	$this->db->where('username',$usem);
 	$this->db->or_where('email',$usem);
 	return $this->db->get()->result_array();
 }
}