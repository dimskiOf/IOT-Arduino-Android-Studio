<div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?php echo base_url() ?>" class="h1"><b>PT. </b>MPI</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Silahkan Upload dengan Pilih Tombol Dibawah</p>

        <div class="input-group mb-3">
          <button type="submit" style="width: 100%;" class="btn btn-success" onclick="see();" data-toggle="modal" data-target="#importgbrbarcode">Material Keluar</button>
        </div>
        <div class="input-group mb-3">
          <button type="submit" style="width: 100%;" class="btn btn-success" onclick="see2();" data-toggle="modal" data-target="#importgbrbarcodemasuk">Material Masuk</button>
        </div>
        <div class="input-group mb-3">
          <button type="submit" style="width: 100%;" class="btn btn-success" data-toggle="modal" data-target="#importsuratjalan">Upload Hanya Barcode Surat Jalan</button>
        </div>
        <div class="input-group mb-3">
          <button type="submit" style="width: 100%;" class="btn btn-success" data-toggle="modal" data-target="#importgbrbarcodeplustimbangan">Upload Barcode + Timbangan</button>
          
        </div> 
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->