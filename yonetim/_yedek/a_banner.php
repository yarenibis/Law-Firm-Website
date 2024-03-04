<?php
// BAŞLATICI ÇAĞIR 
include_once("_baslatici.php");

// HEADER SAYFASINI ÇAĞIR 
include_once("cerceveler/header.php");

// SİDEBAR SAYFASINI ÇAĞIR 
include_once("cerceveler/sidebar.php");

//////////////////////////////////////////////////////////////////////////////////

// DİLLERİ DİZİYE AT
  // sayfa dil çek
$sqldil="SELECT ID, DilKodu FROM diller";             
 if ($resultdil = $mysqli -> query($sqldil)) {
  while ($rowdil = $resultdil -> fetch_row()) {
      $dil[$rowdil[0]] = $rowdil[1];

  }
}

/////////////////////////////////////////////////////

if(isset($_GET['action'])) {
    $action=$_GET['action'] ;
}
else { $action="";}
 
////////////////////////////////////////////////////////////
// TOAST MESAJLARI
// toastmessage=EditOk  , NewSaveOk
if(isset($_GET['toastmessage'])){
  
      $toaster[$_GET['toast']] = $_GET['toastmessage'];
   
}
/////////////////////////////////////////////////////////////////////


 // ONCE EN ESKI ID Yİ BUL. İSİMLENDİRME İÇİN////////////////////////

  $sql_bannermaxid="SELECT id FROM banner_resimler1 ORDER BY id DESC LIMIT 1";   
    if ($result_bannermaxid = $mysqli -> query($sql_bannermaxid)) {
      while ($row_bannermaxid= $result_bannermaxid -> fetch_row()) {
                         $bannermaxid=  $row_bannermaxid[0];
               }
      }

/////////////////////////////////////////////////////////////
// MAX SIRAYI BUL. İSİMLENDİRME İÇİN////////////////////////7
              $sql_bannermaxsira="SELECT sira FROM banner_resimler1 ORDER BY sira DESC LIMIT 1";   
              if ($result_bannermaxsira = $mysqli -> query($sql_bannermaxsira)) {

                    while ($row_bannermaxsira= $result_bannermaxsira -> fetch_row()) {
                                       $bannermaxsira=  $row_bannermaxsira[0];
                             }
                    }

              if(isset($bannermaxsira)) {  $banneryenisira = $bannermaxsira + 1; } else { $banneryenisira = 1 ;}
/////////////////////////////////////////////////////////////


 /////////////////////////////////////////////////////////////             
$bannercollapsed="collapsed-card";

 ///////////// DOSYA YÜKLEME //////////////////

// UPLOAD A GÖNDERECEĞİ PARAMETRELER
$target_dir=UPLOADDIR."/banner/";
 //$dosyaad
$allowfiletypes=array('jpg', 'png', 'jpeg', 'gif', 'webp','svg');
//  // SADECE RESİM DOSYALARI
$maxfilesize= 10000000 ; // 10 MB 


////////////////////////////////////////////////////////////////////
 
// KAYDETME YA DA EDİTLEME

