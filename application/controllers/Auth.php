<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {

 	 public function __construct()
        {
                parent::__construct();
                $this->load->model('Login_model');

        }
        public function index($autentik = null)
    {
    switch ($autentik) {
		case '' : redirect(base_url('member/login'),'refresh'); break;
	}

	$usem = $this->input->post('usem');
	$password = md5($this->input->post('password'));

	$cek = $this->Login_model->check($usem,$password);
	$cek1 = $this->Login_model->check2($usem);

	if (($cek && $cek1)==null){
		 $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Username atau email atau Password  salah..!</div>');
		redirect(base_url().'member/login');
	}else{
		$data_session = array(
			'privilages' => $cek[0]['privilage'],
			'id' => $cek[0]['username'],
			'token' => $cek[0]['access_token'],
			'userid'=> $cek1[0]['user_id'],
			'namas'=> $cek1[0]['nama'],
			'emailusr'=> $cek1[0]['email'],
			'tgls'=>$cek1[0]['tgl_daftar'],
			'foto_profil'=>$cek1[0]['foto_profil'],
			'logged_in'=> TRUE
			);
		$this->session->set_userdata($data_session);
 		echo '<script>alert("Login Berhasil!");</script>';
 		switch ($cek[0]['privilage']) {
				case 'SUPERADMIN' : redirect(base_url('beranda'),'refresh'); break;
				case 'ADMIN' : redirect(base_url('beranda'),'refresh'); break;
				case 'MEMBER' : redirect(base_url('beranda'),'refresh'); break;
				default; break;
			}
		}
	}
}