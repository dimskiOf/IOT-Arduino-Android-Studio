<?php
 
class Get_rm_masuk extends CI_Model {
 
    var $table = 'WAREHOUSE_RM_MASUK a'; //nama tabel dari database
    var $column_order = array(null,'a.ID_RM_MASUK', 'b.KODE_BARANG_RM','b.NAMA_BARANG_RM','b.BERAT_ITEM','a.QTY_RM','a.TGL_CREATE_RM'); //field yang ada di table
    var $column_search = array('b.KODE_BARANG_RM','b.NAMA_BARANG_RM','a.TGL_CREATE_RM','a.QTY_RM'); //field yang diizin untuk pencarian 
    var $order = array('a.ID_RM_MASUK' => 'desc'); // default order 
    

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
        $this->db->select('a.*,b.*'); 
        $this->db->from($this->table);
        $this->db->join('WAREHOUSE_RM b', 'b.ID_BARANG_RM = a.ID_BARANG_RM','inner');
 
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
        $this->db->select('a.*,b.*'); 
        $this->db->from($this->table);
        $this->db->join('WAREHOUSE_RM b', 'b.ID_BARANG_RM = a.ID_BARANG_RM','inner');
        return $this->db->count_all_results();
    }
 
}