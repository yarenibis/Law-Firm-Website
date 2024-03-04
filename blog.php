
   

			<div role="main" class="main">
				
				<section class="page-header page-header-modern bg-color-quaternary page-header-lg border-0 m-0">
					<div class="container position-relative z-index-2">
						<div class="row text-center text-md-start py-3">
							<div class="col-md-8 order-2 order-md-1 align-self-center p-static">
								<h1 class="font-weight-bold text-color-dark text-10 mb-0">Blog</h1>
							</div>
							<div class="col-md-4 order-1 order-md-2 align-self-center">
								<ul class="breadcrumb breadcrumb-dark font-weight-bold d-block text-md-end text-4 mb-0">
									<li><a href="demo-finance.html" class="text-decoration-none text-dark">Anasayfa</a></li>
									<li class="text-upeercase active text-color-primary">Blog</li>
								</ul>
							</div>
						</div>
					</div>
				</section>

				<div class="container py-5 my-3">
					<div class="row">
					<?php $sonuc=dbSorgu("select * from sayfalar where konum = 666 and aktif =1  order by sira",array($istekSayfa_Dil)); 
					if (count($sonuc)>0) {
					foreach ($sonuc as $row) {
					?>
						<div class="col-lg-4 mb-5 mb-lg-0">
						
							<article class="mb-5">
								<div class="card border-0 border-radius-0 custom-box-shadow-1">
									<div class="card-img-top">
										<a href="/<?=$row['purl']?>">
											<img class="card-img-top border-radius-0 hover-effect-2" src="/upload/sayfa-resimleri/<?=$row['res']?>" alt="Card Image">
										</a>
									</div>
									<div class="card-body bg-light px-0 py-4 z-index-1">
										<p class="text-uppercase text-color-default text-1 mb-1 pt-1">
											<time pubdate datetime="2022-01-10">10 Jan 2022</time> 
											<span class="opacity-3 d-inline-block px-2">|</span> 
											John Doe
										</p>
										<div class="card-body p-0">
											<h4 class="card-title alternative-font-4 font-weight-semibold text-5 mb-3"><a class="text-color-dark text-color-hover-primary text-decoration-none font-weight-bold text-3" href="/<?=$row['purl']?>"><?=$row['adi']?></a></h4>
											<p class="card-text mb-2"><?=$row['descr']?></p>
											<a href="/<?=$row['purl']?>" class="custom-view-more d-inline-flex font-weight-medium text-color-primary">
												Daha fazla
												<img width="27" height="27" src="img/demos/law-firm/icons/arrow-right.svg" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-primary ms-2'}" style="width: 27px;" />
											</a>
										</div>
									</div>
								</div>
							</article>
							</div>
							<?php }} ?>
						
						
					</div>
				</div>

			</div>