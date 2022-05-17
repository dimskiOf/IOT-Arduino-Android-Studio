
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     
      <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">
            <?php foreach ($jmlnotif as $jmlntf) {
            $data1 = $jmlntf['total_seluruh_notifikasi'];
            $data2 = $jmlntf['total_notifikasi'];
            $set1 = array_filter($jmlnotif, function($e){
            return $e['jenis_notifikasi'] == '1';
            });

            $set2 = array_filter($jmlnotif, function($b){
             return $b['jenis_notifikasi'] == '2';
            });

            $set3 = array_filter($jmlnotif, function($c){
             return $c['jenis_notifikasi'] == '3';
            });

            $set4 = array_filter($jmlnotif, function($d){
             return $d['jenis_notifikasi'] == '4';
            });
             } 
            if (!empty($data1)) { echo $data1; } else { echo '0'; } ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><?php if (!empty($data1)) { echo $data1; } else { echo '0'; } ?> Notifikasi</span>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url('notif/notifikasi_pembaruan'); ?>" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> <?php if (!empty($set1)) { foreach ($set1 as $pembaruans) {
              $dodatapem = $pembaruans['total_notifikasi'];
            } echo $dodatapem; } else { echo '0'; }  ?> Pembaruan web
            <span class="float-right text-muted text-sm" id=""> <div id="munculpembaruan"></div> </span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url('notif/notifikasi_pengumuman'); ?>" class="dropdown-item">
            <i class="far fa-bell mr-2"></i> <?php if (!empty($set3)) { foreach ($set3 as $pembaruans3) {
              $dodatapem3 = $pembaruans3['total_notifikasi'];
            } echo $dodatapem3; } else { echo '0'; }  ?> Pengumuman
            <span class="float-right text-muted text-sm"><div id="munculpengumuman"></div></span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url('notif/notifikasi_pembayaran'); ?>" class="dropdown-item">
            <i class="far fa-bell mr-2"></i> <?php if (!empty($set2)) { foreach ($set2 as $pembaruans2) {
              $dodatapem2 = $pembaruans2['total_notifikasi'];
            } echo $dodatapem2; } else { echo '0'; }  ?> Pembayaran
            <span class="float-right text-muted text-sm"> <div id="munculberita"></div> </span>
          </a>
          <?php if (($this->session->userdata('privilages') !== 'MEMBER')) { ?>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url('admin/notifikasi_registrasi'); ?>" class="dropdown-item">
            <i class="far fa-bell mr-2"></i> <?php if (!empty($set4)) { foreach ($set4 as $pembaruans4) {
              $dodatapem4 = $pembaruans4['total_notifikasi'];
            } echo $dodatapem4; } else { echo '0'; }  ?> Registrasi
            <span class="float-right text-muted text-sm"><div id="munculpengumuman"></div></span>
          </a>
        <?php } ?>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->