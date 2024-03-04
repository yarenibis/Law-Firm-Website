<?php
	include_once("_baslatici.php");
	include_once("cerceveler/header.php");
	include_once("cerceveler/sidebar.php");

	if (isset($_POST['kaydet'])) {
		$s1 = $_POST['s1'];
		$s2 = $_POST['s2'];
		$s3 = $_POST['s3'];
		$s4 = $_POST['s4'];
		$s5 = $_POST['s5'];
		$s6 = $_POST['s6'];
		$s7 = $_POST['s7'];
		$s8 = $_POST['s8'];
		$dil = $_POST['dil'];
		$aktif = $_POST['aktif'];
		$kaydet = $_POST['kaydet'];

		$sql = "UPDATE sayac SET s1 ='$s1', s2 ='$s2', s3 ='$s3', s4 ='$s4', s5 ='$s5', s6 ='$s6', s7 ='$s7', s8 ='$s8', dil ='$dil', aktif ='$aktif' WHERE id = '$kaydet'";
		if ($mysqli->query($sql) == TRUE) {
			$toaster['info'] = "Kayıt Güncellendi...";
		} else {
			$toaster['info'] = "1111Error: " . $sql . "<br>" . $mysqli->error;
		}
	}

?>
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Sayaç</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
							<li class="breadcrumb-item active">Sayaç</li>
						</ol>
					</div>
				</div>
			</div>
		</div>

		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<?php
					if ($sonuc = $mysqli -> query("select s.*, d.adi as dil_adi from diller d left join sayac s on d.id = s.dil")) {
						foreach($sonuc as $row) {
					?>
					<div class="col-md-6">
							<form role="form" method="post" action="?">
								<input type="hidden" name="kaydet" value="<?=$row['id']?>">
								<div class="form-group">
									<?=$row['dil_adi']?>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="s1" value="<?=$row['s1']?>">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="s2" value="<?=$row['s2']?>">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="s3" value="<?=$row['s3']?>">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="s4" value="<?=$row['s4']?>">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="s5" value="<?=$row['s5']?>">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="s6" value="<?=$row['s6']?>">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="s7" value="<?=$row['s7']?>">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="s8" value="<?=$row['s8']?>">
								</div>
								<div class="form-group">
									<select name="dil" class="form-control m-bot15">
										<option value="0">- Dil -</option>
										<?php
										if ($sonuc1 = $mysqli -> query("select id, adi, DilKodu from diller")) {
											foreach($sonuc1 as $row1) {
											?>
										<option value="<?=$row1['id']?>" <?if ($row['dil']==$row1['id']){echo "selected";}?>><?=$row1['adi']?></option>
											<?
											}
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<select name="aktif" class="form-control m-bot15">
										<option value="0">Pasif</option>
										<option value="1" <?if ($row['aktif']==1){echo "selected";}?>>Aktif</option>
									</select>
								</div>
								<button type="submit" class="btn btn-success">Kaydet</button>
							</form>
					</div>
					<?
						}
					}
					?>
				</div>
			</div>
		</section>
	</div>
<?php
	include_once("cerceveler/footer.php");
?>