<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Fgkeluar_c extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Get_fg_keluar');
        $this->load->model('Menuall_model'); 
        $this->load->model('Admin_data_notifikasi_model');
        $this->load->model('Qrcoder');
        $this->load->model('Barcoder'); 
    }
 

    public function index()
    {
        $data['jmlnotif'] = $this->Admin_data_notifikasi_model->notifikasi_jumlah();
        $data['datadiri'] = $this->Menuall_model->getDataDiri();
        $this->load->view('Fgkeluar/header');
        $this->load->view('Fgkeluar/modal');
        $this->load->view('Menu_All/modal_dasboard'); 
        $this->load->view('Menu_All/navbar',$data);
        $this->load->view('Menu_All/sidebar',$data);  
        $this->load->view('Fgkeluar/konten'); 
        $this->load->view('Menu_All/footer');
        $this->load->view('Fgkeluar/script',$data);
        $this->load->view('Menu_All/script');
        $this->load->view('Menu_All/end_of_tag');  
    }

    //load data fg keluar
     public function getdatafgkeluar()
    {   

        $list = $this->Get_fg_keluar->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row[] = $no;
            $row[] = $field->load_nmbr;
            $row[] = $field->id_identific;
            $row[] = $field->itemno;
            $row[] = $field->unit1;
            $row[] = (float)$field->qty_fg - (float)$field->inputminusplus;
            $row[] = $field->inputminusplus;
            $row[] = $field->qty_fg;
            $row[] = $field->tgl_create_fg;
            $row[] = $field->id_fg_keluar;
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Get_fg_keluar->count_all(),
            "recordsFiltered" => $this->Get_fg_keluar->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);

    }

      //hapus data fg keluar
        public function hapusdatafgkeluar(){
          $data = $this->input->post('id');
          if (!empty($data))
          {
            $status = $this->db->get_where('warehouse_fg_keluar', array('id_fg_keluar' => $this->input->post('id')));
             if ($status->num_rows() > 0){ 
              $this->Get_fg_keluar->hapusfgkeluar();
              echo json_encode(array('pesan' => "<div class='alert alert-success'>Hapus Data Berhasil</div>"));
             }else{
               echo json_encode(array('pesan' => "<div class='alert alert-danger'>DATA TIDAK ADA</div>"));
             }
          }else{
             echo json_encode(array('pesan' => "<div class='alert alert-danger'>DATA TIDAK BOLEH KOSONG</div>"));
          }
        }

     ///tabel barcode
     public function getadddata()
        {
        $list = $this->Get_fg_keluar->get_datatables_barcode();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
          $row[] = $no;
          $row[] = $field->itemno;
          $row[] = $field->itemdescription;
          $row[] = $field->jml;
          $row[] = '<img src="data:image/png;base64,' . $this->Barcoder->barcode("",$field->itemno,55,"horizontal","code128","false",1) . '">';
          $row[] = '<img src="data:image/png;base64,' . $this->Qrcoder->encodethis($field->itemno) . '">';
          $row[] = $field->id_add_fg;
          $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Get_fg_keluar->count_all_barcode(),
            "recordsFiltered" => $this->Get_fg_keluar->count_filtered_barcode(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
        }

        public function select2getdata(){
           if(!isset($_POST['searchTerm'])){ 
              $fetchData = $this->Get_fg_keluar->getbyalldataraw('select * from item limit 10');
            }else{ 
              $search = $_POST['searchTerm'];   
              $fetchData = $this->Get_fg_keluar->getbyalldataraw('select * from item where itemno like '."'%".$search."%'");
            } 

             $data = array();
              foreach ($fetchData as $field) {
                  $data[] = array("id"=>$field->itemno, "text"=>$field->itemno);
              }
            echo json_encode($data);
        }


        //untuk printing barcode
        public function insertdataforprinting()
        {

            $this->load->library('form_validation');
            $this->form_validation->set_rules('addjumlah', 'Jumlah', 'required|numeric');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            if ($this->form_validation->run() == true) {

            $data = $this->input->post('addbarcoder',TRUE);
            
            if (!empty($data)){

            $nomor = $this->Get_fg_keluar->get_numbers(); 

            foreach($data AS $key => $val){

            $stat = $this->Get_fg_keluar->inputdata($_POST['addbarcoder'][$key],'null',$nomor++,$this->input->post('addjumlah'));

            }   

            echo json_encode(array('pesan' => "<div class='alert alert-success'>Input Data Berhasil</div>"));

            }else{
            echo json_encode(array('pesan' => "<div class='alert alert-danger'>DATA TIDAK BOLEH KOSONG</div>"));
            
            }
          }else{
            $datar = validation_errors();
            $data = array('pesan' => $datar);
            echo json_encode($data);
          }
        }

         //hapus data pada add fg
        public function hapusadditem()
        {
          $data = $this->input->post('id');
          if (!empty($data))
          {
            $status = $this->db->get_where('add_fg', array('id_add_fg' => $this->input->post('id')));
             if ($status->num_rows() > 0){ 
              $this->Get_fg_keluar->hapusadditem();
              echo json_encode(array('pesan' => "<div class='alert alert-success'>Hapus Data Berhasil</div>"));
             }else{
               echo json_encode(array('pesan' => "<div class='alert alert-danger'>DATA TIDAK ADA</div>"));
             }
          }else{
             echo json_encode(array('pesan' => "<div class='alert alert-danger'>DATA TIDAK BOLEH KOSONG</div>"));
          }
        }
    
}