<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Admin_data_notifikasi_model extends CI_Model {

	var $table = 'tbl_notifikasi'; //nama tabel dari database
    var $column_order = array(null,'tentang_notif', 'tanggal','status'); //field yang ada di table user
    var $column_search = array('tentang_notif', 'tanggal','status','isi_notifikasi'); //field yang diizin untuk pencarian 
    var $order = array('id_notifikasi' => 'desc'); // default order 

 public function __construct()
    {
        parent::__construct();

    }

 private function _get_datatables_query($where)
    {
        $this->db->from($this->table);
        $this->db->where($where);
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($where)
    {
        $this->_get_datatables_query($where);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered($where)
    {
        $this->_get_datatables_query($where);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function getuser(){
    	$this->db->select('username,nama,user_id');
    	$this->db->from('tbl_user');
    	$this->db->like('username', $this->input->post('search'));
		$this->db->like('nama', $this->input->post('search'));
		return $this->db->get()->result();
    }
    public function inputnotifikasipemilihan($datapost)
    {
    $this->db->trans_start();
    date_default_timezone_set('Asia/Jakarta');

    $result = array();
        foreach($datapost AS $key => $val){
             $result[] = array(
              'user_id'   => $_POST['add-person-name'][$key],
              'tanggal'   => date('Y-m-d H:i:s'),
              'tentang_notif' => $this->input->post('judul-name'),
              'jenis_notifikasi' => $this->input->post('add-jenis-name'),
              'isi_notifikasi' => $this->input->post('kontens'),
              'status' => 'BELUM DIBACA'
             );
        }      
    $this->db->insert_batch('tbl_notifikasi', $result);
    $this->db->trans_complete();
    }

    public function alluser(){
    $this->db->select('user_id');
    $this->db->from('tbl_user');
    return $this->db->get()->result_array();
 	}

    public function inputnotifikasiall(){
    $this->db->trans_start();
    date_default_timezone_set('Asia/Jakarta');
    $data = $this->Admin_data_notifikasi_model->alluser();
    $result = array();
        foreach($data as $key){
             $result[] = array(
              'user_id'   => $key['user_id'],
              'tanggal'   => date('Y-m-d H:i:s'),
              'tentang_notif' => $this->input->post('judul-name'),
              'jenis_notifikasi' => $this->input->post('add-jenis-name'),
              'isi_notifikasi' => $this->input->post('kontens'),
              'status' => 'BELUM DIBACA'
             );
        }      
    $this->db->insert_batch('tbl_notifikasi', $result);
    $this->db->trans_complete();
}
public function notifikasi_jumlah(){
    $userid = $this->session->userdata('userid');
    $inall  = "SELECT *,(SELECT COUNT(*) FROM tbl_notifikasi where user_id= '$userid'and status = 'BELUM DIBACA' ) AS  total_seluruh_notifikasi, count(*) as total_notifikasi FROM tbl_notifikasi where user_id = '$userid' and status = 'BELUM DIBACA' GROUP BY jenis_notifikasi ORDER BY tanggal desc";
    return $this->db->query($inall)->result_array();
}

public function updatenotif(){
	$this->db->set(array('status' => 'DIBACA'));
    $this->db->where('id_notifikasi', $this->input->post('id'));
    return $this->db->update('tbl_notifikasi');
}

public function getnotifbyid(){
	$this->db->select('id_notifikasi,isi_notifikasi,status,tanggal,tentang_notif');
	$this->db->from('tbl_notifikasi');
	$this->db->where('id_notifikasi',$this->input->post('id'));
	return $this->db->get()->result_array();
}
}