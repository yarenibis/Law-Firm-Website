<?php 
if (!defined("KORUMA")) {
 	header("Location: ../404.html");
	exit();
}
$mevcutsayfa= basename($_SERVER['PHP_SELF']); 
$mevcutsayfa2=basename($_SERVER['REQUEST_URI']);
?>
			<aside class="main-sidebar sidebar-dark-primary elevation-4">
				<div class="sidebar">
					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							<li class="nav-item"><a href="default.php" class="nav-link" style="border-bottom: 1px solid #4b545c;"><i class="nav-icon fas fa-tachometer-alt"></i> ON YAZILIM (<small>260921</small>) </a></li>
				
							<li class="nav-item">
								<a href="a_sayfalar.php?k=1" class="nav-link<?php if(isset($_GET['k'])) { if($_GET['k']=='1') { echo ' active';}} ?>"><i class="nav-icon fas fa-bars"></i>
									Üst Menü
								</a>
							</li>
							<li class="nav-item">
								<a href="a_slider.php" class="nav-link<?php if($mevcutsayfa=='a_slider.php') { echo ' active';} ?>"><i class="nav-icon fa fa-sliders-h"></i>Slider</a>
							</li>
							
							<li class="nav-item">
								<a href="a_sayfalar.php?k=3" class="nav-link<?php if(isset($_GET['k'])) { if($_GET['k']=='3') { echo ' active';}} ?>"><i class="nav-icon fas fa-blog"></i>Anasayfa İçerik 1</a>
							</li>
							<li class="nav-item">
								<a href="a_sayfalar.php?k=44" class="nav-link<?php if(isset($_GET['k'])) { if($_GET['k']=='44') { echo ' active';}} ?>"><i class="nav-icon fas fa-blog"></i>Hizmetlerimiz</a>
							</li>
							<li class="nav-item">
								<a href="a_sayfalar.php?k=33" class="nav-link<?php if(isset($_GET['k'])) { if($_GET['k']=='33') { echo ' active';}} ?>"><i class="nav-icon fas fa-blog"></i>Anasayfa İçerik 3</a>
							</li>
							<li class="nav-item">
								<a href="a_sayfalar.php?k=55" class="nav-link<?php if(isset($_GET['k'])) { if($_GET['k']=='55') { echo ' active';}} ?>"><i class="nav-icon fas fa-blog"></i>Ekibimiz</a>
							</li>
							<li class="nav-item">
								<a href="a_sayfalar.php?k=555" class="nav-link<?php if(isset($_GET['k'])) { if($_GET['k']=='555') { echo ' active';}} ?>"><i class="nav-icon fas fa-blog"></i>Anasayfa İçerik 5</a>
							</li>
							
							
							<li class="nav-item">
								<a href="a_sayfalar.php?k=6" class="nav-link<?php if(isset($_GET['k'])) { if($_GET['k']=='6') { echo ' active';}} ?>"><i class="nav-icon fas fa-blog"></i>Hakkımızda</a>
							</li>
							
							<li class="nav-item">
								<a href="a_sayfalar.php?k=666" class="nav-link<?php if(isset($_GET['k'])) { if($_GET['k']=='666') { echo ' active';}} ?>"><i class="nav-icon fas fa-blog"></i>Blog</a>
							</li>
							<li class="nav-item">
								<a href="a_dosyayonetici.php" class="nav-link<?php if($mevcutsayfa=='a_dosyayonetici.php') {echo ' active';}?>"><i class="nav-icon fas fa-file-upload"></i>Dosya Yöneticisi</a>
							</li>
							<li class="nav-item">
								<a href="a_mesajlar.php" class="nav-link<?php if($mevcutsayfa=='a_mesajlar.php') {echo ' active';}?>"><i class="nav-icon fas fa-mail-bulk"></i>Mesaj Kutusu</a>
							</li>
							<li class="nav-item">
								<a href="a_siteiletisim.php" class="nav-link<?php if($mevcutsayfa=='a_siteiletisim.php') {echo ' active';}?>"><i class="nav-icon fas fa-address-book"></i> İletişim Bilgileri</a>
							</li>
							<li class="nav-item">
								<a href="yoneticihesap.php" class="nav-link<?php if($mevcutsayfa=='yoneticihesap.php') {echo ' active';}?>"><i class="nav-icon fas fa-user"></i>Yönetici Hesabı</a>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link" role="button" data-toggle="modal" data-target="#modal-oturumkapat"><i class=" nav-icon fas fa-user-slash"></i>   Oturumu Kapat</a>
							</li>
						</ul>
					</nav>
				</div>
			</aside>
