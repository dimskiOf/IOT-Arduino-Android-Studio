<?php
 
class In_Timbangandanbarcode extends CI_Model {

 public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

 public function Getdata(){

 }

 public function Inputdata($data1,$data2,$data3){
 	$dummy = array(
        'ID_BARANG_RM' => $data1,
        'TGL_CREATE_RM' => date("Y-m-d H:i:s"),
        'QTY_RM' => $data2,
        'LOAD_NMBR' => $data1."/".""."/".date("ymd"),
        'INPUTMINUSPLUS' => $data3
	);
$gd99 = $this->load->database('gd99', TRUE);
  $set = $gd99->insert('WAREHOUSE_RM_KELUAR', $dummy);
  return $set;
 }

  public function Inputdata2($data1,$data2,$data3){
    $dummy = array(
        'ID_BARANG_RM' => $data1,
        'TGL_CREATE_RM' => date("Y-m-d H:i:s"),
        'QTY_RM' => $data2,
        'LOAD_NMBR' => $data1."/".""."/".date("ymd"),
        'INPUTMINUSPLUS' => $data3
    );
$gd99 = $this->load->database('gd99', TRUE);
  $set = $gd99->insert('WAREHOUSE_RM_MASUK', $dummy);
  return $set;
 }

   public function Inputdata3($data1,$data2,$data3){
    $dummy = array(
        'ID_BARANG_FG' => $data1,
        'TGL_CREATE_FG' => date("Y-m-d H:i:s"),
        'QTY_FG' => $data2,
        'LOAD_NMBR' => $data1."/".""."/".date("ymd"),
        'INPUTMINUSPLUS' => $data3
    );
$gd99 = $this->load->database('gd99', TRUE);
  $set = $gd99->insert('WAREHOUSE_FG_KELUAR', $dummy);
  return $set;
 }

   public function Inputdata4($data1,$data2,$data3){
    $dummy = array(
        'ID_BARANG_FG' => $data1,
        'TGL_CREATE_FG' => date("Y-m-d H:i:s"),
        'QTY_FG' => $data2,
        'LOAD_NMBR' => $data1."/".""."/".date("ymd"),
        'INPUTMINUSPLUS' => $data3
    );
$gd99 = $this->load->database('gd99', TRUE);
  $set = $gd99->insert('WAREHOUSE_FG_MASUK', $dummy);
  return $set;
 }

}