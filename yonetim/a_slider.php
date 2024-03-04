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

//////////////////////////////////////////////////////////////////////////////

// TOAST MESAJLARI
// toastmessage=EditOk  , NewSaveOk
if(isset($_GET['toastmessage'])){
  
      $toaster[$_GET['toast']] = $_GET['toastmessage'];
   
}
 
/////////////////////////////////////////////////////////////

if(isset($_GET['action'])) {
    $action=$_GET['action'] ;
}
else { $action="";}
 
///


 // ONCE EN ESKI ID Yİ BUL. İSİMLENDİRME İÇİN////////////////////////

  $sql_slidermaxid="SELECT id FROM slider ORDER BY id DESC LIMIT 1";   
    if ($result_slidermaxid = $mysqli -> query($sql_slidermaxid)) {
      while ($row_slidermaxid= $result_slidermaxid -> fetch_row()) {
                         $slidermaxid=  $row_slidermaxid[0];
               }
      }

/////////////////////////////////////////////////////////////
// MAX SIRAYI BUL. İSİMLENDİRME İÇİN////////////////////////7
              $sql_slidermaxsira="SELECT sira FROM slider ORDER BY sira DESC LIMIT 1";   
              if ($result_slidermaxsira = $mysqli -> query($sql_slidermaxsira)) {

                    while ($row_slidermaxsira= $result_slidermaxsira -> fetch_row()) {
                                       $slidermaxsira=  $row_slidermaxsira[0];
                             }
                    }

              if(isset($slidermaxsira)) {  $slideryenisira = $slidermaxsira + 1; } else { $slideryenisira = 1 ;}
/////////////////////////////////////////////////////////////


 /////////////////////////////////////////////////////////////             
$slidercollapsed="collapsed-card";

 ///////////// DOSYA YÜKLEME //////////////////

// UPLOAD A GÖNDERECEĞİ PARAMETRELER
$target_dir=UPLOADDIR."/slider/";
 //$dosyaad
$allowfiletypes=array('jpg', 'png', 'jpeg', 'gif', 'webp','svg');
//  // SADECE RESİM DOSYALARI
$maxfilesize= 10000000 ; // 10 MB 


////////////////////////////////////////////////////////////////////
 
// KAYDETME YA DA EDİTLEME

