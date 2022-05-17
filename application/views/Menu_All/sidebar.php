<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url(); ?>" target="_blank" class="brand-link">
      <img src="<?php echo base_url('assets'); ?>/dist/img/AdminLTELogo.png" alt="Admin Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
     <span class="brand-text font-weight-light">Admin-Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image" id="foto2">
          <img src="<?php foreach ($datadiri as $fp) { 
            $datafoto = $fp['foto_profil'];
           }
            if ($datafoto == 'w') { echo base_url('assets/img/avatar2.png'); } elseif ($datafoto == 'l') { echo base_url('assets/img/avatar5.png'); } else { echo base_url('assets/img/foto-profil/'.$datafoto); } ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php if (!empty($this->session->userdata('namas'))) {
            echo $this->session->userdata('namas');
          }else{
            echo 'nama user';
          } ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         <?php
        $username = $this->session->userdata('id');
        $privilage = $this->session->userdata('privilages');

        $this->db->from('user_akses_menu');
        $this->db->join('menu_panel', 'menu_panel.id_menu = user_akses_menu.id_menu');
        $this->db->where('user_akses_menu.privilage', $privilage);
        $this->db->where('user_akses_menu.username', $username);
        $this->db->where('menu_panel.status', 1);
        $this->db->order_by('menu_panel.id_menu', 'ASC');
        $query = $this->db->get();
        $menu = $query->result_array();
        ?>

        <?php foreach ($menu as $row) {
          if ($row['have_dropdown'] == 1) {
            echo '<li class="nav-item has-treeview" id="' . $row['id_menu'] . '">';
            echo '<a href="' . $row['url'] . '" class="nav-link" id="menu' . $row['id_menu'] . '">';
            echo '<i class="' . $row['icon_menu'] . ' nav-icon"></i>';
            echo '<p>' . $row['nama_menu'] . '<i class="fas fa-angle-left right"></i>';
            echo '</p><a/>';
            echo '<ul class="nav nav-treeview">';

            $id_menu = $row['id_menu'];
            $this->db->from('user_akses_submenu');
            $this->db->join('menu_sub_menu', 'menu_sub_menu.id_submenu = user_akses_submenu.id_submenu');
            $this->db->where('user_akses_submenu.username', $username);
            $this->db->where('user_akses_submenu.privilage', $privilage);
            $this->db->where('user_akses_submenu.id_menu', $id_menu);
            $this->db->where('menu_sub_menu.status', 1);
            $this->db->order_by('menu_sub_menu.id_submenu', 'ASC');
            $query = $this->db->get();
            $submenu = $query->result_array();

            foreach ($submenu as $sub) {
              if ($sub['have_dropdown'] == 1) {
                echo '<li class="nav-item has-treeview" id="' . $sub['id_submenu'] . '">';
                echo '<a href="' . base_url() . $sub['url'] . '" class="nav-link" id="submenu' . $sub['id_submenu'] . '">';
                echo '<i class="'. $sub['icon'] .'" ></i>';
                echo '<p>';
                echo $sub['nama_submenu'];
                echo '<i class="right fas fa-angle-left"></i>';
                echo '</p></a>';
                echo '<ul class="nav nav-treeview">';

                $id_submenu = $sub['id_submenu'];
                $this->db->from('user_akses_sub_submenu');
                $this->db->join('menu_sub_submenu', 'menu_sub_submenu.id_sub_submenu = user_akses_sub_submenu.id_sub_submenu');
                $this->db->where('user_akses_sub_submenu.username', $username);
                $this->db->where('user_akses_sub_submenu.privilage', $privilage);
                $this->db->where('user_akses_sub_submenu.id_submenu', $id_submenu);
                $this->db->where('menu_sub_submenu.status', 1);
                $this->db->order_by('menu_sub_submenu.id_sub_submenu', 'ASC');
                $query = $this->db->get();
                $sub_submenu = $query->result_array();

                foreach ($sub_submenu as $tree) {
                  echo '<li class="nav-item">';
                  echo '<a href="' . base_url() . $tree['url'] . '" class="nav-link" data-menu="' . $row['id_menu'] . '" data-submenu="' . $sub['id_submenu'] . '">';
                  echo '<i class="'. $sub['icon'] .'"></i>';
                  echo '<p>' . $tree['nama_sub_submenu'] . '</p>';
                  echo '</a></li>';
                }

                echo '</ul></li>';
              } else {
                echo '<li class="nav-item">';
                echo '<a href="' . base_url() . $sub['url'] . '" class="nav-link" '.$sub['opsi'].' data-menu="' . $row['id_menu'] . '">';
                echo '<i class="'. $sub['icon'] .'" ></i>';
                echo '<p>' . $sub['nama_submenu'] . '</p></a></li>';
              }
            }

            echo '</ul></li>';
          } else {
            echo '<li class="nav-item">';
            echo '<a href="' . base_url() . $row['url'] . '" class="nav-link" '.$row['opsi'].'>';
            echo '<i class="' . $row['icon_menu'] . ' nav-icon"></i>';
            echo '<p>' . $row['nama_menu'] . '</p></a></li>';
          }
        } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>