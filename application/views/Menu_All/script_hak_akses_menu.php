<!-- jQuery -->
<script src="<?php echo base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url('assets/'); ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/'); ?>js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/'); ?>js/demo.js"></script>
<!-- Toastr -->
  <script src="<?php echo base_url('assets/'); ?>plugins/toastr/toastr.min.js"></script>
<script>
	    $(document).ready(function() {
        $('.list_menu').change(function() {
            if ($(this).is(":checked")) {
                notifikasi = '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fas fa-check"></i> Berhasil!</h5>Hak Akses Telah Ditambah';

                var user = $('#form_kelola_hak_akses').find('#username').val();
                var privi = $('#form_kelola_hak_akses').find('#privilege').val();
                var tambah = $(this).val();

                $.ajax({
                    url: "<?php echo base_url('admin/tambahhak') ?>/",
                    method: "POST",
                    data: {
                        username: user,
                        tambah: tambah,
                        privilage: privi
                    },

                    success: function(data) {

                        $(".alert").html(notifikasi);
                        $(".alert").addClass('alert-success alert-dismissible');
                        $(".alert").fadeIn();
                        setTimeout(function() {
                            $(".alert").fadeOut();
                        }, 2000);
                    }

                });
            } else {
                notifikasi = '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fas fa-check"></i> Berhasil!</h5>Hak Akses Telah Dihapus';
                var user = $('#form_kelola_hak_akses').find('#username').val();
                var privi = $('#form_kelola_hak_akses').find('#privilege').val();
                var hapus = $(this).val();

                $.ajax({
                    url: "<?php echo base_url('admin/hapushak') ?>/",
                    method: "POST",
                    data: {
                        username: user,
                        privilage: privi,
                        hapus: hapus
                    },

                    success: function(data) {
                        $('input[data-menu=' + hapus + ']').prop('checked', false);
                        $(".alert").html(notifikasi);
                        $(".alert").addClass('alert-success alert-dismissible');
                        $(".alert").fadeIn();
                        setTimeout(function() {
                            $(".alert").fadeOut();
                        }, 2000);
                    }
                });
            }
        });

        $('.list_submenu').change(function() {
            if ($(this).is(":checked")) {
                notifikasi = '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fas fa-check"></i> Berhasil!</h5>Hak Akses Telah Ditambah';

                var user = $('#form_kelola_hak_akses').find('#username').val();
                var privi = $('#form_kelola_hak_akses').find('#privilege').val();
                var id_submenu = $(this).val();
                var id_menu = $(this).data('menu')

                $.ajax({
                    url: "<?php echo base_url('admin/tambahhaksub') ?>/",
                    method: "POST",
                    data: {
                        username: user,
                        privilage: privi,
                        id_submenu: id_submenu,
                        id_menu: id_menu
                    },

                    success: function(data) {

                        $(".alert").html(notifikasi);
                        $(".alert").addClass('alert-success alert-dismissible');
                        $(".alert").fadeIn();
                        setTimeout(function() {
                            $(".alert").fadeOut();
                        }, 2000);
                    }

                });
            } else {
                notifikasi = '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fas fa-check"></i> Berhasil!</h5>Hak Akses Telah Dihapus';
                var user = $('#form_kelola_hak_akses').find('#username').val();
                var privi = $('#form_kelola_hak_akses').find('#privilege').val();
                var id_submenu = $(this).val();
                var id_menu = $(this).data('menu')

                $.ajax({
                    url: "<?php echo base_url('admin/hapushaksub') ?>/",
                    method: "POST",
                    data: {
                        username: user,
                        privilage: privi,
                        id_submenu: id_submenu,
                        id_menu: id_menu
                    },

                    success: function(data) {
                        $('input[data-submenu=' + id_submenu + ']').prop('checked', false);
                        $(".alert").html(notifikasi);
                        $(".alert").addClass('alert-success alert-dismissible');
                        $(".alert").fadeIn();
                        setTimeout(function() {
                            $(".alert").fadeOut();
                        }, 2000);
                    }
                });
            }
        });

        $('.list_sub_submenu').change(function() {
            if ($(this).is(":checked")) {
                notifikasi = '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fas fa-check"></i> Berhasil!</h5>Hak Akses Telah Ditambah';

                var user = $('#form_kelola_hak_akses').find('#username').val();
                var privi = $('#form_kelola_hak_akses').find('#privilege').val();
                var id_sub_submenu = $(this).val();
                var id_submenu = $(this).data('submenu');

                $.ajax({
                    url: "<?php echo base_url('admin/tambahhaksubsub') ?>/",
                    method: "POST",
                    data: {
                        username: user,
                        privilage: privi,
                        id_sub_submenu: id_sub_submenu,
                        id_submenu: id_submenu
                    },

                    success: function(data) {

                        $(".alert").html(notifikasi);
                        $(".alert").addClass('alert-success alert-dismissible');
                        $(".alert").fadeIn();
                        setTimeout(function() {
                            $(".alert").fadeOut();
                        }, 2000);
                    }

                });
            } else {
                notifikasi = '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fas fa-check"></i> Berhasil!</h5>Hak Akses Telah Dihapus';
                var user = $('#form_kelola_hak_akses').find('#username').val();
                var privi = $('#form_kelola_hak_akses').find('#privilege').val();
                var id_sub_submenu = $(this).val();
                var id_submenu = $(this).data('submenu');

                $.ajax({
                    url: "<?php echo base_url('admin/hapushaksubsub') ?>/",
                    method: "POST",
                    data: {
                        username: user,
                        privilage: privi,
                        id_sub_submenu: id_sub_submenu,
                        id_submenu: id_submenu
                    },

                    success: function(data) {

                        $(".alert").html(notifikasi);
                        $(".alert").addClass('alert-success alert-dismissible');
                        $(".alert").fadeIn();
                        setTimeout(function() {
                            $(".alert").fadeOut();
                        }, 2000);
                    }
                });
            }
        });
    });

    function kelola_hak_akses(id,prv) {


        $('#form_kelola_hak_akses').find('#username').val(id);
        $('#form_kelola_hak_akses').find('#privilege').val(prv);

        $("#form_kelola_hak_akses").find(".list_menu").prop('checked', false);
        $("#form_kelola_hak_akses").find(".list_submenu").prop('checked', false);
        $("#form_kelola_hak_akses").find(".list_sub_submenu").prop('checked', false);

        $.ajax({
            url: "<?php echo base_url('admin/hakaksesmenu') ?>/" + id +"/" + prv ,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                if (data.length > 0) {
                    for (i = 0; i < data.length; i++) {
                        $('#form_kelola_hak_akses').find('#menu' + data[i].id_menu).prop("checked", true);
                    }
                }
            },
        });

        $.ajax({
            url: "<?php echo base_url('admin/hakaksessubmenu') ?>/" + id +"/" + prv,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                if (data.length > 0) {
                    for (i = 0; i < data.length; i++) {
                        $('#form_kelola_hak_akses').find('#submenu' + data[i].id_submenu).prop("checked", true);
                    }
                }
            },
        });

        $.ajax({
            url: "<?php echo base_url('admin/hakaksessubsubmenu') ?>/" + id +"/" + prv,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                if (data.length > 0) {
                    for (i = 0; i < data.length; i++) {
                        $('#form_kelola_hak_akses').find('#sub_submenu' + data[i].id_sub_submenu).prop("checked", true);
                    }
                }
            },
        });

        $.ajax({
            url: "<?php echo base_url('admin/carirole') ?>/" + id +"/" + prv,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                if (data.length > 0) {
                    $('#form_kelola_hak_akses').find('#id_role').val(data[0].privilage);
                    $('#form_kelola_hak_akses').find('#kode_desa').val(data[0].username);
                }

            },
        });

        $('#modal_hak_akses').modal('show');
        $('.modal-title').text('Ubah Hak Akses');
    }

	var table;
    $(document).ready(function() {
        //datatables
        table = $('#data_user').DataTable({ 
 			"responsive": true,
      		"lengthChange": false, 
      		"autoWidth": false,
      		dom: 'Bfrtip',
     		"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('admin/kelhas')?>",
                "type": "POST"
            },
             
            "columnDefs": [
            { 
                "targets": [ -1 ], 
                "orderable": false,
                "data": null,
                "mRender" : function(data, type, full){
                	return '<button class="btn btn-sm btn-warning text-white" onclick=kelola_hak_akses("'+full[1]+'","'+full[2]+'") title="Edit Data"><i class="fas fa-cogs"></i></button>';
                }
            }]
 
        }).buttons().container().appendTo('#data_user_wrapper .col-md-6:eq(0)');

    });

</script>