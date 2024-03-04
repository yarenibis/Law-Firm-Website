<?php
// BAŞLATICI ÇAĞIR 
include_once("_baslatici.php");

// HEADER SAYFASINI ÇAĞIR 
include_once("cerceveler/header.php");

// SİDEBAR SAYFASINI ÇAĞIR 
include_once("cerceveler/sidebar.php");

//////////////////////////////////////////////////////////////////////////////////

// ACTION AL
 $action="";
 if(isset($_GET['action'])) {
    $action= $_GET['action'];
  }
// SECTION AL
 $section="";  
if(isset($_GET['section'])){
   $section= $_GET['section'];
}



  ///

// TEPEDEN SAYFA IDSINI AL LAZIM OLUR

if($action=="edit") 
{
  $secilisayfaid=$_GET['id'];
}
///////


// URLDEN K YI AL
if(isset($_GET['k']))
{
  $k=$_GET['k'];
} 
else
{
  $k=1;
}
//////////////////////////////
// DİLLERİ DİZİYE AT
  // sayfa dil çek
$sqldil="SELECT ID, DilKodu FROM diller";             
 if ($resultdil = $mysqli -> query($sqldil)) {
  while ($rowdil = $resultdil -> fetch_row()) {
      $dil[$rowdil[0]] = $rowdil[1];

  }
}
/////////////////////////////////////////////////////////////////////////////
/// RESİMLER İÇİN THUMB VARSAYILANI AL

$thumbsql= "SELECT * FROM thumbset WHERE varsayilan=1 LIMIT 1";
$thumbquery = mysqli_query($mysqli, $thumbsql );
$thumbrowCount = mysqli_num_rows($thumbquery);
if($thumbrowCount > 0){ 
  while($thumbrow = mysqli_fetch_assoc($thumbquery)){      
     $varsayilan_thumb_en=  $thumbrow['en'] ;     
 }
}     


////////////////////////////

 
 // SAYFA SİLME
if($action== 'deletepage')
{

 // echo"Geldi!!";
  $silid= $_GET['id'];

  $silsql = "DELETE FROM sayfalar WHERE id=$silid";

  if ($mysqli->query($silsql) === TRUE) {
  //echo "Record deleted successfully";
   $toaster['success'] = " Kayıt Silinmiştir...";
  } else {
  echo "Error deleting record: " . $mysqli->error;
}

}

// TOAST MESAJLARI
// toastmessage=EditOk  , NewSaveOk
if(isset($_GET['toastmessage'])){
  switch ($_GET['toastmessage']) {
    case 'EditOk':
      $toaster['success'] = " Kayıt Güncellendi...";
    break;
    case 'NewSaveOk':
      $toaster['success'] = " Kayıt Başarıyla Oluşturuldu...";
    break;
    case 'NewImageOk':
      $toaster['info'] = " Resim Başarıyla Yüklenip Kaydedildi..";
    break;
    case 'ImageUpdateOk':
      $toaster['info'] = " Resim Başarıyla Güncellendi..";
    break;
    case 'ImageUpdateFailed':
      $toaster['info'] = " Dosya Yüklemede Hata Oluştu..";
    break;
    case 'ImageUploadFailed':
      $toaster['error'] = " Dosya Yüklemede Hata Oluştu..";
    break;
    case 'NewGaleryImageOk':
    $toaster['info'] = " Resim Galeriye Başarıyla Yüklenip Kaydedildi..";
    break;
    case 'ImageGaleryUpdateOk':
    $toaster['info'] = " Galerideki Resim Başarıyla Güncellendi..";
    break;




  }
}
 
//////////////////

/////

////////////////////////////////////////////////////////////////////////////
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php if ($k==2){echo "Blog Yönetim";}  elseif($k==100) {echo "Vİdeo Yönetim";} elseif($k==20) {echo "Yazar Yönetim";}  elseif($k==2000) {echo "Otel Oda Yönetim";}   else {echo "Üst Menüler Yönetim"; } ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
              <li class="breadcrumb-item active"><?php if ($k==2){echo "Blog Yazıları";}  elseif($k==100) {echo "Video Listesi";} elseif($k==20) {echo "Yazar Yönetim";}  elseif($k==2000) {echo "Otel Oda Yönetim";} else {echo "Üst Menüler"; } ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">  <!-- SATIR BAŞI -->
          <!--sol taraf -->
          <div class="col-md-4">


          

  
<?php include "a_sayfalar_alt_yenimenuekle.php" ?>     

          
<?php include "a_sayfalar_alt_menulistelemesi.php" ?>



</div>  <!-- SOL TARAF COL BİTİŞ -->

<!---------------------------------------------------------------->
  
     

<?php

/// SAĞ TARAF


