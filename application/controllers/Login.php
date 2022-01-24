<?php
include_once (dirname(__FILE__) . "../Visitor/Fungsivisitor.php");
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends Fungsivisitor {

   public function __construct()
        {
                parent::__construct();

        }
        public function index()
    {
      
    if (!empty($this->session->userdata('privilages'))){
    switch ($this->session->userdata('privilages')) {
        case '1' : redirect(base_url('warehouserm'),'refresh'); break;
        case '3' : redirect(base_url('operator/upload'),'refresh'); break;
        case '4' : redirect(base_url('gd99'),'refresh'); break;
        case '5' : redirect(base_url('operator99/upload'),'refresh'); break;        
        default; break;
         }
    }else{
        $this->load->view('Login/header.php');
        $this->load->view('Login/login.php');
        $this->load->view('Login/footer.php');
        $this->insertidentitastracking('Mengakses Login Page');
    }
        

    }
}