<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Konfirmasi_bahan99 extends CI_Controller {

	function __construct(){
        parent::__construct();
        switch ($this->session->userdata('privilages')) {
            case '' : redirect(base_url('user/login'),'refresh'); break;
            case '1' : redirect(base_url('warehouserm'),'refresh'); break;
            case '3' : redirect(base_url('operator/upload'),'refresh'); break;
            case '4' : break;
            case '5' : break;
         }
         $this->load->model('Get_raw_gd99');
    }
 

	public function index()
	{
	  $this->load->view('UploadBarcode99/Header_barcode');
      $this->load->view('UploadBarcode99/Konten_barcode');
      $this->load->view('UploadBarcode99/Footer_barcode');
	}

//Get data rm by code item for select
    public function getrmbykodeitem()
    {
      $gd99 = $this->load->database('gd99', TRUE);  
      $list = $gd99->get_where('ITEM', array('ITEMNO' => $this->input->post('idbr')));
        if ($list->num_rows() > 0){

        $returndata = $this->Get_raw_gd99->getawrbykode($this->input->post('idbr'));
        foreach ($returndata as $lo) {
          $a = $lo['ITEMNO'];
          $c = "25 Kg";
          $d = $lo['ITEMDESCRIPTION'];
        }
        echo json_encode(array('nama' => $d, 'kode' => $a, 'berat' => $c ,'pesan' => 'sukses'));
      }else{
        echo json_encode(array('pesan' => "<div class='alert alert-danger'>DATA TIDAK TERSEDIA SILAHKAN SCAN KEMBALI</div>"));
      }
    }

}