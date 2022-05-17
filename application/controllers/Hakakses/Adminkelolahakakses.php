<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Adminkelolahakakses extends CI_Controller {

     public function __construct()
            {
                parent::__construct();
                $this->load->model('Admin_kelola_hakakses_model');
                $this->load->model('Menuall_model');
                $this->load->model('Admin_data_notifikasi_model');
            }
               
        
  public function index(){
    $data['jmlnotif'] = $this->Admin_data_notifikasi_model->notifikasi_jumlah();
    $data['datadiri'] = $this->Menuall_model->getDataDiri();
    $data['menu'] = $this->Admin_kelola_hakakses_model->get_data_menu('menu_panel', 'id_menu', 'ASC');
    $this->load->view('Menu_All/header_hak_akses_menu');
    $this->load->view('Menu_All/modal_dasboard');
    $this->load->view('Menu_All/modal_hak_akses_menu',$data); 
    $this->load->view('Menu_All/navbar',$data);
    $this->load->view('Menu_All/sidebar',$data);  
    $this->load->view('Menu_All/konten_hak_akses_menu'); 
    $this->load->view('Menu_All/footer');
    $this->load->view('Menu_All/script_hak_akses_menu');
    $this->load->view('Menu_All/script');
    $this->load->view('Menu_All/end_of_tag');

    }

public function hak_akses_menu($privilege = null,$usernme = null)
    {  
        $data = $this->Admin_kelola_hakakses_model->get_akses_menu($privilege, $usernme);
        echo json_encode($data); 
    }

    public function hak_akses_submenu($privilege = null,$usernme = null)
    {  
        $data = $this->Admin_kelola_hakakses_model->get_akses_submenu($privilege, $usernme);
        echo json_encode($data);
    }

    public function hak_akses_sub_submenu($privilege = null,$usernme = null)
    {  
        $data = $this->Admin_kelola_hakakses_model->get_akses_sub_submenu($privilege, $usernme);
        echo json_encode($data);
    }

    public function cari_role($privilege = null,$usernme = null)
    {
       
        $data = $this->Admin_kelola_hakakses_model->cari_role($privilege, $usernme);
        echo json_encode($data);
    
    }

    public function tambah_hak_akses()
    {
     
        
        $usrn = $this->input->post('username');
        $tambah = $this->input->post('tambah');
        $prv = $this->input->post('privilage');
       

        $cari = $this->Admin_kelola_hakakses_model->cari_hak_akses($usrn,$prv,$tambah);
        if (!$cari) {
            $data = array(
                'id_menu'        => $tambah,
                'username'        => $usrn,
                'privilage'      => $prv,
                'status'        => '1',
            );
            $this->Admin_kelola_hakakses_model->simpan_data('user_akses_menu', $data);
            echo json_encode(array("status" => TRUE));
        }
      
    }

    public function tambah_hak_akses_sub_menu()
    {
       
        $prv = $this->input->post('privilage');
        $usrn = $this->input->post('username');
        $id_menu = $this->input->post('id_menu');
        $id_submenu = $this->input->post('id_submenu');

        $cari = $this->Admin_kelola_hakakses_model->cari_hak_akses_sub_menu($prv, $usrn, $id_menu, $id_submenu);
        if (!$cari) {
            $data = array(
                'username'       => $usrn,
                'id_menu'        => $id_menu,
                'id_submenu'     => $id_submenu,
                'privilage'      => $prv,
                'status'        => '1',
            );
            $this->Admin_kelola_hakakses_model->simpan_data('user_akses_submenu', $data);
            echo json_encode(array("status" => TRUE));
        }
       
    }

    public function tambah_hak_akses_sub_submenu()
    {
        
        $prv = $this->input->post('privilage');
        $usrn = $this->input->post('username');
        $id_submenu = $this->input->post('id_submenu');
        $id_sub_submenu = $this->input->post('id_sub_submenu');

        $cari = $this->Admin_kelola_hakakses_model->cari_hak_akses_sub_submenu($prv, $usrn, $id_submenu, $id_sub_submenu);
        if (!$cari) {
            $data = array(
                'privilage'        => $prv,
                'id_submenu'        => $id_submenu,
                'id_sub_submenu'     => $id_sub_submenu,
                'username'      => $usrn,
                'status'        => '1',
            );
            $this->Admin_kelola_hakakses_model->simpan_data('user_akses_sub_submenu', $data);
            echo json_encode(array("status" => TRUE));
        }
      
    }

    public function hapus_hak_akses()
    {
       
        $prv = $this->input->post('privilage');
        $usrn = $this->input->post('username');
        $hapus = $this->input->post('hapus');

        $cari = $this->Admin_kelola_hakakses_model->cari_hak_akses($prv, $usrn, $hapus);
        if ($cari) {

            $query = $this->Admin_kelola_hakakses_model->cari_sesuai_sub_menu($prv, $usrn, $hapus);
            foreach ($query as $row) {
                $id_submenu = $row['id_submenu'];
                $this->Admin_kelola_hakakses_model->sesuaikan_hak_akses_sub_submenu($prv, $usrn, $id_submenu);
            }
            $this->Admin_kelola_hakakses_model->sesuaikan_hak_akses_submenu($prv, $hapus, $usrn);
            $this->Admin_kelola_hakakses_model->hapus_hak_akses($prv, $hapus, $usrn);

            echo json_encode(array("status" => TRUE));
        }
        
    }

    public function hapus_hak_akses_sub_menu()
    {
       
        $prv = $this->input->post('privilage');
        $usrn = $this->input->post('username');
        $id_menu = $this->input->post('id_menu');
        $id_submenu = $this->input->post('id_submenu');

        $cari = $this->Admin_kelola_hakakses_model->cari_hak_akses_sub_menu($prv, $usrn, $id_menu, $id_submenu);
        if ($cari) {
            $this->Admin_kelola_hakakses_model->sesuaikan_hak_akses_sub_submenu($prv, $usrn, $id_submenu);
            $this->Admin_kelola_hakakses_model->hapus_hak_akses_submenu($prv, $id_menu, $id_submenu, $usrn);

            echo json_encode(array("status" => TRUE));
        }
        
    }

    public function hapus_hak_akses_sub_submenu()
    {
       
        $prv = $this->input->post('privilage');
        $usrn = $this->input->post('username');
        $id_submenu = $this->input->post('id_submenu');
        $id_sub_submenu = $this->input->post('id_sub_submenu');

        $cari = $this->Admin_kelola_hakakses_model->cari_hak_akses_sub_submenu($prv, $usrn, $id_submenu, $id_sub_submenu);
        if ($cari) {
            $this->Admin_kelola_hakakses_model->hapus_hak_akses_sub_submenu($prv, $usrn, $id_submenu, $id_sub_submenu);
            echo json_encode(array("status" => TRUE));
        }
       
    }
      public function kelola_hak_akses(){
     $list = $this->Admin_kelola_hakakses_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->username;
            $row[] = $field->privilage;
            $row[] = $field->user_id;
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Admin_kelola_hakakses_model->count_all(),
            "recordsFiltered" => $this->Admin_kelola_hakakses_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}