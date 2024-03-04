<!DOCTYPE html>
<html data-style-switcher-options="{'changeLogo': false, 'colorPrimary': '#c69d66', 'colorSecondary': '#D9B372', 'colorTertiary': '#C59F5E', 'colorQuaternary': '#cccccc'}">
	
<head>
		
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Porto</title>	

		<meta name="keywords" content="WebSite Template" />
		<meta name="description" content="Porto - Multipurpose Website Template">
		<meta name="author" content="okler.net">

		
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="img/apple-touch-icon.png">

		
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

		<link id="googleFonts" href="https://fonts.googleapis.com/css?family=Merriweather:300,400,700,900%7CPoppins:200,300,400,500,600,700,800&amp;display=swap" rel="stylesheet" type="text/css">

		
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">		<link rel="stylesheet" href="vendor/fontawesome-free/css/all.min.css">		<link rel="stylesheet" href="vendor/animate/animate.compat.css">		<link rel="stylesheet" href="vendor/simple-line-icons/css/simple-line-icons.min.css">		<link rel="stylesheet" href="vendor/owl.carousel/assets/owl.carousel.min.css">		<link rel="stylesheet" href="vendor/owl.carousel/assets/owl.theme.default.min.css">		<link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.min.css">

		
		<link rel="stylesheet" href="css/theme.css">
		<link rel="stylesheet" href="css/theme-elements.css">
		<link rel="stylesheet" href="css/theme-blog.css">
		<link rel="stylesheet" href="css/theme-shop.css">

		<link rel="stylesheet" href="vendor/rs-plugin/css/settings.css">		<link rel="stylesheet" href="vendor/rs-plugin/css/layers.css">		<link rel="stylesheet" href="vendor/rs-plugin/css/navigation.css">

		<link rel="stylesheet" href="css/demos/demo-law-firm.css">

		<link id="skinCSS" rel="stylesheet" href="css/skins/skin-law-firm.css">

		
		<link rel="stylesheet" href="css/custom.css">

		
		<script src="vendor/modernizr/modernizr.min.js"></script>

		
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-42715764-11"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-42715764-11');
		</script>

	</head>
	<body>

		<div class="body">
		<?php
    $sonuc = dbSorgu("SELECT * FROM iletisim_bilgileri WHERE id=1");
    if ($sonuc > 0) {
        foreach($sonuc as $row ) { ?>
			<header id="header" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': false, 'stickyStartAt': 107, 'stickySetTop': '-107px', 'stickyChangeLogo': true}">
				<div class="header-body border-color-primary border-top-0 box-shadow-none">
					<div class="header-container container z-index-2">
						<div class="header-row">
							<div class="header-column">
								<div class="header-row">
									<div class="header-logo">
										<a href="demo-law-firm.html">
											<img alt="Porto" width="125" height="47" src="img/demos/law-firm/logo.png">
										</a>
									</div>
								</div>
							</div>
							<div class="header-column justify-content-end">
								<div class="header-row h-100">
									<ul class="header-extra-info d-flex h-100 align-items-center">
										<li class="align-items-center d-none d-lg-block h-100 py-4">
											<div class="header-extra-info-text h-100 py-2">
												<div class="feature-box feature-box-style-2 align-items-center">
													<div class="feature-box-icon">
														<img width="34" height="28" src="img/demos/law-firm/icons/envelope.svg" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-primary'}" style="width: 34px; height: 28px;" />
													</div>
													<div class="feature-box-info ps-1">
														<label>EMAIL ADRESİMİZ</label>
														<strong><a href="https://www.okler.net/cdn-cgi/l/email-protection#177a767e7b57726f767a677b723974787a"><span class="__cf_email__" data-cfemail="8dc0ccc4c1cdc8d5ccc0ddc1c8a3cec2c0"><?=$row['eposta']?></span></a></strong>
													</div>
												</div>
											</div>
										</li>
										<li class="align-items-center d-none d-lg-block h-100 py-4">
											<div class="header-extra-info-text h-100 py-2">
												<div class="feature-box feature-box-style-2 align-items-center">
													<div class="feature-box-icon">
														<img width="30" height="30" src="img/demos/law-firm/icons/phone.svg" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-stroke-color-primary p-relative left-3'}" style="width: 30px; height: 30px;" />
													</div>
													<div class="feature-box-info ps-1">
														<label>ŞİMDİ ARAYIN</label>
														<strong><a href="tel:8001234567"><?=$row['cep']?></a></strong>
													</div>
												</div>
											</div>
										</li>
										<li class="align-items-center d-none d-sm-block h-100 py-4">
											<div class="header-extra-info-text h-100 py-2">
												<div class="feature-box feature-box-style-2 align-items-center">
													<div class="feature-box-icon">
														<img width="33" height="31" src="img/demos/law-firm/icons/comment.svg" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-primary'}" style="width: 33px; height: 31px;" />
													</div>
													<div class="feature-box-info ps-1">
														<label class="p-relative top-4">BAŞLAYALIM</label>
														<strong class="text-uppercase"><a href="/iletisim">SORU SORUN <img width="27" height="27" src="img/demos/law-firm/icons/arrow-right.svg" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-primary ms-2 d-inline'}" /></a></strong>
													</div>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<?php } } ?>

					
					
					<div class="header-nav-bar">
						<div class="container">
							<div class="header-row">
								<div class="header-column">
									<div class="header-row">
										<div class="header-column">

											<div class="header-nav justify-content-start header-nav-line header-nav-bottom-line header-nav-bottom-line-effect-1">
												<div class="header-nav-main header-nav-main-square header-nav-main-dropdown-no-borders header-nav-main-effect-2 header-nav-main-sub-effect-1">
													<nav class="collapse">
														<?php include_once "ustmenu.php"; ?>
													</nav>
												</div>
											</div>

										</div>
										<div class="header-column">
											<div class="header-row justify-content-end py-2">
												<div class="header-nav-features header-nav-features-no-border ms-0 ps-0 w-100">


													<form role="search" class="d-flex w-100" action="arama-sonuclari" method="post" >
														<div class="simple-search input-group w-100">
															<input class="form-control bg-transparent border-0 border-radius-0 text-2" id="headerSearch" name="search" type="search" value="" placeholder="Search...">
															<button class="btn border-0" type="submit" name="submit">
																<i class="fa fa-search text-color-primary header-nav-top-icon p-relative top-1"></i>
															</button>
														</div>
													</form>


												</div>
											</div>
										</div>
										<button class="btn header-btn-collapse-nav" data-bs-toggle="collapse" data-bs-target=".header-nav-main nav">
											<i class="fas fa-bars"></i>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
			</header>