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
// THUMB KAYDET- GÜNCELLE
if (isset($_POST['thumbekle']) ) 
 {
     $toaster['info'] ="";
     $thumben=intval($_POST['thumben']); 
     if($thumben < 10) { 
       $thumben =10;
       $toaster['info'] ="10 pikselden küçük olamaz! <br> ";
       }
     $thumbsql = "INSERT INTO thumbset (en, varsayilan) VALUES ('$thumben', '0')";
                if ($mysqli->query($thumbsql) === TRUE) {
                   $toaster['info'] .= " Thumbset Eklendi...";
                } else {
                  echo "Error: " . $sql . "<br>" . $mysqli->error;
                }

} // YENİ  BİTİŞ
/////////////////////////////////////////////////////////////
///////////////////////// VARSAYILAN YAPMA /////////////////////
if(isset( $_GET['DefaultThumb'] )) 
{
    $varsayilanyap= $_GET['DefaultThumb'];
    $varsayilansql1 = "UPDATE thumbset  SET varsayilan='0' WHERE varsayilan = '1'";
    $varsayilansql2= "UPDATE thumbset  SET varsayilan='1' WHERE id = '$varsayilanyap'";
    if (($mysqli->query($varsayilansql1) === TRUE)) {
          if (($mysqli->query($varsayilansql2) === TRUE)) {
                $toaster['info'] = "Seçilen Varsayılan Yapıldı...";

                   }
                } else {
                    echo "Error: " . $sql . "<br>" . $mysqli->error;
                  }

}
//////////////////////////////////////////////////////

if(isset( $_GET['DelThumb'] )) 
{
    $silinecekthumb= $_GET['DelThumb'];
// VARSAYILANSA SİLME!

//get rows query
 $thumbbaksql= "SELECT varsayilan FROM thumbset WHERE id=$silinecekthumb LIMIT 1 ";
 $thumbbakquery = mysqli_query($mysqli, $thumbbaksql );
 while($thumbbakrow = mysqli_fetch_assoc($thumbbakquery)){ 
     if( $thumbbakrow['varsayilan'] == '1') {
       $toaster['error'] = " Varsayılan Thumb Silinemez...";
     }
     else{
              $silsql = "DELETE FROM  thumbset  WHERE id=$silinecekthumb";
              if ($mysqli->query($silsql) === TRUE) {
               $toaster['success'] = " Kayıt Silinmiştir...";
              } else {
              echo "Error deleting record: " . $mysqli->error;
            }
     }
 }
}
//////////////////////////////////////////////////////



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
Thumb Set Listesi

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
      <th scope="col"  style="width:10%">#</th>
      <th scope="col"  style="width:50%">En <br><small>(Boy Orantısal Oluşturulacak)</small></th>
      <th scope="col"  style="width:20%">Sil?</th>
        <th scope="col"  style="width:20%">Varsayılan Yap</th>
    </tr>
  </thead>
  <tbody>

<?php
//get rows query
$thumbsql= "SELECT * FROM thumbset ORDER BY id DESC ";
$thumbquery = mysqli_query($mysqli, $thumbsql );

//number of rows
$thumbrowCount = mysqli_num_rows($thumbquery);
if($thumbrowCount > 0){ 
  while($thumbrow = mysqli_fetch_assoc($thumbquery)){ 
     
?>
      <tr>
      <th scope="row"><?php echo $thumbrow['id'] ?></th>
      <td><?php 
        echo $thumbrow['en'] ;
        if($thumbrow['varsayilan'] =='1' ) {
             echo " (Varsayılan)" ;
        }
      ?>  

    </td>
       
      <td>

         <a class="btn" data-toggle="modal" data-target="#confirm-delete" 
                      data-delurl="a_galeriayarlari.php?action=GaleriAyar&DelThumb=<?php echo $thumbrow['id']; ?>">
                       <i class="fas fa-trash-alt"></i></a>

      </td>
     <td><?php if($thumbrow['varsayilan'] !='1' ) { ?>
             
         <a class="btn" href="a_galeriayarlari.php?action=GaleriAyar&DefaultThumb=<?php echo $thumbrow['id']; ?>">
                       <i class="fa fa-check"></i>
</a>      
        <?php } ?>
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


      


<!--YENİ THUMB AYAR CARDI  -->


 <div class="card card-success">
              
              <div class="card-header">
                <h3 class="card-title">Yeni Galeri Thumb Ekle</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              
<div class="card-body">
          <form action=a_galeriayarlari.php?action=GaleriAyar" method="POST">

<div class="input-group mb-3">
 <input type="text" class="form-control" name="thumben" placeholder="En (Piksel)">
 <!-- BOY OTOMATİK OLUŞTURULACAK -->
  <div class="input-group-append">
  <button type="submit" class="btn btn-primary" name="thumbekle">EKLE</button>
  </div>
</div>
     
 </form>
              </div>

            </div>

<!--YENİ THUMB EKLE CARDI BİTİŞ  -->




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