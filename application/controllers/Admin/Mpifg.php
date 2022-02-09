<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpifg extends CI_Controller {

    function __construct(){
        parent::__construct();
        switch ($this->session->userdata('privilages')) {
            case '' : redirect(base_url('user/login'),'refresh'); break;
            case '1' : break;
            case '3' : redirect(base_url('operatormpi/upload'),'refresh'); break;
            case '4' : redirect(base_url('gd99'),'refresh'); break;
            case '5' : redirect(base_url('operator99/upload'),'refresh'); break;
         }
          $this->load->model('Get_fg_mpi');
          $this->load->model('Get_add_fg_mpi');
          $this->load->model('In_fg_mpi');
          $this->load->model('Get_fgmpi_keluarmasuk');
    }
 

    public function index()
    {
      $this->load->view('Admin/header_warehousefg');
      $this->load->view('Admin/Modal_warehousefg');
      $this->load->view('Admin/navbar');
      $this->load->view('Admin/sidebar');
      $this->load->view('Admin/konten_warehousefg');
      $this->load->view('Admin/footer');
      $this->load->view('Admin/src_script_wrfg');
      $this->load->view('Admin/static_script');
      $this->load->view('Admin/end_of_tag');
    }

        //INI FG MATERIALNYA MPI
    public function getdatafg(){
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
            $arraywhere = array('a.INVENTORYGROUP' => 3);
            $where  = $arraywhere; 

            
            // jika memakai IS NULL pada where sql
            $isWhere = null;
    
           
            echo json_encode($this->Get_fg_mpi->get_tables_query($query,$cari,$where,$isWhere));
    }

        //get data add fg
    public function getadddata()
    {
       $datenow = date('m/d/Y');
         $query  = 'fg.ID_ADD_FG, fg.URL,fg."FILE", fg.JML, r.ITEMNO, r.ITEMDESCRIPTION, r.ITEMTYPE, r.SUBITEM, r.PARENTITEM,
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
                     r.IMPORTDUTY_TYPE, r.CUKAI_RATE, r.DELIVERNOSTOCKSN FROM ITEM r inner  join ADD_FG fg on fg.KODE_BARANG_FG = r.ITEMNO';

            $cari = array('r.ITEMNO','r.ITEMDESCRIPTION');
            $arraywhere = array();
            $where  = $arraywhere; 

            
            // jika memakai IS NULL pada where sql
            $isWhere = null;
    
           
            echo json_encode($this->Get_add_fg_mpi->get_tables_query($query,$cari,$where,$isWhere));
    }

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
              $fetchData = $this->Get_fg_mpi->getbyalldataraw('select first 10 '.$query);
            }else{ 
              $search = $_POST['searchTerm'];   
              $fetchData = $this->Get_fg_mpi->getbyalldataraw('select first 10 '.$query.'where a.ITEMNO like '."'%".$search."%'");
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

        $nomor = $this->Get_fg_mpi->get_numbers(); 

        foreach($data AS $key => $val){

        $stat = $this->In_fg_mpi->inputdata($_POST['addbarcoder'][$key],'null',$nomor++,$this->input->post('addjumlah'));

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


        //hapus data pada add fg
    public function hapusadditem()
    {
      $data = $this->input->post('id');
      if (!empty($data))
      {
        $status = $this->db->get_where('ADD_FG', array('ID_ADD_FG' => $this->input->post('id')));
         if ($status->num_rows() > 0){ 
          $this->Get_add_fg_mpi->hapusadditem();
          echo json_encode(array('pesan' => "<div class='alert alert-success'>Hapus Data Berhasil</div>"));
         }else{
           echo json_encode(array('pesan' => "<div class='alert alert-danger'>DATA TIDAK ADA</div>"));
         }
      }else{
         echo json_encode(array('pesan' => "<div class='alert alert-danger'>DATA TIDAK BOLEH KOSONG</div>"));
      }
    }

    //hapus data fg masuk
    public function hapusfgmasuk()
    {
      $data = $this->input->post('id');
      if (!empty($data))
      {
        $status = $this->db->get_where('ADD_FG', array('ID_ADD_FG' => $this->input->post('id')));
         if ($status->num_rows() > 0){ 
          $this->Get_add_fg_mpi->hapusadditem();
          echo json_encode(array('pesan' => "<div class='alert alert-success'>Hapus Data Berhasil</div>"));
         }else{
           echo json_encode(array('pesan' => "<div class='alert alert-danger'>DATA TIDAK ADA</div>"));
         }
      }else{
         echo json_encode(array('pesan' => "<div class='alert alert-danger'>DATA TIDAK BOLEH KOSONG</div>"));
      }
    }

    //data fg keluar
    public function getdatafgkeluar()
    {
      $query  = 'fg.ID_FG_KELUAR, fg.TGL_CREATE_FG,fg.QTY_FG, fg.LOAD_NMBR, fg.INPUTMINUSPLUS, r.ITEMNO, r.ITEMDESCRIPTION, r.ITEMTYPE, r.SUBITEM, r.PARENTITEM,
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
                     r.IMPORTDUTY_TYPE, r.CUKAI_RATE, r.DELIVERNOSTOCKSN FROM ITEM r inner  join WAREHOUSE_FG_KELUAR fg on fg.ID_BARANG_FG = r.ITEMNO';
      
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

      $cari = array('r.ITEMNO','r.ITEMDESCRIPTION','fg.QTY_FG','fg.TGL_CREATE_FG');
      $arraywhere = array('fg.TGL_CREATE_FG' => $addfilter);
      $where  = $arraywhere; 

      
      // jika memakai IS NULL pada where sql
      $isWhere = null;

     
      echo json_encode($this->Get_fgmpi_keluarmasuk->get_fgmpi_keluar($query,$cari,$where,$isWhere));
    }

    //data fg masuk
    public function getdatafgmasuk()
    {
      $query  = 'fg.ID_FG_MASUK, fg.TGL_CREATE_FG,fg.QTY_FG, fg.LOAD_NMBR, fg.INPUTMINUSPLUS, r.ITEMNO, r.ITEMDESCRIPTION, r.ITEMTYPE, r.SUBITEM, r.PARENTITEM,
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
                     r.IMPORTDUTY_TYPE, r.CUKAI_RATE, r.DELIVERNOSTOCKSN FROM ITEM r inner  join WAREHOUSE_FG_MASUK fg on fg.ID_BARANG_FG = r.ITEMNO';
      
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

      $cari = array('r.ITEMNO','r.ITEMDESCRIPTION','fg.QTY_FG','fg.TGL_CREATE_FG');
      $arraywhere = array('fg.TGL_CREATE_FG' => $addfilter);
      $where  = $arraywhere; 

      
      // jika memakai IS NULL pada where sql
      $isWhere = null;

     
      echo json_encode($this->Get_fgmpi_keluarmasuk->get_fgmpi_masuk($query,$cari,$where,$isWhere));
    }

    //hapus data fg keluar
    public function hapusdatafgkeluar(){
      $data = $this->input->post('id');
      if (!empty($data))
      {
        $status = $this->db->get_where('WAREHOUSE_FG_KELUAR', array('ID_FG_KELUAR' => $this->input->post('id')));
         if ($status->num_rows() > 0){ 
          $this->Get_fgmpi_keluarmasuk->hapusfgkeluar();
          echo json_encode(array('pesan' => "<div class='alert alert-success'>Hapus Data Berhasil</div>"));
         }else{
           echo json_encode(array('pesan' => "<div class='alert alert-danger'>DATA TIDAK ADA</div>"));
         }
      }else{
         echo json_encode(array('pesan' => "<div class='alert alert-danger'>DATA TIDAK BOLEH KOSONG</div>"));
      }
    }

  //hapus data fg masuk
    public function hapusdatafgmasuk(){
      $data = $this->input->post('id');
      if (!empty($data))
      {
        $status = $this->db->get_where('WAREHOUSE_FG_MASUK', array('ID_FG_MASUK' => $this->input->post('id')));
         if ($status->num_rows() > 0){ 
          $this->Get_fgmpi_keluarmasuk->hapusfgmasuk();
          echo json_encode(array('pesan' => "<div class='alert alert-success'>Hapus Data Berhasil</div>"));
         }else{
           echo json_encode(array('pesan' => "<div class='alert alert-danger'>DATA TIDAK ADA</div>"));
         }
      }else{
         echo json_encode(array('pesan' => "<div class='alert alert-danger'>DATA TIDAK BOLEH KOSONG</div>"));
      }
    }

}