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


///////////////////////   MESAJ SİL   /////////////////////////

 if($action=='deletemessage') {
  $silinecekid=$_GET['id'] ;
  $silsql = "DELETE FROM mesaj_kutusu WHERE id=$silinecekid";

  if ($mysqli->query($silsql) === TRUE) {
   $toaster['success'] = " Kayıt Silinmiştir...";
  } else {
  echo "Error deleting record: " . $mysqli->error;
}
 }

////////////////////////////////////////////////////////

//////////OKUNDU İŞARETLEME //////////////////////
if(isset($_GET['show-message-detail'])){
  $okunduisaret=$_GET['show-message-detail'];
}
if(isset($_GET['MarkAsRead'])){
  $okunduisaret=$_GET['MarkAsRead'];
}
if(isset($okunduisaret)) {
   $okundusql = "UPDATE mesaj_kutusu  SET okundu = '1' WHERE id =  '$okunduisaret'";
    if ($mysqli->query($okundusql) === TRUE) {
      $toaster['info'] = "Okundu Olarak İşaretlendi!";
      } else {
      echo "Error: " . $okundusql . "<br>" . $mysqli->error;
    }
}

////////////////////////////////////////
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Mesaj Kutusu</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Anasayfa</a></li>
              <li class="breadcrumb-item active">Mesaj Kutusu</li>
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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Gelen Mesajlar</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Adı Soyadı</th>
                      <th>Eposta</th>
                      <th>Konu</th>
                      <th>Mesaj</th>
                      <th>Tarih - Saat</th>
                      <th>Detay</th>
                      <th>Okundu</th>
                      <th>Sil</th>
                    </tr>
                  </thead>
                  <tbody>


<?php

$mesajsql="SELECT adi_soyadi, eposta, konu, mesaj, tarih, saat, okundu, id FROM mesaj_kutusu ORDER BY okundu ASC, id DESC ";             

 if ($mesajresult = $mysqli -> query($mesajsql)) {
  while ($mesajrow = $mesajresult -> fetch_row()) {
    // VERİLERİ ÇEK
    $msg_adisoyadi= $mesajrow[0];
    $msg_eposta= $mesajrow[1];
    $msg_konu= $mesajrow[2];
    $msg_mesaj=$mesajrow[3];
    $msg_tarihsaat= $mesajrow[4]. " " .$mesajrow[5];
    $msg_okundu= $mesajrow[6];
    if(strlen($msg_mesaj) > 20 ) {
        $msg_mesaj= mb_substr($msg_mesaj, 0, 20, 'UTF-8'). "...";  
    }
    $msg_id=$mesajrow[7];
    if($msg_okundu==0) {    $stil= " style=\"background:#ACFF80;\"";   }
    else { $stil="";}

?>

                    <tr <?php echo $stil; ?>>
                      <td><?php echo $msg_adisoyadi; ?></td>
                      <td><?php echo $msg_eposta; ?></td>
                      <td><?php echo $msg_konu; ?></td>
                      <td><?php echo $msg_mesaj; ?></td>
                      <td><?php echo $msg_tarihsaat; ?></td>
                      <td>
                        <a class="btn" href="a_mesajlar.php?&show-message-detail=<?php echo $msg_id; ?>">
                         <i class="fas fa-search-plus"></i> </a>
                      </td>
                      <td> <?php if($msg_okundu==0) {  ?>
                        <a class="btn" href="a_mesajlar.php?&MarkAsRead=<?php echo $msg_id; ?>">
                         <i class="far fa-thumbs-up"></i> </a> 
                       <?php } ?>
                        </td>
                      <td>
                      <a class="btn" data-toggle="modal" data-target="#confirm-delete" 
                      data-delurl="a_mesajlar.php?&action=deletemessage&id=<?php echo $msg_id; ?>">
                       <i class="fas fa-trash-alt"></i></a>
                      </td>
                    </tr>

<?php
  }  // while kapat

} // if kapat

 ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->



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



<!------------- Mesaj detay MODAL ------------->
<?php
 if (isset($_GET['show-message-detail'])) { 
    $msg_detail_id= $_GET['show-message-detail'];
  ?>
<div id="show-message-detail" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mesaj Detay: </h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

           <?php 

  // MESAJ BİLGİLERİNİ ÇEK
  $stmt_mesaj = $mysqli->prepare("SELECT
   adi_soyadi,sabit_tel, cep_tel, eposta,konu, mesaj, uye_id, tarih, saat, firma_adi, adres
     FROM mesaj_kutusu WHERE id = ? LIMIT 1") ;
  $stmt_mesaj->bind_param('i', $msg_detail_id);  // username i ekle
  $stmt_mesaj->execute();    // çalıştır
  $stmt_mesaj->store_result();
        // veritabanı sorgusu sonuçtan değerleri çek
  $stmt_mesaj->bind_result($msg_detail_adisoyadi, $msg_detail_sabit_tel, $msg_detail_cep_tel, $msg_detail_eposta, 
    $msg_detail_konu,   $msg_detail_mesaj, $msg_detail_uye_id, $msg_detail_tarih, $msg_detail_saat, $msg_detail_firma_adi ,$msg_detail_adres);
  $stmt_mesaj->fetch();
            ?>

    <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <td>Adı Soyadı: </td>
                      <td><?php echo $msg_detail_adisoyadi; ?></td>
                    </tr>

                    <tr>
                      <td>Sabit Tel: </td>
                      <td><?php echo $msg_detail_sabit_tel; ?></td>
                    </tr>

                    <tr>
                      <td>Cep Tel: </td>
                      <td><?php echo $msg_detail_cep_tel; ?></td>
                    </tr>
                    <tr>
                      <td>Eposta: </td>
                      <td><?php echo $msg_detail_eposta; ?></td>
                    </tr>
                    <tr>
                      <td>Konu: </td>
                      <td><?php echo  $msg_detail_konu; ?></td>
                    </tr>
                    <tr>
                      <td>Mesaj: </td>
                      <td><?php echo $msg_detail_mesaj; ?></td>
                    </tr>
                    <tr>
                      <td>Üye İd: </td>
                      <td><?php echo $msg_detail_adisoyadi; ?></td>
                    </tr>
                    <tr>
                      <td>Tarih-Saat: </td>
                      <td><?php echo  $msg_detail_tarih. " ". $msg_detail_saat; ?></td>
                    </tr>
                    <tr>
                      <td>Firma Adı: </td>
                      <td><?php echo $msg_detail_firma_adi; ?></td>
                    </tr>
                    <tr>
                      <td>Adres: </td>
                      <td><?php echo $msg_detail_adres; ?></td>
                    </tr>

                  </tbody>
                </table>   

         <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-md active" data-dismiss="modal">Tamam</button>
      </div>    
            </div>
        </div>
    </div>
</div>

<?php
 }  // MODAL GÖSTER BİTİŞ

?>






      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
  // FOOTER SAYFASINI ÇAĞIR 
    include_once("cerceveler/footer.php");
?>