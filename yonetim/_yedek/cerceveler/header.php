<?php 
if (!defined("KORUMA")) {
 	header("Location: ../404.html");
	exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>YÖNETİM ANA EKRAN</title>

  <!-- Theme style -->
 

 


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
 
 <!-- Font Awesome -->
  <link rel="stylesheet" type="text/css"  href="fontawesome-free/css/all.css">
  

  
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="https://depo.bulutdanismanlik.com/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="https://depo.bulutdanismanlik.com/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="https://depo.bulutdanismanlik.com/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://depo.bulutdanismanlik.com/dist/css/adminlte.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="https://depo.bulutdanismanlik.com/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="https://depo.bulutdanismanlik.com/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote 
  <link rel="stylesheet" href="https://depo.bulutdanismanlik.com/plugins/summernote/summernote-bs4.min.css">-->

<link rel="stylesheet" href="https://depo.bulutdanismanlik.com/plugins/ekko-lightbox/ekko-lightbox.css">

 <link rel="stylesheet" href="https://depo.bulutdanismanlik.com/dist/ozelcss.css">


<!-- jQuery -->
<script src="https://depo.bulutdanismanlik.com/plugins/jquery/jquery.min.js"></script>


<script src="https://depo.bulutdanismanlik.com/dist/ckeditor/ckeditor.js"></script>

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="https://depo.bulutdanismanlik.com/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">



<?php

 if (isset($_GET['flashmessage'])) { 
 ?>
<script>
    $(document).ready(function(){
        $("#flashmessage").modal('show');
    });
</script>
<?php
 }
 ?>

<?php
 if (isset($_GET['onaymessage'])) { 
 ?>
<script>
    $(document).ready(function(){
        $("#onaymessage").modal('show');
    });
</script>
<?php
 }
 ?>

<?php
 if (isset($_GET['show-message-detail'])) { 
 ?>
<script>
    $(document).ready(function(){
        $("#show-message-detail").modal('show');
    });
</script>
<?php
 }
 ?>






 
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="default.php" class="nav-link">Anasayfa</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">TEST MENU</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
   


      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
   
      <li class="nav-item">
  <!-- Sidebar user panel (optional) -->

  <div class="input-group input-group-md">
                  <div class="">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                    <?php 
                      $profiladi=explode(" ", $firmaadi);
                     // echo $profiladi[0] .  " " . $profiladi[1] ; 
                     echo $firmaadi;
                    ?>
                    </button>
                    

                    <ul class="dropdown-menu list-group-flush"> 
                    <li>
  <a href="yoneticihesap.php" class="list-group-item"> Hesabım</a> </li>
 <li>
 <a href="#" class="list-group-item" role="button" data-toggle="modal" data-target="#modal-oturumkapat"> Oturumu Kapat</a> </li>
  
                
 
                  </ul>
                  
                  
                  </div>

</div>





    </li>




    </ul>
  </nav>
  <!-- /.navbar -->

 