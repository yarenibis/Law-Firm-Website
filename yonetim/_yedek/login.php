<?php
/*
ob_start();
session_start();
define("KORUMA", null);
// GEREKLİLERİ ÇEK
include_once('gerekli/ayarlar.php');
include_once ('gerekli/db_baglan.php');
include_once ('gerekli/fonksiyonlar.php');

/// LOGIN CHECK////////////////////
// LOGIN OLDUYSA
if (login_kontrol($mysqli) == true) {
  $logged = 1;
 // index.php ye gönder
  $adminname= $_SESSION['adminname'];
  $adminid= $_SESSION['adminid'];

	header("Location: default.php"); 
} else {
    $logged = 0;
    $hatamesaj= "Giriş Yapmanız Gerekmektedir";
}
////////////////////////////////////////
*/



?>




<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>YÖNETİM EKRANI</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://depo.bulutdanismanlik.com/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="https://depo.bulutdanismanlik.com/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://depo.bulutdanismanlik.com/dist/css/adminlte.css">
</head>
<body class="hold-transition login-page">

<div class="login-box">




  <div class="login-logo">
   
<?php 
 
  // LOGIN KONTROL 
  if ( isset($_POST['username']) &&  isset($_POST['passwd'])    ) {

    //POST EDİLDİYSE BOŞ MU KONTROL ET 
    if( !empty($_POST['username']) && !empty($_POST['passwd']) ) {
      
      // formdan al
      $username= $_POST['username']; 
      $passwd = $_POST['passwd']; 
    
      // ŞİMDİ LOGIN FONKSİYONU İLE LOGIN KONTROL
      if (login($username,$passwd , $mysqli, 'yonetim') == TRUE) {
        // Login BAŞARILI
        echo "GİRİŞ BAŞARILI";
          // index.php ye yönlendir
          header('Location:default.php');
        } else {
          $hatamesaj= "GİRİŞ BAŞARISIZ";
        }
    }
    else
    {
      $hatamesaj= "FORMU BOŞ BIRAKMAYINIZ";
    }
    
  } 
    
?>
 

 <?php if(isset($hatamesaj)) { 
// HATA MESAJI VARSA
?>
  <div class="alert alert-warning alert-dismissible">
           <h6><i class="icon fas fa-exclamation-triangle"></i>  
                  <?php echo $hatamesaj; ?> ! </h6>
              
  </div>
<?php } ?>





  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Yönetim Ekranı</p>

      <form action="default.php" method="post">
        <div class="input-group mb-3">
          <input type="name" class="form-control" placeholder="Kullanıcı Adı" name="username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Şifre" name="passwd" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="giris">Giriş</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


    </div>
    <!-- /.login-card-body -->

  </div>
</div>
<!-- /.login-box -->



<!-- jQuery -->
<script src="https://depo.bulutdanismanlik.com/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://depo.bulutdanismanlik.com/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://depo.bulutdanismanlik.com/dist/js/adminlte.min.js"></script>
</body>
</html>
