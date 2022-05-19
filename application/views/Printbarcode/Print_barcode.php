<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin MPI | Barcode/Qrcode Print</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets'); ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets'); ?>/dist/css/adminlte.min.css">
  <style>
* {
  box-sizing: border-box;
}

.row {
  margin-left:-5px;
  margin-right:-5px;
}
  
.column {
  float: left;
  width: 50%;
  padding: 5px;
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 180px;
  margin: 0 0 0 0;
  border: 1px solid #ddd;

}

th, td {
  text-align: left;
  padding: 0;
  margin: 0 0 0 0;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}


@media print {
    .row {
        display: inline;
    }
  
    table{
      display: inline;
    }
}
</style>
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <i class="fas fa-globe"></i> Barcode
          <small class="float-right"><?php echo date('d/m/Y'); ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>

    <!-- Table row -->
     <div class="row">
    <?php 
     $i = 0;
     foreach ($getter as $row) {
      for ($row['jml'] > -1; $row['jml']--;){ 
        $datas = $row['jml'] - 1;
        if($datas > -2){
    ?>
      <div class="column">
        <table id="table" class="table table-bordered" style="border: 1px solid !important; ">
          <tr  style="line-height: 3px !important; ">
            <th style="border: 1px solid !important; " width="50%" rowspan="6"><?php echo '<img width="100%" src="data:image/png;base64,' . $this->Barcoder->barcode("",$row['itemno'],70,"horizontal","code128","false",6) . '"><br><img src="data:image/png;base64,' . $this->Qrcoder->encodethis($row['itemno'],QR_ECLEVEL_L, 3) . '">' ?></th>
          </tr>
          <tr>
            <td  style="border: 1px solid !important; "><b>Code Item &nbsp;:</b> <?php echo $row['itemno']; ?></td>
          </tr>
          <!-- <tr style="line-height: 11px !important;">
            <td style="border: 1px solid !important; "><b>Deskripsi Item &nbsp;:</b> <?php echo $row['itemdescription']; ?></td>
          </tr> -->
          <tr  style="line-height: 1px !important;">
            <td style="border: 1px solid !important; " ><b>Packing &nbsp;: </b></td>
          </tr>
          <tr style="line-height: 1px !important;">
            <td style="border: 1px solid !important; "><b>Tgl Prod &nbsp;: </b><?php echo ""; ?></td>
          </tr>
          <tr  style="line-height: 1px !important;">
            <td style="border: 1px solid !important; "><b>Mesin &nbsp;: <?php echo ""; ?></b></td>
          </tr>
          <tr  style="line-height: 1px !important;">
            <td style="border: 1px solid !important; "><b>Berat &nbsp;: </b></td>
          </tr>
        </table>
     </div>
      <!-- /.col -->
    <?php       } 
              }
            }     ?>
    <!-- /.row -->
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());

</script>
</body>
</html>
