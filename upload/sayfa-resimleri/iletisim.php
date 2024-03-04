<?php

if(isset($_POST["iletisim_formu"])) {

$date = date("Y-m-d");
$saat = date("H:i:s", time());

    $sonuc = dbSorgu("INSERT INTO mesaj_kutusu (adi_soyadi, cep_tel, eposta, konu, mesaj, tarih, saat) VALUES ('".$_POST["adi_soyadi"]."', '".$_POST["cep_tel"]."', '".$_POST["eposta"]."', '".$_POST["konu"]."', '".$_POST["mesaj"]."', '$date', '$saat')");
}
?>


<div role="main" class="main">
    <section class="page-header page-header-modern page-header-background page-header-background-md custom-bg-color-grey-1 mb-0" style="
            background-image: url(img/demos/education/backgrounds/page-header.jpg);
            background-position: 100% 100%;
          ">
        <div class="container">
            <div class="row mt-5">
                <div class="col align-self-center p-static text-center">
                    <h1 class="font-weight-bold text-color-secondary text-10">
                        <?= $istekSayfa_Adi ?>
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row py-3">
            <div class="col">
                <ul class="breadcrumb d-block">
                    <li><a href="#">Anasayfa</a></li>
                    <li class="active"><?= $istekSayfa_Adi ?></li>
                </ul>
            </div>
        </div>
        <div class="row py-3">
            <div class="col">
                <p class="font-weight-medium text-4">
                    Sizlerle iletişim kurmaktan mutluluk duyarız. Her türlü soru, görüş, öneri veya işbirliği talebiniz için bize ulaşmaktan çekinmeyin. Polydijital olarak, sizinle dijital dünyada değer yaratmak için bekliyoruz. İletişim bilgilerimiz aşağıda yer almaktadır.
                </p>

                <hr class="solid my-5" />

                <div class="row">
                    <div class="col-md-3 mb-4 mb-md-0 text-center">
                        <div class="feature-box d-flex flex-column align-items-center">

                            <div class="feature-box-icon bg-color-quaternary feature-box-icon-extra-large appear-animation" data-appear-animation="fadeInLeftShorterPlus" data-appear-animation-delay="250">
                                <img class="icon-animated" width="100" height="46" src="/upload/sayfa-resimleri/adres-ikonu-223.svg" alt="#" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-primary'}" />
                            </div>

                            <div class="feature-box-info ps-0 appear-animation" data-appear-animation="fadeInLeftShorterPlus" data-appear-animation-delay="150">
                                <p class="mt-2 pt-1 mb-0 text-1 p-relative top-5 text-uppercase">
                                    Adres
                                </p>
                                <p class="mb-0 text-color-secondary text-4 font-weight-semi-bold">
                                    <?= $Site->Adres ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4 mb-md-0 text-center">
                        <div class="feature-box d-flex flex-column align-items-center">

                            <div class="feature-box-icon bg-color-quaternary feature-box-icon-extra-large appear-animation" data-appear-animation="fadeInLeftShorterPlus" data-appear-animation-delay="250">
                                <img class="icon-animated" width="100" height="46" src="upload/sayfa-resimleri/telefon-ikonu-224.svg" alt="<?= $row1["s2_descr"] ?>" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-primary'}" />
                            </div>


                            <div class="feature-box-info ps-0 appear-animation" data-appear-animation="fadeInLeftShorterPlus" data-appear-animation-delay="150">
                                <p class="mt-2 pt-1 mb-0 text-1 p-relative top-5 text-uppercase">
                                    Telefon Numarası
                                </p>
                                <p class="mb-0 text-color-secondary text-4 font-weight-semi-bold">
                                    <a href="tel:<?= $Site->Cep ?>" class="text-color-secondary"><?= $Site->Cep ?></a> <br />
                                    <a href="tel:<?= $Site->Sabit ?>" class="text-color-secondary"><?= $Site->Sabit ?></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4 mb-md-0 text-center">
                        <div class="feature-box d-flex flex-column align-items-center">

                            <div class="feature-box-icon bg-color-quaternary feature-box-icon-extra-large appear-animation" data-appear-animation="fadeInLeftShorterPlus" data-appear-animation-delay="250">
                                <img class="icon-animated" width="100" height="46" src="upload/sayfa-resimleri/eposta-ikonu-225.svg" alt="#" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-primary'}" />
                            </div>


                            <div class="feature-box-info ps-0 appear-animation" data-appear-animation="fadeInLeftShorterPlus" data-appear-animation-delay="150">
                                <p class="mt-2 pt-1 mb-0 text-1 p-relative top-5 text-uppercase">
                                    E-posta Adresi
                                </p>
                                <p class="mb-0 text-color-secondary text-4 font-weight-semi-bold">
                                    <a href="mailto: <?= $Site->Eposta ?>" class="text-color-secondary"><span class="__cf_email__" data-cfemail="5c2c332e28331c2c332e28332834393139723f3331"><?= $Site->Eposta ?></span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4 mb-md-0 text-center">
                        <div class="feature-box d-flex flex-column align-items-center">


                            <div class="feature-box-icon bg-color-quaternary feature-box-icon-extra-large appear-animation" data-appear-animation="fadeInLeftShorterPlus" data-appear-animation-delay="250">
                                <img class="icon-animated" width="100" height="46" src="upload/sayfa-resimleri/calisma-saatleri-ikonu-226.svg" alt="#" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-primary'}" />
                            </div>


                            <div class="feature-box-info ps-0 appear-animation" data-appear-animation="fadeInLeftShorterPlus" data-appear-animation-delay="150">
                                <p class="mt-2 pt-1 mb-0 text-1 p-relative top-5 text-uppercase">
                                    Çalışma Gün/Saatleri
                                </p>
                                <p class="mb-0 text-color-secondary text-4 font-weight-semi-bold">
                                    <?= $Site->CalismaSaatleri ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="solid mt-5 mb-4" />
            </div>
        </div>
        <div class="row pb-5 mb-3">
            <div class="col">
                <h2 class="text-color-secondary font-weight-semi-bold text-6 line-height-1 mb-4">
                    Mesaj Gönderin
                </h2>
                <form class="contact-form custom-form-style-1" action="" method="POST">
                    <div class="contact-form-success alert alert-success d-none mt-4">
                        <strong>Başarılı!</strong> Mesajınız Bize İletildi.
                    </div>

                    <div class="contact-form-error alert alert-danger d-none mt-4">
                        <strong>Hata!</strong> Mesaj Gönderilirken Bir Hata Oluştu.
                        <span class="mail-error-message text-1 d-block"></span>
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
                            <button type="submit" name= "iletisim_formu" class="btn btn-secondary font-weight-bold btn-px-5 btn-py-3 mt-4 mb-2" data-loading-text="Loading...">
                                MESAJ GÖNDER
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>