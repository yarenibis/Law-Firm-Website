<?php
// BAŞLATICI ÇAĞIR 
include_once("_baslatici.php");

// HEADER SAYFASINI ÇAĞIR 
include_once("cerceveler/header.php");

// SİDEBAR SAYFASINI ÇAĞIR 
include_once("cerceveler/sidebar.php");

//////////////////////////////////////////////////////////////////////////////////







?>





  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Yönetici Hesabı Değiştirme</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
              <li class="breadcrumb-item active">Hesap Değiştirme</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
          <!-- left column -->
          <div class="col-md-6">

<?php
 // PAROLA DEĞİŞTİRME KODLARI


if ( isset($_POST['kaydet']) &&  isset($_POST['passwd']) &&  isset($_POST['newpass'])  &&  isset($_POST['newpass2'])) {
  
   //POST EDİLDİYSE BOŞ MU KONTROL ET 
    if( !empty($_POST['passwd']) && !empty($_POST['newpass'])   && !empty($_POST['newpass2'])    ) {


      // formdan al
      $passwd= $_POST['passwd']; 
      $newpass = $_POST['newpass'] ;
      $newpass2 = $_POST['newpass2'] ;

    // ESKİ ŞİFREYİ DOĞRU MU GİRDİ?
        $passkontrolstmt = $mysqli->prepare("SELECT passwd FROM yonetim WHERE id = ? LIMIT 1") ;
        $passkontrolstmt->bind_param('i', $adminid);  // username i ekle
        $passkontrolstmt->execute();    // çalıştır
        $passkontrolstmt->store_result();
        // veritabanı sorgusu sonuçtan değerleri çek
        $passkontrolstmt->bind_result($mevcutpass);
        $passkontrolstmt->fetch();
        
         

         // EĞER ŞİFRE DOĞRUYSA
        if ($mevcutpass == $passwd) {
        // YENİ GİRİLEN ŞİFRELER BİRBİRİNİ TUTUYOR MU
          if ($newpass == $newpass2) {

            // KALKIŞA HAZIRIZ, ŞİFRE GÜNCELLE
           $passupdatestmt = $mysqli->prepare("UPDATE yonetim SET passwd=? WHERE id=?");
           $passupdatestmt->bind_param('si', $newpass, $adminid);
           
           if ($passupdatestmt->execute()) {
            $hatamesaj="Parola Değiştirildi!";
           }
           else {
            $hatamesaj="Parola Güncellenemedi";
           }
                


 
          } //Yeni şifreler  ayn mı 
          else {
           $hatamesaj="Yeni Girdiğiniz Parolalar Birbirinin Aynı Değil";
          }
        } // vertabanı şifre kontrol bitiş
          else {
         $hatamesaj="Lütfen Eski Parolanızı Doğru Girin";
        }

     } // empty kontrol bitiş
    else {
      $hatamesaj="Lütfen Alanları Boş Bırakmayınız";
    }


  

}  //İSSET


?>

<?php if(isset($hatamesaj)) { 
// HATA MESAJI VARSA
?>
  <div class="alert alert-warning alert-dismissible">
           <h6><i class="icon fas fa-exclamation-triangle"></i>  
                  <?php echo $hatamesaj; ?> ! </h6>
              
  </div>
<?php } ?>





          <!-- FORM -->
 <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?php echo $adminname; ?> : İçin Parola Değiştir</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="POST">
                <div class="card-body">
                  
                  <div class="form-group">
                    <label for="InputPassword1">Eski Parolanız</label>
                    <input type="password" class="form-control" id="InputPassword1" placeholder="Eski Parolanız" required name="passwd">
                  </div>

                  <div class="form-group">
                    <label for="InputPassword2">Yeni Parola</label>
                    <input type="password" class="form-control" id="InputPassword2" placeholder="Yeni Parola" required  name="newpass">
                  </div>

                  <div class="form-group">
                    <label for="InputPassword3">Yeni Parola Tekrar</label>
                    <input type="password" class="form-control" id="InputPassword3" placeholder="Yeni Parola Tekrar" required name="newpass2">
                  </div>
               
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="kaydet">Parolamı Değiştir</button>
                </div>
              </form>
            </div>
            <!-- /FORM BİTİŞ -->





</div>
</div>





      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
  // FOOTER SAYFASINI ÇAĞIR 
    include_once("cerceveler/footer.php");
?>