// ACTION= YENİ SAYFA DAN GELDİ
if($action == "yenisayfa") {  // YENİ SAYFA KAYDETME
      $form= "yenisayfa";  // FORMU yeni sayfa ya göre modifiye et
      $ssayfaadi=$_POST['yenisayfaad'];  // YENİ SAYFAADI DİYE  FORMDAN GELDİYSE ONU AL
     

}
if($action == "edit") {  // YENİ SAYFA KAYDETME
     $form= "editsayfa";  // FORMU yen, sayfa ya göre modifiye et
}

////////////////////////////////////////////////////////////////////////////////////
 
// SAYFA KAYDET- GÜNCELLE
if (isset($_POST['sayfakaydet']) ) {

            $sayfaadi=$_POST['sayfaadi'];  


            if(isset($_POST['sayfapurl']))   {  $sayfapurl=$_POST['sayfapurl'];  } else {$sayfapurl=NULL; }
            if(isset($_POST['sayfatitle']))   {  $sayfatitle=$_POST['sayfatitle'];  } else {$sayfatitle=NULL; }
            if(isset($_POST['sayfaurl']))   {  $sayfaurl=$_POST['sayfaurl'];  } else {$sayfaurl=NULL; } 
            if(isset($_POST['sayfacano']))   {  $sayfacano=$_POST['sayfacano'];  } else {$sayfacano=NULL; }
            if(isset($_POST['sayfadescr']))   {  $sayfadescr=$_POST['sayfadescr'];  } else {$sayfadescr=NULL; }
            if(isset($_POST['sayfaicerik']))   {  $sayfaicerik=$_POST['sayfaicerik'];  } else {$sayfaicerik=NULL; }
            if(isset($_POST['sayfaaktif']))   {  $sayfaaktif=$_POST['sayfaaktif'];  } else {$sayfaaktif=0; }
            if(isset($_POST['sayfakodhead']))   {  $sayfakodhead=$_POST['sayfakodhead'];  } else {$sayfakodhead=NULL; } 
            if(isset($_POST['sayfakodfoot']))   {  $sayfakodfoot=$_POST['sayfakodfoot'];  } else {$sayfakodfoot=NULL; } 
            if(isset($_POST['sayfaindexle']))   {  $sayfaindexle=$_POST['sayfaindexle'];  } else {$sayfaindexle=1; } 
            if(isset($_POST['sayfadili']))   {  $sayfadili=$_POST['sayfadili'];  } else {$sayfadili=1; } 
            if(isset($_POST['sayfakeywords']))   {  $sayfakeywords=$_POST['sayfakeywords'];  } else {$sayfakeywords=NULL; } 
            if(isset($_POST['sayfaturu']))   {  $sayfaturu=$_POST['sayfaturu'];  } else {$sayfaturu=""; } 
            if(isset($_POST['sayfayazar']))   {  $sayfayazar=$_POST['sayfayazar'];  } else {$sayfayazar=NULL; } 
            if(isset($_POST['sayfaustmenu']))   {  $sayfaustmenu=$_POST['sayfaustmenu'];  } else {$sayfaustmenu=0; } 
            if(isset($_POST['sayfasira']))   {  $sayfasira=$_POST['sayfasira'];  } else {$sayfasira=1; } 
            $eklenme_tarihi= date('Y-m-d H:i:s');
            $tur=1; // hata vermesin diye
            $sayfaicon=$_POST['sayfaicon']; 

           //  EDITLEME ISE
            if($action=="edit") {
              $editsayfaid=$_POST['editsayfaid']; 

            // ESKİYİ EDİTLEME BAŞ
                  $sql = "UPDATE sayfalar  SET
                   uid = '$sayfaustmenu', adi ='$sayfaadi' , url ='$sayfaurl', purl = '$sayfapurl', title = '$sayfatitle', descr = '$sayfadescr', keywords = '$sayfakeywords',
                   sira = '$sayfasira', icerik = '$sayfaicerik', aktif = '$sayfaaktif', tur = '$tur', dil = '$sayfadili', sayfa_turu = '$sayfaturu',  konum = '$k', 
                   eklenme_tarihi ='$eklenme_tarihi', yazar = '$sayfayazar', kodfoot = '$sayfakodfoot', kodhead = '$sayfakodhead',
                   cano = '$sayfacano', indexle ='$sayfaindexle', icon ='$sayfaicon'
                  WHERE id = '$editsayfaid'";

                  if ($mysqli->query($sql) === TRUE) {
                    $last_id = $mysqli->insert_id;
                     $git=BASE_ADMIN."a_sayfalar.php?k=".$k."&action=edit&id=".$editsayfaid."&toastmessage=EditOk";
                     echo "OK: " ;
                    header("Location:".$git.""); 
                    //echo $last_id ;
                  } else {
                    echo "Error: " . $sql . "<br>" . $mysqli->error;
                  }


            }//  EDITLEME ISE BİTİŞ

            // YENİ SAYFA İSE
            if($action=="yenisayfa") {

                $sql = "INSERT INTO
                                sayfalar (uid, adi, url, purl, title, descr, keywords, sira, icerik, aktif, tur, dil, sayfa_turu,  konum, 
                  eklenme_tarihi, yazar, kodfoot, kodhead, cano, indexle, icon) VALUES ('$sayfaustmenu', '$sayfaadi', '$sayfaurl',  '$sayfapurl', '$sayfatitle', 
                  '$sayfadescr', '$sayfakeywords',
                   '$sayfasira', '$sayfaicerik', '$sayfaaktif',  '$tur', '$sayfadili', '$sayfaturu', '$k', '$eklenme_tarihi', '$sayfayazar', '$sayfakodfoot', 
                   '$sayfakodhead', '$sayfacano', '$sayfaindexle','$sayfaicon')";
                if ($mysqli->query($sql) === TRUE) {
                  $last_id = $mysqli->insert_id;  // KAYDETİĞİNİN IDsini al
                  $git=BASE_ADMIN."a_sayfalar.php?k=".$k."&action=edit&id=".$last_id."&toastmessage=NewSaveOk";
                   echo "OK: " ;
                  header("Location:".$git.""); 
                  //echo $last_id ;
                } else {
                  echo "Error: " . $sql . "<br>" . $mysqli->error;
                }

            } // YENİ SAYFA İSE BİTİŞ



} //  SAYFA KAYDET - GÜNCELLE isset $post [sayfakaydet]BİTİŞ


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




