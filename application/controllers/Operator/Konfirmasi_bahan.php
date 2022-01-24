<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Konfirmasi_bahan extends CI_Controller {

    function __construct(){
        parent::__construct();
        
        $this->load->model('Get_Warehouse_2');
        $this->load->model('In_Warehouse_2');
        $this->load->model('In_Timbangandanbarcode');
         switch ($this->session->userdata('privilages')) {
            case '' : redirect(base_url('user/login'),'refresh'); break;
            case '1' :  break;
            case '3' :  break;
            case '4' : redirect(base_url('gd99/upload'),'refresh'); break;
            case '5' : redirect(base_url('operator99/upload'),'refresh'); break;
         }
    }

    public function index()
    {
      $this->load->view('UploadBarcode/Header_barcode');
      $this->load->view('UploadBarcode/Konten_barcode');
      $this->load->view('UploadBarcode/Footer_barcode');
    }

     public function decodebarcodes(){
      $list = $this->db->get_where('WAREHOUSE_RM', array('KODE_BARANG_RM' => $this->input->post('idbr')));
        if ($list->num_rows() > 0){

        $returndata = $this->Get_Warehouse_2->getawrbykode($this->input->post('idbr'));
        foreach ($returndata as $lo) {
          $a = $lo['KODE_BARANG_RM'];
          $b = $lo['ID_BARANG_RM'];
          $c = $lo['BERAT_ITEM']."Kg";
          $d = $lo['NAMA_BARANG_RM'];
        }
        echo json_encode(array('nama' => $d, 'kode' => $a, 'berat' => $c, 'idr' => $b ,'pesan' => 'sukses'));
      }else{
        echo json_encode(array('pesan' => "<div class='alert alert-danger'>DATA TIDAK TERSEDIA SILAHKAN SCAN KEMBALI</div>"));
      }
    }

    public function databahankeluarkonfirm()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('itemid', 'itemid', 'trim|required|numeric|callback__checkiditem');
        $this->form_validation->set_rules('quantity', 'quantity', 'trim|required|numeric');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == true) {
          $setter = array('ID_BARANG_RM' => $this->input->post('itemid'),'QTY_RM' => $this->input->post('quantity'),'TGL_CREATE_RM' => date("Y-m-d H:i:s"));
          $getter = $this->In_Warehouse_2->Inputdatarmkeluar($setter);
          if ($getter){
            $data = array('parameter' => "<div class='alert alert-success'>Konfirmasi data sukses</div>",'pesan' => 'datasukses');
            $host = getHostByName(getHostName());
            $port = 1883;
            $clientID = md5(uniqid());
    
            $mqtt = new \Lightning\App($host, $port, $clientID);
    
            if (!$mqtt->connect()) {
                exit(1);
            }
    
            //$mqtt->publish("dimas", '{"hello":"world"}', 1);
            $mqtt->publish("dimas", 'data rm update', 1);
            echo json_encode($data);
          }

        }else {
            $datar = validation_errors();
            $data = array('parameter' => $datar,'pesan' => 'dataerror');
            echo json_encode($data);
        }
    }

        public function databahankeluarkonfirm2()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('itemid2', 'itemid2', 'trim|required|numeric|callback__checkiditem');
        $this->form_validation->set_rules('quantity2', 'quantity2', 'trim|required|numeric');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == true) {
          $setter = array('ID_BARANG_RM' => $this->input->post('itemid2'),'QTY_RM' => $this->input->post('quantity2'),'TGL_CREATE_RM' => date("Y-m-d H:i:s"));
          $getter = $this->In_Warehouse_2->Inputdatarmmasuk($setter);
          if ($getter){
            $data = array('parameter' => "<div class='alert alert-success'>Konfirmasi data sukses</div>",'pesan' => 'datasukses');
            $host = getHostByName(getHostName());
            $port = 1883;
            $clientID = md5(uniqid());
    
            $mqtt = new \Lightning\App($host, $port, $clientID);
    
            if (!$mqtt->connect()) {
                exit(1);
            }
    
            //$mqtt->publish("dimas", '{"hello":"world"}', 1);
            $mqtt->publish("dimas", 'data rm masuk', 1);
            echo json_encode($data);
          }

        }else {
            $datar = validation_errors();
            $data = array('parameter' => $datar,'pesan' => 'dataerror');
            echo json_encode($data);
        }
    }

   function _checkiditem($data){
        $array = array('ID_BARANG_RM' => $data);
        $query = $this->db->where($array)->get("WAREHOUSE_RM");

        if ($query->num_rows() > 0){
            return TRUE;
        }else{
            $this->form_validation->set_message('_checkiditem','Manipulasi Data');
            return FALSE;
        }
    }

}
