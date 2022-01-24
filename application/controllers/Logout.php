<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Logout extends CI_Controller {

 	 public function __construct()
        {
                parent::__construct();
                $this->load->library('session');

        }
        public function index()
    {
    if ($this->session->userdata('id')){
      session_destroy();
      echo '<script>alert("Terimakasih!");</script>';
	  redirect(base_url('user/login'), 'refresh');
	}else{
	  redirect(base_url('user/login'), 'refresh');
	}
    }
}