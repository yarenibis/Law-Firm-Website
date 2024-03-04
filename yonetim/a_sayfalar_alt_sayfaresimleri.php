 <?php 
if (!defined("KORUMA")) {
  header("Location: ../404.html");
  exit();
}
 // RESİM YÜKLEME KISMI


// GELEN PARAMETRELERİ
// $secilisayfaid


// UPLOAD A GÖNDERECEĞİ PARAMETRELER
$target_dir=UPLOADDIR."/sayfa-resimleri/";
 //$dosyaad
$allowfiletypes=array('jpg', 'png', 'jpeg', 'gif', 'webp','svg');
//  // SADECE RESİM DOSYALARI
$maxfilesize= 11000000 ; // 10 MB Resimler için


// VARSAYILAN COLLAPSED
$resimyuklecollapse=" collapsed-card "; 
if($section=='PageImages' ) {
 $resimyuklecollapse=" ";
}


 // ONCE EN ESKI ID Yİ BUL. İSİMLENDİRME İÇİN


  $sql_resimmaxid="SELECT id FROM sayfa_resimleri ORDER BY id DESC LIMIT 1";   
    if ($result_resimmaxid = $mysqli -> query($sql_resimmaxid)) {
      while ($row_resimmaxid= $result_resimmaxid -> fetch_row()) {
                         $resimmaxid=  $row_resimmaxid[0];
               }
      }


 
  if(!empty($_POST['resimozelisim']))  {
      $dosyaad=PrettyURLyap($_POST['resimozelisim']);
  }
  else { 
    $dosyaad=  PrettyURLyap($ssayfaadi) . "-" . ($resimmaxid + 1);
  }
// 

  $uploadMesaj="";

  


// KAYDETME YA DA EDİTLEME

if(isset($_POST['yuklesayfaresim'])) {

  $resimalt= $_POST['resimalt'];
 

// EDIT VARSA 
  if(isset($_POST['editlenecekresim']))
  {
        $editresimid=$_POST['editlenecekresim'];
        $editresim_uzanti =$_POST['editlenecekresim_uzanti'];
        $editresimad=PrettyURLyap($_POST['resimozelisim']).".".$editresim_uzanti;
        $editresimalt=$_POST['resimalt'];
        $editlenecekresim_yollu =$_POST['editlenecekresim_yollu'];
        $resimsql = "UPDATE sayfa_resimleri SET adi = '$editresimad', alt = '$editresimalt' WHERE id = '$editresimid'";

        // RENAME
        if( rename($editlenecekresim_yollu, $target_dir.$editresimad)) {
            $uploadOk = 1;
             //'ImageUpdateOk':
            // $toaster['info'] = " Resim Başarıyla Güncellendi..";
            $toastmessage_image= "ImageUpdateOk";

        } else {
          $uploadOk = 0;
         // $toastmessage= "ImageUpdateFailed";
          //$toaster['info'] = " Aynı isimde dosya var , başka bir isim yazın..";
        }
        
  }
   else {
 /// SIFIRDAN KAYIT
        include("gerekli/upload.php");
          // ÇIKTILARI 
          // $uploadMesaj
          // $uploaddurum= ok / error
          // $dosyatamad
        /*
          if(isset($uploaddurum)) {
                if($uploaddurum == "ok") {
                   $toaster['success'] =  $uploadMesaj;
                }
                 if($uploaddurum == "error") {
                   $toaster['error'] =  $uploadMesaj;
                }
          }*/
          // THUMB OLUŞTURMA
          $thumb_ad="thumb_".$dosyatamad;
          $thumb_yollu=$target_dir.$thumb_ad;
          $dosya_yollu= $target_dir.$dosyatamad;
          if(make_thumb($dosya_yollu, $thumb_yollu, $varsayilan_thumb_en)) {}

          $resimsql = "INSERT INTO sayfa_resimleri (sid, res, durum, adi, alt) VALUES ('$secilisayfaid', NULL, '1', '$dosyatamad', '$resimalt')  ";
          $toastmessage_image= "NewImageOk";
/////// SIFIRDANN KAYIT BİTİŞ
   }
          //echo $resimsql  ;

                  if($uploadOk == 1) {
                    if ($mysqli->query($resimsql ) === TRUE) {
                       $git=BASE_ADMIN."a_sayfalar.php?k=".$k."&action=edit&id=".$secilisayfaid."&section=PageImages&toastmessage=".$toastmessage_image;
                       echo "OK: " ;
                       header("Location:".$git."");
                      // $toaster['success'] = " Sayfa Resimlerine ".$dosyatamad. " <br> Adıyla Başarıyla Kaydedildi...";
                       
                    } else {
                       $git=BASE_ADMIN."a_sayfalar.php?k=".$k."&action=edit&id=".$secilisayfaid."&section=PageImages&toastmessage=ImageUploadFailed";
                       echo "OK: " ;
                       header("Location:".$git."");
                      // $toaster['error'] =  "Resim Yüklemeden Hata Oluştu";
                      //echo "Error: " . $resimsql . "<br>" . $mysqli->error;
                    }
                  }

}
///////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////
/// KApak Resmi Yap //

