<?php

class In_fg_gd99 extends CI_Model {

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
  
  $gd99 = $this->load->database('gd99', TRUE);
  $set = $gd99->insert('ADD_FG', $dummy);
  return $set;
}

}