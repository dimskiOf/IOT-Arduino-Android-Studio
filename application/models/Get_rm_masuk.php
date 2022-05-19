<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Get_rm_masuk extends CI_Model {

    var $table = 'warehouse_rm_masuk a'; //nama tabel dari database
    var $column_order = array(null,'a.load_nmbr','a.id_identific','a.id_barang_rm','b.unit1','b.quantity', 'a.inputminusplus','b.quantity','a.tgl_create_rm','a.id_rm_masuk'); //field yang ada di table user
    var $column_search = array('a.load_nmbr','a.id_identific','a.id_barang_rm','a.inputminusplus','b.quantity','a.tgl_create_rm'); //field yang diizin untuk pencarian 
    var $order = array('a.id_rm_masuk' => 'desc'); // default order 

    var $table_barcode = 'add_rm a'; //nama tabel dari database
    var $column_order_barcode = array(null,'a.kode_barang_rm','b.itemdescription','a.jml',null,null,null); //field yang ada di table user
    var $column_search_barcode = array('a.kode_barang_rm','b.itemdescription','a.jml'); //field yang diizin untuk pencarian 
    var $order_barcode = array('a.id_add_rm' => 'desc'); // default order 

 public function __construct()
    {
        parent::__construct();
        $this->load->model('Qrcoder');
        $this->load->model('Barcoder');

    }

//********************************************* get rm masuk tabel *******************************//
 private function _get_datatables_query()
    {
        $this->db->select('a.*,b.*');
        $this->db->from($this->table);
        $this->db->join('item b', 'b.itemno = a.id_barang_rm','inner');

        $searchdate = $this->input->post('datefilter');
        
        if (!empty($searchdate)){
            $filter = explode("#start#", strtolower($searchdate));
            $from =str_replace(['"',"'"], "", $filter[0]);
            $end =str_replace(['"',"'"], "", $filter[1]);

            if((!empty($end) && !empty($from)) && ($from != $end)){
            
            $this->db->where('a.tgl_create_rm >=', $from);
            $this->db->where('a.tgl_create_rm <=', $end);
            
            }elseif((!empty($end) && !empty($from)) && ($from == $end)){
            
            $this->db->like('a.tgl_create_rm', $end);

            }else{
            $this->db->where('a.tgl_create_rm !=', 'null');
            }
          }

        
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
        $searchdate = $this->input->post('datefilter');

        $this->db->select('a.*,b.*'); 
        $this->db->from($this->table);
        $this->db->join('item b', 'b.itemno = a.id_barang_rm','inner');

          if (!empty($searchdate)){
            $filter = explode("#start#", strtolower($searchdate));
            $from =str_replace(['"',"'"], "", $filter[0]);
            $end =str_replace(['"',"'"], "", $filter[1]);

            if((!empty($end) && !empty($from)) && ($from != $end)){
            
            $this->db->where('a.tgl_create_rm >=', $from);
            $this->db->where('a.tgl_create_rm <=', $end);
            
            }elseif((!empty($end) && !empty($from)) && ($from == $end)){
            
            $this->db->like('a.tgl_create_rm', $end);

            }else{
            $this->db->where('a.tgl_create_rm !=', 'null');
            }
          }
        return $this->db->count_all_results();
    }
    //******************************************** end ***************************************\\
      //hapus rm masuk
        public function hapusrmmasuk()
       {
        $this->db->where('id_rm_masuk', $this->input->post('id'));
        return  $this->db->delete('warehouse_rm_masuk');
       }


       //********************************* BARCODER *************************************************\\

       private function _get_datatables_query_barcode()
            {
                $this->db->select('a.*,b.*');
                $this->db->from($this->table_barcode);
                $this->db->join('item b', 'a.kode_barang_rm = b.itemno','inner');
                $i = 0;
             
                foreach ($this->column_search_barcode as $item) // looping awal
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
         
                        if(count($this->column_search_barcode) - 1 == $i) 
                            $this->db->group_end(); 
                    }
                    $i++;
                }
                 
                if(isset($_POST['order'])) 
                {
                    $this->db->order_by($this->column_order_barcode[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
                } 
                else if(isset($this->order_barcode))
                {
                    $order_barcode = $this->order_barcode;
                    $this->db->order_by(key($order_barcode), $order_barcode[key($order_barcode)]);
                }
            }

            function get_datatables_barcode()
            {
                $this->_get_datatables_query_barcode();
                if($_POST['length'] != -1)
                $this->db->limit($_POST['length'], $_POST['start']);
                $query = $this->db->get();
                return $query->result();
            }
         
            function count_filtered_barcode()
            {
                $this->_get_datatables_query_barcode();
                $query = $this->db->get();
                return $query->num_rows();
            }
         
            public function count_all_barcode()
            {
                $this->db->select('a.*,b.*');
                $this->db->from($this->table_barcode);
                $this->db->join('item b', 'a.kode_barang_rm = b.itemno','inner');
                return $this->db->count_all_results();
            }


            //**************************************************** GET rm MPI**********************\\
       public function getbyalldataraw($query)
        {

            $data = $this->db->query($query)->result();
            return $data;
        }

       public function get_numbers(){
          $hasil =  $this->db->get("add_rm")->num_rows();
          return $hasil;
        }

        public function inputdata($data1,$data2,$data3,$data4){
         $dummy = array(
                'kode_barang_rm' => $data1,
                'url' => $data2,
                'file' => $data3,
                'jml' => $data4
            );
          
          $set = $this->db->insert('add_rm', $dummy);
          return $set;
        }

        public function hapusadditem()
       {
        $this->db->where('id_add_rm', $this->input->post('id'));
        return  $this->db->delete('add_rm');
       }


       function getalladdrm(){
        $this->db->select('rm.* , r.*');
        $this->db->from('item r');
        $this->db->join('add_rm rm', 'r.itemno = rm.kode_barang_rm','inner');
        $data = $this->db->get()->result_array();
        return $data;
        }
}
