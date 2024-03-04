
<?php

if(isset($_POST["kaydet"])) {

$date = date("Y-m-d");
$saat = date("H:i:s", time());

    $sonuc = dbSorgu("INSERT INTO mesaj_kutusu (adi_soyadi, cep_tel, eposta, konu, mesaj, tarih, saat) VALUES ('".$_POST["adi_soyadi"]."', '".$_POST["cep_tel"]."', '".$_POST["eposta"]."', '".$_POST["konu"]."', '".$_POST["mesaj"]."', '$date', '$saat')");
}
?>
<div role="main" class="main">
				
				<section class="page-header page-header-modern bg-color-quaternary page-header-lg border-0 m-0">
					<div class="container position-relative z-index-2">
						<div class="row text-center text-md-start py-3">
							<div class="col-md-8 order-2 order-md-1 align-self-center p-static">
								<h1 class="font-weight-bold text-color-dark text-10 mb-0"><?=$istekSayfa_Adi?></h1>
							</div>
							<div class="col-md-4 order-1 order-md-2 align-self-center">
								<ul class="breadcrumb breadcrumb-dark font-weight-bold d-block text-md-end text-4 mb-0">
									<li><a href="demo-finance.html" class="text-decoration-none text-dark">Anasayfa</a></li>
									<li class="text-upeercase active text-color-primary"><?=$istekSayfa_Adi?></li>
								</ul>
							</div>
						</div>
					</div>
				</section>

				<div class="container py-5 my-3">
					<div class="row">
						<div class="col-lg-8 mb-4 mb-lg-0">
							
					<!--		<div class="row pb-5">
								<div class="col-md-5">
									<img src="<?=$istekSayfa_Res?>" />
									
								</div>
								<div class="col-md-7">
									<p class="text-color-dark text-5 font-weight-bold mb-1"></p>
									<p class="d-block text-color-default font-weight-semibold line-height-1 positive-ls-2 text-2 text-uppercase mb-3"><?=$istekSayfa_Title?></p>
									

									<ul class="social-icons social-icons-clean social-icons-icon-dark social-icons-medium pt-3 mb-0">
										<li class="social-icons-facebook">
											<a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
										</li>
										<li class="social-icons-twitter">
											<a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a>
										</li>
										<li class="social-icons-linkedin">
											<a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fab fa-linkedin-in"></i></a>
										</li>
									</ul>
								</div>
							</div> -->

							<h4 class="mb-0"><?=$istekSayfa_Adi?></h4>
							<div class="divider divider-primary divider-small mt-2 mb-4">
								<hr class="my-0 me-auto">
							</div>

							<?=$istekSayfa_Icerik?>
						</div>
						<div class="col-lg-4">
							


							<h4 class="mb-0 pt-4">benimle iletişime geçin</h4>
							<div class="divider divider-primary divider-small mt-2 mb-4">
								<hr class="my-0 me-auto">
							</div>

							<form class="contact-form form-style-2" action="" method="POST">
								<div class="contact-form-success alert alert-success d-none mt-4">
									<strong>başarılı!</strong>mesajınız iletildi
								</div>

								<div class="contact-form-error alert alert-danger d-none mt-4">
									<strong>başarılı!</strong>mesajınız iletildi
									<span class="mail-error-message text-1 d-block"></span>
								</div>
								
								<div class="row pb-1">
									<div class="form-group">
										<input type="text" value="" placeholder="Full Name" data-msg-required="Please enter your name." maxlength="100" class="form-control bg-color-light-grey text-2 h-auto py-2" name="adi_soyadi" required>
									</div>
								</div>
								<div class="row pb-1">
									<div class="form-group">
										<textarea maxlength="5000" placeholder="cep tel" data-msg-required="Please enter your message." rows="8" class="form-control bg-color-light-grey text-2 h-auto py-2" name="cep_tel" required></textarea>
									</div>
								</div>
								<div class="row pb-1">
									<div class="form-group">
										<input type="email" value="" placeholder="Email Address" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control bg-color-light-grey text-2 h-auto py-2" name="eposta" required>
									</div>
								</div>
								<div class="row pb-1">
									<div class="form-group">
										<input type="text" value="" placeholder="Subject" data-msg-required="Please enter the subject." maxlength="100" class="form-control bg-color-light-grey text-2 h-auto py-2" name="konu" required>
									</div>
								</div>
								<div class="row pb-1">
									<div class="form-group">
										<textarea maxlength="5000" placeholder="Message" data-msg-required="Please enter your message." rows="8" class="form-control bg-color-light-grey text-2 h-auto py-2" name="mesaj" required></textarea>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<input type="submit" value="gönder" name="kaydet" class="btn btn-primary btn-modern text-uppercase font-weight-bold text-2 py-3 btn-px-4" data-loading-text="Loading...">
									</div>
								</div>
							</form>
                       
						</div>
					</div>
				</div>

				

			</div>

			

			