if(isset($_POST['banneryukle'])) {

        $uploadMesaj="";
         // ADINI AL
        if(!empty($_POST['bannerad']))  { // Adını formdan Girdiyse
               $dosyaad=PrettyURLyap($_POST['bannerad']); // uzantısız 
            }
        elseif (isset($_POST['editbannerad'])) {  // Orjinal ismi kullanmaya devam
            $dosyaad=$_POST['editbannerad']; // uzantısız
         }
        elseif(isset($_FILES["fileToUpload"]["name"])) { // yuklenen dosya adını al
             $dosyagelenad=basename($_FILES["fileToUpload"]["name"]);
             $dosyaad = PrettyURLyap(substr($dosyagelenad, 0, strrpos($dosyagelenad, '.'))) . "_". ($bannermaxid+ 1) ;  //istenen ad
          }
        else {
             $uploaddurum = "error";
             $uploadMesaj="Dosya Yüklemediniz";
         }
        // uzantısını al. Yukardan gelmediyse
        if(isset($_POST['editbanneruzanti'])) {
          $uzanti= $_POST['editbanneruzanti'];
        }
        elseif(isset($_FILES["fileToUpload"]["name"]))  {
          $dosyagelenad=basename($_FILES["fileToUpload"]["name"]);
          $uzanti= strtolower(pathinfo($dosyagelenad,PATHINFO_EXTENSION)); // uzantısı
        }
        else {
          $uzanti="jpg";
        }

  
        // edit varsa 
         if(isset($_POST['editbannerid'])) {
                 ///////////////////////////////
                 $editbannerid=$_POST['editbannerid'];
                 $editbannerurl=$_POST['bannerurl'];
               
                 $editbanneraktif=$_POST['banneraktif'];
                 
                 $editbanner_yollu =$_POST['editbanner_yollu']; // rename için
                 $dosyatamad= $dosyaad.".".$uzanti;
                 $yuklenendosya= $target_dir . $dosyatamad; // yüklendiği yer

                 if (( $dosyaad!= $_POST['editbannerad'] )  && (file_exists($yuklenendosya))) {
                    $uploaddurum = "error";
                    $uploadMesaj="Aynı isimde başka dosya var";
                 }
                 else
                 {
                        $bannerkayitsql = "UPDATE banner_resimler1 SET 
                        adi = '$dosyatamad', res= '', url = '$editbannerurl' , aktif = '$editbanneraktif'
                         WHERE id = '$editbannerid'";

                        if ($mysqli->query($bannerkayitsql) === TRUE) {
                            if( rename($editbanner_yollu, $yuklenendosya)) {
                               $uploaddurum = "ok";
                               $uploadMesaj="banner Resmi Güncellendi";
                            } else {  
                                $uploaddurum = "error";
                                $uploadMesaj="banner dosyası isimlendirme hatası!";
                            } 
                         }
                     else {  
                            $uploaddurum = "error";
                            $uploadMesaj="banner dosyası veritabanı hatası!";
                    }    
            }  //   Logo resmi güncelleme bitiş 
         } //  isset($_POST['editlogoid'])) 
        // edit bitiş

  
       /// SIFIRDAN KAYIT

      if(isset($_FILES["fileToUpload"]["name"])) {
    
                 
                 $banneraktif=$_POST['banneraktif'];
                 $bannerurl= $_POST['bannerurl'];
                 $dosyatamad= $dosyaad.".".$uzanti;
                 $yuklenendosya= $target_dir . $dosyatamad; // yüklendiği yer

             //$dosyaad , $target_dir zaten geldi
             include("gerekli/upload.php");
             // ÇIKTILARI 
              // $uploadMesaj
              // $uploaddurum= ok / error
              // $dosyatamad
              //if($uploadOk == 1)
              if(true) {
              
                  $bannerkayitsql = "INSERT INTO banner_resimler1 (adi, res, url,  sira, aktif ) 
                  VALUES ('$dosyatamad', '', '$bannerurl', '$banneryenisira', '$banneraktif')  ";
                  
                  if ($mysqli->query($bannerkayitsql ) === TRUE) {
                                       $uploaddurum = "ok";
                                       $uploadMesaj="banner dosyası başarıyla yüklendi!";
                                    } else {
                                        $uploaddurum = "error";
                                       $uploadMesaj="banner dosyası veritabanı yükleme hatası oluştu";
                                    }
               }
               else {  
                       // cıktı =$uploaddurum, $uploadMesaj
                }    

        }// sıfırdan kayıt bitiş

////////////////////////////// HATA MESAJLARINI GÖNDER//////////////////////////////////////

   
          if(isset($uploaddurum)) {
                if($uploaddurum == "ok") {
                   $toaster['success'] =  $uploadMesaj;
                   // 

                    $git=BASE_ADMIN."a_banner.php?toast=info&toastmessage=".$uploadMesaj;
                    header("Location:".$git."");
                      

                   //

                }
                 if($uploaddurum == "error") {
                   $toaster['error'] =  $uploadMesaj;
                }
          }
   
////////////////////////////////////////////////////////////////////////////////////


} // if isset $_POST['logoyukle']
        
///////////////  EDİT LOGO BİLGİLERİNİ ÇEK ///////////////////////////    
if($action=='BannerEdit') {
   $bannercollapsed="";
   $editbannerid= $_GET['id'];
   $sql_editbanner="SELECT adi, url, aktif FROM banner_resimler1  WHERE id= $editbannerid LIMIT 1"; 
         if ($result_editbanner = $mysqli -> query($sql_editbanner)) {
            while ($row_editbanner = $result_editbanner -> fetch_row()) {
                         $editbanner_ad=  $row_editbanner[0]; 
                         $editbanner_yollu= $target_dir.$editbanner_ad; 
                         $editbanner_uzantisiz = substr($editbanner_ad, 0, strrpos($editbanner_ad, '.'));
                         $editbanner_uzanti = pathinfo($editbanner_ad, PATHINFO_EXTENSION); 
                         $editbanner_url= $row_editbanner[1]; 
                         $editbanner_aktif= $row_editbanner[2];
   
   }  // while kapat
 }  // İF kapat
}
/////////////////////////////////////////////


