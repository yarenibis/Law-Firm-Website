<?php
// BAŞLATICI ÇAĞIR 
include_once("_baslatici.php");

// HEADER SAYFASINI ÇAĞIR 
include_once("cerceveler/header.php");

// SİDEBAR SAYFASINI ÇAĞIR 
include_once("cerceveler/sidebar.php");

//////////////////////////////////////////////////////////////////////////////////


if(isset($_GET['action'])) {
    $action=$_GET['action'] ;
}
else $action="";

//////////////////////////////////////////////////////////////////
//////////////////   SİTE İLETİŞİM KAYDET   ////////////////////////////

if(isset($_POST['iletisimkaydet'])){

 $iletisimyetkili= $_POST['yetkili'];
 $iletisimfirma= $_POST['firma'];
 $iletisimsabittel= $_POST['sabittel'];
 $iletisimceptel= $_POST['ceptel'];
 $iletisimfax= $_POST['fax'];
 $iletisimadres= $_POST['adres'];
 $iletisimeposta= $_POST['eposta'];
 $iletisimfacebook= $_POST['facebook'];
 $iletisimtwitter= $_POST['twitter'];
 $iletisiminstagram= $_POST['instagram'];
 $iletisimyoutube= $_POST['youtube'];
 $iletisimgoogle= $_POST['google'];
 $iletisimmaps= $_POST['maps'];
 $iletisimkonum= $_POST['konum'];
 $iletisimsaatler= $_POST['saatler'];

 $iletisimsql = "UPDATE iletisim_bilgileri SET
      yetkili='$iletisimyetkili', firma='$iletisimfirma', sabit='$iletisimsabittel', cep='$iletisimceptel', fax='$iletisimfax',
      adres='$iletisimadres', eposta='$iletisimeposta', facebook='$iletisimfacebook', twitter='$iletisimtwitter', instagram='$iletisiminstagram',
      youtube='$iletisimyoutube', google='$iletisimgoogle', maps='$iletisimmaps', calisma_saatleri='$iletisimsaatler', konum='$iletisimkonum'
      LIMIT 1";
          if ($mysqli->query($iletisimsql) === TRUE) {
                    $toaster['info'] = " Kayıt Güncellendi...";
                  } else {
                    echo "Error: " . $sql . "<br>" . $mysqli->error;
                  }
}

//////////////////////////////////////////////////

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Site Genel Ayarları</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Anasayfa</a></li>
              <li class="breadcrumb-item active">.</li>
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
          <div class="col-12 col-sm-6">
           


<?php

    // İLETİSİM BİLGİLERİNİ ÇEK
  $stmt_iletisim = $mysqli->prepare("SELECT 
    yetkili, firma, sabit, cep, fax, adres, eposta, facebook, twitter, instagram, youtube, google, maps, calisma_saatleri,  konum
     FROM iletisim_bilgileri LIMIT 1") ;
  $stmt_iletisim->execute();    // çalıştır
  $stmt_iletisim->store_result();
        // veritabanı sorgusu sonuçtan değerleri çek
  $stmt_iletisim->bind_result($yetkili, $firma, $sabittel, $ceptel, $faxno, $adres, $eposta,
   $facebook, $twitter, $instagram, $youtube, $google, $maps, $calisma_saatleri, $konum);
  $stmt_iletisim->fetch();

?>


  <!-- FORM -->
 <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Site İletişim Bilgileri</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="a_siteiletisim.php" method="POST">
                <div class="card-body">
                  
                  <div class="form-group">
                    <label for="Yetkili">Yetkili Adı</label>
                    <input type="text" class="form-control" id="Yetkili" placeholder="Yetkili Adı" required name="yetkili" 
                    value="<?php if(isset($yetkili)) {echo $yetkili;} ?>">
                  </div>

                  <div class="form-group">
                    <label for="Firma">Firma Adı</label>
                    <input type="text" class="form-control" id="Yetkili" placeholder="Firma Adı" required name="firma"
                    value="<?php if(isset($firma)) {echo $firma;} ?>">
                  </div>

                  <div class="form-group">
                    <label for="sabittel">Sabit Telefon</label>
                    <input type="tel" class="form-control" id="sabittel" placeholder="Sabit Telefon"  name="sabittel"
                    value="<?php if(isset($sabittel)) {echo $sabittel;} ?>">
                  </div>


                  <div class="form-group">
                    <label for="ceptel">Cep Telefonu</label>
                    <input type="tel" class="form-control" id="ceptel" placeholder="Cep telefonu" name="ceptel"
                    value="<?php if(isset($ceptel)) {echo $ceptel;} ?>">
                  </div>

                  <div class="form-group">
                    <label for="fax">Fax No</label>
                    <input type="tel" class="form-control" id="fax" placeholder="Fax" name="fax"
                    value="<?php if(isset($faxno)) {echo $faxno;} ?>">
                  </div>                  


                <div class="form-group">
                <label for="adres">Adres</label>
                <textarea class="form-control" id="adres" name="adres" rows="3"><?php if(isset($adres))
                 {echo $adres;} ?></textarea>
              </div>

                 <div class="form-group">
                    <label for="eposta">Eposta</label>
                    <input type="email" class="form-control" id="eposta" placeholder="E-posta" name="eposta"
                    value="<?php if(isset($eposta)) {echo $eposta;} ?>">
                </div>     


                 <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input type="url" class="form-control" id="facebook" placeholder="Facebook" name="facebook"
                    value="<?php if(isset($facebook)) {echo $facebook;} ?>">
                </div>     

                 <div class="form-group">
                    <label for="twitter">Twitter</label>
                    <input type="url" class="form-control" id="twitter" placeholder="Twitter" name="twitter"
                    value="<?php if(isset($twitter)) {echo $twitter;} ?>">
                </div>  


                 <div class="form-group">
                    <label for="instagram">Instagram</label>
                    <input type="url" class="form-control" id="instagram" placeholder="Instagram" name="instagram"
                    value="<?php if(isset($instagram)) {echo $instagram;} ?>">
                </div>     


                 <div class="form-group">
                    <label for="youtube">Youtube</label>
                    <input type="url" class="form-control" id="youtube" placeholder="Youtube" name="youtube"
                    value="<?php if(isset($youtube)) {echo $youtube;} ?>">
                </div>     


                 <div class="form-group">
                    <label for="google">Google</label>
                    <input type="url" class="form-control" id="google" placeholder="Google" name="google"
                    value="<?php if(isset($google)) {echo $google;} ?>">
                </div>     


                <div class="form-group">
                <label for="maps">Maps Frame</label>
                <textarea class="form-control" id="maps" name="maps" rows="3"><?php if(isset($maps))
                 {echo $maps;} ?></textarea>
              </div>


                <div class="form-group">
                <label for="konum">Konum Link</label>
                <textarea class="form-control" id="konum" name="konum" rows="3"><?php if(isset($konum))
                 {echo $konum;} ?></textarea>
              </div>


              <div class="form-group">
                    <label for="saatler">Çalışma Saatleri</label>
                    <input type="text" class="form-control" id="saatler" placeholder="Çalışma Saatleri" name="saatler"
                    value="<?php if(isset($calisma_saatleri)) {echo $calisma_saatleri;} ?>">
                </div>  
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="iletisimkaydet">Kaydet</button>
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