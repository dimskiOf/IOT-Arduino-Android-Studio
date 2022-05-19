<?php
 
class In_Timbangandanbarcodempi extends CI_Model {

 public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

 public function Getdata(){

 }

 public function Inputdata($data1,$data2,$data3){
 	$dummy = array(
        'id_barang_rm' => $data1,
        'tgl_create_rm' => date("Y-m-d H:i:s"),
        'qty_rm' => $data2,
        'load_nmbr' => $data1."/".""."/".date("ymd"),
        'inputminusplus' => $data3
	);
  $set = $this->db->insert('warehouse_rm_keluar', $dummy);
  return $set;
 }

  public function Inputdata2($data1,$data2,$data3){
    $dummy = array(
        'id_barang_rm' => $data1,
        'tgl_create_rm' => date("Y-m-d H:i:s"),
        'qty_rm' => $data2,
        'load_nmbr' => $data1."/".""."/".date("ymd"),
        'inputminusplus' => $data3
    );
  $set = $this->db->insert('warehouse_rm_masuk', $dummy);
  return $set;
 }

   public function Inputdata3($data1,$data2,$data3){
    $dummy = array(
        'id_barang_fg' => $data1,
        'tgl_create_fg' => date("Y-m-d H:i:s"),
        'qty_fg' => $data2,
        'load_nmbr' => $data1."/".""."/".date("ymd"),
        'inputminusplus' => $data3
    );
  $set = $this->db->insert('warehouse_fg_keluar', $dummy);
  return $set;
 }

   public function Inputdata4($data1,$data2,$data3){
    $dummy = array(
        'id_barang_fg' => $data1,
        'tgl_create_fg' => date("Y-m-d H:i:s"),
        'qty_fg' => $data2,
        'load_nmbr' => $data1."/".""."/".date("ymd"),
        'inputminusplus' => $data3
    );
  $set = $this->db->insert('warehouse_fg_masuk', $dummy);
  return $set;
 }

}