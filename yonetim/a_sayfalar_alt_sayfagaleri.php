 <?php 
if (!defined("KORUMA")) {
  header("Location: ../404.html");
  exit();
}
////////////////// PARAMETRELER////////////////////
// $secilisayfaid


// UPLOAD A GÖNDERECEĞİ PARAMETRELER
$target_dir=UPLOADDIR."/galeri/";
 //$dosyaad
$allowfiletypes=array('jpg', 'png', 'jpeg', 'gif', 'webp','svg');
//  // SADECE RESİM DOSYALARI
$maxfilesize= 11000000 ; // 10 MB Resimler için


// VARSAYILAN COLLAPSED
$galeriyuklecollapse=" collapsed-card "; 
if($section=='Galeri' ) {
 $galeriyuklecollapse=" ";
}


 // ONCE EN ESKI ID Yİ BUL. İSİMLENDİRME İÇİN////////////////////////7
  $sql_galerimaxid="SELECT id FROM galeri ORDER BY id DESC LIMIT 1";   
    if ($result_galerimaxid = $mysqli -> query($sql_galerimaxid)) {
      while ($row_galerimaxid= $result_galerimaxid -> fetch_row()) {
                         $galerimaxid=  $row_galerimaxid[0];
               }
      }
////////////////////////////////////////////////////////////////////
 
  if(!empty($_POST['galeriozelisim']))  {
      $dosyaad=PrettyURLyap($_POST['galeriozelisim']);
  }
  else { 
      $dosyaad=  PrettyURLyap($ssayfaadi);
  }
// 

  $uploadMesaj="";

////////////////////////////////////////////////

// KAYDETME YA DA EDİTLEME

