
<!-- jQuery -->
<script src="<?php echo base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/'); ?>js/adminlte.min.js"></script>
<!-- Toastr -->
 <script src="<?php echo base_url('assets/'); ?>plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- file input -->
<script src="<?php echo base_url('assets/'); ?>plugins/fileinput/js/piexif.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/fileinput/js/sortable.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/fileinput/js/purify.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/fileinput/fileinput.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/fileinput/fa/theme.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/fileinput/fas/theme.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/fileinput/explorer-fas/theme.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url('assets/'); ?>plugins/jsqrcode/grid.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/'); ?>plugins/jsqrcode/version.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/'); ?>plugins/jsqrcode/detector.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/'); ?>plugins/jsqrcode/formatinf.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/'); ?>plugins/jsqrcode/errorlevel.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/'); ?>plugins/jsqrcode/bitmat.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/'); ?>plugins/jsqrcode/datablock.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/'); ?>plugins/jsqrcode/bmparser.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/'); ?>plugins/jsqrcode/datamask.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/'); ?>plugins/jsqrcode/rsdecoder.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/'); ?>plugins/jsqrcode/gf256poly.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/'); ?>plugins/jsqrcode/gf256.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/'); ?>plugins/jsqrcode/decoder.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/'); ?>plugins/jsqrcode/qrcode.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/'); ?>plugins/jsqrcode/findpat.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/'); ?>plugins/jsqrcode/alignpat.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/'); ?>plugins/jsqrcode/databr.js"></script>
<script>
async function see() {
	const video = document.getElementById('video-preview');
  	const qrCanvasElement = document.getElementById('qr-canvas');
	qrCanvasElement.classList.add('hidden');
    video.classList.remove('hidden');
  try {
    /* Ask for "environnement" (rear) camera if available (mobile),
     * will fallback to only available otherwise (desktop).
     * User will be prompted if (s)he allows camera to be started */
    const stream = await navigator.mediaDevices.getUserMedia({
      video: {
        facingMode: "environment",
      },
      audio: false,
    });
    const video = document.getElementById("video-preview");
    video.srcObject = stream;
    video.setAttribute("playsinline", true); /* otherwise iOS safari starts fullscreen */
    video.play();
    setTimeout(tick, 100); /* We launch the tick function 100ms later (see next step) */
  } catch(err) {
    console.log(err); /* User probably refused to grant access*/
  };
};

function tick() {
  const video = document.getElementById('video-preview');
  const qrCanvasElement = document.getElementById('qr-canvas');
  const qrCanvas = qrCanvasElement.getContext('2d');
  let width;
  let height;

  if (video.readyState === video.HAVE_ENOUGH_DATA) {
    qrCanvasElement.height = video.videoHeight;
    qrCanvasElement.width = video.videoWidth;
    qrCanvas.drawImage(video, 0, 0, qrCanvasElement.width, qrCanvasElement.height);

    try {
      const result = qrcode.decode();
      if (result !== "") {
          		$.ajax({
                    url: "<?php echo base_url('operator99/getitembycode') ?>/",
                    method: "POST",
                    data: {
                        idbr: result
                    },
                    dataType:"json",
                    success: function(data) {
                     $.each(data,function(pesan,nama,kode,berat){
		        	if (data.pesan.match(/alert-danger.*/)){
                        setTimeout(function () { $("#loadings").modal("hide"); }, 500);
                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.pesan);
                      }else{
                      	video.pause();
				        video.src = '';
				        video.srcObject.getVideoTracks().forEach(track => track.stop());

				      /* Display Canvas and hide video stream */
				        qrCanvasElement.classList.remove('hidden');
				        video.classList.add('hidden');
                        setTimeout(function () { $("#loadings").modal("hide"); }, 500);
                      	$('[name="kodebahan"]').val(data.kode);
                      	$('[name="deskripsi"]').val(data.nama);
                      	$('[name="beratmaterial"]').val(data.berat);
                      	//$('[name="itemid"]').val(data.idr);
                      	$('#databarcode').modal('show');
                        $('#pops').html("");
                        $('#importgbrbarcode').modal('hide');
                      }
		        	   })
                }

    		});
      }
    } catch(e) {
      /* No Op */
    }
  }

  /* If no QR could be decoded from image copied in canvas */
  if (!video.classList.contains('hidden'))
    setTimeout(tick, 100);
}

async function see2() {
	const video = document.getElementById('video-preview');
  	const qrCanvasElement = document.getElementById('qr-canvas');
	qrCanvasElement.classList.add('hidden');
    video.classList.remove('hidden');
  try {
    /* Ask for "environnement" (rear) camera if available (mobile),
     * will fallback to only available otherwise (desktop).
     * User will be prompted if (s)he allows camera to be started */
    const stream = await navigator.mediaDevices.getUserMedia({
      video: {
        facingMode: "environment",
      },
      audio: false,
    });
    const video = document.getElementById("video-preview");
    video.srcObject = stream;
    video.setAttribute("playsinline", true); /* otherwise iOS safari starts fullscreen */
    video.play();
    setTimeout(ticks2, 100); /* We launch the tick function 100ms later (see next step) */
  } catch(err) {
    console.log(err); /* User probably refused to grant access*/
  };
};

