<?php include('./phpqrcode/qrlib.php'); 
class Qrcoder extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

public function encodethis($setter,$ukuran = null,$nom = null){
    if (!empty($setter)) {

                $param = $setter;
    
                ob_start();
                QRCode::png($param, null,$ukuran,$nom);
                $imageString = base64_encode( ob_get_contents() );
                ob_end_clean();
                
                // outputs image directly into browser, as PNG stream
                return $imageString;
          }else{

          }
}

}
 