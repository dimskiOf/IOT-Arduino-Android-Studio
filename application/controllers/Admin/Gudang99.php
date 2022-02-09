<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang99 extends CI_Controller {

	function __construct(){
        parent::__construct();
        switch ($this->session->userdata('privilages')) {
            case '' : redirect(base_url('user/login'),'refresh'); break;
            case '1' : redirect(base_url('warehouserm'),'refresh'); break;
            case '3' : redirect(base_url('operator/upload'),'refresh'); break;
            case '4' : break;
            case '5' : redirect(base_url('operator99/upload'),'refresh'); break;
         }
          $this->load->model('Get_raw_gd99');
          $this->load->model('Get_add_rm_gd99');
          $this->load->model('In_raw_gd99');
          $this->load->model('Get_rm99_keluarmasuk');
    }
 

	public function index()
	{
      $this->load->view('Admin99/header_warehouserm');
      $this->load->view('Admin99/Modal_warehouserm');
      $this->load->view('Admin99/navbar');
      $this->load->view('Admin99/sidebar');
      $this->load->view('Admin99/konten_warehouserm');
      $this->load->view('Admin99/footer');
      $this->load->view('Admin99/src_script_wrfm');
      $this->load->view('Admin99/static_script');
      $this->load->view('Admin99/end_of_tag');
	}

    //INI RAW MATERIALNYA GUDANG 99
    public function getdatarm(){
         $datenow = date('m/d/Y');
         $query  = "
            a.ITEMNO, a.ITEMDESCRIPTION, a.ITEMTYPE, a.SUBITEM, a.SerialNumberType,a.ManageExpired, a.ForceSN, a.ManageSN, a.DELIVERNOSTOCKSN, 
            cast('' as varchar(30)) PARENTITEM, 
            cast(0 as numeric(18,4)) QUANTITY,  
            cast(0 as numeric(18,4)) OnOrder, 
            cast(0 as numeric(18,4)) OnSales , 
            cast('' as char(3)) TAXCODES, a.UNITPRICE, 
            cast(0 as numeric(18,4)) UNITPRICE2, 
            cast(0 as numeric(18,4)) UNITPRICE3, 
            cast(0 as numeric(18,4)) UNITPRICE4, 
            cast(0 as numeric(18,4)) UNITPRICE5, 
            cast(0 as numeric(18,4)) COST, a.SUSPENDED, 
            cast(0 as numeric(18,4)) MINIMUMQTY, a.UNIT1, 
            cast('' as char(3)) UNIT2,
            cast('' as char(3)) UNIT3, 
            cast(0 as numeric(18,4)) RATIO2, 
            cast(0 as numeric(18,4)) RATIO3, 
            cast('' as varchar(30)) DISCPC, 0 PREFEREDVENDOR, 
            cast('' as varchar(80)) RESERVED1, 
            cast('' as varchar(80)) RESERVED2, 
            cast('' as varchar(80)) RESERVED3, 
            cast('' as varchar(80)) RESERVED4,
            cast('' as varchar(80)) RESERVED5, 
            cast('' as varchar(30)) InventoryGLAccnt, 
            cast('' as varchar(30)) COGSGLACCNT, 
            cast('' as varchar(30)) PurchaseRetGLAccnt,
            cast('' as varchar(30)) SALESGLACCNT, 
            cast('' as varchar(30)) SALESRETGLACCNT, 
            cast('' as varchar(240)) NOTES, 
            cast('' as varchar(7)) CostMethod, 
            cast('' as char(3)) PTaxCodes, 
            cast('' as varchar(30)) SalesDiscountAccnt, 
            cast('' as varchar(30)) GoodsTransitAccnt, 
            cast('' as varchar(80)) RESERVED6,
            cast('' as varchar(80)) RESERVED7, 
            cast('' as varchar(80)) RESERVED8, 
            cast('' as varchar(80)) RESERVED9, 
            cast('' as varchar(80)) RESERVED10, a.FirstParentItem, a.IndentLevel, 
            cast(0 as numeric(18,4)) QtyControl, 
            cast('' as varchar(255)) ItemIndent, g.Quantity qty, g.ControlQty ControlQty, ic.ChildCount, 0 WarehouseID, 0 DeptID, 0 ProjectID, a.LOGO, 
            cast('' as varchar(30)) Format_Logo, 
            cast(0 as numeric(18,4)) Weight, 
            cast(0 as numeric(18,4)) DeliveryLeadTime,
            cast(0 as numeric(18,4)) DimWidth, 
            cast(0 as numeric(18,4)) DimHeight, 
            cast(0 as numeric(18,4)) DimDepth, a.INVENTORYGROUP, a.CATEGORYID, a.DefStandardCost, DW.Name DefWHName ,
            Current_Date AdjDate, -1 OBWarehouseID, null OBWarehouseName, -1 CountOB , a.TransactionID, a.ImportedTransactionID, a.BranchCodeID, 
            cast('' as varchar(10)) UnitControl, 
            cast('' as varchar(30)) UnbilledAccount, a.Rgt, a.Lft, II.ITEM_INDENT 
            from ITEM a   
            left outer join WareHs DW on DW.WarehouseID=a.WarehouseID  
            Left outer join IsChild(a.ItemNo, 1) ic on a.ItemNO = ic.ItemNo  
            Left outer join GetItemQuantity(a.ItemNo, '$datenow', Null) g on a.ItemNo = g.ItemNo_Qty  
            left outer join ITEM_INDENTED_VER3(a.Itemno) II on II.ITEMNO_INDENT = a.itemno";

            $cari = array('a.ITEMNO','a.ITEMDESCRIPTION','a.WEIGHT','g.QUANTITY');
            $arraywhere = array('a.INVENTORYGROUP' => 0);
            $where  = $arraywhere; 

            
            // jika memakai IS NULL pada where sql
            $isWhere = null;
    
           
            echo json_encode($this->Get_raw_gd99->get_tables_query($query,$cari,$where,$isWhere));
    }

    //get data add rm
    public function getadddatarm()
    {
       $datenow = date('m/d/Y');
         $query  = 'rm.ID_ADD_RM, rm.URL,rm."FILE", rm.JML, r.ITEMNO, r.ITEMDESCRIPTION, r.ITEMTYPE, r.SUBITEM, r.PARENTITEM,
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
                     r.IMPORTDUTY_TYPE, r.CUKAI_RATE, r.DELIVERNOSTOCKSN FROM ITEM r inner  join ADD_RM rm on rm.KODE_BARANG_RM = r.ITEMNO';

            $cari = array('r.ITEMNO','r.ITEMDESCRIPTION');
            $arraywhere = array();
            $where  = $arraywhere; 

            
            // jika memakai IS NULL pada where sql
            $isWhere = null;
    
           
            echo json_encode($this->Get_add_rm_gd99->get_tables_query($query,$cari,$where,$isWhere));
    }

    //untuk tambah add rm untuk select2
    public function select2getdata()
    {
            $datenow = date('m/d/Y');
         $query  = "
            a.ITEMNO, a.ITEMDESCRIPTION, a.ITEMTYPE, a.SUBITEM, a.SerialNumberType,a.ManageExpired, a.ForceSN, a.ManageSN, a.DELIVERNOSTOCKSN, 
            cast('' as varchar(30)) PARENTITEM, 
            cast(0 as numeric(18,4)) QUANTITY,  
            cast(0 as numeric(18,4)) OnOrder, 
            cast(0 as numeric(18,4)) OnSales , 
            cast('' as char(3)) TAXCODES, a.UNITPRICE, 
            cast(0 as numeric(18,4)) UNITPRICE2, 
            cast(0 as numeric(18,4)) UNITPRICE3, 
            cast(0 as numeric(18,4)) UNITPRICE4, 
            cast(0 as numeric(18,4)) UNITPRICE5, 
            cast(0 as numeric(18,4)) COST, a.SUSPENDED, 
            cast(0 as numeric(18,4)) MINIMUMQTY, a.UNIT1, 
            cast('' as char(3)) UNIT2,
            cast('' as char(3)) UNIT3, 
            cast(0 as numeric(18,4)) RATIO2, 
            cast(0 as numeric(18,4)) RATIO3, 
            cast('' as varchar(30)) DISCPC, 0 PREFEREDVENDOR, 
            cast('' as varchar(80)) RESERVED1, 
            cast('' as varchar(80)) RESERVED2, 
            cast('' as varchar(80)) RESERVED3, 
            cast('' as varchar(80)) RESERVED4,
            cast('' as varchar(80)) RESERVED5, 
            cast('' as varchar(30)) InventoryGLAccnt, 
            cast('' as varchar(30)) COGSGLACCNT, 
            cast('' as varchar(30)) PurchaseRetGLAccnt,
            cast('' as varchar(30)) SALESGLACCNT, 
            cast('' as varchar(30)) SALESRETGLACCNT, 
            cast('' as varchar(240)) NOTES, 
            cast('' as varchar(7)) CostMethod, 
            cast('' as char(3)) PTaxCodes, 
            cast('' as varchar(30)) SalesDiscountAccnt, 
            cast('' as varchar(30)) GoodsTransitAccnt, 
            cast('' as varchar(80)) RESERVED6,
            cast('' as varchar(80)) RESERVED7, 
            cast('' as varchar(80)) RESERVED8, 
            cast('' as varchar(80)) RESERVED9, 
            cast('' as varchar(80)) RESERVED10, a.FirstParentItem, a.IndentLevel, 
            cast(0 as numeric(18,4)) QtyControl, 
            cast('' as varchar(255)) ItemIndent, g.Quantity qty, g.ControlQty ControlQty, ic.ChildCount, 0 WarehouseID, 0 DeptID, 0 ProjectID, a.LOGO, 
            cast('' as varchar(30)) Format_Logo, 
            cast(0 as numeric(18,4)) Weight, 
            cast(0 as numeric(18,4)) DeliveryLeadTime,
            cast(0 as numeric(18,4)) DimWidth, 
            cast(0 as numeric(18,4)) DimHeight, 
            cast(0 as numeric(18,4)) DimDepth, a.INVENTORYGROUP, a.CATEGORYID, a.DefStandardCost, DW.Name DefWHName ,
            Current_Date AdjDate, -1 OBWarehouseID, null OBWarehouseName, -1 CountOB , a.TransactionID, a.ImportedTransactionID, a.BranchCodeID, 
            cast('' as varchar(10)) UnitControl, 
            cast('' as varchar(30)) UnbilledAccount, a.Rgt, a.Lft, II.ITEM_INDENT 
            from ITEM a   
            left outer join WareHs DW on DW.WarehouseID=a.WarehouseID  
            Left outer join IsChild(a.ItemNo, 1) ic on a.ItemNO = ic.ItemNo  
            Left outer join GetItemQuantity(a.ItemNo, '$datenow', Null) g on a.ItemNo = g.ItemNo_Qty  
            left outer join ITEM_INDENTED_VER3(a.Itemno) II on II.ITEMNO_INDENT = a.itemno 
            ";
            


            if(!isset($_POST['searchTerm'])){ 
              $fetchData = $this->Get_raw_gd99->getbyalldataraw('select first 10 '.$query);
            }else{ 
              $search = $_POST['searchTerm'];   
              $fetchData = $this->Get_raw_gd99->getbyalldataraw('select first 10 '.$query.'where a.ITEMNO like '."'%".$search."%'");
            } 

             $data = array();
              foreach ($fetchData as $field) {
                  $data[] = array("id"=>$field->ITEMNO, "text"=>$field->ITEMNO);
              }
            echo json_encode($data);
    }

    //untuk printing barcode
    public function insertdataforprinting()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('addjumlah', 'Jumlah', 'required|numeric');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == true) {

        $data = $this->input->post('addbarcoder',TRUE);
        
        if (!empty($data)){

        $nomor = $this->Get_raw_gd99->get_numbers(); 

        foreach($data AS $key => $val){

        $stat = $this->In_raw_gd99->inputdata($_POST['addbarcoder'][$key],'null',$nomor++,$this->input->post('addjumlah'));

        }   

        echo json_encode(array('pesan' => "<div class='alert alert-success'>Input Data Berhasil</div>"));

        }else{
        echo json_encode(array('pesan' => "<div class='alert alert-danger'>DATA TIDAK BOLEH KOSONG</div>"));
        
        }
      }else{
        $datar = validation_errors();
        $data = array('pesan' => $datar);
        echo json_encode($data);
      }
    }

    //hapus data pada add rm
    public function hapusadditem()
    {
      $data = $this->input->post('id');
      if (!empty($data))
      {
        $gd99 = $this->load->database('gd99', TRUE);
        $status = $gd99->get_where('ADD_RM', array('ID_ADD_RM' => $this->input->post('id')));
         if ($status->num_rows() > 0){ 
          $this->Get_add_rm_gd99->hapusadditem();
          echo json_encode(array('pesan' => "<div class='alert alert-success'>Hapus Data Berhasil</div>"));
         }else{
           echo json_encode(array('pesan' => "<div class='alert alert-danger'>DATA TIDAK ADA</div>"));
         }
      }else{
         echo json_encode(array('pesan' => "<div class='alert alert-danger'>DATA TIDAK BOLEH KOSONG</div>"));
      }
    }

    

    //data rm keluar
    public function getdatarmkeluar()
    {
      $query  = 'rm.ID_RM_KELUAR, rm.TGL_CREATE_RM,rm.QTY_RM, rm.LOAD_NMBR, rm.INPUTMINUSPLUS, r.ITEMNO, r.ITEMDESCRIPTION, r.ITEMTYPE, r.SUBITEM, r.PARENTITEM,
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
                     r.IMPORTDUTY_TYPE, r.CUKAI_RATE, r.DELIVERNOSTOCKSN FROM ITEM r inner  join WAREHOUSE_RM_KELUAR rm on rm.ID_BARANG_RM = r.ITEMNO';
      
      $searchdate = $this->input->post('datefilter');

      if (!empty($searchdate)){
        $filter = explode("#start#", strtolower($searchdate));
        $from =str_replace(['"',"'"], "", $filter[0]);
        $end =str_replace(['"',"'"], "", $filter[1]);

        if((!empty($end) && !empty($from)) && ($from != $end)){
        $addfilter = "between '".$from."' and '".$end."'";
        }elseif((!empty($end) && !empty($from)) && ($from == $end)){
        $addfilter = "like '%".$end."%'";
        }else{
        $addfilter = "!= 'null'";
        }
      }

      $cari = array('r.ITEMNO','r.ITEMDESCRIPTION','rm.QTY_RM','rm.TGL_CREATE_RM');
      $arraywhere = array('rm.TGL_CREATE_RM' => $addfilter);
      $where  = $arraywhere; 

      
      // jika memakai IS NULL pada where sql
      $isWhere = null;

     
      echo json_encode($this->Get_rm99_keluarmasuk->get_rm99_keluar($query,$cari,$where,$isWhere));
    }

    //data rm masuk
    public function getdatarmmasuk()
    {
      $query  = 'rm.ID_RM_MASUK, rm.TGL_CREATE_RM,rm.QTY_RM, rm.LOAD_NMBR, rm.INPUTMINUSPLUS, r.ITEMNO, r.ITEMDESCRIPTION, r.ITEMTYPE, r.SUBITEM, r.PARENTITEM,
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
                     r.IMPORTDUTY_TYPE, r.CUKAI_RATE, r.DELIVERNOSTOCKSN FROM ITEM r inner  join WAREHOUSE_RM_MASUK rm on rm.ID_BARANG_RM = r.ITEMNO';

      $searchdate = $this->input->post('datefilter');
      
      if (!empty($searchdate)){
        $filter = explode("#start#", strtolower($searchdate));
        $from =str_replace(['"',"'"], "", $filter[0]);
        $end =str_replace(['"',"'"], "", $filter[1]);

        if((!empty($end) && !empty($from)) && ($from != $end)){
        $addfilter = "between '".$from."' and '".$end."'";
        }elseif((!empty($end) && !empty($from)) && ($from == $end)){
        $addfilter = "like '%".$end."%'";
        }else{
        $addfilter = "!= 'null'";
        }
      }

      $cari = array('r.ITEMNO','r.ITEMDESCRIPTION','rm.QTY_RM','rm.TGL_CREATE_RM');
      $arraywhere = array('rm.TGL_CREATE_RM' => $addfilter);
      $where  = $arraywhere; 

      
      // jika memakai IS NULL pada where sql
      $isWhere = null;

     
      echo json_encode($this->Get_rm99_keluarmasuk->get_rm99_masuk($query,$cari,$where,$isWhere));
    }

    //hapus data rm keluar
    public function hapusdatarmkeluar(){
      $data = $this->input->post('id');
      if (!empty($data))
      {
        $gd99 = $this->load->database('gd99', TRUE);
        $status = $gd99->get_where('WAREHOUSE_RM_KELUAR', array('ID_RM_KELUAR' => $this->input->post('id')));
         if ($status->num_rows() > 0){ 
          $this->Get_rm99_keluarmasuk->hapusrmkeluar();
          echo json_encode(array('pesan' => "<div class='alert alert-success'>Hapus Data Berhasil</div>"));
         }else{
           echo json_encode(array('pesan' => "<div class='alert alert-danger'>DATA TIDAK ADA</div>"));
         }
      }else{
         echo json_encode(array('pesan' => "<div class='alert alert-danger'>DATA TIDAK BOLEH KOSONG</div>"));
      }
    }

  //hapus data rm masuk
    public function hapusdatarmmasuk(){
      $data = $this->input->post('id');
      if (!empty($data))
      {
        $gd99 = $this->load->database('gd99', TRUE);
        $status = $gd99->get_where('WAREHOUSE_RM_MASUK', array('ID_RM_MASUK' => $this->input->post('id')));
         if ($status->num_rows() > 0){ 
          $this->Get_rm99_keluarmasuk->hapusrmmasuk();
          echo json_encode(array('pesan' => "<div class='alert alert-success'>Hapus Data Berhasil</div>"));
         }else{
           echo json_encode(array('pesan' => "<div class='alert alert-danger'>DATA TIDAK ADA</div>"));
         }
      }else{
         echo json_encode(array('pesan' => "<div class='alert alert-danger'>DATA TIDAK BOLEH KOSONG</div>"));
      }
    }

}