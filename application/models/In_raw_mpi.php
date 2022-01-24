<?php

class In_raw_mpi extends CI_Model {

public function __construct()
    {
        parent::__construct();
        $this->load->database();

    }

public function inputdata($data1,$data2,$data3,$data4){
 $dummy = array(
        'KODE_BARANG_RM' => $data1,
        'URL' => $data2,
        'FILE' => $data3,
        'JML' => $data4
    );
  
  $set = $this->db->insert('ADD_RM', $dummy);
  return $set;
}

}