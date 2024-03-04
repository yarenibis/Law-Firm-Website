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
  $silsql = "DELETE FROM temsilci WHERE id=$silinecekid";

  if ($mysqli->query($silsql) === TRUE) {
   $toaster['success'] = " Kayıt Silinmiştir...";
  } else {
  echo "Error deleting record: " . $mysqli->error;
}
 }


////////////////////////////////////////////////////////

//////////OKUNDU İŞARETLEME //////////////////////


////////////////////////////////////
?>
  <?php
  /*
if(isset($_POST['duzenle'])){

$editgelen_adi=$_POST['adi'];
$editgelen_sifre=$_POST['sifre'];
$editgelen_adsoyad=$_POST['adsoyad'];
$editgelen_adres=$_POST['adres'];
$editgelen_eposta=$_POST['eposta'];
$editgelen_tel=$_POST['tel'];
 $id=$_POST['id'];


 $uyesql = "UPDATE users SET Email= '$editgelen_adi', Sifre='$editgelen_sifre', adsoyad='$editgelen_adsoyad', adres='$editgelen_adres', eposta='$editgelen_eposta', tel='$editgelen_tel' WHERE id='$id' ";
          if ($mysqli->query($uyesql) === TRUE) {
                    $toaster['info'] = " Kayıt Güncellendi...";
                    header("refresh:2,");
                  } else {
                    echo "Error: " . $sql . "<br>" . $mysqli->error;
                  }
}
*/
    ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Temsilci Başvurusu Listeleme</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Anasayfa</a></li>
              <li class="breadcrumb-item active">Temsilci Başvurusu Listeleme</li>
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
                <h3 class="card-title">Temsilci Başvurusu Listeleme Bilgileri</h3>

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
                      <th>Adı</th>
                      <th>Soyadı</th>
                      <th>Gün</th>
                      <th>Ay</th>
                      <th>Yıl</th>
                      <th>E-Posta</th>
                      <th>Telefon-1</th>
                      <th>Telefon-2</th>
                      <th>Adres</th>
                      <th>İl</th>
                      <th>İlçe</th>
                      <th>Sil</th>

                    </tr>
                  </thead>
                  <tbody>


<?php

$mesajsql="SELECT ad, soyad, gun, ay, yil, eposta, telefon1, telefon2, adres, il, ilce,  id FROM temsilci ORDER BY id DESC, id DESC ";             

 if ($mesajresult = $mysqli -> query($mesajsql)) {
  while ($mesajrow = $mesajresult -> fetch_row()) {
    // VERİLERİ ÇEK
    $msg_ad= $mesajrow[0];
    $msg_soyad= $mesajrow[1];
    $msg_gun= $mesajrow[2];
    $msg_ay= $mesajrow[3];
    $msg_yil= $mesajrow[4];
    $msg_eposta= $mesajrow[5];
    $msg_telefon1= $mesajrow[6];
    $msg_telefon2= $mesajrow[7];
    $msg_adres= $mesajrow[8];
    $msg_il= $mesajrow[9];
    $msg_ilce= $mesajrow[10];
    $msg_id= $mesajrow[11];



   

?>
<form action="" method="POST">

                    <tr>
                      <td><?php echo $msg_ad;?></td>
                      <td><?php echo $msg_soyad;?></td>
                      <td><?php echo $msg_gun;?></td>
                      <td><?php echo $msg_ay;?></td>
                      <td><?php echo $msg_yil;?></td>
                      <td><?php echo $msg_eposta;?></td>
                      <td><?php echo $msg_telefon1;?></td>
                      <td><?php echo $msg_telefon2;?></td>
                      <td><?php echo $msg_adres;?></td>
                      <td><?php echo $msg_il;?></td>
                      <td><?php echo $msg_ilce;?></td>
                      
                        <td>
                      <a class="btn" data-toggle="modal" data-target="#confirm-delete" 
                      data-delurl="a_temsilci.php?&action=deletemessage&id=<?php echo $msg_id; ?>">
                       <i class="fas fa-trash-alt"></i></a>
                     </td>
                          
                    </tr>
   </form>
                    

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


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
  // FOOTER SAYFASINI ÇAĞIR 
    include_once("cerceveler/footer.php");
?>