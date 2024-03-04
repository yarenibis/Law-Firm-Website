<footer id="footer" class="border-top-0 mt-0">
	<div class="container py-4">
		<div class="row py-5">
			<div class="col-md-6 mb-4 mb-lg-0">
				<a href="index.html" class="logo pe-0 pe-lg-3 pb-4">
					<img alt="Porto" width="125" height="47" src="img/demos/law-firm/logo-footer.png">
				</a>
				<p class="pt-3 mb-2">Porto Hukuk alanında uzman avukatlar...</p>

			</div>

			<?php
			$sonuc = dbSorgu("SELECT * from iletisim_bilgileri ", array($istekSayfa_Dil));
			if (count($sonuc) > 0) {
				foreach ($sonuc as $row) { ?>

					<div class="col-md-3 mb-4 mb-lg-0">
						<h5 class="text-4-5 text-transform-none custom-font-primary mb-3">İletişime geçin</h5>
						<div class="row pb-3">
							<div class="col">
								<div class="feature-box feature-box-style-2 align-items-center">
									<div class="feature-box-icon">
										<img width="34" height="28" src="img/demos/law-firm/icons/envelope.svg" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-primary'}" style="width: 34px; height: 28px;" />
									</div>
									<div class="feature-box-info ps-1">
										<label class="custom-footer-label-1">MAIL GÖNDERİN</label>
										<strong class="custom-footer-strong-1"><a href="https://www.okler.net/cdn-cgi/l/email-protection#1b767a72775b7e637a766b777e35787476" class="text-color-light"><span class="__cf_email__" data-cfemail="216c60686d616479606c716d640f626e6c"><?= $row['eposta'] ?></span></a></strong>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="feature-box feature-box-style-2 align-items-center">
									<div class="feature-box-icon">
										<img width="30" height="30" src="img/demos/law-firm/icons/phone.svg" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-stroke-color-primary p-relative left-3'}" style="width: 30px; height: 30px;" />
									</div>
									<div class="feature-box-info ps-1">
										<label class="custom-footer-label-1">ŞİMDİ ARA</label>
										<strong class="custom-footer-strong-1"><a href="tel:8001234567" class="text-color-light"><?= $row['cep'] ?></a></strong>
									</div>
								</div>
							</div>
						</div>
					</div>
			<?php }
			} ?>


			<?php $sonuc = dbSorgu("SELECT * from iletisim_bilgileri ", array($istekSayfa_Dil));
			if ($sonuc > 0) {
				foreach ($sonuc as $row) {  ?>
					<div class="col-md-3">
						<h5 class="text-4-5 text-transform-none custom-font-primary mb-3">Sosyal Mecralar</h5>

						<ul class="custom-social-icons-style-1 social-icons social-icons-clean">
							<li class="social-icons-instagram">
								<a href="<?= $row['instagram'] ?>" class="no-footer-css" target="_blank" title="Instagram"><i class="text-primary fab fa-instagram"></i></a>
							</li>
							<li class="social-icons-twitter mx-4">
								<a href="<?= $row['twitter'] ?>" class="no-footer-css" target="_blank" title="Twitter"><i class="text-primary fab fa-twitter"></i></a>
							</li>
							<li class="social-icons-facebook">
								<a href="<?= $row['facebook'] ?>" class="no-footer-css" target="_blank" title="Facebook"><i class="text-primary fab fa-facebook-f"></i></a>
							</li>
						</ul>
					</div>
		</div>
<?php }
			} ?>
	</div>



	<div class="footer-copyright footer-copyright-style-2">
		<div class="container py-2">
			<div class="row py-4">
				<div class="col d-flex align-items-center justify-content-center">
					<p>© Copyright 2022. All Rights Reserved.</p>
				</div>
			</div>
		</div>
	</div>
</footer>
</div>
<!--
<a class="style-switcher-open-loader" href="#" data-base-path="" data-skin-src="master/less/skin-law-firm.less" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="right" title="Style Switcher"><i class="fas fa-cogs"></i>
	<div class="style-switcher-tooltip"><strong>Style Switcher</strong>
		<p>Check out different color options and styles.</p>
	</div>
</a>

<a class="envato-buy-redirect" href="https://themeforest.net/checkout/from_item/4106987?license=regular&amp;support=bundle_6month&amp;ref=Okler" target="_blank" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="right" title="Buy Porto"><i class="fas fa-shopping-cart"></i></a>
<a class="demos-redirect" href="index.html#demos" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="right" title="Demos"><img src="img/icons/demos-redirect.png" class="img-fluid" /></a>
		-->

<!-- Vendor -->
<script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="vendor/plugins/js/plugins.min.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="js/theme.js"></script>

<!-- Revolution Slider Scripts -->
<script src="vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

<!-- Current Page Vendor and Views -->
<script src="js/views/view.contact.js"></script>

<!-- Demo -->
<script src="js/demos/demo-law-firm.js"></script>

<!-- Theme Initialization Files -->
<script src="js/theme.init.js"></script>

</body>

</html>