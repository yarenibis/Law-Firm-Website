<div role="main" class="main">
<?php
$sonuc = dbSorgu("select * from slider where aktif = 1 order by sira", array($istekSayfa_Dil));
if (count($sonuc) > 0) { ?> 
                <div class="owl-carousel owl-carousel-light owl-carousel-light-init-fadeIn owl-theme manual dots-inside dots-modern dots-modern-lg dots-horizontal-center show-dots-hover show-dots-xs nav-style-1 nav-inside nav-inside-plus nav-dark nav-lg nav-font-size-lg show-nav-hover mb-0" data-plugin-options="{'autoplayTimeout': 7000}" data-dynamic-height="['700px','700px','700px','550px','500px']" style="height: 700px;">
                    <div class="owl-stage-outer">
                        <div class="owl-stage">
                        <?php
                            $i = 1;
                            $k= 1;
                            $l =1;
                            $m=1;
                            $n=1;
                            $nn=1;
                            $t=1;
                            $d=1;
                            $tt=1;
                            $ttt=1;
                            foreach ($sonuc as $row) {
                        ?>   
                            <div class="owl-item position-relative" style="background-image: url(/upload/slider/<?=$row['adi']?>); background-size: cover; background-position: center;">
                                <div class="container h-100">
                                    <div class="row h-100">
                                        <div class="col<?php if ($i == 1) {echo "-lg-6";  }else{ echo " text-center";} $i++; ?>">
                                            <div class="d-flex flex-column justify-content-center h-100">
                                                <p class="custom-font-slider-2 text-<?php if ($k == 1) { echo "dark"; } else{ echo "light"; } $k++; ?>" data-plugin-animated-letters data-plugin-options="{'startDelay': 750, 'minWindowWidth': 0, 'animationSpeed': 30}"><?=$row['aciklama1']?></p>
                                                <h2 class="custom-font-slider-1 mb-0 font-weight-bold <?php if ($l != 1) { echo "text-light"; } $l++; ?> appear-animation" data-appear-animation="blurIn" data-appear-animation-delay="500" data-plugin-options="{'minWindowWidth': 0}"><?=$row['aciklama2']?></h2>
                                                <div class="divider divider-primary divider-small <?php if ($m == 1) { echo "text-start"; } $m++; ?>  mt-2 mb-4 <?php if ($n == 1) { echo "mx-0"; } $n++; ?> appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="750">
                                                    <hr class="my-0 <?php if ($nn != 1) { echo "me-auto"; } $nn++; ?>">
                                                </div>
                                                <p class="text-3-5 line-height-9 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1000"><?=$row['aciklama3']?></p>
                                                    <div class="<?php if ($t != 1) { echo "text-center"; } $t++; ?> appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1250">
                                              
                                                     </div>
                                                </div>
                                            </div>
                                       </div>
									 </div>
                               </div>
                            <?php } ?>
						 </div>
                    </div>
                    <div class="owl-nav">
                        <button type="button" role="presentation" class="owl-prev"></button>
                        <button type="button" role="presentation" class="owl-next"></button>
                    </div>
                    <div class="owl-dots mb-5">
                        <button role="button" class="owl-dot active"><span></span></button>
                        <button role="button" class="owl-dot"><span></span></button>
                    </div>
                </div>

<?php } ?>


				
				



