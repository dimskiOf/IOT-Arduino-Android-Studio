

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    

    <!-- Main content -->
 
    <section class="content">
       <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Warehouse rm Masuk</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

      <div class="container-fluid"> 
        <!-- Main row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Barang Masuk</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <br>
                 <button id="generatebarcode" class="btn btn-success" style="float:right;" data-toggle="modal" data-target="#databar"><i class="fas fa-plus">Buat Barcode</i></button>
                 <br>
                <div class="form-group">
                  <label>Date range Filter:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right" id="rmmasukfilter">
                  </div>
                  <!-- /.input group -->
                </div>
                <table id="rmmasuk" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Load Number</th>
                    <th>Kode Material</th>
                    <th>Deskripsi Material</th>
                    <th>Satuan</th>
                    <th>Quantity(Bruto)</th>
                    <th>Berat Palet</th>
                    <th>Quantity(Netto)</th>
                    <th>TGL Keluar</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                 
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Load Number</th>
                    <th>Kode Material</th>
                    <th>Deskripsi Material</th>
                    <th>Satuan</th>
                    <th>Quantity(Bruto)</th>
                    <th>Berat Palet</th>
                    <th>Quantity(Netto)</th>
                    <th>TGL Keluar</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->