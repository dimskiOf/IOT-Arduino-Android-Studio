<?php
 
class Get_Warehouse_2 extends CI_Model {
 
    var $table = 'ITEM r'; //nama tabel dari database
    var $column_order = array(null,'a.ITEMNO','a.ITEMDESCRIPTION','a.WEIGHT','a.QUANTITY'); //field yang ada di table
    var $column_search = array('a.ITEMNO','a.ITEMDESCRIPTION','a.WEIGHT','a.QUANTITY'); //field yang diizin untuk pencarian 
    var $order = array('r.ITEMNO' => 'desc'); // default order 
    public $syntax;
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query($length,$start)
    {
        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                   // $this->db->group_start(); 
                   // $this->db->like($item, $_POST['search']['value']);
                    $setter = $_POST['search']['value'];
                    $this->syntax = "select first $length skip $start a.ITEMNO, a.ITEMDESCRIPTION, a.ITEMTYPE, a.SUBITEM, a.SerialNumberType,a.ManageExpired,a.ForceSN, a.ManageSN, a.DELIVERNOSTOCKSN, 
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
                    cast(0 as numeric(18,4)) MINIMUMQTY,a.UNIT1, 
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
                    Current_Date AdjDate, -1 OBWarehouseID,
                    null OBWarehouseName, -1 CountOB , a.TransactionID, a.ImportedTransactionID, a.BranchCodeID, 
                    cast('' as varchar(10)) UnitControl, 
                    cast('' as varchar(30)) UnbilledAccount, a.Rgt, a.Lft, II.ITEM_INDENT 
                    from ITEM a 
                    left outer join WareHs DW on DW.WarehouseID=a.WarehouseID 
                    Left outer join IsChild(a.ItemNo, 1) ic on a.ItemNO = ic.ItemNo  
                    Left outer join GetItemQuantity(a.ItemNo, '12/20/2021', Null) g on a.ItemNo = g.ItemNo_Qty
                    left outer join ITEM_INDENTED_VER3(a.Itemno) II on II.ITEMNO_INDENT = a.itemno 
                    Where a.CATEGORYID = 17 and ($item like '%$setter%')
                    order by a.FirstParentItem, II.ITEM_INDENT";
                }
                else
                {
                    $setter = $_POST['search']['value'];
                    $this->syntax = "select first $length skip $start a.ITEMNO, a.ITEMDESCRIPTION, a.ITEMTYPE, a.SUBITEM, a.SerialNumberType,a.ManageExpired,a.ForceSN, a.ManageSN, a.DELIVERNOSTOCKSN, 
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
                    cast(0 as numeric(18,4)) MINIMUMQTY,a.UNIT1, 
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
                    Current_Date AdjDate, -1 OBWarehouseID,
                    null OBWarehouseName, -1 CountOB , a.TransactionID, a.ImportedTransactionID, a.BranchCodeID, 
                    cast('' as varchar(10)) UnitControl, 
                    cast('' as varchar(30)) UnbilledAccount, a.Rgt, a.Lft, II.ITEM_INDENT 
                    from ITEM a 
                    left outer join WareHs DW on DW.WarehouseID=a.WarehouseID 
                    Left outer join IsChild(a.ItemNo, 1) ic on a.ItemNO = ic.ItemNo  
                    Left outer join GetItemQuantity(a.ItemNo, '12/20/2021', Null) g on a.ItemNo = g.ItemNo_Qty
                    left outer join ITEM_INDENTED_VER3(a.Itemno) II on II.ITEMNO_INDENT = a.itemno 
                    Where a.CATEGORYID = 17 and ($item like '%$setter%' or $item like  '%$setter%')
                    order by a.FirstParentItem, II.ITEM_INDENT ";
                }
 