////////////////////// GALERİDEN RESİM SİLME İŞİ //////////////////////

if($action=='BannerDelete') {

 $silinecekbanner= $_GET['id'];
// adını çek
 $sql_silenecekbanner="SELECT adi FROM banner_resimler1 WHERE id= $silinecekbanner LIMIT 1";
         if ($result_silenecekbannercek = $mysqli -> query($sql_silenecekbanner)) {
            while ($row_silenecekbannercek = $result_silenecekbannercek -> fetch_row()) {
                         $silenecekbannercek_ad=  $row_silenecekbannercek[0];
                         $silenecekbannerocek_yollu= $target_dir.$silenecekbannercek_ad;

   }  // while kapat
 }  // İF kapat

        // SQL DEN SİL
         $silbannersql = "DELETE FROM banner_resimler1 WHERE id=$silinecekbanner";
          if ($mysqli->query($silbannersql) === TRUE) {
          //echo "Record deleted successfully";
            if(isset($silenecekbanner_yollu)) { unlink($silenecekbanner_yollu); } // FİZİKSEL SİL
            $toaster['success'] = " banner Listesinden Kayıt Silinmiştir...";
          } else {
          echo "Error deleting record: " . $mysqli->error;
        }
    
}  // if(isset($_GET['DeleteImage'])) 
////////////////////////////////////////////


///////////////////////// VARSAYILAN YAPMA /////////////////////
if($action=='MakeAktif') 
{
    $varsayilanyap= $_GET['id'];
    $varsayilansql= "UPDATE banner_resimler1 SET aktif='1' WHERE id = '$varsayilanyap'";
          if ($mysqli->query($varsayilansql) === TRUE) {
                $toaster['info'] = "Seçilen Aktif Yapıldı...";
                } else {
                    echo "Error: " . $sql . "<br>" . $mysqli->error;
                  }

}
//////////////////////////////////////////////////////
///////////////////// SIRALAMA KODU//////////////////

if( $action=='ReOrder') {
  $bannersiralama= $_POST['bannersira'];
  

  $bannersiralama= explode(',', $bannersiralama);
  $sirasi=0;
  foreach ($bannersiralama as $key => $siradaki) {
  $sirasi=$sirasi+1;
     $stmt1 = $mysqli->prepare("UPDATE banner_resimler1 SET sira=? WHERE id=?");
     $stmt1->bind_param('ii', $sirasi, $siradaki );
      if( $stmt1->execute()){
        $toaster['info'] = "Sıralama Değiştirildi!";
      }
            else {
          $toaster['error'] =  "Hata Oluştu.Sıralama Değiştirilemedi!";
        }
  
    } 
  

}
 


/////////////////////////////////////
?>




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Banner Yönetim</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Anasayfa</a></li>
              <li class="breadcrumb-item active">Banner Yönetim</li>
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
         
 <!--sol taraf -->
 <div class="col-md-6">


<!--- SAYFA GALERİ KISMI ---> 

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Banner Listesi</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">

<!-- GALERİ GÖSTER BAŞLANGIç -->

<form name="frmQA" method="POST" action="<?php echo"a_banner.php?action=ReOrder"; ?>" />
 
<ul class="list-group tablelist" id="post_list">

<?php
//get rows query 

$bannergostersql= "SELECT * FROM banner_resimler1 ORDER BY sira ASC ";

$bannergosterquery = mysqli_query($mysqli, $bannergostersql );
 
