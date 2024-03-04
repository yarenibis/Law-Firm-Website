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

/// DİL SİL ////////////////////////////////////////////
if($action=='DeleteLang')
{
 $silinecekdil= $_GET['id'];
 $sildilsql = "DELETE FROM diller WHERE id=$silinecekdil";
  if ($mysqli->query($sildilsql) === TRUE) {
  //echo "Record deleted successfully";
   $toaster['success'] = " Kayıt Silinmiştir...";
  } else {
  echo "Error deleting record: " . $mysqli->error;
 }
}
//////////////////////////////////////////////////////////////////////
/////// DİL KAYDET ////////
if(isset($_POST['dilkaydet'])) {
  $editdilid= $_GET['id'];
  $editdiladi= $_POST['diladi'];
  $editdilkodu= $_POST['dilkodu'];
  $editdilyon= $_POST['dilyon'];  
  $editdilaktif= $_POST['dilaktif']; 

  $dileditsql = "UPDATE diller  SET Adi ='$editdiladi', DilKodu ='$editdilkodu', Yon ='$editdilyon',  Aktif ='$editdilaktif',
                  WHERE ID = '$editdilid'";
                  if ($mysqli->query($dileditsql) === TRUE) {
                    $toaster['info'] = " Kayıt Güncellendi...";
                    //
                  } else {
                    echo "Error: " . $sql . "<br>" . $mysqli->error;
                  }
}

////////////////////////////////////////////////////////////////////////////
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Dil Yöneticisi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
              <li class="breadcrumb-item active">Dil Yöneticisi</li>
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



 <!--MENÜLER CARDI BAŞ  -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">
DİL LİSTESİ

              </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body darpad"> <!-- MENÜLERİN LİSTELENDİĞİ SUTUN -->

<ul class="list-group">

<?php // diller çek

$dillistsql="SELECT ID, Adi, DilKodu, Yon, Aktif FROM diller ORDER BY  ID ASC ";             

 if ($dillistresult = $mysqli -> query($dillistsql)) {
  while ($dillistrow = $dillistresult -> fetch_row()) {
    // VERİLERİ ÇEK
    $dillistid= $dillistrow[0];
    $dillistadi= $dillistrow[1];
    $dillistkodu=$dillistrow[2];
    $dillistyon= $dillistrow[3];
    $dilllistaktif=  $dillistrow[4];

//$sayfaaktif  imajı
    if($dilllistaktif== 1 ) {
      $aktifsimge="<i class=\"fas fa-check-circle\"></i>";
    }
    else { $aktifsimge="<i class=\"fas fa-times-circle\"></i>";
    }

//$sayfadil  imajı
  $dilsimge="<img src=\"img/flags/".$dillistkodu.".png\">";

  $aktiflik="";
  if(isset($_GET['id']))
  {
     if($_GET['id']== $dillistid){
       $aktiflik = "active";
     }
  }
?>

<li class="list-group-item <?php echo $aktiflik; ?>">
 <?php echo $aktifsimge. $dilsimge.  " "; ?>
<a href="a_diller.php?action=EditLang&id=<?php echo $dillistid; ?>" class="menulerli"><b><?php echo  $dillistadi; ?></b></a>


<a class="btn btn-tool btn-link menukucuk" data-toggle="modal" data-target="#confirm-delete" 
data-delurl="a_diller.php?action=DeleteLang&id=<?php echo $dillistid; ?>">
<i class="fas fa-trash"></i></a>

<a href="a_diller.php?action=EditLang&id=<?php echo $dillistid; ?>" class="btn btn-tool btn-link menukucuk"><i class="fas fa-pen"></i></a>


</li>

   <?php 
  }
}

?>

</ul>


              </div> <!-- MENÜLERİN LİSTELENDİĞİ SUTUN  BİTİŞ-->
                <div class="card-footer">
                 
                </div>
              <!-- /.card-body -->
            </div>
        <!--MENÜLER CARDI BİTİŞ  -->



</div>  <!-- SOL TARAF COL BİTİŞ -->

<!---------------------------------------------------------------->



<div class="col-md-8">


   <!-- SAĞ TARAf -->

<?php if($action=='EditLang') { 

// VERİLERİNİ ÇEK
$dilcekid= $_GET['id'];
$dilceksql="SELECT Adi, DilKodu, Yon, Aktif FROM diller  WHERE ID= $dilcekid ORDER BY ID LIMIT 1";             
 if ($dilcekresult = $mysqli -> query($dilceksql)) {
  while ($dilcekrow = $dilcekresult -> fetch_row()) {
    $dilcekadi= $dilcekrow[0];
    $dilcekkodu=$dilcekrow[1];
    $dilcekyon= $dilcekrow[2];
    $dilcekaktif= $dilcekrow[3];
 }
}

  ?>

 <!--DİL DEĞİŞTİR  -->


        <div class="card card-success">
              
              <div class="card-header">
                <h3 class="card-title">Dili Düzenle </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
        

 <form action="a_diller.php?EditLang=<?php $_GET['id']; ?>" method="POST">
                <div class="card-body">

                  <div class="form-group">
                    <label for="diladi">Dil Adı</label>
                    <input type="text" class="form-control" id="diladi" placeholder="Dil Adı" value="<?php echo $dilcekadi; ?>">
                  </div>

                    <div class="form-group">
                    <label for="dilkodu">Dil Kodu</label>
                    <input type="text" class="form-control" id="dilkodu" placeholder="Dil Kodu" value="<?php echo $dilcekkodu; ?>">
                  </div>   

                  <div class="form-group">
                    <label for="dilyon">Yazım Yönü</label>
                    <input type="text" class="form-control" id="dilyon" placeholder="Dil Yönü" value="<?php echo $dilcekyon; ?>">
                  </div>                             
                
                <div class="form-group">
                  <label for="aktif">Aktiflik </label>
                  <select class="custom-select form-control-border" id="aktif" name="dilaktif">
                    <option value="1"<?php if($dilcekaktif== '1')  {echo " selected=\"selected\""; }?>>Aktif</option>
                    <option value="0"<?php if($dilcekaktif== '0')  {echo " selected=\"selected\""; }?>>Pasif</option>
                    
                  </select>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="dilkaydet">Kaydet</button>
                </div>
              </form>


              </div>

            </div>


<?php } ?>

</div>  <!-- COL BİTİş -->

</div> <!-- row BİTİş -->


<!-- SİL MODAL-->


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


<!-- SİL MODAL BİTİŞ-->
















      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
  // FOOTER SAYFASINI ÇAĞIR 
    include_once("cerceveler/footer.php");
?>
<!-------------------------------------------->
