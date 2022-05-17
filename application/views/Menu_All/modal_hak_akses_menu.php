<!-- MODAL HAK AKSES -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal_hak_akses">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" id="form_kelola_hak_akses">
          <div class="card-body">
            <div id="keterangan_role">
              <input type="text" id="privilege" name="privilege" hidden>
              <input type="text" id="username" name="username" hidden>
            </div>
            <?php foreach ($menu as $row_menu) {
            ?>

              <div class="row" id="menu_utama">
                <div class="col-12">
                  <div class="mt-1" style="background: none; border:none;">
                    <div class="icheck-success d-inline">
                      <input type="checkbox" class="list_menu" id="menu<?= $row_menu['id_menu']; ?>" value="<?= $row_menu['id_menu']; ?>">
                      <label for="menu<?= $row_menu['id_menu']; ?>"><?= $row_menu['nama_menu']; ?></label>
                    </div>
                  </div>

                  <?php
                  $id_menu = $row_menu['id_menu'];
                  $this->db->from('menu_sub_menu');
                  $this->db->where('id_menu', $id_menu);
                  $this->db->where('status', 1);
                  $this->db->order_by('id_submenu', "ASC");
                  $query = $this->db->get();
                  $submenu = $query->result_array();
                  ?>

                  <?php foreach ($submenu as $row_submenu) {
                  ?>
                    <div class="row" id="sub_menu">
                      <div class="col-12">
                        <div class="mt-1 ml-5" style="background: none; border:none;">
                          <div class="icheck-success d-inline">
                            <input type="checkbox" class="list_submenu" id="submenu<?= $row_submenu['id_submenu'] ?>" value="<?= $row_submenu['id_submenu'] ?>" data-menu="<?= $row_menu['id_menu']; ?>">
                            <label for="submenu<?= $row_submenu['id_submenu'] ?>"><?= $row_submenu['nama_submenu'] ?></label>
                          </div>
                        </div>

                        <?php
                        $id_submenu = $row_submenu['id_submenu'];
                        $this->db->from('menu_sub_submenu');
                        $this->db->where('id_submenu', $id_submenu);
                        $this->db->where('status', 1);
                        $this->db->order_by('id_sub_submenu', "ASC");
                        $query2 = $this->db->get();
                        $sub_submenu = $query2->result_array();
                        ?>

                        <?php foreach ($sub_submenu as $row_submenu2) {
                        ?>
                          <div class="row" id="sub_menu2">
                            <div class="col-12">
                              <div class="mt-1" style="background: none; border:none; margin-left:100px;">
                                <div class="icheck-success d-inline">
                                  <input type="checkbox" class="list_sub_submenu" id="sub_submenu<?= $row_submenu2['id_sub_submenu'] ?>" value="<?= $row_submenu2['id_sub_submenu'] ?>" data-submenu="<?= $row_submenu['id_submenu']; ?>" data-menu="<?= $row_menu['id_menu']; ?>">
                                  <label for="sub_submenu<?= $row_submenu2['id_sub_submenu'] ?>"><?= $row_submenu2['nama_sub_submenu'] ?></label>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>
            <?php } ?>

          </div>
          <!-- /.card-body -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
      </div>
    </div>
  </div>
</div>
<!-- AKHIR MODAL HAK AKSES --> 