                if(count($this->column_search) - 1 == $i) {
                  
            }
            $i++;
                }
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query(1,1);
        $this->syntax = "select a.ITEMNO, a.ITEMDESCRIPTION, a.ITEMTYPE, a.SUBITEM, a.SerialNumberType,a.ManageExpired,a.ForceSN, a.ManageSN, a.DELIVERNOSTOCKSN, 
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
                cast(0 as numeric(18,4)) MINIMUMQTY,a.UNIT1, 
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
                Current_Date AdjDate, -1 OBWarehouseID,
                null OBWarehouseName, -1 CountOB , a.TransactionID, a.ImportedTransactionID, a.BranchCodeID, 
                cast('' as varchar(10)) UnitControl, 
                cast('' as varchar(30)) UnbilledAccount, a.Rgt, a.Lft, II.ITEM_INDENT 
                from ITEM a 
                left outer join WareHs DW on DW.WarehouseID=a.WarehouseID 
                Left outer join IsChild(a.ItemNo, 1) ic on a.ItemNO = ic.ItemNo  
                Left outer join GetItemQuantity(a.ItemNo, '12/20/2021', Null) g on a.ItemNo = g.ItemNo_Qty
                left outer join ITEM_INDENTED_VER3(a.Itemno) II on II.ITEMNO_INDENT = a.itemno 
                Where a.CATEGORYID = 17
                order by a.FirstParentItem, II.ITEM_INDENT";
        if($_POST['length'] != -1)
        $this->_get_datatables_query($_POST['length'], $_POST['start']);
        $result = $this->db->query($this->syntax)->result();
        return $result;
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query(10,10);
        $result = $this->db->query($this->syntax)->num_rows();
        return $result;
    }
 
    public function count_all()
    {
           $query2 =  $this->db->query("select a.ITEMNO, a.ITEMDESCRIPTION, a.ITEMTYPE, a.SUBITEM, a.SerialNumberType,a.ManageExpired,a.ForceSN, a.ManageSN, a.DELIVERNOSTOCKSN, 
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
                cast(0 as numeric(18,4)) MINIMUMQTY,a.UNIT1, 
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
                Current_Date AdjDate, -1 OBWarehouseID,
                null OBWarehouseName, -1 CountOB , a.TransactionID, a.ImportedTransactionID, a.BranchCodeID, 
                cast('' as varchar(10)) UnitControl, 
                cast('' as varchar(30)) UnbilledAccount, a.Rgt, a.Lft, II.ITEM_INDENT 
                from ITEM a 
                left outer join WareHs DW on DW.WarehouseID=a.WarehouseID 
                Left outer join IsChild(a.ItemNo, 1) ic on a.ItemNO = ic.ItemNo  
                Left outer join GetItemQuantity(a.ItemNo, '12/20/2021', Null) g on a.ItemNo = g.ItemNo_Qty
                left outer join ITEM_INDENTED_VER3(a.Itemno) II on II.ITEMNO_INDENT = a.itemno 
                Where a.CATEGORYID = 17
                order by a.FirstParentItem, II.ITEM_INDENT");
            $result = $query2->num_rows();
       
       
        return $result;
    }

         function get_tables_query($query,$cari,$where,$iswhere)
        {
            // Ambil data yang di ketik user pada textbox pencarian
            $search = htmlspecialchars($_POST['search']['value']);
            // Ambil data limit per page
            $limit = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['length']}");
            // Ambil data start
            $start =preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['start']}"); 

            if($where != null)
            {
                $setWhere = array();
                foreach ($where as $key => $value)
                {
                    $setWhere[] = $key."='".$value."'";
                }
                $fwhere = implode(' AND ', $setWhere);

                if(!empty($iswhere))
                {
                    $sql = $this->db->query("select ".$query." WHERE  $iswhere AND ".$fwhere);
                    
                }else{
                    $sql = $this->db->query("select ".$query." WHERE ".$fwhere);
                }
                $sql_count = $sql->num_rows();
    
                $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";
                
                // Untuk mengambil nama field yg menjadi acuan untuk sorting
                $order_field = $_POST['order'][0]['column']; 
    
                // Untuk menentukan order by "ASC" atau "DESC"
                $order_ascdesc = $_POST['order'][0]['dir']; 
                $order = " ORDER BY QTY ".$order_ascdesc;
    
                if(!empty($iswhere))
                {
                    $sql_data = $this->db->query("select first ".$limit." skip ".$start." ".$query." WHERE $iswhere AND ".$fwhere." AND (".$cari.")".$order);
                }else{
                    $sql_data = $this->db->query("select first ".$limit." skip ".$start." ".$query." WHERE ".$fwhere." AND (".$cari.")".$order);
                }
                
                if(isset($search))
                {
                    if(!empty($iswhere))
                    {
                        $sql_cari =  $this->db->query("select ".$query." WHERE $iswhere AND ".$fwhere." AND (".$cari.")");
                    }else{
                        $sql_cari =  $this->db->query("select ".$query." WHERE ".$fwhere." AND (".$cari.")");
                    }
                    $sql_filter_count = $sql_cari->num_rows();
                }else{
                    if(!empty($iswhere))
                    {
                        $sql_filter = $this->db->query("select ".$query." WHERE $iswhere AND ".$fwhere);
                    }else{
                        $sql_filter = $this->db->query("slect ".$query." WHERE ".$fwhere);
                    }
                    $sql_filter_count = $sql_filter->num_rows();
                }
                $set = $sql_data->result();

            }else{
                if(!empty($iswhere))
                {
                    $sql = $this->db->query("select ".$query." WHERE  $iswhere ");
                }else{
                    $sql = $this->db->query("select ".$query);
                }
                $sql_count = $sql->num_rows();
    
                $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";
                
                // Untuk mengambil nama field yg menjadi acuan untuk sorting
                $order_field = $_POST['order'][0]['column']; 
    
                // Untuk menentukan order by "ASC" atau "DESC"
                $order_ascdesc = $_POST['order'][0]['dir']; 
                $order = " ORDER BY QTY ".$order_ascdesc;
    
                if(!empty($iswhere))
                {                
                    $sql_data = $this->db->query("select first ".$limit." skip ".$start." ".$query." WHERE $iswhere AND (".$cari.")".$order);
                }else{
                    $sql_data = $this->db->query("select first ".$limit." skip ".$start." ".$query." WHERE (".$cari.")".$order);
                }

                if(isset($search))
                {
                    if(!empty($iswhere))
                    {     
                        $sql_cari =  $this->db->query("select ".$query." WHERE $iswhere AND (".$cari.")");
                    }else{
                        $sql_cari =  $this->db->query("select ".$query." WHERE (".$cari.")");
                    }
                    $sql_filter_count = $sql_cari->num_rows();
                }else{
                    if(!empty($iswhere))
                    {
                        $sql_filter = $this->db->query("select ".$query." WHERE $iswhere");
                    }else{
                        $sql_filter = $this->db->query("select ".$query);
                    }
                    $sql_filter_count = $sql_filter->num_rows();
                }
                $set = $sql_data->result();
            }
            
              $data = array();
              $no = $_POST['start'];
              foreach ($set as $field) {
                  $no++;
                  $row = array();
                  $row[] = $no;
                  $row[] = $field->ITEMNO;
                  $row[] = $field->ITEMDESCRIPTION;
                  $row[] = $field->WEIGHT;
                  $row[] = $field->QTY;
                  $data[] = $row;
              }

            $callback = array(    
                'draw' => $_POST['draw'], // Ini dari datatablenya    
                'recordsTotal' => $sql_count,    
                'recordsFiltered'=>$sql_filter_count,    
                'data'=>$data
            );
            return $callback; // Convert array $callback ke json
        }

    public function getallwr()
    {
        $this->db->select('*');
        $this->db->from('WAREHOUSE_RM');
        return $this->db->result_array();
    }

    public function getawrbykode($data)
    {
        $this->db->select('*');
        $this->db->from('WAREHOUSE_RM');
        $this->db->where('KODE_BARANG_RM',$data);
        $this->db->where('FLAG',1);

        return $this->db->get()->result_array();
    }
 
}