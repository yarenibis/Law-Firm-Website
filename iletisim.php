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
								<h1 class="font-weight-bold text-color-dark text-10 mb-0">İletişim</h1>
							</div>
							<div class="col-md-4 order-1 order-md-2 align-self-center">
								<ul class="breadcrumb breadcrumb-dark font-weight-bold d-block text-md-end text-4 mb-0">
									<li><a href="demo-finance.html" class="text-decoration-none text-dark">Anasayfa</a></li>
									<li class="text-upeercase active text-color-primary">İletişim</li>
								</ul>
							</div>
						</div>
					</div>
				</section>

				<div class="container py-5 my-3">
					<div class="row">
						<div class="col">

							<h2 class="mb-0 font-weight-bold">İletişime geçin</h2>
							<div class="divider divider-primary divider-small mt-2 mb-4">
								<hr class="my-0 me-auto">
							</div>

							<div class="row py-2">

								<div class="col-md-4">
									<p class="mb-0"><strong class="text-dark text-4">Adres</strong></p>
									<p class="mb-0"><?= $Site->Adres ?></p>
								</div>
								<div class="col-md-4">
									<p class="mb-0"><strong class="text-dark text-4">Çalışma saatleri:</strong></p>
									<p class="mb-0"><?= $Site->CalismaSaatleri ?></p>
								</div>
								
								<div class="col-md-4">
									<p class="mb-0"><strong class="text-dark text-4">Email:</strong></p>
									<p class="mb-0"><a href="porto%40portotheme.html"><span class="__cf_email__" data-cfemail="fe8e918c8a91be8e918c8a918a969b939bd09d9193"><?= $Site->Eposta ?></span></a></p>
								</div>
								
							</div>

						</div>
					</div>
				</div>

				<section class="section border-0 lazyload my-0" data-bg-src="img/demos/law-firm/backgrounds/background-4.jpg" style="background-position: 50% 100%;">
					<div class="container">
						<div class="row justify-content-md-end py-3">
							<div class="col-md-6">
								<div class="appear-animation" data-appear-animation="blurIn" data-appear-animation-delay="0">
									<h2 class="mb-0 font-weight-bold">İletişime geçin</h2>
									<div class="divider divider-primary divider-small mt-2 mb-4">
										<hr class="my-0 me-auto">
									</div>
								</div>
								<div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="300">
									<p class="font-weight-medium text-4">Yardım istedğiniz konu ile ilgili irtibata geçin</p>
								</div>
								<div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="400">




				<form class="contact-form custom-form-style-1" action="" method="POST">
                    <div class="contact-form-success alert alert-success d-none mt-4">
                        <strong>Başarılı!</strong> Mesajınız Bize İletildi.
                    </div>

                    <div class="contact-form-error alert alert-danger d-none mt-4">
                        <strong>Başarılı!</strong> Mesajınız Bize İletildi.
                        
                    </div>

                    <div class="row row-gutter-sm">
                        <div class="form-group col-lg-6 mb-4">
                            <input type="text" value="" data-msg-required="Lütfen isim giriniz" maxlength="100" class="form-control" name="adi_soyadi" id="name" required placeholder="İsminiz" />
                        </div>
                        <div class="form-group col-lg-6 mb-4">
                            <input type="text" value="" data-msg-required="Lütfen telefon numarası giriniz." maxlength="100" class="form-control" name="cep_tel" id="phone" required placeholder="Telefon Numaranız" />
                        </div>
                    </div>
                    <div class="row row-gutter-sm">
                        <div class="form-group col-lg-6 mb-4">
                            <input type="email" value="" data-msg-required="Lütfen eposta adresi giriniz." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="eposta" id="email" required placeholder="Eposta Adresiniz" />
                        </div>
                        <div class="form-group col-lg-6 mb-4">
                            <input type="text" value="" data-msg-required="Lütfen Konu Giriniz" maxlength="100" class="form-control" name="konu" id="subject" required placeholder="Konu" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col mb-4">
                            <textarea maxlength="5000" data-msg-required="Lütfen mesajınızı yazınız." rows="10" class="form-control" name="mesaj" id="message" required placeholder="Mesajınız..."></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col mb-0">
                            <button type="submit" name= "kaydet" class="btn btn-secondary font-weight-bold btn-px-5 btn-py-3 mt-4 mb-2" data-loading-text="Loading...">
                                 GÖNDER
                            </button>
							
                        </div>
                    </div>
                </form>
   


								</div>
							</div>
						</div>
					</div>
				</section>



			</div>

			
