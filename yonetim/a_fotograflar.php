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



if(isset($_GET['action'])) {
    $action=$_GET['action'] ;
}
else { $action="";}
 
///


 // ONCE EN ESKI ID Yİ BUL. İSİMLENDİRME İÇİN////////////////////////

  $sql_fotomaxid="SELECT id FROM fotograflar ORDER BY id DESC LIMIT 1";   
    if ($result_fotomaxid = $mysqli -> query($sql_fotomaxid)) {
      while ($row_fotomaxid= $result_fotomaxid -> fetch_row()) {
                         $fotomaxid=  $row_fotomaxid[0];
               }
      }

/////////////////////////////////////////////////////////////
// MAX SIRAYI BUL. İSİMLENDİRME İÇİN////////////////////////7
              $sql_fotomaxsira="SELECT sira FROM fotograflar ORDER BY sira DESC LIMIT 1";   
              if ($result_fotomaxsira = $mysqli -> query($sql_fotomaxsira)) {

                    while ($row_fotomaxsira= $result_fotomaxsira -> fetch_row()) {
                                       $fotomaxsira=  $row_fotomaxsira[0];
                             }
                    }

              if(isset($fotomaxsira)) {  $fotoyenisira = $fotomaxsira + 1; } else { $fotoyenisira = 1 ;}
/////////////////////////////////////////////////////////////


 /////////////////////////////////////////////////////////////             
$fotocollapsed="collapsed-card";

 ///////////// DOSYA YÜKLEME //////////////////

// UPLOAD A GÖNDERECEĞİ PARAMETRELER
$target_dir=UPLOADDIR."/fotograflar/";
 //$dosyaad
$allowfiletypes=array('jpg', 'png', 'jpeg', 'gif', 'webp','svg');
//  // SADECE RESİM DOSYALARI
$maxfilesize= 10000000 ; // 10 MB 


////////////////////////////////////////////////////////////////////
 
// KAYDETME YA DA EDİTLEME

if(isset($_POST['fotoyukle'])) {

        $uploadMesaj="";
         // ADINI AL
        if(!empty($_POST['fotoad']))  { // Adını formdan Girdiyse
               $dosyaad=PrettyURLyap($_POST['fotoad']); // uzantısız 
            }
        elseif (isset($_POST['editfotoad'])) {  // Orjinal ismi kullanmaya devam
            $dosyaad=$_POST['editfotoad']; // uzantısız
         }
        elseif(isset($_FILES["fileToUpload"]["name"])) { // yuklenen dosya adını al
             $dosyagelenad=basename($_FILES["fileToUpload"]["name"]);
             $dosyaad = PrettyURLyap(substr($dosyagelenad, 0, strrpos($dosyagelenad, '.'))) . "_". ($fotomaxid+ 1) ;  //istenen ad
          }
        else {
             $uploaddurum = "error";
             $uploadMesaj="Dosya Yüklemediniz";
         }
        // uzantısını al. Yukardan gelmediyse
        if(isset($_POST['editfotouzanti'])) {
          $uzanti= $_POST['editfotouzanti'];
        }
        elseif(isset($_FILES["fileToUpload"]["name"]))  {
          $dosyagelenad=basename($_FILES["fileToUpload"]["name"]);
          $uzanti= strtolower(pathinfo($dosyagelenad,PATHINFO_EXTENSION)); // uzantısı
        }
        else {
          $uzanti="jpg";
        }

  
        // edit varsa 
         if(isset($_POST['editfotoid'])) {
                 ///////////////////////////////
                 $editfotoid=$_POST['editfotoid'];
                
               
                 $editfotoaktif=$_POST['fotoaktif'];
                 
                 $editfoto_yollu =$_POST['editfoto_yollu']; // rename için
                 $dosyatamad= $dosyaad.".".$uzanti;
                 $yuklenendosya= $target_dir . $dosyatamad; // yüklendiği yer

                echo "<h1>".$dosyaad."</h1>";
               echo "<h1>".$_POST['editfotoad']."</h1>";


                 if (( $dosyaad!= $_POST['editfotoad'] )  && (file_exists($yuklenendosya))) {
                    $uploaddurum = "error";
                    $uploadMesaj="Aynı isimde başka dosya var1";
                 }
                 else
                 {
                        $fotokayitsql = "UPDATE fotograflar SET 
                        adi = '$dosyatamad', res= '$dosyatamad', aktif = '$editfotoaktif'
                         WHERE id = '$editfotoid'";

                        if ($mysqli->query($fotokayitsql) === TRUE) {
                            if( rename($editfoto_yollu, $yuklenendosya)) {
                               $uploaddurum = "ok";
                               $uploadMesaj="foto Resmi Güncellendi";
                            } else {  
                                $uploaddurum = "error";
                                $uploadMesaj="foto dosyası isimlendirme hatası!";
                            } 
                         }
                     else {  
                            $uploaddurum = "error";
                            $uploadMesaj="foto dosyası veritabanı hatası!";
                    }    
            }  //   Logo resmi güncelleme bitiş 
         } //  isset($_POST['editlogoid'])) 
        // edit bitiş

  
       /// SIFIRDAN KAYIT

      if(isset($_FILES["fileToUpload"]["name"])) {
    
                 
                 $fotoaktif=$_POST['fotoaktif'];
                 
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
              
                  $fotokayitsql = "INSERT INTO fotograflar (adi, res,  sira, aktif ) 
                  VALUES ('$dosyatamad', '$dosyatamad',  '$fotoyenisira', '$fotoaktif')  ";
                  
                  if ($mysqli->query($fotokayitsql ) === TRUE) {
                                       $uploaddurum = "ok";
                                       $uploadMesaj="foto dosyası başarıyla yüklendi!";
                                    } else {
                                        $uploaddurum = "error";
                                       $uploadMesaj="foto dosyası veritabanı yükleme hatası oluştu";
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

/*
$git=BASE_ADMIN."a_sayfalar.php?k=".$k."&action=edit&id=".$secilisayfaid."&section=Galeri&toastmessage=".$toastmessage_image;
                       header("Location:".$git."");
                       */

                   //

                }
                 if($uploaddurum == "error") {
                   $toaster['error'] =  $uploadMesaj;
                }
          }
   
////////////////////////////////////////////////////////////////////////////////////


} // if isset $_POST['logoyukle']
        
