<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ServerApi extends CI_Controller {

  public function __construct()
    {
        parent::__construct();
    }

    public function index(){
      $this->load->view('welcome_message');
    }

    // fungsi untuk CREATE
    public function addStaff()
    {
          $dbconnect = $this->load->database('testerdb', TRUE);
          // deklarasi variable
          $name = $this->input->post('name');
          $hp = $this->input->post('hp');
        $alamat = $this->input->post('alamat');
          // isikan variabel dengan nama file
          $data['staff_name'] = $name;
        $data['staff_hp'] = $hp;
          $data['staff_alamat'] = $alamat;
          $q = $dbconnect->insert('tb_staff', $data);
          // check insert berhasil apa nggak
          if ($q) {
            $response['pesan'] = 'insert berhasil';
            $response['status'] = 200;
          } else {
            $response['pesan'] = 'insert error';
            $response['status'] = 404;
          }
          echo json_encode($response);
    }
      // fungsi untuk READ
    public function getDataStaff()
    {

          $dbconnect = $this->load->database('testerdb', TRUE);
          $q = $dbconnect->get('tb_staff');
          if ($q -> num_rows() > 0) {
            $response['pesan'] = 'data ada';
            $response['status'] = 200;
            // 1 row
            $response['staff'] = $q->row();
            $response['staff'] = $q->result();
          } else {
            $response['pesan'] = 'data tidak ada';
            $response['status'] = 404;
          }
          echo json_encode($response);
    }
      // fungsi untuk DELETE
    public function deleteStaff()
    {
          $dbconnect = $this->load->database('testerdb', TRUE);
          $id = $this->input->post('id');
          $dbconnect->where('staff_id', $id);
          $status = $dbconnect->delete('tb_staff');
          if ($status == true) {
            $response['pesan'] = 'hapus berhasil';
            $response['status'] = 200;
          } else {
            $response['pesan'] = 'hapus error';
            $response['status'] = 404;
          }
          echo json_encode($response);
    }
      // fungsi untuk UPDATE
    public function updateStaff()
    {
          $dbconnect = $this->load->database('testerdb', TRUE);
          // deklarasi variable
          $id = $this->input->post('id');
          $name = $this->input->post('name');
          $hp = $this->input->post('hp');
          $alamat = $this->input->post('alamat');
          $dbconnect->where('staff_id', $id);
          // isikan variabel dengan nama file
          $data['staff_name'] = $name;
          $data['staff_hp'] = $hp;
          $data['staff_alamat'] = $alamat;
          $q = $dbconnect->update('tb_staff', $data);
          // check insert berhasil apa nggak
          if ($q) {
            $response['pesan'] = 'update berhasil';
            $response['status'] = 200;
          } else {
            $response['pesan'] = 'update error';
            $response['status'] = 404;
          }
          echo json_encode($response);
    }

    // fungsi untuk Login
    public function login()
    {
          $check = $this->db->get_where('USER_LOGIN', array('USERNAME' => $this->input->post('username') , 'PASSWD' => md5($this->input->post('password'))));
          // check insert berhasil apa nggak
          if ($check->num_rows() > 0) {
            $check2 = $this->db->get_where('TBL_USER', array('USERNAME' => $this->input->post('username')));
            $response['pesan'] = 'login berhasil';
            $response['status'] = 200;
            $response['logincred'] = $check->row();
            $response['logincred'] = $check->result();
            $response['logincred'] = $check2->row();
            $response['logincred'] = $check2->result();
          } else {
            $response['pesan'] = 'login gagal, username atau password salah';
            $response['status'] = 404;
          }
          echo json_encode($response);
    }

    // fungsi untuk getitembyid 

    public function getitembyid()
    {
         $gd99 = $this->load->database('gd99', TRUE);
          $check = $gd99->get_where('ITEM', array('ITEMNO' => $this->input->post('itemnos')));
          // check insert berhasil apa nggak
          if ($check->num_rows() > 0) {
            $response['pesan'] = 'ITEM ADA';
            $response['status'] = 200;
            $response['ResultGetItem'] = $check->row();
            $response['ResultGetItem'] = $check->result();
          } else {
            $response['pesan'] = 'ITEM TIDAK DITEMUKAN';
            $response['status'] = 404;
          }
          echo json_encode($response);
    }

    // fungsi get data fg keluar <!--- start get data rm fg -->
    public function getDataFgKeluar(){
      $query  = 'select first 50 fg.ID_FG_KELUAR, fg.TGL_CREATE_FG,fg.QTY_FG, fg.LOAD_NMBR, fg.INPUTMINUSPLUS, r.ITEMNO, r.ITEMDESCRIPTION, r.ITEMTYPE, r.SUBITEM, r.PARENTITEM,
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
                     r.IMPORTDUTY_TYPE, r.CUKAI_RATE, r.DELIVERNOSTOCKSN FROM ITEM r inner  join WAREHOUSE_FG_KELUAR fg on fg.ID_BARANG_FG = r.ITEMNO order by fg.TGL_CREATE_FG desc';

          $gd99 = $this->load->database('gd99', TRUE);
          $q = $gd99->query($query);

          if ($q -> num_rows() > 0) {
            $response['pesan'] = 'data ada';
            $response['status'] = 200;
            // 1 row
            $response['ResultFgKeluarItem'] = $q->row();
            $response['ResultFgKeluarItem'] = $q->result();
          } else {
            $response['pesan'] = 'data tidak ada';
            $response['status'] = 404;
          }
          echo json_encode($response);
      }

      public function getDataFgMasuk(){
        $query  = 'select first 50 fg.ID_FG_MASUK, fg.TGL_CREATE_FG,fg.QTY_FG, fg.LOAD_NMBR, fg.INPUTMINUSPLUS, r.ITEMNO, r.ITEMDESCRIPTION, r.ITEMTYPE, r.SUBITEM, r.PARENTITEM,
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
                     r.IMPORTDUTY_TYPE, r.CUKAI_RATE, r.DELIVERNOSTOCKSN FROM ITEM r inner  join WAREHOUSE_FG_MASUK fg on fg.ID_BARANG_FG = r.ITEMNO order by fg.TGL_CREATE_FG desc';
          $gd99 = $this->load->database('gd99', TRUE);
          $q = $gd99->query($query);

          if ($q -> num_rows() > 0) {
            $response['pesan'] = 'data ada';
            $response['status'] = 200;
            // 1 row
            $response['ResultFgMasukItem'] = $q->row();
            $response['ResultFgMasukItem'] = $q->result();
          } else {
            $response['pesan'] = 'data tidak ada';
            $response['status'] = 404;
          }
          echo json_encode($response);
      }

      public function getDataRmKeluar(){
        $query  = 'select first 50 rm.ID_RM_KELUAR, rm.TGL_CREATE_RM,rm.QTY_RM, rm.LOAD_NMBR, rm.INPUTMINUSPLUS, r.ITEMNO, r.ITEMDESCRIPTION, r.ITEMTYPE, r.SUBITEM, r.PARENTITEM,
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
                     r.IMPORTDUTY_TYPE, r.CUKAI_RATE, r.DELIVERNOSTOCKSN FROM ITEM r inner  join WAREHOUSE_RM_KELUAR rm on rm.ID_BARANG_RM = r.ITEMNO order by rm.TGL_CREATE_RM';

              $gd99 = $this->load->database('gd99', TRUE);
              $q = $gd99->query($query);

              if ($q -> num_rows() > 0) {
                $response['pesan'] = 'data ada';
                $response['status'] = 200;
                // 1 row
                $response['ResultRmKeluarItem'] = $q->row();
                $response['ResultRmKeluarItem'] = $q->result();
              } else {
                $response['pesan'] = 'data tidak ada';
                $response['status'] = 404;
              }
              echo json_encode($response); 

      }

      public function getDataRmMasuk(){
        $query  = 'select first 50 rm.ID_RM_MASUK, rm.TGL_CREATE_RM,rm.QTY_RM, rm.LOAD_NMBR, rm.INPUTMINUSPLUS, r.ITEMNO, r.ITEMDESCRIPTION, r.ITEMTYPE, r.SUBITEM, r.PARENTITEM,
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
                     r.IMPORTDUTY_TYPE, r.CUKAI_RATE, r.DELIVERNOSTOCKSN FROM ITEM r inner  join WAREHOUSE_RM_MASUK rm on rm.ID_BARANG_RM = r.ITEMNO order by rm.TGL_CREATE_RM';

          $gd99 = $this->load->database('gd99', TRUE);
          $q = $gd99->query($query);

          if ($q -> num_rows() > 0) {
            $response['pesan'] = 'data ada';
            $response['status'] = 200;
            // 1 row
            $response['ResultRmMasukItem'] = $q->row();
            $response['ResultRmMasukItem'] = $q->result();
          } else {
            $response['pesan'] = 'data tidak ada';
            $response['status'] = 404;
          }
          echo json_encode($response);

      }
      //  <!--- end get data rm fg -->
}