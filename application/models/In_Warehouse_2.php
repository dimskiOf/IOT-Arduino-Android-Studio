<?php
 
class In_Warehouse_2 extends CI_Model {

 public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

 public function Inputdata($param){

  $set = $this->db->insert('WAREHOUSE_RM', $param);
  return $set;
 }

 public function Inputdatarmkeluar($param){
    $set = $this->db->insert('WAREHOUSE_RM_KELUAR',$param);
    return $set;
 }

 public function Inputdatarmmasuk($param){
    $set = $this->db->insert('WAREHOUSE_RM_MASUK',$param);
    return $set;
 }

}