if(isset($_POST['yuklegaleriresim'])) {


  $galerialt= $_POST['galerialt'];
   
// EDIT VARSA 
  if(isset($_POST['editlenecekgaleri']))
  {
        $galeriresimid=$_POST['editlenecekgaleri'];
        $editgaleri_uzanti =$_POST['editlenecekgaleri_uzanti'];
        $editgaleriad=PrettyURLyap($_POST['galeriozelisim']).".".$editgaleri_uzanti;
        $editlenecekgaleri_yollu =$_POST['editlenecekgaleri_yollu'];
        $editgalerialt= $_POST['galerialt'];
        //echo "İSİM2=" . $editgaleriad;
        $galerisql = "UPDATE galeri SET adi = '$editgaleriad', alt = '$editgalerialt' WHERE id = '$galeriresimid'";

        // RENAME
        if( rename($editlenecekgaleri_yollu, $target_dir.$editgaleriad)) {
            $uploadOk = 1;
             //'ImageUpdateOk':
           // $toaster['info'] = " Galeri Resimi Başarıyla Güncellendi..";
            $toastmessage_image= "ImageGaleryUpdateOk";

        } else {
          $uploadOk = 0;
         // $toastmessage= "ImageUpdateFailed";
          $toaster['info'] = " Galeride Aynı isimde dosya var , başka bir isim yazın..";
        }

        if ($mysqli->query($galerisql ) === TRUE) {
          $uploadMesaj=" Galeriye ". $editgaleriad. " Adıyla Başarıyla Kaydedildi...";

        }
  
  }
   else {
 /// SIFIRDAN KAYIT


// ÇOKLU RESİM YÜKLEME
      $kaydetid= $galerimaxid;
      $dosya_sayi=count($_FILES['multidosya']['name']);
      $dosyaadyedek= $dosyaad;
      
        for($i=0;$i<$dosya_sayi;$i++){ 

          $dosyaad=$dosyaadyedek;

          if(!empty($_FILES['multidosya']['name'][$i])){ 
           // uzantı kontrol  
        
             $FileType = strtolower(pathinfo($_FILES['multidosya']['name'][$i],PATHINFO_EXTENSION)); // uzantısı
             if (in_array($FileType, $allowfiletypes))
             {

              $kaydetid++;

              $kaydetek= rand(10000, 99999);
              $dosyaad=  $dosyaad  . "-" . $kaydetid;
              $target_file = $target_dir . $dosyaad . ".".$FileType;  // hedef dosya
              $dosyatamad= $dosyaad . ".".$FileType;   // kaydedildiği yer. veritabanındaki ismi
              $multiupload=move_uploaded_file($_FILES['multidosya']['tmp_name'][$i], $target_file); 
               //THUMB OLUŞTURMA
              $thumb_ad="thumb_".$dosyatamad;
              $thumb_yollu=$target_dir.$thumb_ad;
              $dosya_yollu= $target_dir.$dosyatamad;
              $multiuploadthumb= make_thumb($dosya_yollu, $thumb_yollu, $varsayilan_thumb_en);
             

              // MAX SIRAYI BUL. İSİMLENDİRME İÇİN////////////////////////7
              $sql_galerimaxsira="SELECT sira FROM galeri WHERE sid=$secilisayfaid ORDER BY sira DESC LIMIT 1";   
              if ($result_galerimaxsira = $mysqli -> query($sql_galerimaxsira)) {

                    while ($row_galerimaxsira= $result_galerimaxsira -> fetch_row()) {
                                       $galerimaxsira=  $row_galerimaxsira[0];
                             }
                    }

              if(isset($galerimaxsira)) {  $galeriyenisira = $galerimaxsira + 1; } else { $galeriyenisira = 1 ;}


              $galerisql = "INSERT INTO galeri (sid, durum, adi, alt, sira) VALUES ('$secilisayfaid', '1', '$dosyatamad', '$galerialt', '$galeriyenisira')  ";
     
               if ($mysqli->query($galerisql ))
               {
                $uploadMesaj .= $dosyatamad . " dosyası yüklendi <br>";
               }
               else {   $uploadMesaj .= $dosyatamad ." dosyası yüklenemedi<br>"; }
               $uploadOk=1;

             }
        } 
    }  // for bitiş


/////// SIFIRDANN KAYIT BİTİŞ
}


                  if($uploadOk == 1) {
                        $toaster['success'] = $uploadMesaj;
                    } 
                  

  
} //if(isset($_POST['yuklegaleriresim'])) { bitiş
///////////////////////////////////////////////////////////////////////////////////

////////////////////// GALERİDEN RESİM SİLME İŞİ //////////////////////

if(isset($_GET['DeleteFromGallery'])) {

 $silinecekgaleri= $_GET['DeleteFromGallery'];

// adını çek
 $sql_silenecekgalericek="SELECT adi FROM galeri WHERE id=  $silinecekgaleri LIMIT 1"; 
         if ($result_silenecekgalericek = $mysqli -> query($sql_silenecekgalericek)) {
            while ($row_silenecekgalericek = $result_silenecekgalericek -> fetch_row()) {
                         $silenecekgalericek_ad=  $row_silenecekgalericek[0];
                         $silenecekgalericek_yollu= $target_dir.$silenecekgalericek_ad;

   }  // while kapat
 }  // İF kapat

// SQL DEN SİL
 $silgalerisql = "DELETE FROM galeri WHERE id=$silinecekgaleri";
  if ($mysqli->query($silgalerisql) === TRUE) {
  //echo "Record deleted successfully";
    if(isset($silenecekgalericek_yollu)) { unlink($silenecekgalericek_yollu); } // FİZİKSEL SİL
   $toaster['success'] = " Galeriden Kayıt Silinmiştir...";
  } else {
  echo "Error deleting record: " . $mysqli->error;

}
}  // if(isset($_GET['DeleteImage'])) 
////////////////////////////////////////////

//RESİM EDİTLEME //////////////////////////

