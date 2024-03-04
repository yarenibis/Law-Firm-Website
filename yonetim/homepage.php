<?php
if ($stmt = $mysqli->prepare("SELECT firma FROM iletisim_bilgileri LIMIT 1")) {
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($firmaadi);
	$stmt->fetch();
}
include_once("cerceveler/header.php");
include_once("cerceveler/sidebar.php");
?>
			<div class="content-wrapper">
				<div class="content-header">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1 class="m-0">Dashboard</h1>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right">
									<li class="breadcrumb-item"><a href="default.php">Anasayfa</a></li>
								</ol>
							</div>
						</div>
					</div>
				</div>

				<section class="content">
					<div class="container-fluid">
						<div class="row">
							<!-- DASHBOARD---------------------->





							<!-- DASHBOARD---------------------->
						</div>
					</div>
				</section>
			</div>
			<?php
			include_once("cerceveler/footer.php");
			?>