//number of rows
$bannergosterrowCount = mysqli_num_rows($bannergosterquery);
if($bannergosterrowCount > 0){ 
  while($bannergosterrow = mysqli_fetch_assoc($bannergosterquery)){ 
  
  $sayfaaktif= $bannergosterrow['aktif'];
//$sayfaaktif  imajı
    if($sayfaaktif == 1 ) {
      $aktifsimge="<i class=\"fas fa-check-circle\"></i>";
    }
    else { $aktifsimge="<i class=\"fas fa-times-circle\"></i>";
    }
//$sayfadil  imajı
   //$sayfadil =$bannergosterrow['dil']; 
  $sayfadil=1;
   $dilsimge="<img src=\"img/flags/".$dil[$sayfadil].".png\">";


  $aktiflik="";
  if(isset($_GET['id']))
  {
     if($_GET['id']== $bannergosterrow['id']){
       $aktiflik = " active";
     }
  }


?>

 <li data-post-id="<?php echo $bannergosterrow['id']; ?>" class="list-group-item<?php echo $aktiflik; ?>"  style="padding:5px !important;  margin: 0px !important;"> 
 <div class="row">

    <div class="col-sm">
      <i class="fas fa-arrows-alt"></i>

      <?php echo  $aktifsimge." ".$dilsimge; 
      //$bannergosterrow['sira'] ;
       ?>

    <a class="btn" href="<?php echo $target_dir. $bannergosterrow['adi']; ?>" data-toggle="lightbox" data-title="<?php echo $bannergosterrow['adi']; ?>"><?php echo $bannergosterrow['adi'] ; ?> </a>

    </div>
    <div class="col-sm text-right">

      <a class="btn btnkucuk" data-toggle="modal" data-target="#confirm-delete" 
      data-delurl="<?php echo "a_banner.php?action=BannerDelete&id=". $bannergosterrow['id'] .""; ?>"
      title="Sil" alt="Sil">
      <i class="fas fa-trash"></i></a>
      <a class="btn btnkucuk" href="<?php echo "a_banner.php?action=BannerEdit&id=". $bannergosterrow['id'].""; ?>"
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
      $("#bannersira").html(post_order_ids);
      $("#bannersira").val(post_order_ids);
    });
} 
  </script>

 <input type= "hidden" name="bannersira" id="bannersira" /> 
      <button type="submit" class="btn-block btn btn-md btn-primary shadow-md" onClick="updateDisplayOrder()" name="SaveOrder">
        <i class="fas fa-save fa-lg fa-fw"></i>Sıralamayı Kaydet
      </button>
</form> 

<!--- SAYFA GALERİ BİTİŞ -->


            </div>
            <!-- /.card-body -->
       </div><!-- /.card-->



</div>  <!-- SOL TARAF COL BİTİŞ -->

<!---------------------------------------------------------------->



<div class="col-md-6">


   <!-- SAĞ TARAf -->


    

<!--YENİ DOSYA EKLE CARDI  -->

        <div class="card <?php echo $bannercollapsed; ?> card-info">
              
              <div class="card-header">
                <h3 class="card-title"> Banner Yükle</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                 

 <form action="<?php echo"a_banner.php?action=BannerUpload"; ?>" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                 
<?php if(isset($editbannerid)) {

?>

  <input type="hidden"  name="editbannerid" value="<?php echo $editbannerid; ?>">
  <input type="hidden"  name="editbannerad" value="<?php echo $editbanner_ad; ?>">
  <input type="hidden"  name="editbanneruzanti" value="<?php echo $editbanner_uzanti; ?>"> 
  <input type="hidden"  name="editbanner_yollu" value="<?php echo $editbanner_yollu ; ?>">
  <a href="<?php echo $editbanner_yollu; ?>" data-toggle="lightbox" data-title="<?php echo $editbanner_yollu; ?>">
    <img src="<?php echo $editbanner_yollu; ?>"  style="max-width: 200px; max-height: 200px;"/>
  </a>
<?php
}
else {
?>
                  <div class="form-group">
                    <label for="exampleInputFile">Banner Resim Dosyası Seç</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="InputFile" name="fileToUpload">
                        <label class="custom-file-label" for="InputFile">Banner Resim Dosyası Seç</label>
                      </div>
                    </div>
                  </div>

<?php
}
?>

                  <div class="form-group">
                        <label>Adı</label>
                        <input type="text" class="form-control" placeholder="Girilmezse otomatik oluşturulacak" name="bannerad" 
                        value="<?php if(isset($editbanner_uzantisiz)) { echo $editbanner_uzantisiz ;} ?>">
                </div>

                  <div class="form-group">
                        <label>URL</label>
                        <input type="text" class="form-control" placeholder="" name="bannerurl" 
                        value="<?php if(isset($editbanner_url)) { echo $editbanner_url ;} ?>">
                </div>

                  

                <div class="form-group">
                <label for="banneraktif">Aktiflik</label>
                <select name="banneraktif" id="banneraktif" class="form-control">
                    <?php if(!isset($editbanner_aktif)) {$editbanner_aktif='0'; } ?>
                    <option <?php echo ($editbanner_aktif == '0' ? " selected " : " "); ?>value="0">Pasif</option>
                    <option <?php echo ($editbanner_aktif == '1' ? " selected " : " "); ?>value="1">Aktif</option>
              </select>
              </div>

        
                <!-- /.card-body -->

               <div class="card-footer">
              <button type="submit" class="btn btn-primary btn-block" name="banneryukle">Kaydet</button>
            </div>
              </form>
 
              </div>

            </div>

        <!--YENİ EKLE CARDI BİTİŞ  -->




</div>  <!-- COL BİTİş -->

</div> <!-- row BİTİş -->




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

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
  // FOOTER SAYFASINI ÇAĞIR 
    include_once("cerceveler/footer.php");
?>