if(isset($_GET['EditInGallery'])) {
 
 $editlenecekgaleri= $_GET['EditInGallery'];
// adını çek
 $sql_editlenecekgaleri="SELECT adi,alt FROM galeri WHERE id= $editlenecekgaleri LIMIT 1"; 
 
         if ($result_editlenecekgaleri = $mysqli -> query($sql_editlenecekgaleri)) {
            while ($row_editlenecekgaleri = $result_editlenecekgaleri -> fetch_row()) {
                         $editlenecekgaleri_ad=  $row_editlenecekgaleri[0];
                         $editlenecekgaleri_yollu= $target_dir.$editlenecekgaleri_ad;
                         $editlenecekgaleri_uzantisiz = substr($editlenecekgaleri_ad, 0, strrpos($editlenecekgaleri_ad, '.'));
                         $editlenecekgaleri_uzanti = pathinfo($editlenecekgaleri_ad, PATHINFO_EXTENSION);
                         
                         $editlenecekgaleri_alt= $row_editlenecekgaleri[1];


   }  // while kapat
 }  // İF kapat
  
} // $_GET['EditImage']))  BİTİŞ
  

///////////////////////////////////////
///////////////////// SIRALAMA KODU//////////////////

if(isset($_GET['reorderGalery'])) {
  $galerisiralama= $_POST['galerisira'];
  
 //echo $galerisiralama;
  $galerisiralama= explode(',', $galerisiralama);
  $sirasi=0;
  foreach ($galerisiralama as $key => $siradaki) {
  $sirasi=$sirasi+1;
     $stmt1 = $mysqli->prepare("UPDATE galeri SET sira=? WHERE id=?");
     $stmt1->bind_param('ii', $sirasi, $siradaki );
      if( $stmt1->execute()){
        $sayfamesaj= "Sıralama Değiştirildi!";
      }
            else {
          $sayfamesaj= "Hata Oluştu.Sıralama Değiştirilemedi!";
        }
  
    } 
  

}
 
/////////////////////////////




/////////////////////////////////////////////////////
?>

<!--- SAYFA GALERİ KISMI ---> 

            <div class="card card-primary<?php echo $galeriyuklecollapse; ?>">
              <div class="card-header">
                <h3 class="card-title">Sayfa Galerisi</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">


   <form action="<?php echo"a_sayfalar.php?k=".$k."&action=edit&id=".$secilisayfaid."&section=Galeri"; ?>" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                 
<?php if(isset($editlenecekgaleri)) {
?>
  <input type="hidden"  name="editlenecekgaleri" value="<?php echo $editlenecekgaleri ; ?>">
  <input type="hidden"  name="editlenecekgaleri_uzanti" value="<?php echo $editlenecekgaleri_uzanti ; ?>">
  <input type="hidden"  name="editlenecekgaleri_yollu" value="<?php echo $editlenecekgaleri_yollu ; ?>">
  <a href="<?php echo $editlenecekgaleri_yollu; ?>" data-toggle="lightbox" data-title="<?php echo $editlenecekgaleri_yollu; ?>">
    <img src="<?php echo $editlenecekgaleri_yollu; ?>" class="img-thumbnail"  style="max-height: 150px; max-width: : 150px;" alt="<?php echo $editlenecekgaleri_yollu; ?>" />
  </a>
<?php
}
else {
?>


 <div class="form-group">
  <label for="exampleInputFile">Galeri Resim Yükle (Çoklu Seçilebilir!)</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="InputFile" name="multidosya[]" multiple="multiple">
                        <label class="custom-file-label" for="InputFile">Resim Dosyası Seç</label>
                      </div>
                    </div>
</div>


                  
<?php
}
?>

                  <div class="form-group">
                        <label>Adı</label>
                        <input type="text" class="form-control" placeholder="Girilmezse otomatik oluşturulacak" name="galeriozelisim" 
                        value="<?php if(isset($editlenecekgaleri_uzantisiz)) { echo $editlenecekgaleri_uzantisiz ;} ?>">
                      </div>
              
            <div class="form-group">
                        <label>Alt Bilgisi</label>
                        <input type="text" class="form-control" placeholder="Alt Bilgisi" name="galerialt"
                         value="<?php if(isset($editlenecekgaleri_alt)) { echo $editlenecekgaleri_alt ;} ?>">
                      </div>


                 
                </div>
                <!-- /.card-body -->

               <div class="card-footer">
              <button type="submit" class="btn btn-primary btn-block" name="yuklegaleriresim">Kaydet</button>
            </div>
              </form>