if(isset($_POST['slideyukle'])) {

        $uploadMesaj="";
         // ADINI AL
        if(!empty($_POST['slidead']))  { // Adını formdan Girdiyse
               $dosyaad=PrettyURLyap($_POST['slidead']); // uzantısız 
            }
        elseif (isset($_POST['editslidead'])) {  // Orjinal ismi kullanmaya devam
            $dosyaad=$_POST['editslidead']; // uzantısız
         }
        elseif(isset($_FILES["fileToUpload"]["name"])) { // yuklenen dosya adını al
             $dosyagelenad=basename($_FILES["fileToUpload"]["name"]);
             $dosyaad = PrettyURLyap(substr($dosyagelenad, 0, strrpos($dosyagelenad, '.'))) . "_". ($slidermaxid+ 1) ;  //istenen ad
          }
        else {
             $uploaddurum = "error";
             $uploadMesaj="Dosya Yüklemediniz";
         }
        // uzantısını al. Yukardan gelmediyse
        if(isset($_POST['editslideuzanti'])) {
          $uzanti= $_POST['editslideuzanti'];
        }
        elseif(isset($_FILES["fileToUpload"]["name"]))  {
          $dosyagelenad=basename($_FILES["fileToUpload"]["name"]);
          $uzanti= strtolower(pathinfo($dosyagelenad,PATHINFO_EXTENSION)); // uzantısı
        }
        else {
          $uzanti="jpg";
        }

  
        // edit varsa 
         if(isset($_POST['editslideid'])) {
                 ///////////////////////////////
                 $editslideid=$_POST['editslideid'];
                 $editslideurl=$_POST['slideurl'];
                 $editslideaciklama1=$_POST['slideaciklama1'];
                 $editslideaciklama2=$_POST['slideaciklama2'];
                 $editslideaciklama3=$_POST['slideaciklama3'];
                 $editslidebuton=$_POST['slidebuton'];
                 $editslideaktif=$_POST['slideaktif'];
                 $editslidedil=$_POST['slidedil'];
                 $editslide_yollu =$_POST['editslide_yollu']; // rename için
                 $dosyatamad= $dosyaad.".".$uzanti;
                 $yuklenendosya= $target_dir . $dosyatamad; // yüklendiği yer
                 echo "***".$editslideaciklama1."***";

                 if ( ( $dosyaad!= $_POST['editslidead'] )  && (file_exists($yuklenendosya))) {
                    $uploaddurum = "error";
                    $uploadMesaj="Aynı isimde başka dosya var";
                 }
                 else
                 {
                        $slidekayitsql = "UPDATE slider SET 
                        adi = '$dosyatamad', res= '', url = '$editslideurl' , aciklama1 = '$editslideaciklama1',
                        aciklama2 = '$editslideaciklama2', aciklama3 = '$editslideaciklama3', buton = '$editslidebuton' ,
                        aktif = '$editslideaktif',  dil = '$editslidedil' WHERE id = '$editslideid'";
                          
                      
                        if ($mysqli->query($slidekayitsql) === TRUE) {
							 header("Location:?action=SliderEdit&id=".$editslideid."");
                            if( rename($editslide_yollu, $yuklenendosya)) {
                               $uploaddurum = "ok";
                               $uploadMesaj="Slide Resmi Güncellendi";
                            } else {  
                                $uploaddurum = "error";
                                $uploadMesaj="Slide dosyası isimlendirme hatası!";
                            } 
                         }
                     else {  
                            $uploaddurum = "error";
                            $uploadMesaj="Slide dosyası veritabanı hatası!";
                    }    
            }  //   Logo resmi güncelleme bitiş 
         } //  isset($_POST['editlogoid'])) 
        // edit bitiş

  
       /// SIFIRDAN KAYIT

      if(isset($_FILES["fileToUpload"]["name"])) {
    
                 $slideurl=$_POST['slideurl'];
                 $slideaciklama1=$_POST['slideaciklama1'];
                 $slideaciklama2=$_POST['slideaciklama2'];
                 $slideaciklama3=$_POST['slideaciklama3'];
                 $slidebuton=$_POST['slidebuton'];
                 $slideaktif=$_POST['slideaktif'];
                 $slidedil=$_POST['slidedil'];
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
              
                  $slidekayitsql = "INSERT INTO slider (adi, url, aciklama1, aciklama2, aciklama3, buton, sira, res, aktif , dil) 
                  VALUES ('$dosyatamad', '$slideurl', '$slideaciklama1','$slideaciklama2','$slideaciklama3',
                  '$slidebuton', '$slideryenisira', '', '$slideaktif', '$slidedil' )  ";
                  //echo  $slidekayitsql;
                  if ($mysqli->query($slidekayitsql ) == TRUE) {

                                       $uploaddurum = "ok";
                                       $uploadMesaj="Slide dosyası başarıyla yüklendi!";
                                    } else {
                                        $uploaddurum = "error";
                                       $uploadMesaj="Slide dosyası veritabanı yükleme hatası oluştu";
                                    }

               }
               else {  
                       // cıktı =$uploaddurum, $uploadMesaj
                }    

        }// sıfırdan kayıt bitiş

