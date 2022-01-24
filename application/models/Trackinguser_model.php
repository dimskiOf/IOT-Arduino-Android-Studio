<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Trackinguser_model extends CI_Model {

 public function __construct()
    {
        parent::__construct();
    }
public function tracknow($a,$b,$c,$d,$e,$f,$g,$h){
    $data['IP']   = $a;
    $data['USER_AGENT'] = $b;
    $data['NAMA_DEVICE']  = $c;
    $data['OS']   = $d;
    $data['TGL_AKSES']    = $e;
    $data['USER_ID']   = $f;
    $data['NGAPAINDIA'] = $g;
    $data['LOKASI'] = $h;
    return $this->db->insert('VISITOR_TRACKING', $data);
}

}