<!-- FORM BİTİŞ -->


<!-- GALERİ GÖSTER BAŞLANGIç -->

<form name="frmQA" method="POST" action="<?php echo"a_sayfalar.php?k=".$k."&action=edit&id=".$secilisayfaid."&section=Galeri&reorderGalery=Reorder"; ?>" />
 
<ul class="list-group tablelist" id="post_list">

<?php
//get rows query 

$galerigostersql= "SELECT * FROM galeri WHERE sid=$secilisayfaid ORDER BY sira ASC ";

$galerigosterquery = mysqli_query($mysqli, $galerigostersql );
 
//number of rows
$galerigosterrowCount = mysqli_num_rows($galerigosterquery);
if($galerigosterrowCount > 0){ 
  while($galerigosterrow = mysqli_fetch_assoc($galerigosterquery)){ 
    
?>

 <li data-post-id="<?php echo $galerigosterrow['id']; ?>" class="list-group-item"  style="padding:5px !important;  margin: 0px !important;"> 
 <div class="row">

  
    <div class="col-sm">
      <i class="fas fa-arrows-alt"></i>
      <?php echo $galerigosterrow['sira'] ; ?>
    <a href="<?php echo $target_dir. $galerigosterrow['adi']; ?>" data-toggle="lightbox" data-title="<?php echo $galerigosterrow['adi']; ?>">
      <img src="<?php echo $target_dir. $galerigosterrow['adi']; ?>" class="img-thumbnail"  alt="<?php echo $galerigosterrow['adi']; ?>"
                        style="max-height: 80px; max-width: 80px;" /></a>
    <small>
     <?php echo $galerigosterrow['adi'] ; ?>
    </small>

    </div>
    <div class="col-sm text-right">

      <a class="btn btnkucuk" data-toggle="modal" data-target="#confirm-delete" 
      data-delurl="<?php echo "a_sayfalar.php?k=".$k."&action=edit&id=".$secilisayfaid."&section=Galeri&DeleteFromGallery=". $galerigosterrow['id'] .""; ?>"
      title="Sil" alt="Sil">
      <i class="fas fa-trash"></i></a>
      <a class="btn btnkucuk" href="<?php echo "a_sayfalar.php?k=".$k."&action=edit&id=".$secilisayfaid."&section=Galeri&EditInGallery=". $galerigosterrow['id'].""; ?>"
      title="Düzenle" alt="Düzenle">
      <i class="fas fa-pen"></i></a>
    </div>

  </div>
  </li>

<?php
 } 
} ?>


</ul>

<script>
  $( function() {
    $( "#post_list" ).sortable();
    $( "#post_list" ).disableSelection();
  } );
  
function updateDisplayOrder() {
  var post_order_ids = new Array();
    $('#post_list li').each(function(){
      post_order_ids.push($(this).data("post-id"));
      $("#galerisira").html(post_order_ids);
      $("#galerisira").val(post_order_ids);
    });
} 
  </script>

 <input type= "hidden" name="galerisira" id="galerisira" /> 
      <button type="submit" class="btn-block btn btn-md btn-primary shadow-md" onClick="updateDisplayOrder()" name="SaveOrder">
        <i class="fas fa-save fa-lg fa-fw"></i>Sıralamayı Kaydet
      </button>
</form> 

<!--- SAYFA GALERİ BİTİŞ -->




            </div>
            <!-- /.card-body -->
       </div><!-- /.card-->