if(isset($_GET['MakePageCapImage'])) {
   
    $kapakresmiyapilacak=$_GET['MakePageCapImage'];
    // kapak resminin adını al
    $sql_kapakresmicek="SELECT adi FROM sayfa_resimleri WHERE id= $kapakresmiyapilacak LIMIT 1"; 

         if ($result_kapakresmicek = $mysqli -> query($sql_kapakresmicek)) {
            while ($row_kapakresmicek= $result_kapakresmicek -> fetch_row()) {
                         $kapakresmicek_ad=  $row_kapakresmicek[0];
                         $kapakresmicek_yollu= $target_dir.$kapakresmicek_ad;


   }  // while kapat
 }  // İF kapat


// kapak resmini ata:
     $kapaksql = "UPDATE sayfalar SET res = '$kapakresmicek_ad' WHERE id = '$secilisayfaid'";
    // echo $kapaksql;
                  if ($mysqli->query($kapaksql) === TRUE) {
                     //echo "OK: " ;
                     $toaster['success'] = "Kapak Resmi Yapıldı!";
                  } else {
                    echo "Error: " . $kapaksql . "<br>" . $mysqli->error;
                  }

  
} // $_GET['MakePageCapImage'])) KAPAT


// ORJİNAL SAYFA KAPAK RESMİNİ ÇEK 

// SAYFA BİLGİLERİNİ ÇEK
  $stmt_sayfakapakcek = $mysqli->prepare("SELECT res FROM sayfalar WHERE id = ? LIMIT 1") ;
  $stmt_sayfakapakcek->bind_param('s', $secilisayfaid);  // username i ekle
  $stmt_sayfakapakcek->execute();    // çalıştır
  $stmt_sayfakapakcek->store_result();
        // veritabanı sorgusu sonuçtan değerleri çek
  $stmt_sayfakapakcek->bind_result($secilikapakresmi);
  $stmt_sayfakapakcek->fetch();
  $stmt_sayfakapakcek->free_result();

///

////////////////////// RESİM SİLME İŞİ //////////////////////

if(isset($_GET['DeleteImage'])) {
 
 $silinecekresim= $_GET['DeleteImage'];

// adını çek
 $sql_silenecekresmicek="SELECT adi FROM sayfa_resimleri WHERE id=  $silinecekresim LIMIT 1"; 
         if ($result_silenecekresmicek = $mysqli -> query($sql_silenecekresmicek)) {
            while ($row_silenecekresmicek = $result_silenecekresmicek -> fetch_row()) {
                         $silenecekresmicek_ad=  $row_silenecekresmicek[0];
                         $silenecekresmicek_yollu= $target_dir.$silenecekresmicek_ad;
                         $silinecekresimthumb= $target_dir."thumb_".$silenecekresmicek_ad;

   }  // while kapat
 }  // İF kapat

// SQL DEN SİL
 $silresimsql = "DELETE FROM sayfa_resimleri WHERE id=$silinecekresim";
  if ($mysqli->query($silresimsql) === TRUE) {
  //echo "Record deleted successfully";
    if(isset($silenecekresmicek_yollu)) { unlink($silenecekresmicek_yollu); } // FİZİKSEL SİL
    if(isset($silinecekresimthumb)) { unlink($silinecekresimthumb); } // THUMB FİZİKSEL SİL


   $toaster['success'] = " Kayıt Silinmiştir...";
  } else {
  echo "Error deleting record: " . $mysqli->error;
}
}  // if(isset($_GET['DeleteImage'])) 
////////////////////////////////////////////

