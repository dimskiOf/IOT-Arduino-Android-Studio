<?php
class Get_fgmpi_keluarmasuk extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Qrcoder');
        $this->load->model('Barcoder');
    }
 
   function get_fgmpi_keluar($query,$cari,$where,$iswhere)
        {
            // Ambil data yang di ketik user pada textbox pencarian
            $search = htmlspecialchars($_POST['search']['value']);
            // Ambil data limit per page
            $limit = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['length']}");
            // Ambil data start
            $start =preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['start']}"); 
            // order by apa
            $orderby = " fg.ID_FG_KELUAR ";
            $ascdesc = " asc ";

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
                $order = " ORDER BY".$orderby.$ascdesc;
    
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
                $order = " ORDER BY".$orderby.$ascdesc;
    
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
                  $row[] = $field->LOAD_NMBR;
                  $row[] = $field->ITEMNO;
                  $row[] = $field->ITEMDESCRIPTION;
                  $row[] = $field->UNIT1;
                  $row[] = $field->QTY_FG;
                  $row[] = $field->TGL_CREATE_FG;
                  $row[] = $field->INPUTMINUSPLUS;
                  $row[] = $field->ID_FG_KELUAR;
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


        function get_fgmpi_masuk($query,$cari,$where,$iswhere)
        {
            // Ambil data yang di ketik user pada textbox pencarian
            $search = htmlspecialchars($_POST['search']['value']);
            // Ambil data limit per page
            $limit = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['length']}");
            // Ambil data start
            $start =preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['start']}"); 
            // order by apa
            $orderby = " fg.ID_FG_MASUK ";
            $ascdesc = " asc ";

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
                $order = " ORDER BY".$orderby.$ascdesc;
    
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
                $order = " ORDER BY".$orderby.$ascdesc;
    
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
                  $row[] = $field->LOAD_NMBR;
                  $row[] = $field->ITEMNO;
                  $row[] = $field->ITEMDESCRIPTION;
                  $row[] = $field->UNIT1;
                  $row[] = $field->QTY_FG;
                  $row[] = $field->TGL_CREATE_FG;
                  $row[] = $field->INPUTMINUSPLUS;
                  $row[] = $field->ID_FG_MASUK;
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

        //hapus fg keluar
        public function hapusfgkeluar()
       {
        $this->db->where('ID_FG_KELUAR', $this->input->post('id'));
        return  $this->db->delete('WAREHOUSE_FG_KELUAR');
       }

        //hapus fg masuk
        public function hapusfgmasuk()
       {
        $this->db->where('ID_FG_MASUK', $this->input->post('id'));
        return  $this->db->delete('WAREHOUSE_FG_MASUK');
       }

    }