<?php
 
class In_Warehouse_1 extends CI_Model {

 public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

 public function Getdata(){

 }

 public function Inputdata($data1,$data2){
 	$dummy = array(
        'ID_BARANG_FG' => $data1,
        'TGL_CREATE' => date("Y-m-d H:i:s"),
        'QTY_FG' => $data2
	);

  $set = $this->db->insert('WAREHOUSE_FG_MASUK', $dummy);
  return $set;
 }

}