//RESİM EDİTLEME //////////////////////////

if(isset($_GET['EditImage'])) {
 
 $editlenecekresim= $_GET['EditImage'];
// adını çek
 $sql_editlenecekresim="SELECT adi,alt FROM sayfa_resimleri WHERE id= $editlenecekresim LIMIT 1"; 
 
         if ($result_editlenecekresim = $mysqli -> query($sql_editlenecekresim)) {
            while ($row_editlenecekresim = $result_editlenecekresim -> fetch_row()) {
                         $editlenecekresim_ad=  $row_editlenecekresim[0];
                         $editlenecekresim_yollu= $target_dir.$editlenecekresim_ad;
                         $editlenecekresim_uzantisiz = substr($editlenecekresim_ad, 0, strrpos($editlenecekresim_ad, '.'));
                         $editlenecekresim_uzanti = pathinfo($editlenecekresim_ad, PATHINFO_EXTENSION);
                         
                         $editlenecekresim_alt= $row_editlenecekresim[1];


   }  // while kapat
 }  // İF kapat
  
} // $_GET['EditImage']))  BİTİŞ
  

///////////////////////////////////////
?>
<!-- SAYFAYA TEK RESİM YÜKLEME KISMI --->

            <div class="card card-primary<?php echo $resimyuklecollapse; ?>">
              <div class="card-header">
                <h3 class="card-title">Sayfa Resimleri- Sayfa İçi Resimler ve Kapak Resmi</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">


   <form action="<?php echo"a_sayfalar.php?k=".$k."&action=edit&id=".$secilisayfaid."&section=PageImages"; ?>" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                 
<?php if(isset($editlenecekresim)) {
?>
  <input type="hidden"  name="editlenecekresim" value="<?php echo $editlenecekresim ; ?>">
  <input type="hidden"  name="editlenecekresim_uzanti" value="<?php echo $editlenecekresim_uzanti ; ?>">
  <input type="hidden"  name="editlenecekresim_yollu" value="<?php echo $editlenecekresim_yollu ; ?>">
  <a href="<?php echo $editlenecekresim_yollu; ?>" data-toggle="lightbox" data-title="<?php echo $editlenecekresim_yollu; ?>">
    <img src="<?php echo $editlenecekresim_yollu; ?>" class="img-thumbnail"  style="max-height: 150px; max-width: : 150px;" alt="<?php echo $editlenecekresim_yollu; ?>" />
  </a>
<?php
}
else {
?>
                  <div class="form-group">
                    <label for="exampleInputFile">Resim Seç</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="InputFile" name="fileToUpload">
                        <label class="custom-file-label" for="InputFile">Resim Dosyası Seç</label>
                      </div>
                    </div>
                  </div>

<?php
}
?>

                  <div class="form-group">
                        <label>Adı</label>
                        <input type="text" class="form-control" placeholder="Girilmezse otomatik oluşturulacak" name="resimozelisim" 
                        value="<?php if(isset($editlenecekresim_uzantisiz)) { echo $editlenecekresim_uzantisiz ;} ?>">
                      </div>
              
            <div class="form-group">
                        <label>Alt Bilgisi</label>
                        <input type="text" class="form-control" placeholder="Alt Bilgisi" name="resimalt"
                         value="<?php if(isset($editlenecekresim_alt)) { echo $editlenecekresim_alt ;} ?>">
                      </div>


                 
                </div>
                <!-- /.card-body -->

               <div class="card-footer">
              <button type="submit" class="btn btn-primary btn-block" name="yuklesayfaresim">Kaydet</button>
            </div>

              </form>

