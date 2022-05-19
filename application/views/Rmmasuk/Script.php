<!-- jQuery -->
<script src="<?php echo base_url('assets'); ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url('assets'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- PAGE PLUGINS -->
<!-- date-range-picker -->
<script src="<?php echo base_url('assets'); ?>/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url('assets'); ?>/plugins/daterangepicker/daterangepicker.js"></script>

<!-- DataTables  & Plugins -->
<script src="<?php echo base_url('assets'); ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets'); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets'); ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url('assets'); ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets'); ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url('assets'); ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets'); ?>/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url('assets'); ?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url('assets'); ?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url('assets'); ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url('assets'); ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url('assets'); ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- overlayScrollbars -->
<script src="<?php echo base_url('assets'); ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets'); ?>/dist/js/adminlte.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets'); ?>/dist/js/demo.js"></script>
<!-- Toastr -->
 <script src="<?php echo base_url('assets/'); ?>plugins/toastr/toastr.min.js"></script>
<!-- MQTT JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js" type="text/javascript"></script>
<!-- Select2 -->
<script src="<?php echo base_url('assets/'); ?>plugins/select2/js/select2.full.min.js"></script>

<script>

var a = "<?php echo getHostByName(getHostName()); ?>";
var b = 9001;
let c = Math.random();
    // Create a client instance
client = new Paho.MQTT.Client(a, Number(b), "'"+c+"'");

// set callback handlers
client.onConnectionLost = onConnectionLost;
client.onMessageArrived = onMessageArrived;

// connect the client
client.connect({onSuccess:onConnect});


// called when the client connects
function onConnect() {
  // Once a connection has been made, make a subscription and send a message.
  console.log("onConnect");
  client.subscribe("dimas");
//  message = new Paho.MQTT.Message("tester");
//  message.destinationName = "dimas";
//  client.send(message);
}

// called when the client loses its connection
function onConnectionLost(responseObject) {
  if (responseObject.errorCode !== 0) {
    console.log("onConnectionLost:"+responseObject.errorMessage);
  }
}

 // called when a message arrives
function onMessageArrived(message) {
  if (message.payloadString == 'scanner update'){
  console.log("onMessageArrived:"+message.payloadString);
 // table.ajax.reload();
  }else if(message.payloadString == 'data rmmpi masuk'){
    tabless.ajax.reload();
  }
}

  $('#rmmasukfilter').daterangepicker({
           // endDate: moment().add(1,'days')
         }, function(start, end, label) {
            tabless.ajax.reload();

         //    console.log(start.format('YYYY-MM-DD') + "#start#" + end.format('YYYY-MM-DD')+ "#start#");
        });


        //get data rm masuk
    $(document).ready( function () {
       window.tabless = $('#rmmasuk').DataTable({ 
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?php echo base_url('rmmasuk/loadrmmasuk')?>",
            "type": "POST",
            "data" : function(d){ d.datefilter = $('#rmmasukfilter').data('daterangepicker').startDate.format('YYYY-MM-DD')+"#start#"+$('#rmmasukfilter').data('daterangepicker').endDate.format('YYYY-MM-DD')+"#start#" }
        },
        "columnDefs": [
            {
                "targets":  2, 
                "mRender" : function(data, type, full){ return full[2]; }
            },
            {
                "targets":  3,
                "mRender" : function(data, type, full){ return full[3]; }
            },
            {
                "targets":  4,
                "mRender" : function(data, type, full){ return full[4]; }
            },
            {
                "targets":  5,
                "mRender" : function(data, type, full){ return full[5]; }
            },

            { 
                "targets": [ -1 ], 
                "orderable": false,
                "data": null,
                "mRender" : function(data, type, full){
                    return '<tr><td><button class="btn btn-sm btn-danger text-white" onclick=hapusrmmasuk("'+full[9]+'"); title="Hapus Item"><i class="fa fa-trash"></i></button></td></tr>';
                }
            }],
       dom : 'Bfrtip',
        "buttons": [{
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [':visible' ]
                }
            },{
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [':visible' ]
                }
            },{
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [':visible' ]
                }
            },{
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [':visible' ]
                }
            },{
                extend: 'print',
                exportOptions: {
                    columns: [':visible' ]
                }
            }, "colvis"]
    });
  });

    //get data add 
