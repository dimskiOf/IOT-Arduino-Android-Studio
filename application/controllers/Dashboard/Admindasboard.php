<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Admindasboard extends CI_Controller {

 	 public function __construct()
        {
        parent::__construct();
        $this->load->model('Dashboard_model');
        $this->load->model('Menuall_model'); 
        $this->load->model('Admin_data_notifikasi_model'); 
        }
    
               
        
    public function index()
    {

    $data['jmlnotif'] = $this->Admin_data_notifikasi_model->notifikasi_jumlah();
    $data['datadiri'] = $this->Menuall_model->getDataDiri();
    $this->load->view('Menu_All/header_dasboard');
    $this->load->view('Menu_All/modal_dasboard'); 
    $this->load->view('Menu_All/navbar',$data);
    $this->load->view('Menu_All/sidebar',$data);  
    $this->load->view('Menu_All/konten_dasboard'); 
    $this->load->view('Menu_All/footer');
    $this->load->view('Menu_All/script_dasboard',$data);
    $this->load->view('Menu_All/script');
    $this->load->view('Menu_All/end_of_tag');  
    }

}