<?php
$sonuc = dbSorgu("SELECT * FROM sayfalar WHERE konum = 3 ", array($istekSayfa_Dil));
if (count($sonuc) > 0) {
?>
<section class="section section-default section-no-border my-0">
					<div class="container pt-3 pb-4">
						<div class="row">
							<?php $i=1;
							$m=1;
							$n=1;
							$e=1;
							$k=1;
							$l=1;
                                foreach($sonuc as $row){?>
							<div class="col-lg-<?php if($i==1){ echo "8 mb-4 mb-lg-0";} else{ echo "4";}$i++; ?>">
								<h2 class="mb-0 <?php if($m==1){ echo "font-weight-bold appear-animation";} else{ echo "appear-animation";} $m++; ?>" data-appear-animation="blurIn" data-appear-animation-delay="<?php if($n==1){ echo "100";} else{ echo "400";}$n++; ?>"><?=$row['adi']?></h2>
								<div class="divider divider-primary divider-small mt-2 mb-4 appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="<?php if($e==1){ echo "200";} else{ echo "500";}$e++; ?>">
									<hr class="my-0 me-auto">
								</div>
								<div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="<?php if($k==1){ echo "300";} else{ echo "500";}$k++; ?>">
									<p class="<?php if($l==1){ echo "text-3-5 line-height-9";} else{ echo "mt-4 mb-0";} $l++; ?>"><?=$row['icerik']?></p>

									<a class="mt-3 font-weight-semi-bold" href="/<?=$row['purl']?>">Daha fazla<img width="27" height="27" src="img/demos/law-firm/icons/arrow-right.svg" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-primary d-inline-block ms-2 p-relative bottom-1'}" /></a>
								</div>
							</div>
							<?php } ?>
							
						</div>
					</div>
				</section>
				<?php } ?>




<?php
$sonuc = dbSorgu("SELECT s1.adi as s1_adi, s1.title as s1_title, s2.icon as s2_icon, s2.adi as s2_adi, s2.descr as s2_descr ,s2.res as s2_res  FROM sayfalar s1, sayfalar s2 WHERE s1.konum = 44 and s1.id = s2.uid ", array($istekSayfa_Dil));
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
										<a class="mt-3 font-weight-semi-bold" href="demo-law-firm-practice-areas-detail.html">Daha fazla<img width="27" height="27" src="img/demos/law-firm/icons/arrow-right.svg" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-primary d-inline-block ms-2 p-relative bottom-1'}" /></a>
									</div>
								</div>
							</div>  <?php } ?>
						</div>
					</div>
				</section>
<?php } ?>





<!--icerik 3-->
<div class="container-fluid">
    <div class="row">
	<?php
