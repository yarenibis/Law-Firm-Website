<div role="main" class="main">
				
				<section class="page-header page-header-modern bg-color-quaternary page-header-lg border-0 m-0">
					<div class="container position-relative z-index-2">
						<div class="row text-center text-md-start py-3">
							<div class="col-md-8 order-2 order-md-1 align-self-center p-static">
								<h1 class="font-weight-bold text-color-dark text-10 mb-0">Hizmetlerimiz</h1>
							</div>
							<div class="col-md-4 order-1 order-md-2 align-self-center">
								<ul class="breadcrumb breadcrumb-dark font-weight-bold d-block text-md-end text-4 mb-0">
									<li><a href="demo-finance.html" class="text-decoration-none text-dark">Anasayfa</a></li>
									<li class="text-upeercase active text-color-primary">Hizmetlerimiz</li>
								</ul>
							</div>
						</div>
					</div>
				</section>

				
				

<?php
$sonuc = dbSorgu("SELECT s1.adi as s1_adi, s1.title as s1_title, s2.icon as s2_icon, s2.adi as s2_adi, s2.icerik ,s2.purl as s2_purl,s2.descr as s2_descr,s2.res as s2_res FROM sayfalar s1, sayfalar s2 WHERE s1.konum = 44 and s1.id = s2.uid", array($istekSayfa_Dil));
if (count($sonuc) > 0) {
	$i = 1;
	$k=1;
	$m=1;
	foreach ($sonuc as $row) {
		if ($i == 1) { ?>

				
<section class="section bg-transparent section-no-border my-0">
					<div class="container pt-3 pb-4">
						<div class="row">
							<div class="col text-center">
								<div class="appear-animation" data-appear-animation="blurIn" data-appear-animation-delay="0">
									<h2 class="mb-0 font-weight-bold"><?=$row['s1_adi']?></h2>
									<div class="divider divider-primary divider-small mt-2 mb-4 text-center">
										<hr class="my-0 mx-auto">
									</div>
								</div>
							</div>
						</div>
						<div class="<?php if($m<4){echo"row mt-4";} else {echo "row mt-lg-3";} $m++; ?>">
						<?php } $i++; ?>
							<div class="col-lg-4">
								<div class="feature-box feature-box-style-2 mb-4 appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="0">
									<div class="feature-box-icon mt-3">
										<img width="50" height="50" src="/upload/sayfa-resimleri/<?=$row['s2_res']?>" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': '<?php if($k==1){echo"svg-fill-color-dark";}  else if($k==2 or $k==3 or $k==5){echo"svg-fill-color-light";}
										 else if($k==4){echo" ";} else{echo "svg-fill-color-dark d-inline-block ms-2 p-relative bottom-1";} $k++;?>'}" />
									</div>
									<div class="feature-box-info ms-3">
										<h4 class="mb-2"><?=$row['s2_adi']?></h4>
										<p><?=$row['s2_descr']?></p>
										<a class="mt-3 font-weight-semi-bold" href="/<?=$row['s2_purl']?>">Daha fazla<img width="27" height="27" src="img/demos/law-firm/icons/arrow-right.svg" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-primary d-inline-block ms-2 p-relative bottom-1'}" /></a>
									</div>
								</div>
							</div>  <?php } ?>
						</div>
					</div>
				</section>
<?php } ?>

				

			</div>