<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Upload Barcode| Operator</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/toastr/toastr.min.css">
  <!-- fileinput -->
  <link href="<?php echo base_url('assets/') ?>dist/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/'); ?>css/adminlte.min.css">
  <!-- Loading -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/');?>css/loading2.css">
</head>

    <div class="modal fade" id="importgbrbarcode" role="dialog" style="overflow-y: auto;">
   <div class="subtab_left">
        <div class="modal-dialog modal-dialog-centered">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            
            <h4 class="modal-title">Material Keluar(pemakaian bahan baku)</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- <form class="form-horizontal" id="importformbarcode"> -->
          <div class="modal-body">
            <div class="form-group row">
              <label class="col-sm-2 form-control-label"> live camera barcode</label>
              <div class="col-sm-10">
                 <canvas id="qr-canvas" style="width: 100%;" class="hidden" ></canvas>
              </div>
            </div>
           <!-- <div class="form-group row"> -->
            <!--           <label class="col-sm-2 form-control-label">Masukan Foto Barcode</label>
                      <div class="col-sm-10">
                    <input id="fotobarcode" name="fotobarcode" class="file" type="file">
                </div> -->
            <!-- </div> -->
          </div>
      <div class="modal-footer">
            <!-- <button type="button" id="importbarcodekonfirm" class="btn btn-primary">Upload Data</button> -->
          </div>
          <!-- </form> -->
          </div>
        </div>
       
      </div>
  </div>

  <div class="modal fade" id="importgbrbarcodemasuk" role="dialog" style="overflow-y: auto;">
   <div class="subtab_left">
        <div class="modal-dialog modal-dialog-centered">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            
            <h4 class="modal-title">Material Masuk(Penerimaan Bahan Baku)</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- <form class="form-horizontal" id="importformbarcode"> -->
          <div class="modal-body">
            <div class="form-group row">
              <label class="col-sm-2 form-control-label"> live camera barcode</label>
              <div class="col-sm-10">
                 
              <video style="width: 100%;" id="video-preview"></video>
              
              </div>
            </div>
           <!-- <div class="form-group row"> -->
            <!--           <label class="col-sm-2 form-control-label">Masukan Foto Barcode</label>
                      <div class="col-sm-10">
                    <input id="fotobarcode" name="fotobarcode" class="file" type="file">
                </div> -->
            <!-- </div> -->
          </div>
      <div class="modal-footer">
            <!-- <button type="button" id="importbarcodekonfirm" class="btn btn-primary">Upload Data</button> -->
          </div>
          <!-- </form> -->
          </div>
        </div>
       
      </div>
  </div>

  <div class="container">
  <div class="modal fade" style="z-index: 100000;" role="dialog">
   <div class="subtab_left">
        <div class="modal-dialog modal-dialog-centered">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            
            <h4 class="modal-title">  </h4>
           
          </div>
          <div class="modal-body">
          
          </div>
          </div>
        </div>
       
      </div>
  </div>
  </div>
  
 <div class="container">
  <div class="modal fade" id="popupvalidate" style="z-index: 100000;" role="dialog">
   <div class="subtab_left">
        <div class="modal-dialog modal-dialog-centered">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            
            <h4 class="modal-title">  Form Validasi  </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
           <center><div id="pops"></div></center>
          </div>
          </div>
        </div>
       
      </div>
  </div>
  </div>

  <div class="modal fade" id="databarcode" style="overflow-y: auto;" role="dialog">
   <div class="subtab_left">
        <div class="modal-dialog modal-dialog-centered">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            
            <h4 class="modal-title">  Data Bahan Keluar  </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
           <form class="form-horizontal" id="importformbarcodekonfirm">
          <div class="modal-body">
          <div class="form-group">
            <label>Kode Material</label>
            <input type="hidden" name="itemid" class="form-control" readonly>
            <input type="text" name="kodebahan" class="form-control" placeholder="Kode Bahan" readonly>
        </div>
         <div class="form-group">
            <label>Deskripsi</label>
            <input type="text" name="deskripsi" class="form-control" placeholder="deskripsi" readonly>
        </div>
         <div class="form-group">
            <label>Berat Material</label>
            <input type="text" name="beratmaterial" class="form-control" placeholder="Berat Material" readonly>
        </div>
        <div class="form-group">
            <label>Quantity</label>
            <input type="text" name="quantity" class="form-control" placeholder="jumlah barang(dalam angka)">
        </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="simpanmasukanrm" class="btn btn-success">Simpan</button>
          </div>
          </form>
          </div>
        </div>
       
      </div>
  </div>

    <div class="modal fade" id="databarcode2" style="overflow-y: auto;" role="dialog">
   <div class="subtab_left">
        <div class="modal-dialog modal-dialog-centered">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            
            <h4 class="modal-title">  Data Bahan Masuk  </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
           <form class="form-horizontal" id="importformbarcodekonfirm2">
          <div class="modal-body">
          <div class="form-group">
            <label>Kode Material</label>
            <input type="hidden" name="itemid2" class="form-control" readonly>
            <input type="text" name="kodebahan2" class="form-control" placeholder="Kode Bahan" readonly>
        </div>
         <div class="form-group">
            <label>Deskripsi</label>
            <input type="text" name="deskripsi2" class="form-control" placeholder="deskripsi" readonly>
        </div>
         <div class="form-group">
            <label>Berat Material</label>
            <input type="text" name="beratmaterial2" class="form-control" placeholder="Berat Material" readonly>
        </div>
        <div class="form-group">
            <label>Quantity</label>
            <input type="text" name="quantity2" class="form-control" placeholder="jumlah barang(dalam angka)">
        </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="simpanmasukanrm2" class="btn btn-success">Simpan</button>
          </div>
          </form>
          </div>
        </div>
       
      </div>
  </div>
        
      <div class="modal fade" id="loadings"  role="dialog" aria-labelledby="center" aria-hidden="true" data-keyboard="true" data-backdrop="static">
       <div class="subtab_left">
          <div class="modal-dialog modal-dialog-centered">
            <div class='containers'>
              <div class='loaders'>
                <div class='loader--dot'></div>
                <div class='loader--dot'></div>
                <div class='loader--dot'></div>
                <div class='loader--dot'></div>
                <div class='loader--dot'></div>
                <div class='loader--dot'></div>
                <div class='loader--text'></div>
              </div>
            </div>
        </div>
        </div>
    </div>

<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->