///////////////////////////////////////// 

if(isset($form))  // SAĞDA FORMU GÖSTER GÖSTERME
{ 

?>
<div class="col-md-8">

   <!-- SAĞ TARAf -->

<?php 
    if($action=='edit') {   // EDIT OLARAK AÇTIYSA RESİM EKLEYEBİLSİN

// ÖNCE SAYFA BİLGİLERİ BİR AL YİĞENİM ///

      // ID GELDİYSE GÖSTERECEK ////////////////////

    // SAYFA BİLGİLERİNİ ÇEK
  $stmt_sayfa = $mysqli->prepare("SELECT uid, adi, url, purl,  title, descr, keywords,sira, res, icerik, aktif, tur, dil, sayfa_turu, urun_turu, marka, konum, vitrin, eklenme_tarihi, yazar, kodfoot, kodhead, cano, indexle, icon FROM sayfalar WHERE id = ? LIMIT 1") ;
  $stmt_sayfa->bind_param('s', $secilisayfaid);  // username i ekle
  $stmt_sayfa->execute();    // çalıştır
  $stmt_sayfa->store_result();
        // veritabanı sorgusu sonuçtan değerleri çek
  $stmt_sayfa->bind_result($ssayfauid, $ssayfaadi, $ssayfaurl, $ssayfapurl, $ssayfatitle, 
    $ssayfadescr, $ssayfakeywords, $ssayfasira, $ssayfares, $ssayfaicerik,
    $ssayfaaktif, $ssayfatur, $ssayfadil, $ssayfaturu,$ssayfaurunturu,
    $ssayfamarka, $ssayfakonum, $ssayfavitrin, $ssayfaeklenmetarihi, $ssayfayazar, $ssayfakodfoot , $ssayfakodhead , $ssayfacano, $sayfaindexle, $sayfaicon);
  $stmt_sayfa->fetch();
 
   include "a_sayfalar_alt_sayfaresimleri.php";
  include "a_sayfalar_alt_sayfaedit.php";
  include "a_sayfalar_alt_sayfagaleri.php"; 
}
 if($action=='yenisayfa') {
   include "a_sayfalar_alt_sayfaedit.php";
}

 ?>


</div>  <!-- COL BİTİş -->


<?php

 }
  // $form varsa bitiş

?>




</div> <!-- row BİTİş -->





      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
  // FOOTER SAYFASINI ÇAĞIR 
    include_once("cerceveler/footer.php");
?>

<!------------- FLASH MESAJ MODAL ------------->

<?php
$mesajyaz="";
 if (isset($_GET['flashmessage'])) { 

    $flashmessage= $_GET['flashmessage'];
    switch ($flashmessage) {
      case "NewSaveOk":
        $mesajyaz= "Yeni Kayıt Başarıyla Oluşturuldu";
      break;
      case "EditOk":
        $mesajyaz= "Kayıt Güncellendi";
      break;
      case "NewImageOk":
        $mesajyaz= "Resim Eklendi";
      break;
}

  ?>
<div id="flashmessage" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bilgi: </h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
        <p><?php echo $mesajyaz; ?></p>
                
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tamam</button>
            </div>
        </div>
    </div>
</div>






<?php
 }  // MODAL GÖSTER BİTİŞ

?>

<!-------------------------------------------->




<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-deleteLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirm-deleteLabel">Kaydı Sil?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       Bu işlemin geri dönüşü yoktur. Emin misiniz?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
        <a href="#" id="silonay" class="btn btn-primary btn-md active" role="button">SİL</a></p>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$('#confirm-delete').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('delurl') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  //modal.find('.modal-title').text('New message to ' + recipient)
  //modal.find('.modal-body input').val(recipient)
  $("#silonay").attr("href", recipient);


})
</script>

