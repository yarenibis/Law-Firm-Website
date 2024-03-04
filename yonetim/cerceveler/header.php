<?php 
if (!defined("KORUMA")) {
 	header("Location: ../404.html");
	exit();
}
?>
<!DOCTYPE html>
<html lang="tr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>YÖNETİM ANA EKRAN</title>

		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<link rel="stylesheet" type="text/css"  href="fontawesome-free/css/all.css">
		<link rel="stylesheet" href="<?=$ynt_files?>/plugins/ionicons/2.0.1/css/ionicons.min.css">
		<link rel="stylesheet" href="<?=$ynt_files?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
		<link rel="stylesheet" href="<?=$ynt_files?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
		<link rel="stylesheet" href="<?=$ynt_files?>/plugins/jqvmap/jqvmap.min.css">
		<link rel="stylesheet" href="<?=$ynt_files?>/dist/css/adminlte.css">
		<link rel="stylesheet" href="<?=$ynt_files?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
		<link rel="stylesheet" href="<?=$ynt_files?>/plugins/daterangepicker/daterangepicker.css">
		<link rel="stylesheet" href="<?=$ynt_files?>/plugins/ekko-lightbox/ekko-lightbox.css">
		<link rel="stylesheet" href="<?=$ynt_files?>/dist/ozelcss.css">

		<script src="<?=$ynt_files?>/plugins/jquery/jquery.min.js"></script>
		<script src="<?=$ynt_files?>/dist/ckeditor/ckeditor.js"></script>

		<link rel="stylesheet" href="<?=$ynt_files?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
		<?php
		if (isset($_GET['flashmessage'])) { 
		?>
			<script>
				$(document).ready(function(){
					$("#flashmessage").modal('show');
				});
			</script>
		<?php
		}

		if (isset($_GET['onaymessage'])) { 
		?>
			<script>
				$(document).ready(function(){
					$("#onaymessage").modal('show');
				});
			</script>
		<?php
		}

		if (isset($_GET['show-message-detail'])) { 
		?>
			<script>
				$(document).ready(function(){
					$("#show-message-detail").modal('show');
				});
			</script>
		<?php
		}
		?>
	</head>
	<body class="hold-transition sidebar-mini layout-fixed">
		<div class="wrapper">
			<nav class="main-header navbar navbar-expand navbar-white navbar-light">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
					</li>
				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" data-widget="fullscreen" href="#" role="button">
							<i class="fas fa-expand-arrows-alt"></i>
						</a>
					</li>
					<li class="nav-item">
						<div class="input-group input-group-md">
							<div class="">
								<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
									<?php 
									$profiladi=explode(" ", $firmaadi);
									echo $firmaadi;
									?>
								</button>
								<ul class="dropdown-menu list-group-flush"> 
									<li><a href="yoneticihesap.php" class="list-group-item"> Hesabım</a> </li>
									<li><a href="#" class="list-group-item" role="button" data-toggle="modal" data-target="#modal-oturumkapat"> Oturumu Kapat</a> </li>
								</ul>
							</div>
						</div>
					</li>
				</ul>
			</nav>