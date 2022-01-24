<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ServerApi extends CI_Controller {

  public function __construct()
    {
        parent::__construct();
    }

    public function index(){
      $this->load->view('welcome_message');
    }

    // fungsi untuk CREATE
    public function addStaff()
    {
          $dbconnect = $this->load->database('testerdb', TRUE);
          // deklarasi variable
          $name = $this->input->post('name');
          $hp = $this->input->post('hp');
        $alamat = $this->input->post('alamat');
          // isikan variabel dengan nama file
          $data['staff_name'] = $name;
        $data['staff_hp'] = $hp;
          $data['staff_alamat'] = $alamat;
          $q = $dbconnect->insert('tb_staff', $data);
          // check insert berhasil apa nggak
          if ($q) {
            $response['pesan'] = 'insert berhasil';
            $response['status'] = 200;
          } else {
            $response['pesan'] = 'insert error';
            $response['status'] = 404;
          }
          echo json_encode($response);
    }
      // fungsi untuk READ
    public function getDataStaff()
    {

          $dbconnect = $this->load->database('testerdb', TRUE);
          $q = $dbconnect->get('tb_staff');
          if ($q -> num_rows() > 0) {
            $response['pesan'] = 'data ada';
            $response['status'] = 200;
            // 1 row
            $response['staff'] = $q->row();
            $response['staff'] = $q->result();
          } else {
            $response['pesan'] = 'data tidak ada';
            $response['status'] = 404;
          }
          echo json_encode($response);
    }
      // fungsi untuk DELETE
    public function deleteStaff()
    {
          $dbconnect = $this->load->database('testerdb', TRUE);
          $id = $this->input->post('id');
          $dbconnect->where('staff_id', $id);
          $status = $dbconnect->delete('tb_staff');
          if ($status == true) {
            $response['pesan'] = 'hapus berhasil';
            $response['status'] = 200;
          } else {
            $response['pesan'] = 'hapus error';
            $response['status'] = 404;
          }
          echo json_encode($response);
    }
      // fungsi untuk UPDATE
    public function updateStaff()
    {
          $dbconnect = $this->load->database('testerdb', TRUE);
          // deklarasi variable
          $id = $this->input->post('id');
          $name = $this->input->post('name');
          $hp = $this->input->post('hp');
          $alamat = $this->input->post('alamat');
          $dbconnect->where('staff_id', $id);
          // isikan variabel dengan nama file
          $data['staff_name'] = $name;
          $data['staff_hp'] = $hp;
          $data['staff_alamat'] = $alamat;
          $q = $dbconnect->update('tb_staff', $data);
          // check insert berhasil apa nggak
          if ($q) {
            $response['pesan'] = 'update berhasil';
            $response['status'] = 200;
          } else {
            $response['pesan'] = 'update error';
            $response['status'] = 404;
          }
          echo json_encode($response);
    }

    // fungsi untuk Login
    public function login()
    {
          $dbconnect = $this->load->database('testerdb', TRUE);
          // isikan variabel dengan nama file
          $check = $dbconnect->get_where('login', array('username' => $this->input->post('username') , 'password' => md5($this->input->post('password'))));
          // check insert berhasil apa nggak
          if ($check->num_rows() > 0) {
            $response['pesan'] = 'login berhasil';
            $response['status'] = 200;
            $response['logincred'] = $check->row();
            $response['logincred'] = $check->result();
          } else {
            $response['pesan'] = 'login gagal, username atau password salah';
            $response['status'] = 404;
          }
          echo json_encode($response);
    }
}