////////////////////////////// HATA MESAJLARINI GÖNDER//////////////////////////////////////

   
          if(isset($uploaddurum)) {
                if($uploaddurum == "ok") {
                   //$toaster['success'] =  $uploadMesaj;
                   
                   $gitek="";
                   if(isset($_POST['editslideid'])) { $gitek= "&action=SliderEdit&id=".$_POST['editslideid'].""; }



                   $git=BASE_ADMIN."a_slider.php?toast=info&toastmessage=".$uploadMesaj.$gitek;
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
if($action=='SliderEdit') {
   $slidecollapsed="";
   $editslideid= $_GET['id'];
   $sql_editslide="SELECT adi, url, aciklama1, aciklama2, aciklama3, buton, aktif, dil FROM slider  WHERE id= $editslideid LIMIT 1"; 
         if ($result_editslide = $mysqli -> query($sql_editslide)) {
            while ($row_editslide = $result_editslide -> fetch_row()) {
                         $editslide_ad=  $row_editslide[0]; 
                         $editslide_yollu= $target_dir.$editslide_ad; 
                         $editslide_uzantisiz = substr($editslide_ad, 0, strrpos($editslide_ad, '.'));
                         $editslide_uzanti = pathinfo($editslide_ad, PATHINFO_EXTENSION); 
                         $editslide_url= $row_editslide[1]; 

                         $editslide_aciklama1= $row_editslide[2];
                         $editslide_aciklama2= $row_editslide[3];
                         $editslide_aciklama3= $row_editslide[4];

                         $editslide_buton= $row_editslide[5];
                         $editslide_aktif= $row_editslide[6];
                         $editslide_dil= $row_editslide[7];
  

   }  // while kapat
 }  // İF kapat
}
/////////////////////////////////////////////


////////////////////// GALERİDEN RESİM SİLME İŞİ //////////////////////

if($action=='SliderDelete') {

 $silinecekslide= $_GET['id'];
// adını çek
 $sql_silenecekslide="SELECT adi FROM slider WHERE id= $silinecekslide LIMIT 1";
         if ($result_silenecekslidecek = $mysqli -> query($sql_silenecekslide)) {
            while ($row_silenecekslidecek = $result_silenecekslidecek -> fetch_row()) {
                         $silenecekslidecek_ad=  $row_silenecekslidecek[0];
                         $silenecekslideocek_yollu= $target_dir.$silenecekslidecek_ad;

   }  // while kapat
 }  // İF kapat

        // SQL DEN SİL
         $silslidesql = "DELETE FROM slider WHERE id=$silinecekslide";
          if ($mysqli->query($silslidesql) === TRUE) {
          //echo "Record deleted successfully";
            if(isset($silenecekslide_yollu)) { unlink($silenecekslide_yollu); } // FİZİKSEL SİL
            $toaster['success'] = " Slide Listesinden Kayıt Silinmiştir...";
          } else {
          echo "Error deleting record: " . $mysqli->error;
        }
    
}  // if(isset($_GET['DeleteImage'])) 
////////////////////////////////////////////


///////////////////////// VARSAYILAN YAPMA /////////////////////
if(isset( $_GET['MakeAktif'] )) 
{
    $varsayilanyap= $_GET['MakeAktif'];
    $varsayilansql1 = "UPDATE logo SET aktif='0' WHERE aktif = '1'";
    $varsayilansql2= "UPDATE logo SET aktif='1' WHERE id = '$varsayilanyap'";
    if (($mysqli->query($varsayilansql1) === TRUE)) {
          if (($mysqli->query($varsayilansql2) === TRUE)) {
                $toaster['info'] = "Seçilen Aktif Yapıldı...";

                   }
                } else {
                    echo "Error: " . $sql . "<br>" . $mysqli->error;
                  }

}
//////////////////////////////////////////////////////
///////////////////// SIRALAMA KODU//////////////////

if( $action=='ReOrder') {
  $slidersiralama= $_POST['slidersira'];
  echo ">>>". $action;

  $slidersiralama= explode(',', $slidersiralama);
  $sirasi=0;
  foreach ($slidersiralama as $key => $siradaki) {
  $sirasi=$sirasi+1;
     $stmt1 = $mysqli->prepare("UPDATE slider SET sira=? WHERE id=?");
     $stmt1->bind_param('ii', $sirasi, $siradaki );
      if( $stmt1->execute()){
        $toaster['info'] = "Sıralama Değiştirildi!";
      }
            else {
          $toaster['error'] =  "Hata Oluştu.Sıralama Değiştirilemedi!";
        }
  
    } 
  

}
 
/////////////////////////////






/////////////////////////////////////
?>




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Slider Ayarları</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Anasayfa</a></li>
              <li class="breadcrumb-item active">Slider Ayarları</li>
              <li class="breadcrumb-item">  
                <a href="a_slider.php" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">
                  <i class="fas fa-plus-circle"></i>YENİ </a>
              </li>
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
                <h3 class="card-title">Slider Listesi</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">

<!-- GALERİ GÖSTER BAŞLANGIç -->

<form name="frmQA" method="POST" action="<?php echo"a_slider.php?action=ReOrder"; ?>" />
 
<ul class="list-group tablelist" id="post_list">

<?php
//get rows query 

$slidergostersql= "SELECT * FROM slider ORDER BY sira ASC ";

$slidergosterquery = mysqli_query($mysqli, $slidergostersql );
 
//number of rows
$slidergosterrowCount = mysqli_num_rows($slidergosterquery);
if($slidergosterrowCount > 0){ 
  while($slidergosterrow = mysqli_fetch_assoc($slidergosterquery)){ 
  
  $sayfaaktif= $slidergosterrow['aktif'];
//$sayfaaktif  imajı
    if($sayfaaktif == 1 ) {
      $aktifsimge="<i class=\"fas fa-check-circle\"></i>";
    }
    else { $aktifsimge="<i class=\"fas fa-times-circle\"></i>";
    }
//$sayfadil  imajı
   $sayfadil =$slidergosterrow['dil'];
   $dilsimge="<img src=\"img/flags/".$dil[$sayfadil].".png\">";


  $aktiflik="";
  if(isset($_GET['id']))
  {
     if($_GET['id']== $slidergosterrow['id']){
       $aktiflik = " active";
     }
  }


?>

 <li data-post-id="<?php echo $slidergosterrow['id']; ?>" class="list-group-item<?php echo $aktiflik; ?>"  style="padding:5px !important;  margin: 0px !important;"> 
 <div class="row">

    <div class="col-sm">
      <i class="fas fa-arrows-alt"></i>

      <?php echo  $aktifsimge." ".$dilsimge; 
      //$slidergosterrow['sira'] ;
       ?>
<!--
    <a class="btn" href="<?php echo $target_dir. $slidergosterrow['adi']; ?>" data-toggle="lightbox" data-title="<?php echo $slidergosterrow['adi']; ?>"><?php echo $slidergosterrow['adi'] ; ?> </a> -->


 <a href="<?php echo $target_dir. $slidergosterrow['adi']; ?>" data-toggle="lightbox" data-title="<?php echo $slidergosterrow['adi']; ?>"><?php if (strlen($slidergosterrow['adi'])>4){?><img src="/upload/slider/<?php echo $slidergosterrow['adi'] ; ?>" style="width:100%; float:left;"><?php }?></a>


    </div>
    <div class="col-sm text-right">

      <a class="btn btnkucuk" data-toggle="modal" data-target="#confirm-delete" 
      data-delurl="<?php echo "a_slider.php?action=SliderDelete&id=". $slidergosterrow['id'] .""; ?>"
      title="Sil" alt="Sil">
      <i class="fas fa-trash"></i></a>
      <a class="btn btnkucuk" href="<?php echo "a_slider.php?action=SliderEdit&id=". $slidergosterrow['id'].""; ?>"
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
      $("#slidersira").html(post_order_ids);
      $("#slidersira").val(post_order_ids);
    });
} 
  </script>
<br>
 <input type= "hidden" name="slidersira" id="slidersira" /> 
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

        <div class="card <?php echo $logocollapsed; ?> card-info">
              
              <div class="card-header">
                <h3 class="card-title"> Slider Yükle</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                 

 <form action="<?php echo"a_slider.php?action=SlideUpload"; ?>" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                 
<?php if(isset($editslideid)) {

?>

  <input type="hidden"  name="editslideid" value="<?php echo $editslideid; ?>">
  <input type="hidden"  name="editslidead" value="<?php echo $editslide_uzantisiz; ?>">
  <input type="hidden"  name="editslideuzanti" value="<?php echo $editslide_uzanti; ?>">
  <input type="hidden"  name="editslideuzantisiz" value="<?php echo $editslide_uzantisiz ; ?>">   
  <input type="hidden"  name="editslide_yollu" value="<?php echo $editslide_yollu ; ?>">
  <a href="<?php echo $editslide_yollu; ?>" data-toggle="lightbox" data-title="<?php echo $editslide_yollu; ?>">
    <img src="<?php echo $editslide_yollu; ?>"  style="max-width: 200px; max-height: 200px;"/>
  </a>
<?php
}
else {
?>
                  <div class="form-group">
                    <label for="exampleInputFile">Slider Resim Dosyası Seç</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="InputFile" name="fileToUpload">
                        <label class="custom-file-label" for="InputFile">Slider Resim Dosyası Seç</label>
                      </div>
                    </div>
                  </div>

<?php
}
?>

                  <div class="form-group">
                        <label>Adı</label>
                        <input type="text" class="form-control" placeholder="Girilmezse otomatik oluşturulacak" name="slidead" 
                        value="<?php if(isset($editslide_uzantisiz)) { echo $editslide_uzantisiz ;} ?>">
                </div>

                  <div class="form-group">
                        <label>URL</label>
                        <input type="text" class="form-control" placeholder="" name="slideurl" 
                        value="<?php if(isset($editslide_url)) { echo $editslide_url ;} ?>">
                </div>

            
                  <div class="form-group">

                        <label>Açıklama 1</label>
                        <input type="text" class="form-control" placeholder="" name="slideaciklama1" 
                        value="<?php if(isset($editslide_aciklama1)) { echo $editslide_aciklama1 ;} ?>">
                </div>
     

                  <div class="form-group">
                        <label>Açıklama 2</label>
                        <input type="text" class="form-control" placeholder="" name="slideaciklama2" 
                        value="<?php if(isset($editslide_aciklama2)) { echo $editslide_aciklama2 ;} ?>">
                </div>


                  <div class="form-group">
                        <label>Açıklama 3</label>
                        <input type="text" class="form-control" placeholder="" name="slideaciklama3" 
                        value="<?php if(isset($editslide_aciklama3)) { echo $editslide_aciklama3 ;} ?>">
                </div>

                <div class="form-group">
                        <label>Buton</label>
                        <input type="text" class="form-control" placeholder="" name="slidebuton" 
                        value="<?php if(isset($editslide_buton)) { echo $editslide_buton ;} ?>">
                </div>


                <div class="form-group">
                <label for="slideaktif">Aktiflik</label>
                <select name="slideaktif" id="slideaktif" class="form-control">
                    <?php if(!isset($editslide_aktif)) {$editslide_aktif='0'; } ?>
                    <option <?php echo ($editslide_aktif == '0' ? " selected " : " "); ?>value="0">Pasif</option>
                    <option <?php echo ($editslide_aktif == '1' ? " selected " : " "); ?>value="1">Aktif</option>
              </select>
              </div>

        <div class="form-group">
                <label for="slidedil">Dil </label>
                <select name="slidedil" id="slidedil" class="form-control">
                 <?php 
                    if(!isset($editslide_dil)) {$editslide_dil='1'; } 
                    $sqldil="SELECT ID, DilKodu,Adi FROM diller";             
                    if ($resultdil = $mysqli -> query($sqldil)) {
                      while ($rowdil = $resultdil -> fetch_row()) {
                      ?>
                       <option value="<?php echo $rowdil[0];?>" <?php echo ($editslide_dil == $rowdil[0] ? " selected " : " "); ?>><?php echo $rowdil[2]; ?> </option>
                      <?php
                    }
                   }
                 ?>     
              </select>
              </div>
                <!-- /.card-body -->

               <div class="card-footer">
              <button type="submit" class="btn btn-primary btn-block" name="slideyukle">Kaydet</button>
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