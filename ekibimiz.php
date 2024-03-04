
			<div role="main" class="main">
				
				<section class="page-header page-header-modern bg-color-quaternary page-header-lg border-0 m-0">
					<div class="container position-relative z-index-2">
						<div class="row text-center text-md-start py-3">
							<div class="col-md-8 order-2 order-md-1 align-self-center p-static">
								<h1 class="font-weight-bold text-color-dark text-10 mb-0">Ekibimiz</h1>
							</div>
							<div class="col-md-4 order-1 order-md-2 align-self-center">
								<ul class="breadcrumb breadcrumb-dark font-weight-bold d-block text-md-end text-4 mb-0">
									<li><a href="demo-finance.html" class="text-decoration-none text-dark">Anasayfa</a></li>
									<li class="text-upeercase active text-color-primary">Ekibimiz</li>
								</ul>
							</div>
						</div>
					</div>
				</section>



<?php
		$sonuc = dbSorgu("SELECT s1.id as s1_id,  s2.res as s2_res, s2.id as s2_id,s2.uid as s2_uid, s2.adi as s2_adi, s2.descr as s2_descr, s2.purl as s2_purl from sayfalar s1 left join sayfalar s2 on s1.id = s2.uid where s2.uid =198 and s1.aktif = 1 and s2.aktif = 1 and s2.konum = 55 ", array($istekSayfa_Dil));
		if (count($sonuc) > 0) {
		$i = 1;
		foreach ($sonuc as $row) { 
			 if ($i == 1) { 
?>		
				<div class="container py-5 my-3">
					<div class="row">
						<div class="col-lg-8 mb-4 mb-lg-0">
							<h2 class="mb-0 font-weight-bold">Avukatlarımız</h2>
							<div class="divider divider-primary divider-small mt-2 mb-4">
								<hr class="my-0 me-auto">
							</div>

							<div class="sort-destination-loader sort-destination-loader-showing">				
								<div class="row portfolio-list">

									
									
									
																
									<?php } $i++; ?>
									<div class="col-sm-6 col-lg-4 isotope-item text-center divorce-law new-york">
										<div class="row">
											<div class="col">
												<a href="/<?=$row['s2_purl']?>">
													<img src="/upload/sayfa-resimleri/<?=$row['s2_res']?>" class="img-fluid" alt="Image of the team member">
												</a>
											</div>
										</div>
										<div class="row pb-3">
											<div class="col pt-3">
												<p class="text-color-dark text-4-5 font-weight-bold mb-1"><?=$row['s2_adi']?></p>
												<p class="d-block text-color-default font-weight-semibold line-height-1 positive-ls-2 text-2 text-uppercase mb-3"><?=$row['s2_title']?></p>
												<p class="text-2 mb-2">
													<?=$row['s2_descr']?>
												</p>
												<p class="text-2 mb-3">
													<a class="mt-3 font-weight-semi-bold" href="/<?=$row['s2_purl']?>">Daha fazla<img width="27" height="27" src="img/demos/law-firm/icons/arrow-right.svg" alt="" data-icon="" data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-primary d-inline-block ms-2 p-relative bottom-1'}"></a>
												</p>
											</div>
										</div>
									</div>
									<?php }} ?>


								</div>
							</div>

						</div>


			 
						<div class="col-lg-4">
							<div id="combinationFilters" class="filters mb-5">
								<h4 class="mb-0">Konuya göre filtre</h4>
								<div class="divider divider-primary divider-small mt-2 mb-4">
									<hr class="my-0 me-auto">
								</div>
                                 
								<ul class="nav nav-pills sort-source sort-source-style-3 custom-sort-source portfolio-filter-group" data-filter-group="group1">
								    <li class="nav-item active" data-option-value="*"><a class="nav-link font-weight-semibold text-color-dark text-color-hover-primary px-0 " href="#">Tümü</a></li>
<?php
		$sonuc = dbSorgu("SELECT s2.title as s2_title, s2.purl as s2_purl ,s2.purl as s2_purl from sayfalar s1 left join sayfalar s2 on s1.id = s2.uid where s2.uid =198 and s1.aktif = 1 and s2.aktif = 1 and s2.konum = 55 ", array($istekSayfa_Dil));
		if (count($sonuc) > 0) {
		foreach ($sonuc as $row) {
?>

								    <li class="nav-item" data-option-value=".<?=$row['s2_cano']?>"><a class="nav-link text-2 text-hover-dark" href="#"> <?=$row['s2_title']?> </a></li>
<?php } } ?>
								</ul>	
							</div>
						</div>



					</div>
				</div>
			</div>
				
		

			