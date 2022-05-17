 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Admin_kelola_hakakses_model extends CI_Model {

	var $table = 'tbl_user'; //nama tabel dari database
    var $column_order = array(null, 'username','nama','user_id','privilage'); //field yang ada di table user
    var $column_search = array('username','nama','privilage'); //field yang diizin untuk pencarian 
    var $order = array('user_id' => 'desc'); // default order 

 public function __construct()
    {
        parent::__construct();
      

    }

     private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
 
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
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

        public function get_data_menu($tabel, $order, $value)
    {

        $this->db->from($tabel);
        $this->db->order_by($order, $value);
        $query = $this->db->get();
        return $query->result_array();
    
    }

    public function get_akses_menu($privilege,$usrnme){
    $this->db->select('*');
    $this->db->from('user_akses_menu');
    $this->db->where('username',$usrnme);
    $this->db->where('privilage',$privilege);
    return $this->db->get()->result_array();
	}

public function cari_hak_akses($prv, $usrn, $tambah)
    {
        $this->db->from('user_akses_menu');
        $this->db->where('privilage', $prv);
        $this->db->where('username', $usrn);
        $this->db->where('id_menu', $tambah);
        $query = $this->db->get();
        return $query->row();
    }

    public function cari_hak_akses_sub_menu($prv, $usrn, $id_menu, $id_submenu)
    {
        $this->db->from('user_akses_submenu');
        $this->db->where('privilage', $prv);
        $this->db->where('username', $usrn);
        $this->db->where('id_menu', $id_menu);
        $this->db->where('id_submenu', $id_submenu);
        $query = $this->db->get();
        return $query->row();
    }

    public function cari_hak_akses_sub_submenu($prv, $usrn, $id_submenu, $id_sub_submenu)
    {
        $this->db->from('user_akses_sub_submenu');
        $this->db->where('privilage', $prv);
        $this->db->where('username', $usrn);
        $this->db->where('id_submenu', $id_submenu);
        $this->db->where('id_sub_submenu', $id_sub_submenu);
        $query = $this->db->get();
        return $query->row();
    }

 public function simpan_data($tabel, $data)
    {
        $query = $this->db->insert($tabel, $data);
        return $query;
    }

public function get_akses_submenu($privilege,$usrnme){
    $this->db->select('*');
    $this->db->from('user_akses_submenu');
    $this->db->where('username',$usrnme);
    $this->db->where('privilage',$privilege);
    return $this->db->get()->result_array();
}

public function get_akses_sub_submenu($privilege,$usrnme){
    $this->db->select('*');
    $this->db->from('user_akses_sub_submenu');
    $this->db->where('username',$usrnme);
    $this->db->where('privilage',$privilege);
    return $this->db->get()->result_array();
}

public function cari_role($privilege, $usrnme)
    {
        $this->db->from('tbl_user');
        $this->db->where('privilage', $privilege);
        $this->db->where('username', $usrnme);
        $query = $this->db->get();
        return $query->result_array();
    }

   public function hapus_hak_akses($prv, $id_menu, $usrn)
    {
        $this->db->delete('user_akses_menu', array(
            'privilage' => $prv,
            'id_menu' => $id_menu,
            'username' => $usrn,
        ));
    }
    public function sesuaikan_hak_akses_sub_submenu($prv, $usrn, $id_submenu)
    {
        $this->db->delete('user_akses_sub_submenu', array(
            'privilage' => $prv,
            'id_submenu' => $id_submenu,
            'username' => $usrn,
        ));
    }

    public function sesuaikan_hak_akses_submenu($prv, $id_menu, $usrn)
    {
        $this->db->delete('user_akses_submenu', array(
            'privilage' => $prv,
            'id_menu' => $id_menu,
            'username' => $usrn,
        ));
    }

    public function cari_sesuai_sub_menu($prv, $usrn, $id_menu)
    {
        $this->db->from('user_akses_submenu');
        $this->db->where('privilage', $prv);
        $this->db->where('username', $usrn);
        $this->db->where('id_menu', $id_menu);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function hapus_hak_akses_submenu($prv, $id_menu, $id_submenu, $usrn)
    {
        $this->db->delete('user_akses_submenu', array(
            'privilage' => $prv,
            'id_menu' => $id_menu,
            'id_submenu' => $id_submenu,
            'username' => $usrn,
        ));
    }

    public function hapus_hak_akses_sub_submenu($prv, $usrn, $id_submenu, $id_sub_submenu)
    {
        $this->db->delete('user_akses_sub_submenu', array(
            'privilage' => $prv,
            'id_submenu' => $id_submenu,
            'id_sub_submenu' => $id_sub_submenu,
            'username' => $usrn,
        ));
    }

}