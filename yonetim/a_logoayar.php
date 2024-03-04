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

///

/////////////////////////////////////////////////////////////
$logocollapsed="collapsed-card";

 ///////////// DOSYA YÜKLEME //////////////////

// UPLOAD A GÖNDERECEĞİ PARAMETRELER
$target_dir=UPLOADDIR."/logos/";
 //$dosyaad
$allowfiletypes=array('jpg', 'png', 'jpeg', 'gif', 'webp','svg');
//  // SADECE RESİM DOSYALARI
$maxfilesize= 10000000 ; // 10 MB 


////////////////////////////////////////////////////////////////////
 

// KAYDETME YA DA EDİTLEME

if(isset($_POST['logoyukle'])) {


        $uploadMesaj="";
         // ADINI AL
        if(!empty($_POST['logoad']))  { // Adını formdan Girdiyse
               $dosyaad=PrettyURLyap($_POST['logoad']); // uzantısız 

            }
        elseif (isset($_POST['editlogoeskiad'])) {  // Orjinal ismi kullanmaya devam
            $dosyaad=$_POST['editlogoeskiad']; // uzantısız
         }
        elseif(isset($_FILES["fileToUpload"]["name"])) { // yuklenen dosya adını al
             $dosyagelenad=basename($_FILES["fileToUpload"]["name"]);
             $dosyaad = PrettyURLyap(substr($dosyagelenad, 0, strrpos($dosyagelenad, '.')));  //istenen ad
          }
        else {
             $uploaddurum = "error";
             $uploadMesaj="Dosya Yüklemediniz";
         }
        
       // uzantısını al. Yukardan gelmediyse
        if(isset($_POST['editlogouzanti'])) {
          $uzanti= $_POST['editlogouzanti'];
        }
        elseif(isset($_FILES["fileToUpload"]["name"]))  {
          $dosyagelenad=basename($_FILES["fileToUpload"]["name"]);
          $uzanti= strtolower(pathinfo($dosyagelenad,PATHINFO_EXTENSION)); // uzantısı
        }
        else {
          $uzanti="jpg";
        }


        // edit varsa 
         if(isset($_POST['editlogoid'])) {
                 ///////////////////////////////
                 $editlogoid=$_POST['editlogoid'];
                 $logoalt= $_POST['logoalt'];
                 $logotur= $_POST['logotur'];
                 $editlogo_yollu =$_POST['editlogo_yollu'];
                 $dosyatamad= $dosyaad.".".$uzanti;
                 $yuklenendosya= $target_dir . $dosyatamad; // yüklendiği yer
                 if (( $dosyaad!= $_POST['editlogoeskiad'] )  &&  (file_exists($yuklenendosya)))  {
                    $uploaddurum = "error";
                    $uploadMesaj="Aynı isimde başka dosya var";
                 }
                 else
                 {
        

                        $logokayitsql = "UPDATE logo SET adi = '$dosyatamad', alt = '$logoalt', tur='$logotur' WHERE id = '$editlogoid'";
                        if ($mysqli->query($logokayitsql) === TRUE) {
                            if( rename($editlogo_yollu, $yuklenendosya)) {
                               $uploaddurum = "ok";
                               $uploadMesaj="Logo Resmi Güncellendi";
                            } else {  
                                $uploaddurum = "error";
                                $uploadMesaj="Logo dosyası isimlendirme hatası!";
                            } 
                         }
                     else {  
                            $uploaddurum = "error";
                            $uploadMesaj="Logo dosyası veritabanı hatası!";
                    }    
            }  //   Logo resmi güncelleme bitiş 
         } //  isset($_POST['editlogoid'])) 
        // edit bitiş
 
       /// SIFIRDAN KAYIT

        if(isset($_FILES["fileToUpload"]["name"])) {
             $logoalt= $_POST['logoalt'];
             $logotur= $_POST['logotur'];
             //$dosyaad , $target_dir zaten geldi
             include("gerekli/upload.php");
             // ÇIKTILARI 
              // $uploadMesaj
              // $uploaddurum= ok / error
              // $dosyatamad
             // $uploadOk
             echo "Upload Mesaj=".$uploadOk;

              if($uploadOk == 1) {
                  $logokayitsql = "INSERT INTO logo (adi, alt, aktif,tur) VALUES ('$dosyatamad', '$logoalt', '0', '$logotur')  ";
                  if ($mysqli->query($logokayitsql ) === TRUE) {
                                       $uploaddurum = "ok";
                                       $uploadMesaj="Logo dosyası başarıyla yüklendi!";
                                    } else {
                                       $uploaddurum = "error";
                                       $uploadMesaj="Logo dosyası veritabanı yükleme hatası oluştu";
                                    }
               }
               else {  
                      $uploaddurum = "error";
                      $uploadMesaj="Aynı ada sahip başka bir dosya var. <br> Lütfen dosyanıza başka bir isim  verin ya da eskisini silin.";
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
if(isset($_GET['EditLogo'])) {
   $logocollapsed="";
   $editlogoid= $_GET['EditLogo'];
   $sql_editlogo="SELECT adi,alt,tur FROM logo  WHERE id= $editlogoid LIMIT 1"; 
         if ($result_editlogo = $mysqli -> query($sql_editlogo)) {
            while ($row_editlogo = $result_editlogo -> fetch_row()) {
                         $editlogo_ad=  $row_editlogo[0];
                         $editlogo_yollu= $target_dir.$editlogo_ad;
                         $editlogo_uzantisiz = substr($editlogo_ad, 0, strrpos($editlogo_ad, '.'));
                         $editlogo_uzanti = pathinfo($editlogo_ad, PATHINFO_EXTENSION);
                         $editlogo_alt= $row_editlogo[1];
                         $editlogotur= $row_editlogo[2];


   }  // while kapat
 }  // İF kapat
}
/////////////////////////////////////////////


////////////////////// GALERİDEN RESİM SİLME İŞİ //////////////////////

if(isset($_GET['DeleteLogo'])) {

 $silineceklogo= $_GET['DeleteLogo'];

// adını çek
 $sql_sileneceklogocek="SELECT adi,aktif FROM logo WHERE id= $silineceklogo LIMIT 1";
         if ($result_sileneceklogocek = $mysqli -> query($sql_sileneceklogocek)) {
            while ($row_sileneceklogocek = $result_sileneceklogocek -> fetch_row()) {
                         $sileneceklogocek_ad=  $row_sileneceklogocek[0];
                         $sileneceklogocek_yollu= $target_dir.$sileneceklogocek_ad;
                         $sileneceklogoaktif= $row_sileneceklogocek[1];

   }  // while kapat
 }  // İF kapat
 if($sileneceklogoaktif=='1') {
   $toaster['error'] = " Aktif Logo Silinemez. Önce başka bir logoyu aktif ediniz...";
 }
 else {
        // SQL DEN SİL
         $sillogosql = "DELETE FROM logo WHERE id=$silineceklogo";
          if ($mysqli->query($sillogosql) === TRUE) {
          //echo "Record deleted successfully";
            if(isset($sileneceklogocek_yollu)) { unlink($sileneceklogocek_yollu); } // FİZİKSEL SİL
           $toaster['success'] = " Logolardan Kayıt Silinmiştir...";
          } else {
          echo "Error deleting record: " . $mysqli->error;
        }
    }
}  // if(isset($_GET['DeleteImage'])) 
////////////////////////////////////////////


///////////////////////// VARSAYILAN YAPMA /////////////////////
if(isset( $_GET['MakeAktif'] )) 
{
    $varsayilanyap= $_GET['MakeAktif'];
    $secilitur= $_GET['LogoTur'];
    $varsayilansql1 = "UPDATE logo SET aktif='0' WHERE aktif = '1' AND tur='$secilitur'";
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



/////////////////////////////////////
?>




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Galeri Ayarları</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Anasayfa</a></li>
              <li class="breadcrumb-item active">Galeri Thumb Ayarları</li>
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



 <!--MENÜLER CARDI BAŞ  -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">
Logo Dosyaları Listesi

              </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body"> <!-- MENÜLERİN LİSTELENDİĞİ SUTUN -->




<table class="table">
  <thead>
    <tr>
      <th scope="col"  style="width:10%">Tür</th>
      <th scope="col"  style="width:50%">Adı</small></th>
      <th scope="col"  style="width:10%">Aktif</th>
      <th scope="col"  style="width:10%">Değiştir</th>
      <th scope="col"  style="width:10%">Sil</th>
     
    </tr>
  </thead>
  <tbody>

<?php
//get rows query
$logosql= "SELECT * FROM logo ORDER BY tur ASC  ";
$logoquery = mysqli_query($mysqli, $logosql );

//number of rows
$logorowCount = mysqli_num_rows($logoquery);
if($logorowCount > 0){ 
  while($logorow = mysqli_fetch_assoc($logoquery)){  
    $logotur=  $logorow['tur'];
    if($logotur=="1") {$logoturyaz='Header';}
    elseif ($logotur=="2") {$logoturyaz='Footer';}
    else {$logoturyaz='---';}


?>
      <tr>
      <th scope="row"><small><?php echo $logoturyaz; ?></small></th>
      <td><?php   echo $logorow['adi'] ; ?>  </td>
      <td><?php if($logorow['aktif'] !='1' ) { ?>
         <a class="btn" href="a_logoayar.php?action=SiteLogo&MakeAktif=<?php echo $logorow['id']; ?>&LogoTur=<?php echo $logotur; ?>">
        <i class="fa fa-check"></i> </a>      
        <?php } ?>
      </td>    
      <td>
        <a href="a_logoayar.php?action=SiteLogo&EditLogo=<?php echo $logorow['id']; ?>" class="btn"><i class="fas fa-pen"></i></a>
      </td> 
      <td>
         <a class="btn" data-toggle="modal" data-target="#confirm-delete" 
          data-delurl="a_logoayar.php?action=SiteLogo&DeleteLogo=<?php echo $logorow['id']; ?>">
          <i class="fas fa-trash-alt"></i></a>
      </td>

    </tr>


<?php
 } 
} ?>
 
  </tbody>
</table>





              </div> <!-- MENÜLERİN LİSTELENDİĞİ SUTUN  BİTİŞ-->
                <div class="card-footer">
                 
                </div>
              <!-- /.card-body -->
            </div>
        <!--MENÜLER CARDI BİTİŞ  -->


</div>  <!-- SOL TARAF COL BİTİŞ -->

<!---------------------------------------------------------------->


<div class="col-md-6">


   <!-- SAĞ TARAf -->

    

<!--YENİ DOSYA EKLE CARDI  -->

        <div class="card <?php echo $logocollapsed; ?> card-info">
              
              <div class="card-header">
                <h3 class="card-title"> Logo Yükle</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                


 <form action="<?php echo"a_logoayar.php?action=SiteLogo"; if(isset($editlogoid)){echo "&EditLogo=". $editlogoid; }?>" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                 
<?php if(isset($editlogoid)) {
?>

  <input type="hidden"  name="editlogoid" value="<?php echo $editlogoid; ?>">
  <input type="hidden"  name="editlogoeskiad" value="<?php echo $editlogo_uzantisiz; ?>">
  <input type="hidden"  name="editlogouzanti" value="<?php echo $editlogo_uzanti; ?>"> 
  <input type="hidden"  name="editlogo_yollu" value="<?php echo $editlogo_yollu ; ?>">
  <a href="<?php echo $editlogo_yollu; ?>" data-toggle="lightbox" data-title="<?php echo $editlogo_yollu; ?>">
    <img src="<?php echo $editlogo_yollu; ?>" style="max-width:200px; max-height: 200px;"/>
  </a>
<?php
}
else {
?>
                  <div class="form-group">
                    <label for="exampleInputFile">Logo Dosyası Seç</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="InputFile" name="fileToUpload">
                        <label class="custom-file-label" for="InputFile">Logo Dosyası Seç</label>
                      </div>
                    </div>
                  </div>

<?php
}
?>

       <div class="form-group">
                <label for="logotur">Logonun Konumu</label>
                <select name="logotur" id="logotur" class="form-control">
                    <?php if(!isset($editlogotur)) {$editlogotur='1'; } ?>
                    <option <?php echo ($editlogotur == '1' ? " selected " : " "); ?>value="1">Header</option>
                    <option <?php echo ($editlogotur == '2' ? " selected " : " "); ?>value="2">Footer</option>
              </select>
              </div>



                  <div class="form-group">
                        <label>Adı</label>
                        <input type="text" class="form-control" placeholder="Girilmezse otomatik oluşturulacak" name="logoad" 
                        value="<?php if(isset($editlogo_uzantisiz)) { echo $editlogo_uzantisiz ;} ?>">
                      </div>
              
            <div class="form-group">
                        <label>Alt Bilgisi</label>
                        <input type="text" class="form-control" placeholder="Alt Bilgisi" name="logoalt"
                         value="<?php if(isset($editlogo_alt)) { echo  $editlogo_alt ;} ?>">
                      </div>

     
                <!-- /.card-body -->

               <div class="card-footer">
              <button type="submit" class="btn btn-primary btn-block" name="logoyukle">Kaydet</button>
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