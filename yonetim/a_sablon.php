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
else $action="GenelAyarlar";



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

$mesajsql="SELECT adi_soyadi, eposta, konu, mesaj, tarih, saat, okundu FROM mesaj_kutusu ORDER BY id DESC ";             

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

?>



                    <tr>
                      <td><?php echo $msg_adisoyadi; ?></td>
                      <td><?php echo $msg_eposta; ?></td>
                      <td><?php echo $msg_konu; ?></td>
                      <td><?php echo $msg_mesaj; ?></td>
                      <td><?php echo $msg_tarihsaat; ?></td>
                      <td><i class="fas fa-search-plus"></i>  </td>
                      <td><i class="far fa-thumbs-up"></i></td>
                      <td><i class="fas fa-trash-alt"></i></td>
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
























      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
  // FOOTER SAYFASINI ÇAĞIR 
    include_once("cerceveler/footer.php");
?>