///////////////  EDİT LOGO BİLGİLERİNİ ÇEK ///////////////////////////    
if($action=='FotoEdit') {
   $fotocollapsed="";
   $editfotoid= $_GET['id'];

   $sql_editfoto="SELECT adi, aktif FROM fotograflar  WHERE id= $editfotoid LIMIT 1"; 
         if ($result_editfoto = $mysqli -> query($sql_editfoto)) {
            while ($row_editfoto = $result_editfoto -> fetch_row()) {
                echo "GELDİ";
                         $editfoto_ad=  $row_editfoto[0]; 
                         $editfoto_yollu= $target_dir.$editfoto_ad; 
                         $editfoto_uzantisiz = substr($editfoto_ad, 0, strrpos($editfoto_ad, '.'));
                         $editfoto_uzanti = pathinfo($editfoto_ad, PATHINFO_EXTENSION); 
                         
                         $editfoto_aktif= $row_editfoto[1];
   
   }  // while kapat
 }  // İF kapat
}
/////////////////////////////////////////////


////////////////////// GALERİDEN RESİM SİLME İŞİ //////////////////////

if($action=='FotoDelete') {

 $silinecekfoto= $_GET['id'];
// adını çek
 $sql_silenecekfoto="SELECT adi FROM fotograflar WHERE id= $silinecekfoto LIMIT 1";
         if ($result_silenecekfotocek = $mysqli -> query($sql_silenecekfoto)) {
            while ($row_silenecekfotocek = $result_silenecekfotocek -> fetch_row()) {
                         $silenecekfotocek_ad=  $row_silenecekfotocek[0];
                         $silenecekfotoocek_yollu= $target_dir.$silenecekfotocek_ad;

   }  // while kapat
 }  // İF kapat

        // SQL DEN SİL
         $silfotosql = "DELETE FROM fotograflar WHERE id=$silinecekfoto";
          if ($mysqli->query($silfotosql) === TRUE) {
          //echo "Record deleted successfully";
            if(isset($silenecekfoto_yollu)) { unlink($silenecekfoto_yollu); } // FİZİKSEL SİL
            $toaster['success'] = " foto Listesinden Kayıt Silinmiştir...";
          } else {
          echo "Error deleting record: " . $mysqli->error;
        }
    
}  // if(isset($_GET['DeleteImage'])) 
////////////////////////////////////////////


///////////////////////// VARSAYILAN YAPMA /////////////////////
if($action=='MakeAktif') 
{
    $varsayilanyap= $_GET['id'];
    $varsayilansql= "UPDATE fotograflar SET aktif='1' WHERE id = '$varsayilanyap'";
          if ($mysqli->query($varsayilansql) === TRUE) {
                $toaster['info'] = "Seçilen Aktif Yapıldı...";
                } else {
                    echo "Error: " . $sql . "<br>" . $mysqli->error;
                  }

}
//////////////////////////////////////////////////////
///////////////////// SIRALAMA KODU//////////////////