$(document).ready( function () {
       window.table2 = $('#barcoder').DataTable({ 
       "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?php echo base_url('rmmasuk/getadddatarm')?>",
            "type": "POST"
        },
        "columnDefs": [
            {
                "targets":  2, 
                "mRender" : function(data, type, full){ return full[2]; }
            },
            {
                "targets":  3,
                "mRender" : function(data, type, full){ return full[3]; }
            },
            {
                "targets":  4,
                "mRender" : function(data, type, full){ return full[4]; }
            },
            {
                "targets":  5,
                "mRender" : function(data, type, full){ return full[5]; }
            },

            { 
                "targets": [ -1 ], 
                "orderable": false,
                "data": null,
                "mRender" : function(data, type, full){
                    return '<tr><td><button class="btn btn-sm btn-danger text-white" onclick=hapusadditem("'+full[6]+'"); title="Hapus Item"><i class="fa fa-trash"></i></button></td></tr>';
                }
            }]
    });
  });

function hapusrmmasuk(idi)
    {
        $data = confirm('Hapus Item Ini?');
        if ($data == true){
        $.ajax({
                  type: "POST",
                  url: "<?php echo base_url(); ?>rmmasuk/hapusrmmasuk",
                  data: {id : idi},
                  dataType:"json",
                  success: function (data) {
                    $.each(data,function(pesan){
                      if (data.pesan.match(/alert-danger.*/)){

                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.pesan);
                       
                      }else{
    
                        $('#rmmasuk').DataTable().ajax.reload();
                       // $('#popupvalidate').modal('show');
                       // $('#pops').html(data.pesan);

                      }  
                  })
                  }
              });
        }else{

        }
    }

    function hapusadditem(idi)
    {
        $data = confirm('Hapus Item Ini?');
        if ($data == true){
        $.ajax({
                  type: "POST",
                  url: "<?php echo base_url(); ?>rmmasuk/hapusadditemrm",
                  data: {id : idi},
                  dataType:"json",
                  success: function (data) {
                    $.each(data,function(pesan){
                      if (data.pesan.match(/alert-danger.*/)){

                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.pesan);
                       
                      }else{
    
                        $('#barcoder').DataTable().ajax.reload();
                       // $('#popupvalidate').modal('show');
                       // $('#pops').html(data.pesan);

                      }  
                  })
                  }
              });
        }else{

        }
    }

    //select ajax
$(document).ready(function(){

 $("#selUser").select2({
  ajax: { 
   url: "<?php echo base_url('rmmasuk/select2getrm') ?>",
   type: "post",
   dataType: 'json',
   delay: 250,
   data: function (params) {
    return {
      searchTerm: params.term // search term
    };
   },
   processResults: function (response) {
     return {
        results: response
     };
   },
   cache: true
  }
 });
});


    $(document).ready(function () {

        $("#printthisbarcode").click(function (event){
            window.open('<?php echo base_url('rmmasuk/printbarcoderm'); ?>','_blank');
         })

          $("#senddata").click(function (event) {
              event.preventDefault();
              var form = $('#addbarcodeqrcode')[0];
              var data = new FormData(form);
              $.ajax({
                  type: "POST",
                  enctype: 'multipart/form-data',
                  url: "<?php echo base_url('rmmasuk/addbarcoderm'); ?>",
                  data: data,
                  processData: false,
                  contentType: false,
                  cache: false,
                  timeout: 600000,
                  dataType:"json",
                  success: function (data) {
                    $.each(data,function(pesan){
                      if (data.pesan.match(/alert-danger.*/)){
                        
                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.pesan);
                      }else{
                        table2.ajax.reload();
                        $('#addjumlah').val(''); 
                        $('#selUser').val(null).trigger('change');
                        $('#databaradd').modal('hide');
                       // $('#popupvalidate').modal('show');
                        $('#pops').html(data.pesan);
                      }
                      
                  })
                  }
              });

          });
       });



</script>