
<div role="main" class="main">
				
				<section class="page-header page-header-modern bg-color-quaternary page-header-lg border-0 m-0">
					<div class="container position-relative z-index-2">
						<div class="row text-center text-md-start py-3">
							<div class="col-md-8 order-2 order-md-1 align-self-center p-static">
								<h1 class="font-weight-bold text-color-dark text-10 mb-0">Hakkımızda</h1>
							</div>
							<div class="col-md-4 order-1 order-md-2 align-self-center">
								<ul class="breadcrumb breadcrumb-dark font-weight-bold d-block text-md-end text-4 mb-0">
									<li><a href="demo-finance.html" class="text-decoration-none text-dark">Anasayfa</a></li>
									<li class="text-upeercase active text-color-primary">Hakkımızda</li>
								</ul>
							</div>
						</div>
					</div>
				</section>

<?php
$sonuc = dbSorgu("SELECT * from sayfalar where konum = 6 and id=213", array($istekSayfa_Dil));
if (count($sonuc) > 0) {
foreach ($sonuc as $row) { ?>  
				<div class="container py-5 my-3">
					<div class="row">
						<div class="col-lg-8 mb-4 mb-lg-0">
							<h2 class="mb-0 font-weight-bold"><?=$row['adi']?></h2>
							<div class="divider divider-primary divider-small mt-2 mb-4">
								<hr class="my-0 me-auto">
							</div>
							<p class="text-3-5 line-height-9 pb-2"><?=$row['icerik']?></p>
<?php } }?>
							
<?php
$sonuc = dbSorgu("SELECT * from sayfalar where konum = 6 and id=214", array($istekSayfa_Dil));
if (count($sonuc) > 0) {
foreach ($sonuc as $row) { ?>							
							<h4 class="mb-0 pt-3"><?=$row['adi']?></h4>
							<div class="divider divider-primary divider-small mt-2 mb-4">
								<hr class="my-0 me-auto">
							</div>
							<p class="mt-4 mb-0"><?=$row['icerik']?></p>
						</div>
<?php }} ?>


					
						  <div class="col-lg-4">
<?php
$sonuc = dbSorgu("SELECT * from sayfalar where konum = 6 and id=215", array($istekSayfa_Dil));
if (count($sonuc) > 0) {
foreach ($sonuc as $row) { ?>	
							<h4 class="mb-0"><?=$row['adi']?></h4>
							<div class="divider divider-primary divider-small mt-2 mb-4">
								<hr class="my-0 me-auto">
							</div>
							<p class="mt-4 mb-0"><?=$row['icerik']?></p>

							<div class="ratio ratio-16x9 mt-4 mb-2 pt-3">
								<iframe src="https://www.youtube.com/watch?v=MsXbOTVULF4" width="560" height="315" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
							</div>

<?php }} ?>							
							
	
<?php
$sonucc = dbSorgu("SELECT s1.id as s1_id,  s1.adi as s1_adi, s2.id as s2_id, s2.adi as s2_adi, s2.icerik as s2_icerik from sayfalar s1 left join sayfalar s2 on s1.id = s2.uid where s1.id =216 and s1.aktif = 1 and s2.aktif = 1 and s2.konum = 6", array($istekSayfa_Dil));
if (count($sonucc) > 0) {
	$i=1;
    foreach ($sonucc as $roww) {
		if($i==1){ ?>
							<h4 class="mt-3 mb-0"><?=$roww['s1_adi']?></h4>
							<div class="divider divider-primary divider-small mt-2 mb-4">
								<hr class="my-0 me-auto">
							</div>

							<div class="owl-carousel owl-theme dots-align-left dots-dark dots-modern dots-modern-lg pt-3" data-plugin-options="{'responsive': {'0': {'items': 1}, '479': {'items': 1}, '768': {'items': 1}, '979': {'items': 1}, '1199': {'items': 1}}, 'loop': true, 'autoHeight': true}">
							<?php } $i++; ?>	
							    <div>
									<p class="text-dark font-weight-bold text-4 mb-2 pb-2"><?=$roww['s2_adi']?></p>
									<p><?=$roww['s2_icerik']?></p>
								</div>
							<?php }} ?>
							</div>
						</div>
					</div>
				</div>
			</div>