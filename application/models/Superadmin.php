<?php
class Superadmin extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function clearall(){
       $gd99 = $this->load->database('gd99', TRUE);
       $tables = array('WAREHOUSE_FG_MASUK', 'WAREHOUSE_FG_KELUAR', 'WAREHOUSE_RM_MASUK','WAREHOUSE_RM_KELUAR');
       $gd99 ->delete($tables);
    }

}