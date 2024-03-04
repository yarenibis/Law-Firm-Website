<?php 
if (!defined("KORUMA")) {
 	header("Location: ../404.html");
	exit();
}
?>



<div class="modal fade" id="modal-oturumkapat">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Oturumu Kapat</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Oturumu Kapatmak Istediginize Emin Misiniz?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
              <a class="btn btn-primary" href="default.php?logout=LOGOUT" role="button">Oturumu Kapat</a>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


  <footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="https://www.onyazilim.com/" rel="nofollow" target="blank"> ON YAZILIM</a>.</strong>
    Her Hakkı Saklıdır.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 0.9
    </div>
  </footer>




<!-- Page specific script 
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>

-->



<!-- jQuery UI 1.11.4 -->
<script src="https://depo.bulutdanismanlik.com/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="https://depo.bulutdanismanlik.com/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="https://depo.bulutdanismanlik.com/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="https://depo.bulutdanismanlik.com/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="https://depo.bulutdanismanlik.com/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="https://depo.bulutdanismanlik.com/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="https://depo.bulutdanismanlik.com/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="https://depo.bulutdanismanlik.com/plugins/moment/moment.min.js"></script>
<script src="https://depo.bulutdanismanlik.com/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="https://depo.bulutdanismanlik.com/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="https://depo.bulutdanismanlik.com/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="https://depo.bulutdanismanlik.com/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="https://depo.bulutdanismanlik.com/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="https://depo.bulutdanismanlik.com/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="https://depo.bulutdanismanlik.com/dist/js/pages/dashboard.js"></script>


<!-- Ekko Lightbox -->
<script src="https://depo.bulutdanismanlik.com/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>



<!-- Page specific script -->
<script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })
</script>













<script src="https://depo.bulutdanismanlik.com/plugins/bs-custom-file-input/bs-custom-file-input.js"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>



<!-- SweetAlert2 -->
<script src="https://depo.bulutdanismanlik.com/plugins/sweetalert2/sweetalert2.min.js"></script>









<script>

  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000
    });

<?php /// TOASTER MESAJLARI
      if(isset($toaster))
      {
       // SAYFA AÇILINCA TOASTER
        // ÖRNEK:   $toaster['success'] = "Başarıldı"
      foreach ($toaster as $toasttur => $toastdeger) {  
       }
?>

 $( document ).ready(function() {
      Toast.fire({
        icon: '<?php echo $toasttur; ?>',
        title: '<?php echo $toastdeger; ?>'
      })
    });

<?php
}
?>



    $('.TostKopyalandi').click(function() {
      Toast.fire({
        icon: 'info',
        title: 'Link Kopyalandı'
      })
    });



    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });





    $('.swalDefaultError').click(function() {
      Toast.fire({
        icon: 'error',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultWarning').click(function() {
      Toast.fire({
        icon: 'warning',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultQuestion').click(function() {
      Toast.fire({
        icon: 'question',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });

  });
</script>




</body>
</html>