<!-- FORM BİTİŞ -->


<!-- RESİMLER GALERİ -->


<div class="filter-container p-0 row scrolling-wrapper flex-row flex-nowrap mt-4 pb-4 pt-2">
<?php 

$sql_sayfaresimlericek="SELECT id,adi FROM sayfa_resimleri WHERE sid= $secilisayfaid ORDER BY id DESC";   
    if ($result_sayfaresimlericek = $mysqli -> query($sql_sayfaresimlericek)) {
      while ($row_sayfaresimlericek= $result_sayfaresimlericek -> fetch_row()) {
                         $sayfaresimlericek_id=  $row_sayfaresimlericek[0];
                         $sayfaresimlericek_ad=  $row_sayfaresimlericek[1];
                         $sayfaresmiyollu= $target_dir.$sayfaresimlericek_ad;
                         $border="";
                         $kapakresmidir=0;
                          if($sayfaresimlericek_ad==$secilikapakresmi) { $border="border border-success"; $kapakresmidir=1; }

?>
 <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">


             <div style="height:70%;" class="<?php echo $border; ?>">
                             <a href="<?php echo $target_dir.$sayfaresimlericek_ad; ?>" data-toggle="lightbox" data-title="<?php echo $sayfaresimlericek_ad; ?>">
                                <img src="<?php echo $target_dir."thumb_".$sayfaresimlericek_ad; ?>" class="img-thumbnail"  alt="<?php echo $sayfaresimlericek_ad; ?>" />
                              </a>
              </div>
                   <div style="height:40%;">

                               <p style="text-align:center;">   


        <a class="btn btnkucuk" data-toggle="modal" data-target="#confirm-delete" 
        data-delurl="<?php echo "a_sayfalar.php?k=".$k."&action=edit&id=".$secilisayfaid."&section=PageImages&DeleteImage=". $sayfaresimlericek_id.""; ?>"
        title="Sil" alt="Sil">
        <i class="fas fa-trash"></i></a>

        <a class="btn btnkucuk" href="<?php echo "a_sayfalar.php?k=".$k."&action=edit&id=".$secilisayfaid."&section=PageImages&EditImage=". $sayfaresimlericek_id.""; ?>"
        title="Düzenle" alt="Düzenle">
        <i class="fas fa-pen"></i></a>

        <?php if($kapakresmidir==0){  ?>
        <a class="btn btnkucuk" href="<?php echo "a_sayfalar.php?k=".$k."&action=edit&id=".$secilisayfaid."&section=PageImages&MakePageCapImage=". $sayfaresimlericek_id.""; ?>" title="Kapak Resmi Yap" alt="Kapak Resmi Yap">
        <i class="fas fa-clipboard-check"></i></a>
        <?php } ?>
        <a class="btn btnkucuk copy-btn TostKopyalandi" title="Linki Kopyala" alt="Linki Kopyala"
        onclick="myFunction()" data-type="attribute" data-clipboard-text="<?php echo $sayfaresmiyollu; ?>">
        <i class="fas fa-copy"></i></a>

          </p>
        </div>
                       
 </div>


<script type="text/javascript">

$(document).ready(function(){
    $('.copy-btn').on("click", function(){
        value = $(this).data('clipboard-text'); //Upto this I am getting value
 
        var $temp = $("<input>");
          $("body").append($temp);
          $temp.val(value).select();
          document.execCommand("copy");
          $temp.remove();
    })
})
</script>



<?php
               }
      }

?>

                    
                  </div>

<!--- RESİMLEER GALERİ BİTİŞ -->




            </div>
            <!-- /.card-body -->
       </div><!-- /.card-->

<!-- SAYFAYA TEK RESİM YÜKLEME KISMI BİTİŞ --->