if( $action=='ReOrder') {
  $fotosiralama= $_POST['fotosira'];
  

  $fotosiralama= explode(',', $fotosiralama);
  $sirasi=0;
  foreach ($fotosiralama as $key => $siradaki) {
  $sirasi=$sirasi+1;
     $stmt1 = $mysqli->prepare("UPDATE fotograflar SET sira=? WHERE id=?");
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
            <h1 class="m-0">Foto Arşivi Yönetim</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Anasayfa</a></li>
              <li class="breadcrumb-item active">Foto Yönetim</li>
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
                <h3 class="card-title">Fotoğraf Listesi</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">

<!-- GALERİ GÖSTER BAŞLANGIç -->

<form name="frmQA" method="POST" action="<?php echo"a_fotograflar.php?action=ReOrder"; ?>" />
 
<ul class="list-group tablelist" id="post_list">

<?php
//get rows query 

$fotogostersql= "SELECT * FROM fotograflar ORDER BY sira ASC ";

$fotogosterquery = mysqli_query($mysqli, $fotogostersql );
 
//number of rows
$fotogosterrowCount = mysqli_num_rows($fotogosterquery);
if($fotogosterrowCount > 0){ 
  while($fotogosterrow = mysqli_fetch_assoc($fotogosterquery)){ 
  
  $sayfaaktif= $fotogosterrow['aktif'];
//$sayfaaktif  imajı
    if($sayfaaktif == 1 ) {
      $aktifsimge="<i class=\"fas fa-check-circle\"></i>";
    }
    else { $aktifsimge="<i class=\"fas fa-times-circle\"></i>";
    }
//$sayfadil  imajı
   //$sayfadil =$fotogosterrow['dil']; 
  $sayfadil=1;
   $dilsimge="<img src=\"img/flags/".$dil[$sayfadil].".png\">";


  $aktiflik="";
  if(isset($_GET['id']))
  {
     if($_GET['id']== $fotogosterrow['id']){
       $aktiflik = " active";
     }
  }


?>

 <li data-post-id="<?php echo $fotogosterrow['id']; ?>" class="list-group-item<?php echo $aktiflik; ?>"  style="padding:5px !important;  margin: 0px !important;"> 
 <div class="row">

    <div class="col-sm">
      <i class="fas fa-arrows-alt"></i>

      <?php echo  $aktifsimge." ".$dilsimge; 
      //$fotogosterrow['sira'] ;
       ?>

    <a class="btn" href="<?php echo $target_dir. $fotogosterrow['adi']; ?>" data-toggle="lightbox" data-title="<?php echo $fotogosterrow['adi']; ?>"><?php echo $fotogosterrow['adi'] ; ?> </a>

    </div>
    <div class="col-sm text-right">

      <a class="btn btnkucuk" data-toggle="modal" data-target="#confirm-delete" 
      data-delurl="<?php echo "a_fotograflar.php?action=FotoDelete&id=". $fotogosterrow['id'] .""; ?>"
      title="Sil" alt="Sil">
      <i class="fas fa-trash"></i></a>
      <a class="btn btnkucuk" href="<?php echo "a_fotograflar.php?action=FotoEdit&id=". $fotogosterrow['id'].""; ?>"
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
      $("#fotosira").html(post_order_ids);
      $("#fotosira").val(post_order_ids);
    });
} 
  </script>

 <input type= "hidden" name="fotosira" id="fotosira" /> 
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

        <div class="card <?php echo $fotocollapsed; ?> card-info">
              
              <div class="card-header">
                <h3 class="card-title"> Fotoğraf Yükle</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                 

 <form action="<?php echo"a_fotograflar.php?action=FotoUpload"; ?>" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                 
<?php if(isset($editfotoid)) {

?>

  <input type="hidden"  name="editfotoid" value="<?php echo $editfotoid; ?>">
  <input type="hidden"  name="editfotoad" value="<?php echo $editfoto_uzantisiz; ?>">
  <input type="hidden"  name="editfotouzanti" value="<?php echo $editfoto_uzanti; ?>"> 
  <input type="hidden"  name="editfoto_yollu" value="<?php echo $editfoto_yollu ; ?>">
  <a href="<?php echo $editfoto_yollu; ?>" data-toggle="lightbox" data-title="<?php echo $editfoto_yollu; ?>">
    <img src="<?php echo $editfoto_yollu; ?>"  style="max-width: 200px; max-height: 200px;"/>
  </a>
<?php
}
else {
?>
                  <div class="form-group">
                    <label for="exampleInputFile">Foto Resim Dosyası Seç</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="InputFile" name="fileToUpload">
                        <label class="custom-file-label" for="InputFile">foto Resim Dosyası Seç</label>
                      </div>
                    </div>
                  </div>

<?php
}
?>

                  <div class="form-group">
                        <label>Adı</label>
                        <input type="text" class="form-control" placeholder="Girilmezse otomatik oluşturulacak" name="fotoad" 
                        value="<?php if(isset($editfoto_uzantisiz)) { echo $editfoto_uzantisiz ;} ?>">
                </div>

                  

                  

                <div class="form-group">
                <label for="fotoaktif">Aktiflik</label>
                <select name="fotoaktif" id="fotoaktif" class="form-control">
                    <?php if(!isset($editfoto_aktif)) {$editfoto_aktif='0'; } ?>
                    <option <?php echo ($editfoto_aktif == '0' ? " selected " : " "); ?>value="0">Pasif</option>
                    <option <?php echo ($editfoto_aktif == '1' ? " selected " : " "); ?>value="1">Aktif</option>
              </select>
              </div>

        
                <!-- /.card-body -->

               <div class="card-footer">
              <button type="submit" class="btn btn-primary btn-block" name="fotoyukle">Kaydet</button>
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