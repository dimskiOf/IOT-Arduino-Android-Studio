<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Print_barcodeqrcode4 extends CI_Controller {

    function __construct(){
        parent::__construct();
        switch ($this->session->userdata('privilages')) {
            case '' : redirect(base_url('user/login'),'refresh'); break;
            case '1' : break;
            case '3' : redirect(base_url('operatormpi/upload'),'refresh'); break;
            case '4' : redirect(base_url('gd99'),'refresh'); break;
            case '5' : redirect(base_url('operator99/upload'),'refresh'); break;
         }
         $this->load->model('Get_add_fg_mpi');
          
    }
 

    public function index()
    {
      $query = 'SELECT fg.ID_ADD_FG, fg.URL,fg."FILE", fg.JML , r.ITEMNO, r.ITEMDESCRIPTION, r.ITEMTYPE, r.SUBITEM, r.PARENTITEM,
    r.QUANTITY, r.ONORDER, r.ONSALES, r.TAXCODES, r.UNITPRICE, r.UNITPRICE2,
    r.UNITPRICE3, r.UNITPRICE4, r.UNITPRICE5, r.COST, r.SUSPENDED, r.MINIMUMQTY,
    r.UNIT1, r.UNIT2, r.UNIT3, r.RATIO2, r.RATIO3, r.DISCPC, r.PREFEREDVENDOR,
    r.RESERVED1, r.RESERVED2, r.RESERVED3, r.RESERVED4, r.RESERVED5,
    r.INVENTORYGLACCNT, r.COGSGLACCNT, r.PURCHASERETGLACCNT, r.SALESGLACCNT,
    r.SALESRETGLACCNT, r.NOTES, r.COSTMETHOD, r.LOCKED_BY, r.LOCKED_TIME,
    r.PTAXCODES, r.RESERVED6, r.RESERVED7, r.RESERVED8, r.RESERVED9,
    r.RESERVED10, r.SALESDISCOUNTACCNT, r.GOODSTRANSITACCNT, r.FIRSTPARENTITEM,
    r.INDENTLEVEL, r.WAREHOUSEID, r.PROJECTID, r.DEPTID, r.LOGO, r.FORMAT_LOGO,
    r.WEIGHT, r.DELIVERYLEADTIME, r.DIMHEIGHT, r.DIMWIDTH, r.DIMDEPTH,
    r.INVENTORYGROUP, r.FINISHEDMTRLGLACCNT, r.CATEGORYID, r.DEFSTANDARDCOST,
    r.TRANSACTIONID, r.IMPORTEDTRANSACTIONID, r.BRANCHCODEID, r.UNITCONTROL,
    r.UNBILLEDACCOUNT, r.QTYCONTROL, r.LFT, r.RGT, r.ISROOT, r.SERIALNUMBERTYPE,
    r.FORCESN, r.MANAGEEXPIRED, r.MANAGESN, r.HSCODE, r.IMPORTDUTY_RATE,
    r.IMPORTDUTY_TYPE, r.CUKAI_RATE, r.DELIVERNOSTOCKSN
    FROM ITEM r
    inner  join ADD_FG fg on fg.KODE_BARANG_FG = r.ITEMNO';
    $data['getter'] = $this->Get_add_fg_mpi->getalladdfg($query);
    if (!empty($data)){
          $this->load->view('Admin/Print_barcode_qrcode',$data);
      }else{
        $base = base_url();
        header($base);
      }
    }

}