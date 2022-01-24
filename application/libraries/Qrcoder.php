<?php  include('./phpqrcode/qrlib.php'); 
defined('BASEPATH') OR exit('No direct script access allowed');
class Qrcoder
{
     
     public function setItemName($itemid)
     {
          if (!empty($itemid)) {
                  // text output  
			    $setter = $itemid;
			    
			    // generating
			    $text = QRcode::text($setter);
			    $raw = join("<br/>", $text);
			    
			    $raw = strtr($raw, array(
			        '0' => '<span style="color:white">&#9608;&#9608;</span>',
			        '1' => '&#9608;&#9608;'
			    ));
			    
			    // displaying
			    
			    echo '<tt style="font-size:7px">'.$raw.'</tt>'; 
          }else{

          }
     }

}