$sonuc = dbSorgu("SELECT s1.id as s1_id,  s1.adi as s1_adi, s2.id as s2_id, s2.adi as s2_adi, s2.icerik as s2_icerik from sayfalar s1 left join sayfalar s2 on s1.id = s2.uid where s1.id =204 and s1.aktif = 1 and s2.aktif = 1 and s1.konum = 33", array($istekSayfa_Dil));
if (count($sonuc) > 0) {
$i=1;
foreach ($sonuc as $row) {
if($i==1){ ?>   
                        <div class="col-lg-6 bg-primary order-2 order-lg-1 p-0" style="background: url(img/demos/law-firm/backgrounds/background-1.jpg); background-size: cover; background-position: center;">
                            <div class="h-100 m-0">
                                <div class="row m-0">

                                    <div class="col-half-section col-half-section-right text-color-light py-5 ms-auto">
                                        <div class="p-3">
                                            <div class="appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="200">
                                                <h2 class="mb-0 font-weight-bold text-light"><?=$row['s1_adi']?></h2>
                                                <div class="divider divider-dark divider-small mt-2 mb-4">
                                                    <hr class="my-0 me-auto">
                                                </div>

                                                <div class="owl-carousel owl-theme dots-align-left dots-light dots-modern custom-dots-modern-1 dots-modern-lg pt-3" data-plugin-options="{'responsive': {'0': {'items': 1}, '479': {'items': 1}, '768': {'items': 1}, '979': {'items': 1}, '1199': {'items': 1}}, 'loop': true, 'autoHeight': true}">
												    <?php } $i++; ?>
												    <div>
                                                    
                                                        <div class="testimonial testimonial-style-2 testimonial-with-quotes testimonial-quotes-light testimonial-remove-right-quote mb-0">
                                                            <blockquote class="opacity-7 pb-3">
                                                                <p class="text-start text-color-light custom-font-secondary text-3 line-height-10 fst-italic pb-0 mb-0"><?=$row['s2_icerik']?></p>
                                                            </blockquote>
                                                            <div class="testimonial-author text-start ps-5 ms-3">
                                                                <p class="text-color-light mb-0 text-start"><?=$row['s2_adi']?></p>
                                                            </div>
                                                        </div>
														
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

<?php } ?>

<?php
$son = dbSorgu("SELECT s1.id as s1_id,  s1.adi as s1_adi, s2.id as s2_id, s2.adi as s2_adi, s2.icerik as s2_icerik from sayfalar s1 left join sayfalar s2 on s1.id = s2.uid where s1.id =205 and s1.aktif = 1 and s2.aktif = 1 and s2.konum = 33", array($istekSayfa_Dil));
if (count($son) > 0) {
$k=1;
foreach ($son as $roww) {
    if($k==1){ ?>

                        <div class="col-lg-6 order-1 order-lg-2 p-0 bg-color-quaternary">
							<section class="parallax section section-parallax custom-parallax-bg-pos-left custom-sec-left h-100 m-0" data-plugin-parallax data-plugin-options="{'speed': 1.5, 'horizontalPosition': '100%'}" data-image-src="img/demos/law-firm/backgrounds/background-2.jpg" style="min-height: 450px;">
								<div class="h-100 m-0">
									<div class="row m-0">
										<div class="col-half-section col-half-section-left">
											<div class="p-3 p-relative zindex-1">
												<div class="appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="400">
													<h2 class="mb-0 font-weight-bold text-dark"><?=$roww['s1_adi']?></h2>
													<div class="divider divider-primary divider-small mt-2 mb-4">
														<hr class="my-0 me-auto">
													</div>
													<div class="owl-carousel owl-theme dots-align-left dots-dark dots-modern dots-modern-lg pt-3" data-plugin-options="{'responsive': {'0': {'items': 1}, '479': {'items': 1}, '768': {'items': 1}, '979': {'items': 1}, '1199': {'items': 1}}, 'loop': true, 'autoHeight': true}">
														<?php } $k++; ?>
													    <div>
															<p class="text-dark font-weight-bold text-4 mb-2 pb-2"><?=$roww['s2_adi']?></p>
															<p><?=$roww['s2_icerik']?></p>
														</div>
														<?php } ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
						</div>
						<?php } ?>
					</div>
				</div>
				

<!--içerik 4-->
            <?php
			$sonuc = dbSorgu("SELECT s1.adi as s1_adi, s2.icerik as s2_icerik, s2.purl as s2_purl, s2.res as s2_res, s2.adi s2_adi, s2.descr as s2_descr FROM sayfalar s1, sayfalar s2 WHERE s1.konum = 55 and s1.id = s2.uid ", array($istekSayfa_Dil));
			if (count($sonuc) > 0) {
				$i = 1;
				foreach ($sonuc as $row) { ?>
					<?php if ($i == 1) { ?>

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
								<div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="300">
									<div class="owl-carousel owl-theme dots-modern dots-modern-lg pt-3 pb-0 mb-0" data-plugin-options="{'responsive': {'0': {'items': 1}, '479': {'items': 1}, '768': {'items': 1}, '979': {'items': 3}, '1199': {'items': 4}}, 'loop': false, 'autoHeight': true, 'margin': 20}">
									<?php } $i++; ?>
									    <div>
											<div class="row">
												<div class="col">
													<a href="/<?=$row['s2_purl']?>">
														<img src="/upload/sayfa-resimleri/<?=$row['s2_res']?>" class="img-fluid" alt="Image of the team member" />
													</a>
												</div>
											</div>
											<div class="row pb-3">
												<div class="col pt-3">
													<p class="text-color-dark text-4-5 font-weight-bold mb-1"><?=$row['s2_adi']?></p>
												
													<p class="text-2 mb-3-5"><?=$row['s2_descr']?></p>
													<p class="text-2 mb-3">
														<a class="mt-3 font-weight-semi-bold" href="/<?=$row['s2_purl']?>">Daha fazla<img width="27" height="27" src="img/demos/law-firm/icons/arrow-right.svg" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-primary d-inline-block ms-2 p-relative bottom-1'}" /></a>
													</p>
													<ul class="social-icons social-icons-clean social-icons-icon-dark social-icons-medium mb-0">
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
											</div>
										</div>
										<?php } ?>	
									</div>
								</div>
							</div>
						</div>
					</div>
				</section><?php } ?>




			<?php
			$sonuc = dbSorgu("SELECT * from sayfalar where konum=555 ", array($istekSayfa_Dil));
			if (count($sonuc) > 0) {  ?>
				
				<section class="parallax section section-text-light section-parallax section-center my-0" data-plugin-parallax data-plugin-options="{'speed': 1.5, 'parallaxHeight': '200%'}" data-image-src="img/demos/law-firm/backgrounds/background-3.jpg">
					<div class="container position-relative">
						<div class="row py-5 counters counters-text-light">
						<?php  $i=1; foreach ($sonuc as $row) { 
							?>
							<div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
								<div class="counter">
									<img width="<?php if($i==1){echo "44";} else if($i==2){echo "60";} else if($i==3){echo "46";} else if($i==4){echo "41";} ; ?>" height="50" src="/upload/sayfa-resimleri/<?=$row['res']?>" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': '<?php if($i==1 or $i==3){echo "svg-fill-color-light";}?> d-inline-block ms-2 p-relative bottom-1'}" />
									<strong class="pt-3 custom-font-secondary font-weight-bold" data-to="<?php if($i==1){echo "50";} else if($i==2){echo "240";} else if($i==3){echo "2000";} else if($i==4){echo "20";} ?>" data-append="+">0</strong>
									<label class="pt-2 text-4 opacity-7"><?=$row['adi']?></label>
								</div>
							</div>
							<?php $i++; } ?>
						</div>
					</div>
				</section>
				<?php } ?>



				<section class="section bg-transparent section-no-border my-0">
					<div class="container pt-3 pb-4">
						<div class="row">
							<div class="col text-center">
								<div class="appear-animation" data-appear-animation="blurIn" data-appear-animation-delay="0">
									<h2 class="mb-0 font-weight-bold">Blog köşesi</h2>
									<div class="divider divider-primary divider-small mt-2 mb-4 text-center">
										<hr class="my-0 mx-auto">
									</div>
								</div>
							</div>
						</div>
						<div class="row pt-3 mt-1 appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="300">

<?php
$sonuc = dbSorgu("SELECT * FROM sayfalar where konum=666 ", array($istekSayfa_Dil));
if (count($sonuc) > 0) {
    foreach($sonuc as $row){
?>
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-6 p-relative">
										<a href="demo-law-firm-news-post.html" class="text-decoration-none text-light">										
											<span class="position-absolute bottom-10 right-0 d-flex justify-content-end w-100 py-3 px-4 z-index-3">
												<span class="text-center bg-primary border-radius text-color-light font-weight-semibold line-height-2 px-3 py-2">
													<span class="position-relative z-index-2">
														<span class="text-8">18</span>
														<span class="custom-font-secondary d-block text-1 positive-ls-2 px-1">FEB</span>
													</span>
												</span>
											</span>
											<img src="/upload/sayfa-resimleri/<?=$row['res']?>" class="img-fluid" alt="Lorem Ipsum Dolor" />
										</a>
									</div>
									<div class="col-md-6">
										<h3 class="custom-font-primary mb-2">
											<a href="/<?=$row['purl']?>" class="text-dark text-transform-none font-weight-bold text-1 line-height-3 text-color-hover-primary text-decoration-none">
											<?=$row['adi']?></h3>
											</a>
										</h3>
										<p class="mb-2"><?=$row['descr']?></p>
										<a href="/<?=$row['purl']?>" class="custom-view-more d-inline-flex font-weight-medium text-color-primary">
											Daha fazla
											<img width="27" height="27" src="img/demos/law-firm/icons/arrow-right.svg" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-primary ms-2'}" style="width: 27px;" />
										</a>
									</div>
								</div>
							</div>
							<?php }} ?>
						</div>
					</div>
				</section>




				

			</div>
	</body>
</html>
