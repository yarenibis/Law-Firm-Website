<?php
// BAŞLATICI ÇAĞIR 
include_once("_baslatici.php");

// HEADER SAYFASINI ÇAĞIR 
include_once("cerceveler/header.php");

// SİDEBAR SAYFASINI ÇAĞIR 
include_once("cerceveler/sidebar.php");

//////////////////////////////////////////////////////////////////////////////////

if(isset($_POST['yeni'])) {  // YENİ SAYFA KAYDETME

	$sayfaadi = $_POST['yeni'];
                $sql = "INSERT INTO sayfa_turu (adi, purl) VALUES ('$sayfaadi', '$sayfaadi')";
                if ($mysqli->query($sql) === TRUE) {
					$last_id = $mysqli->insert_id;  // KAYDETİĞİNİN IDsini al
					$git="?edit=".$id."&toastmessage=NewSaveOk";
					header("Location:".$git.""); 
					//echo $last_id ;
				} else {
					echo "Error: " . $sql . "<br>" . $mysqli->error;
				}

  }

if(isset($_GET['sil'])) {
	$id= $_GET['sil'];
	$sql = "DELETE FROM sayfa_turu WHERE id=$id";
	if ($mysqli->query($sql) === TRUE) {
		//echo "Record deleted successfully";
		$toaster['success'] = " Kayıt Silinmiştir...";
	} else {
		echo "Error deleting record: " . $mysqli->error;
	}
}

if(isset($_GET['kaydet'])) {
	$id= $_GET['kaydet'];
	$adi= $_POST['adi'];
	$purl= $_POST['purl'];

	$dileditsql = "UPDATE sayfa_turu SET adi = '$adi', purl = '$purl' WHERE id= '$id'";
                  if ($mysqli->query($dileditsql) === TRUE) {
                    $toaster['info'] = " Kayıt Güncellendi...";
					$git="?edit=".$id."&toastmessage=NewSaveOk";
					header("Location:".$git.""); 
                    //
                  } else {
                    echo "Error: " . $sql . "<br>" . $mysqli->error;
                  }
}

if (isset($_GET['toastmessage'])){
	$toaster['info'] = " Kayıt Güncellendi...";
}
?>

				<!-- Content Wrapper. Contains page content -->
				<div class="content-wrapper">
					<!-- Content Header (Page header) -->
					<div class="content-header">
						<div class="container-fluid">
							<div class="row mb-2">
								<div class="col-sm-6">
									<h1 class="m-0"> Sayfa Türü Yönetimi</h1>
								</div><!-- /.col -->
								<div class="col-sm-6">
									<ol class="breadcrumb float-sm-right">
										<li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
										<li class="breadcrumb-item active">Sayfa Türü Yöneticisi</li>
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

									<div class="card collapsed-card card-success">
              
										<div class="card-header">
											<h3 class="card-title">Yeni Ekle</h3>

											<div class="card-tools">
												<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
												</button>
											</div>
										</div>
										<div class="card-body">
											<form action="?" method="POST">
												<div class="input-group mb-3">
													<input type="text" class="form-control" name="yeni" >
													<div class="input-group-append">
														<button type="submit" class="btn btn-primary">EKLE</button>
													</div>
												</div>
											</form>
										</div>
									</div>

									<div class="card card-info">
										<div class="card-header">
											<h3 class="card-title">Sayfa Türü Listesi</h3>
											<div class="card-tools">
												<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
											</div>
										</div>
										<div class="card-body darpad">
											<ul class="list-group">
												<?php
												$dillistsql="SELECT id, adi, purl FROM sayfa_turu ORDER BY id ASC ";             

												if ($sonuc = $mysqli -> query($dillistsql)) {
													while ($row = $sonuc -> fetch_row()) {
														$id= $row[0];
														$adi= $row[1];
														$purl=$row[2];
														if(isset($_GET['id'])){
															if($_GET['id']== $id){
															}
														}
												?>
												<li class="list-group-item">
													<a href="?edit=<?=$id;?>" class="menulerli"><b><?=$adi;?></b></a>
													<a class="btn btn-tool btn-link menukucuk" data-toggle="modal" data-target="#confirm-delete" data-delurl="?sil=<?=$id;?>">
														<i class="fas fa-trash"></i></a>
													<a href="?edit=<?=$id;?>" class="btn btn-tool btn-link menukucuk"><i class="fas fa-pen"></i></a>
												</li>
												<?php 
													}
												}
												?>
											</ul>
										</div>
										<div class="card-footer">
										</div>
									</div>
								</div>
								<div class="col-md-8">
									<?php if(isset($_GET['edit'])) { 
											$id= $_GET['edit'];
											$sql="SELECT adi, purl FROM sayfa_turu WHERE id= $id ORDER BY id LIMIT 1";             
											if ($sonuc = $mysqli -> query($sql)) {
												while ($row = $sonuc -> fetch_row()) {
													$adi= $row[0];
													$purl=$row[1];
												}
											}
									?>
									<div class="card card-success">
										<div class="card-header">
											<h3 class="card-title">Sayfa Türü Düzenle </h3>
											<div class="card-tools">
												<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
											</div>
										</div>
										<div class="card-body">
											<form action="?kaydet=<?=$_GET['edit']; ?>" method="POST">
												<div class="card-body">
													<div class="form-group">
														<label for="diladi">Adı</label>
														<input type="text" name="adi" class="form-control" id="diladi" placeholder="Dil Adı" value="<?=$adi; ?>">
													</div>
													<div class="form-group">
														<label for="dilkodu">Purl</label>
														<input type="text" name="purl" class="form-control" id="dilkodu" placeholder="Dil Kodu" value="<?=$purl; ?>">
													</div>
													<div class="card-footer">
														<button type="submit" class="btn btn-primary">Kaydet</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								<?php } ?>
								</div>
							</div>


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
