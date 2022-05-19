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
  
    <div class="modal fade" id="databar" role="dialog" style="overflow-y: auto;">
   <div class="subtab_left">
        <div class="modal-dialog modal-lg">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            
            <h4 class="modal-title">PRINT BARCODE RM</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
          <button class="btn btn-success" style="float:right;" data-toggle="modal" data-target="#databaradd"><i class="fas fa-plus">Tambah Data</i></button>
          <button id="printthisbarcode" class="btn btn-warning" style="float:left;"><i class="fas fa-plus">Print Data</i></button>
            <table id="barcoder" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>KODE BARANG</th>
                    <th>NAMA BARANG</th>
                    <th>JUMLAH BARANG</th>
                    <th>GAMBAR BARCODE 128</th>
                    <th>GAMBAR QRCODE</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                 
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>KODE BARANG</th>
                    <th>NAMA BARANG</th>
                    <th>JUMLAH BARANG</th>
                    <th>GAMBAR BARCODE 128</th>
                    <th>GAMBAR QRCODE</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
          </div>

          </div>
        </div>
       
      </div>
  </div>

    <div class="modal fade" id="databaradd" aria-labelledby="center" aria-hidden="true" style="overflow-y: auto;" data-keyboard="true" data-backdrop="static">
        <div class="modal-dialog">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h4 class="modal-title">Add Data Barcode/Qrcode</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="addbarcodeqrcode">
              <div id="tagihhan">
              <div class="form-group row">
                 <label class="col-sm-2 form-control-label">Isi data code barang</label>
                 <div class="col-sm-10">
                    <select id="selUser" name="addbarcoder[]" multiple="multiple" class="form-control" data-placeholder="Select FG Material" style="width: 100%">
                          <option value="disabled" disabled>DATA RM MATERIAL</option>
                         
                        </select>
                </div>
              </div>
              <div class="form-group row">
                 <label class="col-sm-2 form-control-label">Isi jumlah</label>
                 <div class="col-sm-10">
                    <input type="number" id="addjumlah" name="addjumlah" class="form-control" pattern="[0-9]" title="Input jumlah" style="width: 100%"/> 
                </div>
              </div>
              </div>
                 
            <div class="modal-footer justify-content-between">
              <button  class="btn btn-outline-dark" data-dismiss="modal">Tutup</button>
              <button id="senddata" class="btn btn-outline-dark" >Simpan Data</button>
            </div>
          </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->