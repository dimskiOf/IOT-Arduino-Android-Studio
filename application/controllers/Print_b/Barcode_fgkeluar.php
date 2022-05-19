<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Barcode_fgkeluar extends CI_Controller {

    function __construct(){
        parent::__construct();

         $this->load->model('Get_fg_keluar');
          
    }
 

    public function index()
    {
    $data['getter'] = $this->Get_fg_masuk->getalladdfg();
    if (!empty($data)){
          $this->load->view('Printbarcode/Print_barcode',$data);
      }else{
        $base = base_url();
        header($base);
      }
    }

}