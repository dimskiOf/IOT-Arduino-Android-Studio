<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SERVER | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/adminlte.min.css">
  <!-- Loading -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/loading2.css">
</head>
<div class="container">
      <div class="modal modal--custom fade" id="loadings" style="z-index: 100000;" tabindex="-1" role="dialog" aria-labelledby="center" aria-hidden="true" data-keyboard="true" data-backdrop="static">
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
      </div>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->