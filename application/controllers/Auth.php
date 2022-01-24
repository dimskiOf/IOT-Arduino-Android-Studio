<?php
include_once (dirname(__FILE__) . "../Visitor/Fungsivisitor.php");
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends Fungsivisitor {

 	 public function __construct()
        {
                parent::__construct();
                $this->load->model('Login_model');

        }
    public function index($autentik = null)
    {
    switch ($autentik) {
		case '' : redirect(base_url('user/login'),'refresh'); break;
	}

	$usem = $this->input->post('usem');
	$password = md5($this->input->post('password'));

	$cek = $this->Login_model->check($usem,$password);
	$cek1 = $this->Login_model->check2($usem);

	if (($cek && $cek1)==null){
		$this->insertidentitastracking('Melakukan Login dengan username '.$this->input->post('usem').' dan Password '.$this->input->post('password'));
		 $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Username atau email atau Password  salah..!</div>');
		redirect(base_url().'user/login');
	}else{
		$data_session = array(
			'privilages' => $cek1[0]['ID_JABATAN'],
			'id' => $cek[0]['USERNAME'],
			'userid'=> $cek1[0]['USER_ID'],
			'namas'=> $cek1[0]['NAMA'],
			'emailusr'=> $cek1[0]['EMAIL'],
			'tgls'=>$cek1[0]['TGL_DAFTAR'],
			'logged_in'=> TRUE
			);
		$this->session->set_userdata($data_session);
		
		 echo '<script>alert("Login Berhasil!");</script>';
		 $this->insertidentitastracking('Login berhasil dengan username '.$this->input->post('usem'));
 		switch ($cek1[0]['ID_JABATAN']) {
				case '1' : redirect(base_url('mpi'),'refresh'); break;
				case '3' : redirect(base_url('operatormpi/upload'),'refresh'); break;
				case '4' : redirect(base_url('gd99'),'refresh'); break;
				case '5' : redirect(base_url('operator99/upload'),'refresh'); break;
				default; break;
			}
		}
	}
}