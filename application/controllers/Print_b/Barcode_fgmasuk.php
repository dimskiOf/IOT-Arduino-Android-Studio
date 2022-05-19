<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Barcode_fgmasuk extends CI_Controller {

    function __construct(){
        parent::__construct();

         $this->load->model('Get_fg_masuk');
          
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