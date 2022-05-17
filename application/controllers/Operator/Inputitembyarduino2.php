<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Inputitembyarduino2 extends CI_Controller {

	function __construct(){
        parent::__construct();
          $this->load->model('In_Timbangandanbarcodempi');
    }
 

	public function index()
	{
      $this->load->view("test");
	}

    public function inputdatabarcodedantimbanganmpirmkeluar()
    {
        $input1 = $this->input->post('api_key');
        $input2 = $this->input->post("timbangandanbarcode");
        if (($input1 == "4321")){
          if (!empty($input2))
              {
                //fungsi nge trim
                $html = $input2;
                $needle = "@";
                $lastPos = 0;
                $positions = array();

                while (($lastPos = strpos($html, $needle, $lastPos))!== false) {
                    $positions[] = $lastPos-1;
                    $lastPos = $lastPos + strlen($needle);
                }


                $print = array();
                foreach ($positions as $value) {
                    $print[] = ($html[$value] == '#') ? " " : $html[$value] ;   
                }

                 $sta = "".implode("",$print)."";
                 $str = str_replace("<",'"',$sta);
                 
                 //end ngetrim

                 //fungsi ngetrim data timbangan
                 $html2 = $input2;
                 $needle2 = "*";
                 $lastPos2 = 0;
                 $positions2 = array();

                 while (($lastPos2 = strpos($html2, $needle2, $lastPos2))!== false) {
                    $positions2[] = $lastPos2-1;
                    $lastPos2 = $lastPos2 + strlen($needle2);
                 }


                 $print2 = array();
                 foreach ($positions2 as $value2) {
                    $print2[] = $html2[$value2];   
                 }

                 $str2 = "".implode("",$print2)."";

                 $exploder = explode("kg", strtolower($str2));
                 //end ngetrim data timbangan
                 
                 //fungsi ngetrim minus
                 $html3 = $input2;
                  $needle3 = ")";
                  $lastPos3 = 0;
                  $positions3 = array();

                  while (($lastPos3 = strpos($html3, $needle3, $lastPos3))!== false) {
                    $positions3[] = $lastPos3-1;
                    $lastPos3 = $lastPos3 + strlen($needle3);
                  }


                  $print3 = array();
                  foreach ($positions3 as $value3) {
                    $print3[] = $html3[$value3];   
                  }

                  $str3 = "".implode("",$print3)."";

                  $exploder2 = explode("#", $str3);
                  //end ngetrim minus
                 
                 $status = $this->db->get_where('ITEM', array('ITEMNO' => $str));

                    if (!empty($exploder2[count($exploder2)-2])){
                        $minus = $exploder2[count($exploder2)-2];
                    }else{
                        $minus = 0;
                    }
                if (!empty($exploder[count($exploder)-2])){
                 if (($status->num_rows() > 0)){
                    //sgw/gsc
                    if (preg_match('/(GS)|(ST)|(US)|(NT)|(gs)|(st)|(us)|(nt)|(,)|[+]/i',$exploder[count($exploder)-2]) == true){
                      
                      $sgw = explode(" ", $exploder[count($exploder)-2]);
                      $filteringagain = str_replace("$","",$sgw[count($sgw)-1]);
                      $ex = explode(",", $filteringagain);
                     
                      $host = getHostByName(getHostName());
                      $port = 1883;
                      $clientID = md5(uniqid());
              
                      $mqtt = new \Lightning\App($host, $port, $clientID);
              
                      if (!$mqtt->connect()) {
                          exit(1);
                      }

                      $mqtt->publish("dimas", 'data rmmpi keluar', 1);    
              
                     $status = $this->In_Timbangandanbarcodempi->inputdata($str,$ex[count($ex)-1]+$minus,$minus);
               
                    if($status){
                      echo json_encode(array('pesan' => 'Data Masuk','type' => 'Success Input' ));
                        }else{
                      echo json_encode(array('pesan' => 'ERROR 303','type' => 'Gagal Input Kesalahan Data' ));
                        }
                        
                    //A12E prolite
                    }elseif(preg_match('/(wn)|(WN)/i',$exploder[count($exploder)-2]) == true){
                    
                     $host = getHostByName(getHostName());
                      $port = 1883;
                      $clientID = md5(uniqid());
              
                      $mqtt = new \Lightning\App($host, $port, $clientID);
              
                      if (!$mqtt->connect()) {
                          exit(1);
                      }

                      $mqtt->publish("dimas", 'data rmmpi keluar', 1);    
              
                     $status = $this->In_Timbangandanbarcodempi->inputdata($str,str_replace("wn","",$exploder[count($exploder)-2])+$minus,$minus);

                     if($status){
                      echo json_encode(array('pesan' => 'Data Masuk','type' => 'Success Input' ));
                        }else{
                      echo json_encode(array('pesan' => 'ERROR 303','type' => 'Gagal Input Kesalahan Data' ));
                        }

                    }else{
                  //timbangan cas hdi
                  $host = getHostByName(getHostName());
                  $port = 1883;
                  $clientID = md5(uniqid());
          
                  $mqtt = new \Lightning\App($host, $port, $clientID);
          
                  if (!$mqtt->connect()) {
                      exit(1);
                  }

                  $mqtt->publish("dimas", 'data rmmpi keluar', 1);    
          
                  $status = $this->In_Timbangandanbarcodempi->inputdata($str,$exploder[count($exploder)-2]+$minus,$minus);
                  
                  if($status){
                  
                    echo json_encode(array('pesan' => 'Data Masuk','type' => 'Success Input' ));
                        }else{
                    echo json_encode(array('pesan' => 'ERROR 303','type' => 'Gagal Input Kesalahan Data' ));
                        
                        }
                    }

                }else{
                    echo json_encode(array('pesan' => 'ERROR 302','type' => 'Null data Barcode' ));
                }
            }else{
                    // return $this->output
                    // ->set_content_type('application/json')
                    // ->set_status_header(304)
                    // ->set_output(json_encode(array(
                    //         'pesan' => 'ERROR 304',
                    //         'type' => 'Null data timbangan'
                    // )));
                    echo json_encode(array('pesan' => 'ERROR 304','type' => 'Null data timbangan' ));      
                }
              }else{
                echo json_encode(array('pesan' => 'ERROR 301','type' => 'Null data' ));
              }
        }else{
            echo json_encode(array('pesan' => 'ERROR 300','type' => 'Kode verifikasi' ));
            }
    }

        public function inputdatabarcodedantimbanganmpirmmasuk()
    {
        $input1 = $this->input->post('api_key');
        $input2 = $this->input->post("timbangandanbarcode");
        if (($input1 == "4321")){
          if (!empty($input2))
              {
                //fungsi nge trim
                $html = $input2;
                $needle = "@";
                $lastPos = 0;
                $positions = array();

                while (($lastPos = strpos($html, $needle, $lastPos))!== false) {
                    $positions[] = $lastPos-1;
                    $lastPos = $lastPos + strlen($needle);
                }


                $print = array();
                foreach ($positions as $value) {
                    $print[] = ($html[$value] == '#') ? " " : $html[$value] ;   
                }

                 $sta = "".implode("",$print)."";
                 $str = str_replace("<",'"',$sta);
                 
                 //end ngetrim

                 //fungsi ngetrim data timbangan
                 $html2 = $input2;
                 $needle2 = "*";
                 $lastPos2 = 0;
                 $positions2 = array();

                 while (($lastPos2 = strpos($html2, $needle2, $lastPos2))!== false) {
                    $positions2[] = $lastPos2-1;
                    $lastPos2 = $lastPos2 + strlen($needle2);
                 }


                 $print2 = array();
                 foreach ($positions2 as $value2) {
                    $print2[] = $html2[$value2];   
                 }

                 $str2 = "".implode("",$print2)."";

                 $exploder = explode("kg", strtolower($str2));
                 //end ngetrim data timbangan
                 
                 //fungsi ngetrim minus
                 $html3 = $input2;
                  $needle3 = ")";
                  $lastPos3 = 0;
                  $positions3 = array();

                  while (($lastPos3 = strpos($html3, $needle3, $lastPos3))!== false) {
                    $positions3[] = $lastPos3-1;
                    $lastPos3 = $lastPos3 + strlen($needle3);
                  }


                  $print3 = array();
                  foreach ($positions3 as $value3) {
                    $print3[] = $html3[$value3];   
                  }

                  $str3 = "".implode("",$print3)."";

                  $exploder2 = explode("#", $str3);
                  //end ngetrim minus
                 
                 $status = $this->db->get_where('ITEM', array('ITEMNO' => $str));

                 if (!empty($exploder2[count($exploder2)-2])){
                        $minus = $exploder2[count($exploder2)-2];
                    }else{
                        $minus = 0;
                    }

                if (!empty($exploder[count($exploder)-2])){
                 if (($status->num_rows() > 0)){
                    //sgw/gsc
                    if (preg_match('/(GS)|(ST)|(US)|(NT)|(gs)|(st)|(us)|(nt)|(,)|[+]/i',$exploder[count($exploder)-2]) == true){
                      
                      $sgw = explode(" ", $exploder[count($exploder)-2]);
                      $filteringagain = str_replace("$","",$sgw[count($sgw)-1]);
                      $ex = explode(",", $filteringagain);
                     
                      $host = getHostByName(getHostName());
                      $port = 1883;
                      $clientID = md5(uniqid());
              
                      $mqtt = new \Lightning\App($host, $port, $clientID);
              
                      if (!$mqtt->connect()) {
                          exit(1);
                      }

                      $mqtt->publish("dimas", 'data rmmpi masuk', 1);    
              
                     $status = $this->In_Timbangandanbarcodempi->inputdata2($str,$ex[count($ex)-1]+$minus,$minus);
               
                    if($status){
                      echo json_encode(array('pesan' => 'Data Masuk','type' => 'Success Input' ));
                        }else{
                      echo json_encode(array('pesan' => 'ERROR 303','type' => 'Gagal Input Kesalahan Data' ));
                        }
                    //A12E prolite
                    }elseif(preg_match('/(wn)|(WN)/i',$exploder[count($exploder)-2]) == true){
                    
                     $host = getHostByName(getHostName());
                      $port = 1883;
                      $clientID = md5(uniqid());
              
                      $mqtt = new \Lightning\App($host, $port, $clientID);
              
                      if (!$mqtt->connect()) {
                          exit(1);
                      }

                      $mqtt->publish("dimas", 'data rmmpi masuk', 1);    
              
                     $status = $this->In_Timbangandanbarcodempi->inputdata2($str,str_replace("wn","",$exploder[count($exploder)-2])+$minus,$minus);

                     if($status){
                      echo json_encode(array('pesan' => 'Data Masuk','type' => 'Success Input' ));
                        }else{
                      echo json_encode(array('pesan' => 'ERROR 303','type' => 'Gagal Input Kesalahan Data' ));
                        }

                    }else{
                  //timbangan cas hdi
                  $host = getHostByName(getHostName());
                  $port = 1883;
                  $clientID = md5(uniqid());
          
                  $mqtt = new \Lightning\App($host, $port, $clientID);
          
                  if (!$mqtt->connect()) {
                      exit(1);
                  }

                  $mqtt->publish("dimas", 'data rmmpi masuk', 1);    
          
                  $status = $this->In_Timbangandanbarcodempi->inputdata2($str,$exploder[count($exploder)-2]+$minus,$minus);
                  
                  if($status){
                  
                    echo json_encode(array('pesan' => 'Data Masuk','type' => 'Success Input' ));
                        }else{
                    echo json_encode(array('pesan' => 'ERROR 303','type' => 'Gagal Input Kesalahan Data' ));
                        
                        }
                    }

                }else{
                    echo json_encode(array('pesan' => 'ERROR 302','type' => 'Null data Barcode' ));
                }
            }else{
                    // return $this->output
                    // ->set_content_type('application/json')
                    // ->set_status_header(304)
                    // ->set_output(json_encode(array(
                    //         'pesan' => 'ERROR 304',
                    //         'type' => 'Null data timbangan'
                    // )));
                    echo json_encode(array('pesan' => 'ERROR 304','type' => 'Null data timbangan' ));      
                }
              }else{
                echo json_encode(array('pesan' => 'ERROR 301','type' => 'Null data' ));
              }
        }else{
            echo json_encode(array('pesan' => 'ERROR 300','type' => 'Kode verifikasi' ));
            }
        
    }

        public function inputdatabarcodedantimbanganmpifgkeluar()
    {
        $input1 = $this->input->post('api_key');
        $input2 = $this->input->post("timbangandanbarcode");
        if (($input1 == "4321")){
          if (!empty($input2))
              {
                //fungsi nge trim
                $html = $input2;
                $needle = "@";
                $lastPos = 0;
                $positions = array();

                while (($lastPos = strpos($html, $needle, $lastPos))!== false) {
                    $positions[] = $lastPos-1;
                    $lastPos = $lastPos + strlen($needle);
                }


                $print = array();
                foreach ($positions as $value) {
                    $print[] = ($html[$value] == '#') ? " " : $html[$value] ;   
                }

                 $sta = "".implode("",$print)."";
                 $str = str_replace("<",'"',$sta);
                 
                 //end ngetrim

                 //fungsi ngetrim data timbangan
                 $html2 = $input2;
                 $needle2 = "*";
                 $lastPos2 = 0;
                 $positions2 = array();

                 while (($lastPos2 = strpos($html2, $needle2, $lastPos2))!== false) {
                    $positions2[] = $lastPos2-1;
                    $lastPos2 = $lastPos2 + strlen($needle2);
                 }


                 $print2 = array();
                 foreach ($positions2 as $value2) {
                    $print2[] = $html2[$value2];   
                 }

                 $str2 = "".implode("",$print2)."";

                 $exploder = explode("kg", strtolower($str2));
                 //end ngetrim data timbangan
                 
                 //fungsi ngetrim minus
                 $html3 = $input2;
                  $needle3 = ")";
                  $lastPos3 = 0;
                  $positions3 = array();

                  while (($lastPos3 = strpos($html3, $needle3, $lastPos3))!== false) {
                    $positions3[] = $lastPos3-1;
                    $lastPos3 = $lastPos3 + strlen($needle3);
                  }


                  $print3 = array();
                  foreach ($positions3 as $value3) {
                    $print3[] = $html3[$value3];   
                  }

                  $str3 = "".implode("",$print3)."";

                  $exploder2 = explode("#", $str3);
                  //end ngetrim minus
                 
                 $status = $this->db->get_where('ITEM', array('ITEMNO' => $str));

                 if (!empty($exploder2[count($exploder2)-2])){
                        $minus = $exploder2[count($exploder2)-2];
                    }else{
                        $minus = 0;
                    }

                if (!empty($exploder[count($exploder)-2])){
                 if (($status->num_rows() > 0)){
                    //sgw/gsc
                    if (preg_match('/(GS)|(ST)|(US)|(NT)|(gs)|(st)|(us)|(nt)|(,)|[+]/i',$exploder[count($exploder)-2]) == true){
                      
                      $sgw = explode(" ", $exploder[count($exploder)-2]);
                      $filteringagain = str_replace("$","",$sgw[count($sgw)-1]);
                      $ex = explode(",", $filteringagain);
                     
                      $host = getHostByName(getHostName());
                      $port = 1883;
                      $clientID = md5(uniqid());
              
                      $mqtt = new \Lightning\App($host, $port, $clientID);
              
                      if (!$mqtt->connect()) {
                          exit(1);
                      }

                      $mqtt->publish("dimas", 'data fgmpi keluar', 1);    
              
                     $status = $this->In_Timbangandanbarcodempi->inputdata3($str,$ex[count($ex)-1]+$minus,$minus);
               
                    if($status){
                      echo json_encode(array('pesan' => 'Data Masuk','type' => 'Success Input' ));
                        }else{
                      echo json_encode(array('pesan' => 'ERROR 303','type' => 'Gagal Input Kesalahan Data' ));
                        }
                    //A12E prolite
                    }elseif(preg_match('/(wn)|(WN)/i',$exploder[count($exploder)-2]) == true){
                    
                     $host = getHostByName(getHostName());
                      $port = 1883;
                      $clientID = md5(uniqid());
              
                      $mqtt = new \Lightning\App($host, $port, $clientID);
              
                      if (!$mqtt->connect()) {
                          exit(1);
                      }

                      $mqtt->publish("dimas", 'data fgmpi keluar', 1);    
              
                     $status = $this->In_Timbangandanbarcodempi->inputdata3($str,str_replace("wn","",$exploder[count($exploder)-2])+$minus,$minus);

                     if($status){
                      echo json_encode(array('pesan' => 'Data Masuk','type' => 'Success Input' ));
                        }else{
                      echo json_encode(array('pesan' => 'ERROR 303','type' => 'Gagal Input Kesalahan Data' ));
                        }

                    }else{
                  //timbangan cas hdi
                  $host = getHostByName(getHostName());
                  $port = 1883;
                  $clientID = md5(uniqid());
          
                  $mqtt = new \Lightning\App($host, $port, $clientID);
          
                  if (!$mqtt->connect()) {
                      exit(1);
                  }

                  $mqtt->publish("dimas", 'data fgmpi keluar', 1);    
          
                  $status = $this->In_Timbangandanbarcodempi->inputdata3($str,$exploder[count($exploder)-2]+$minus,$minus);
                  
                  if($status){
                  
                    echo json_encode(array('pesan' => 'Data Masuk','type' => 'Success Input' ));
                        }else{
                    echo json_encode(array('pesan' => 'ERROR 303','type' => 'Gagal Input Kesalahan Data' ));
                        
                        }
                    }

                }else{
                    echo json_encode(array('pesan' => 'ERROR 302','type' => 'Null data Barcode' ));
                }
            }else{
                    // return $this->output
                    // ->set_content_type('application/json')
                    // ->set_status_header(304)
                    // ->set_output(json_encode(array(
                    //         'pesan' => 'ERROR 304',
                    //         'type' => 'Null data timbangan'
                    // )));
                    echo json_encode(array('pesan' => 'ERROR 304','type' => 'Null data timbangan' ));      
                }
              }else{
                echo json_encode(array('pesan' => 'ERROR 301','type' => 'Null data' ));
              }
        }else{
            echo json_encode(array('pesan' => 'ERROR 300','type' => 'Kode verifikasi' ));
            }
        
    }

        public function inputdatabarcodedantimbanganmpifgmasuk()
    {
        $input1 = $this->input->post('api_key');
        $input2 = $this->input->post("timbangandanbarcode");
        if (($input1 == "4321")){
          if (!empty($input2))
              {
                //fungsi nge trim
                $html = $input2;
                $needle = "@";
                $lastPos = 0;
                $positions = array();

                while (($lastPos = strpos($html, $needle, $lastPos))!== false) {
                    $positions[] = $lastPos-1;
                    $lastPos = $lastPos + strlen($needle);
                }


                $print = array();
                foreach ($positions as $value) {
                    $print[] = ($html[$value] == '#') ? " " : $html[$value] ;   
                }

                 $sta = "".implode("",$print)."";
                 $str = str_replace("<",'"',$sta);
                 
                 //end ngetrim

                 //fungsi ngetrim data timbangan
                 $html2 = $input2;
                 $needle2 = "*";
                 $lastPos2 = 0;
                 $positions2 = array();

                 while (($lastPos2 = strpos($html2, $needle2, $lastPos2))!== false) {
                    $positions2[] = $lastPos2-1;
                    $lastPos2 = $lastPos2 + strlen($needle2);
                 }


                 $print2 = array();
                 foreach ($positions2 as $value2) {
                    $print2[] = $html2[$value2];   
                 }

                 $str2 = "".implode("",$print2)."";

                 $exploder = explode("kg", strtolower($str2));
                 //end ngetrim data timbangan
                 
                 //fungsi ngetrim minus
                 $html3 = $input2;
                  $needle3 = ")";
                  $lastPos3 = 0;
                  $positions3 = array();

                  while (($lastPos3 = strpos($html3, $needle3, $lastPos3))!== false) {
                    $positions3[] = $lastPos3-1;
                    $lastPos3 = $lastPos3 + strlen($needle3);
                  }


                  $print3 = array();
                  foreach ($positions3 as $value3) {
                    $print3[] = $html3[$value3];   
                  }

                  $str3 = "".implode("",$print3)."";

                  $exploder2 = explode("#", $str3);
                  //end ngetrim minus
                 
                 $status = $this->db->get_where('ITEM', array('ITEMNO' => $str));

                 if (!empty($exploder2[count($exploder2)-2])){
                        $minus = $exploder2[count($exploder2)-2];
                    }else{
                        $minus = 0;
                    }

                if (!empty($exploder[count($exploder)-2])){
                 if (($status->num_rows() > 0)){
                    //sgw/gsc
                    if (preg_match('/(GS)|(ST)|(US)|(NT)|(gs)|(st)|(us)|(nt)|(,)|[+]/i',$exploder[count($exploder)-2]) == true){
                      
                      $sgw = explode(" ", $exploder[count($exploder)-2]);
                      $filteringagain = str_replace("$","",$sgw[count($sgw)-1]);
                      $ex = explode(",", $filteringagain);
                     
                      $host = getHostByName(getHostName());
                      $port = 1883;
                      $clientID = md5(uniqid());
              
                      $mqtt = new \Lightning\App($host, $port, $clientID);
              
                      if (!$mqtt->connect()) {
                          exit(1);
                      }

                      $mqtt->publish("dimas", 'data fgmpi masuk', 1);    
              
                     $status = $this->In_Timbangandanbarcodempi->inputdata4($str,$ex[count($ex)-1]+$minus,$minus);
               
                    if($status){
                      echo json_encode(array('pesan' => 'Data Masuk','type' => 'Success Input' ));
                        }else{
                      echo json_encode(array('pesan' => 'ERROR 303','type' => 'Gagal Input Kesalahan Data' ));
                        }
                    //A12E prolite
                    }elseif(preg_match('/(wn)|(WN)/i',$exploder[count($exploder)-2]) == true){
                    
                     $host = getHostByName(getHostName());
                      $port = 1883;
                      $clientID = md5(uniqid());
              
                      $mqtt = new \Lightning\App($host, $port, $clientID);
              
                      if (!$mqtt->connect()) {
                          exit(1);
                      }

                      $mqtt->publish("dimas", 'data fgmpi masuk', 1);    
              
                     $status = $this->In_Timbangandanbarcodempi->inputdata4($str,str_replace("wn","",$exploder[count($exploder)-2])+$minus,$minus);

                     if($status){
                      echo json_encode(array('pesan' => 'Data Masuk','type' => 'Success Input' ));
                        }else{
                      echo json_encode(array('pesan' => 'ERROR 303','type' => 'Gagal Input Kesalahan Data' ));
                        }

                    }else{
                  //timbangan cas hdi
                  $host = getHostByName(getHostName());
                  $port = 1883;
                  $clientID = md5(uniqid());
          
                  $mqtt = new \Lightning\App($host, $port, $clientID);
          
                  if (!$mqtt->connect()) {
                      exit(1);
                  }

                  $mqtt->publish("dimas", 'data fgmpi masuk', 1);    
          
                  $status = $this->In_Timbangandanbarcodempi->inputdata4($str,$exploder[count($exploder)-2]+$minus,$minus);
                  
                  if($status){
                  
                    echo json_encode(array('pesan' => 'Data Masuk','type' => 'Success Input' ));
                        }else{
                    echo json_encode(array('pesan' => 'ERROR 303','type' => 'Gagal Input Kesalahan Data' ));
                        
                        }
                    }

                }else{
                    echo json_encode(array('pesan' => 'ERROR 302','type' => 'Null data Barcode' ));
                }
            }else{
                    // return $this->output
                    // ->set_content_type('application/json')
                    // ->set_status_header(304)
                    // ->set_output(json_encode(array(
                    //         'pesan' => 'ERROR 304',
                    //         'type' => 'Null data timbangan'
                    // )));
                    echo json_encode(array('pesan' => 'ERROR 304','type' => 'Null data timbangan' ));      
                }
              }else{
                echo json_encode(array('pesan' => 'ERROR 301','type' => 'Null data' ));
              }
        }else{
            echo json_encode(array('pesan' => 'ERROR 300','type' => 'Kode verifikasi' ));
            }

        }
}