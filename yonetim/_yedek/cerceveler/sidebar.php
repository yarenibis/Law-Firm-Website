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
				<li class="nav-item">   <a href="default.php" class="nav-link"> ON YAZILIM Yönetim v1.0 </a></li><hr />
				<li class="nav-item">
					<a href="a_sayfalar.php?k=1" class="nav-link<?php if(isset($_GET['k'])) { if($_GET['k']=='1') { echo ' active';}} ?>"><i class="nav-icon fas fa-ellipsis-h"></i>
						Üst Menü
					</a>
				</li>
				<li class="nav-item<?php if($mevcutsayfa=='a_slider.php' || $mevcutsayfa=='a_banner.php' || $_GET['k']=='3') {echo ' menu-open';}?>">
					<a href="#" class="nav-link"><i class="nav-icon fas fa-home"></i>
						<p>Anasayfa İçeriği<i class="fas fa-angle-left right"></i></p>
					</a>
					<ul class="nav nav-treeview">

						<li class="nav-item">
							<a href="a_slider.php" class="nav-link<?php if($mevcutsayfa=='a_slider.php') {echo ' active';}?>">&nbsp;<i class="nav-icon fa fa-sliders-h"></i>
								Slider  Yönetim
							</a>
						</li>
						<li class="nav-item">
							<a href="a_banner.php" class="nav-link<?php if($mevcutsayfa=='a_banner.php') {echo ' active';}?>">&nbsp; <i class="nav-icon fa fa-images"></i>
								Banner Yönetim 
							</a>
						</li>
						<li class="nav-item">
							<a href="a_sayfalar.php?k=3" class="nav-link<?php if(isset($_GET['k'])) { if($_GET['k']=='3') { echo ' active';}} ?>">&nbsp; <i class="nav-icon fa fa-images"></i>
								Anasayfa Hakkımızda 
							</a>
						</li>

	<li class="nav-item">
							<a href="a_sayfalar.php?k=3100" class="nav-link<?php if(isset($_GET['k'])) { if($_GET['k']=='3100') { echo ' active';}} ?>">&nbsp; <i class="nav-icon fa fa-images"></i>
								Hizmetlerimiz Slaydırı
							</a>
						</li>




					</ul>
				</li>
				<li class="nav-item">
					<a href="a_sayac.php" class="nav-link"><i class="nav-icon fas fa-wrench"></i>
						Sayaç
					</a>
				</li>
				<li class="nav-item">
					<a href="a_sayfalar.php?k=2" class="nav-link<?php if(isset($_GET['k'])) { if($_GET['k']=='2') { echo ' active';}} ?>"><i class="nav-icon fas fa-blog"></i>Blog</a>
				</li>
				<!--
				<li class="nav-item">
					<a href="a_sayfalar.php?k=2000" class="nav-link<?php if(isset($_GET['k'])) { if($_GET['k']=='2000') { echo ' active';}} ?>"><i class="nav-icon fas fa-map"></i>Otel - Oda Özellikleri</a>
				</li>
			-->
				<li class="nav-item">
					<a href="a_dosyayonetici.php" class="nav-link<?php if($mevcutsayfa=='a_dosyayonetici.php') {echo ' active';}?>"><i class="nav-icon fas fa-file-upload"></i>Dosya Yöneticisi</a>
				</li>
				<li class="nav-item">
					<a href="a_mesajlar.php" class="nav-link<?php if($mevcutsayfa=='a_mesajlar.php') {echo ' active';}?>"><i class="nav-icon fas fa-mail-bulk"></i>Mesaj Kutusu</a>
				</li>
				<li class="nav-item">
					<a href="a_siteiletisim.php" class="nav-link<?php if($mevcutsayfa=='a_siteiletisim.php') {echo ' active';}?>"><i class="nav-icon fas fa-address-book"></i>Site İletişim Bilgileri</a>
				</li>
				<li class="nav-item<?php if(($mevcutsayfa=='a_diller.php') || ($mevcutsayfa=='a_galeriayarlari.php') ||($mevcutsayfa=='a_logoayar.php') ) {echo ' menu-open';}?>">
					<a href="#" class="nav-link"><i class="nav-icon fas fa-table"></i>
						<p>Site Ayarları<i class="fas fa-angle-left right"></i></p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="a_diller.php" class="nav-link<?php if($mevcutsayfa=='a_diller.php') {echo ' active';}?>">&nbsp;<i class="nav-icon fa fa-language"></i>
								Dil Listesi 
							</a>
						</li>
						<li class="nav-item">
							<a href="a_galeriayarlari.php" class="nav-link<?php if($mevcutsayfa=='a_galeriayarlari.php') {echo ' active';}?>">&nbsp;<i class="nav-icon fas fa-images"></i>
								Galeri Ayarları
							</a>
						</li>   
						<li class="nav-item">
							<a href="a_logoayar.php" class="nav-link<?php if($mevcutsayfa=='a_logoayar.php') {echo ' active';}?>"><i class="nav-icon fas fa-copyright"></i>Site Logosu</a>
						</li> 
					</ul>
				</li>
				<li class="nav-item">
					<a href="a_sayfasabitleri.php" class="nav-link<?php if($mevcutsayfa=='a_sayfasabitleri.php') {echo ' active';}?>"><i class="nav-icon fas fa-wrench"></i>Sayfa Sabitleri</a>
				</li>
				<li class="nav-item">
					<a href="a_sayfalar.php?k=20" class="nav-link<?php if(isset($_GET['k'])) { if($_GET['k']=='20') { echo ' active';}} ?>"><i class="nav-icon fas fa-pen-nib"></i>Yazarlar</a>
				</li>
				<li class="nav-item">
					<a href="a_fotograflar.php" class="nav-link<?php if($mevcutsayfa=='a_fotograflar.php') { echo ' active';} ?>"><i class="nav-icon fas fa-camera-retro"></i>Fotoğraf Arşivi</a>
				</li>
				<li class="nav-item">
					<a href="a_sayfalar.php?k=100" class="nav-link<?php if(isset($_GET['k'])) { if($_GET['k']=='100') { echo ' active';}} ?>"><i class="nav-icon fas fa-film"></i>Video Arşivi</a>
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
    <!-- /.sidebar -->
</aside>
