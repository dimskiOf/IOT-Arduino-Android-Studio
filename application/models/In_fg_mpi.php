<?php

class In_fg_mpi extends CI_Model {

public function __construct()
    {
        parent::__construct();
        $this->load->database();

    }

public function inputdata($data1,$data2,$data3,$data4){
 $dummy = array(
        'KODE_BARANG_FG' => $data1,
        'URL' => $data2,
        'FILE' => $data3,
        'JML' => $data4
    );
  
  $set = $this->db->insert('ADD_FG', $dummy);
  return $set;
}

}