function ticks2() {
  const video = document.getElementById('video-preview');
  const qrCanvasElement = document.getElementById('qr-canvas');
  const qrCanvas = qrCanvasElement.getContext('2d');
  let width;
  let height;

  if (video.readyState === video.HAVE_ENOUGH_DATA) {
    qrCanvasElement.height = video.videoHeight;
    qrCanvasElement.width = video.videoWidth;
    qrCanvas.drawImage(video, 0, 0, qrCanvasElement.width, qrCanvasElement.height);

    try {
      const result2 = qrcode.decode();
      if (result2 !== "") {
          		$.ajax({
                    url: "<?php echo base_url('operator99/getitembycode') ?>/",
                    method: "POST",
                    data: {
                        idbr: result2
                    },
                    dataType:"json",
                    success: function(data) {
                     $.each(data,function(pesan,nama,kode,berat){
		        	if (data.pesan.match(/alert-danger.*/)){
                        setTimeout(function () { $("#loadings").modal("hide"); }, 500);
                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.pesan);
                      }else{
                      	video.pause();
				        video.src = '';
				        video.srcObject.getVideoTracks().forEach(track => track.stop());

				      /* Display Canvas and hide video stream */
				        qrCanvasElement.classList.remove('hidden');
				        video.classList.add('hidden');
                        setTimeout(function () { $("#loadings").modal("hide"); }, 500);
                        setTimeout(function () {$('#importgbrbarcodemasuk').modal('hide'); },500);
                      	$('[name="kodebahan2"]').val(data.kode);
                      	$('[name="deskripsi2"]').val(data.nama);
                      	$('[name="beratmaterial2"]').val(data.berat);
                      	//$('[name="itemid2"]').val(data.idr);
                      	$('#databarcode2').modal('show');
                        $('#pops').html("");
                        
                      }
		        	   })
                }

    		});
      }
    } catch(e) {
      /* No Op */
    }
  }

  /* If no QR could be decoded from image copied in canvas */
  if (!video.classList.contains('hidden'))
    setTimeout(ticks2, 100);
}


$("#fotobarcode").fileinput({
                theme: 'fas',
                showUpload: false,
                allowedFileExtensions: ["jpeg","png","jpg"],
                maxImageWidth: 260,
			    maxImageHeight: 260,
			    resizePreference: 'height',
			    maxFileCount: 1,
			    resizeImage: true,
			    resizeIfSizeMoreThan: 1000
        });
		
		$(document).ready(function () {
          $("#simpanmasukanrm").click(function (event) {
              event.preventDefault();
              var form = $('#importformbarcodekonfirm')[0];
              var data = new FormData(form);
              $.ajax({
                  type: "POST",
                  enctype: 'multipart/form-data',
                  url: "<?php echo base_url('operator99/getitembycode'); ?>",
                  data: data,
                  processData: false,
                  contentType: false,
                  cache: false,
                  timeout: 600000,
                  dataType:"json",
                  success: function (data) {
                    $.each(data,function(pesan,parameter){
                      if (data.pesan.match(/dataerror.*/)){
                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.parameter);
                      }else{
                      	document.getElementById('importformbarcodekonfirm').reset();
                      	$('#databarcode').modal('hide');
                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.parameter);
                      }
                      
                  })
                  }
              });

          });
       });

		$(document).ready(function () {
          $("#simpanmasukanrm2").click(function (event) {
              event.preventDefault();
              var form = $('#importformbarcodekonfirm2')[0];
              var data = new FormData(form);
              $.ajax({
                  type: "POST",
                  enctype: 'multipart/form-data',
                  url: "<?php echo base_url('operator99/getitembycode'); ?>",
                  data: data,
                  processData: false,
                  contentType: false,
                  cache: false,
                  timeout: 600000,
                  dataType:"json",
                  success: function (data) {
                    $.each(data,function(pesan,parameter){
                      if (data.pesan.match(/dataerror.*/)){
                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.parameter);
                      }else{
                      	document.getElementById('importformbarcodekonfirm2').reset();
                      	$('#databarcode2').modal('hide');
                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.parameter);
                      }
                      
                  })
                  }
              });

          });
       });

       //  $(document).ready(function () {
       //    $("#importbarcodekonfirm").click(function (event) {
       //    	  $('#loadings').modal('show');
       //        event.preventDefault();
       //        var form = $('#importformbarcode')[0];
       //        var data = new FormData(form);
       //        $.ajax({
       //            type: "POST",
       //            enctype: 'multipart/form-data',
       //            url: "<?php echo base_url('warehouserm/decodebarcode'); ?>",
       //            data: data,
       //            processData: false,
       //            contentType: false,
       //            cache: false,
       //            timeout: 600000,
       //            dataType:"json",
       //            success: function (data) {
       //              $.each(data,function(pesan,nama,kode,idr,berat){
       //                if (data.pesan.match(/alert-danger.*/)){
       //                	setTimeout(function () { $("#loadings").modal("hide"); }, 500);
       //                  $('#popupvalidate').modal('show');
       //                  $('#pops').html(data.pesan);
       //                }else{
       //                	setTimeout(function () { $("#loadings").modal("hide"); }, 500);
       //                	$('[name="kodebahan"]').val(data.kode);
       //                	$('[name="deskripsi"]').val(data.nama);
       //                	$('[name="beratmaterial"]').val(data.berat);
       //                	$('[name="itemid"]').val(data.idr);
       //                	$('#databarcode').modal('show');
       //                  $('#pops').html("");
       //                  $('#importgbrbarcode').modal('hide');
       //                  $('#fotobarcode').fileinput('clear');
                        
       //                }
                      
       //            })
       //            }
       //        });

       //    });
       // });

       //  function dismissmodal()
       //  {
       //  	$('#loadings').modal('hide');
       //  }


</script>
</body>
</html>