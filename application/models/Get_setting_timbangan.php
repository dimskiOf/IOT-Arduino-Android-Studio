<?php
class Get_setting_timbangan extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get1(){
        $gd99 = $this->load->database('gd99', TRUE);
        $gd99->select('r.ID_SET, r.MINUSPLUS');
        $gd99->from('MINUSPLUS_SETTING r');
        $gd99->where('r.ID_SET',0);
        return $gd99->get()->result();
    }

}