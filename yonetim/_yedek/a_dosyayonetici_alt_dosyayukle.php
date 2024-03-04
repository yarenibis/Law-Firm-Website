 <?php 
if (!defined("KORUMA")) {
  header("Location: ../404.html");
  exit();
}

////////// SEÇİLİ DİZİNİ AL ///////////////////

if(isset($_GET['Dir'])) {
  $anadizin=$_GET['Dir'];
  if($_GET['Dir']=='uploads') {
    $secilidizin=UPLOADDIR."/";
  }
  else {  
     $secilidizin=UPLOADDIR."/".$_GET['Dir']."/" ; 
   }
}
else  {
 $secilidizin=UPLOADDIR."/";
}

/////////////////////////////////////////////////////

 ///////////// DOSYA YÜKLEME //////////////////

// UPLOAD A GÖNDERECEĞİ PARAMETRELER
$target_dir=$secilidizin;
 //$dosyaad
$allowfiletypes=array('jpg', 'png', 'jpeg', 'gif', 'webp','svg', 'doc', 'docx', 'xls' , 'xlsx', 'ppt', 'pptx', 'pdf', 'mp4');
//  // SADECE RESİM DOSYALARI
$maxfilesize= 120000000 ; // 100 MB Tüm Dosyalar için

// KAYDETME 

if(isset($_POST['uploadfile'])) {
// Önce aynı isimde var mı kontrol ? //
 $dosyagelenadi=basename($_FILES["fileToUpload"]["name"]);
 $yuklenendosya= $target_dir . $dosyagelenadi; // yüklendiği yer
 $yuklenenuzantisi = strtolower(pathinfo($dosyagelenadi,PATHINFO_EXTENSION)); // uzantısı
 $yuklenen_uzantisiz = substr($dosyagelenadi, 0, strrpos($dosyagelenadi, '.'));
// dosya türü kontrol
if (in_array($yuklenenuzantisi , $allowfiletypes))
  {   // DOSYA TÜRÜ SAĞLANDI
    
  // Dosya var mı?
   if (file_exists($yuklenendosya)) {
      $uploadMesaj=  "Dosya zaten mevcut";
      $uploadOk = 0;
      /// YENİYİ FARKLI İSİMLE KAYDET
       $dosyaad= "copy_".$yuklenen_uzantisiz;
       include("gerekli/upload.php");  
// AYNISI VAR ÜZERİNE KAYDEDİLSİN Mİ?

   $git=BASE_ADMIN."a_dosyayonetici.php?Dir=".$anadizin."&onaymessage=RewriteOk&filename=".$yuklenendosya;
   header("Location:".$git."");



// AYNISI VAR ÜZERİNE KAYDEDİLSİN Mİ BİTİŞ
    }
    else { //dosyanın aynısında yoksa başla
     $dosyaad= $yuklenen_uzantisiz;
    //UPLOAD
      include("gerekli/upload.php");   
       $git=BASE_ADMIN."a_dosyayonetici.php?Dir=".$anadizin."&toastmessage=FileUploadOk";
       header("Location:".$git."");

    } // dosyanın aynısından yoksa bitiş

  } // DOSYA TÜRÜ SAĞLANDI BİTİŞ
else
  { // DOSYA TÜRÜ SAĞLANAMADI 
     $uploadMesaj=  "Dosya türü desteklenmiyor.";
     $uploaddurum=  "error";
  } // DOSYA TÜRÜ SAĞLANAMADI BİTİŞ


// HATA MESAJLARI/////////////////////
 if(isset($uploaddurum)) {
                if($uploaddurum == "ok") {
                   $toaster['success'] =  $uploadMesaj;
                }
                 if($uploaddurum == "error") {
                   $toaster['error'] =  $uploadMesaj;
                }
          }
////////////// HATA MESAJLARI BİT/////////////


} // // UPLOAD FİLE FORM GELDİYSE BİTİŞ


   // include("gerekli/upload.php");
          // ÇIKTILARI 
          // $uploadMesaj
          // $uploaddurum= ok / error
          // $dosyatamad
         /*





*/

/////////////// DOSYA ÜZERİNE YAZMA /////////////////
if($action=='Rewrite') 
{
   $rewritefilename= $_GET['filename'];
   $yenidosyaname= basename($rewritefilename);
   $sileskikopya= unlink ($rewritefilename);
   $isimlendiryenikopya= rename($secilidizin.'copy_'.$yenidosyaname, $rewritefilename);

   if($sileskikopya && $isimlendiryenikopya )
    {
       $git=BASE_ADMIN."a_dosyayonetici.php?Dir=".$anadizin."&toastmessage=RewriteOk";
       header("Location:".$git."");
      }
}


////////////////////////////////////////




/////////////////////////////////////
?>

 <!--YENİ DOSYA EKLE CARDI  -->


        <div class="card collapsed-card card-info">
              
              <div class="card-header">
                <h3 class="card-title"><?php echo $secilidizin . " Dizinine Yeni Dosya Yükle"; ?></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                 <form action="<?php echo "a_dosyayonetici.php?Dir=".$anadizin."&action=FileUpload" ;?>" method="POST"  enctype="multipart/form-data">


                  <div class="form-group"><label> Dosya  Seç</label>
                    <div class="input-group mb-3">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="InputFile" name="fileToUpload">
                        <label class="custom-file-label" for="InputFile">Dosya Seç</label>
                      </div>
                       <div class="input-group-append">
                          <button type="submit" class="btn btn-primary" name="uploadfile"> <i class="fas fa-upload"></i> YÜKLE</button>
                        </div>
                    </div>
                  </div>
     
                </form>
              </div>

            </div>

        <!--YENİ EKLE CARDI BİTİŞ  -->
 
<!------------- onay MESAJ MODAL ------------->

<?php
$mesajyaz="";
 if (isset($_GET['onaymessage'])) { 

    $onaymessage= $_GET['onaymessage'];
    switch ($onaymessage) {
      case "RewriteOk":
        $mesajyaz= "Dosya zaten mevcut olduğu için kopyası oluşturuldu, orjinalin üzerine yazılsın mı? <br>
        Üzerine Yazılacak Dosya: <br>";
        $rewritefilename=$_GET['filename'];
      break;
      
}

  ?>
<div id="onaymessage" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bilgi: </h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
        <p>
          <?php echo  $mesajyaz . $rewritefilename;


        ?></p>

         <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç (Kopya Kalır)</button>
          <a href="<?php echo "a_dosyayonetici.php?Dir=".$anadizin."&filename=".$rewritefilename."&action=Rewrite" ; ?>" id="silonay" class="btn btn-primary btn-md active" role="button">Tamam (Üzerine Yazılır)</a>
      </div>

                
            </div>
        </div>
    </div>
</div>

<?php
 }  // MODAL GÖSTER BİTİŞ

?>