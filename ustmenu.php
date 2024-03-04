<?php

$sonuc = dbSorgu("select t1.id as t1_id,t1.adi as t1_adi,t1.purl as t1_purl, t1.url as t1_url, t1.tur as t1_tur, t1.sayfa_turu as t1_sayfa_turu,
	t2.id as t2_id,t2.adi as t2_adi,t2.purl as t2_purl, t2.url as t2_url, t2.tur as t2_tur,t2.res as t2_res,
	t3.id as t3_id,t3.adi as t3_adi,t3.purl as t3_purl,t3.tur as t3_tur,
	t4.id as t4_id,t4.adi as t4_adi,t4.purl as t4_purl,t4.tur as t4_tur,
	t5.id as t5_id,t5.adi as t5_adi,t5.purl as t5_purl,t5.tur as t5_tur 
	from sayfalar t1 
	left join sayfalar t2 on t1.id = t2.uid and t2.aktif=1 
	left join sayfalar t3 on t2.id = t3.uid and t3.aktif=1  
	left join sayfalar t4 on t3.id = t4.uid and t4.aktif=1 
	left join sayfalar t5 on t4.id = t5.uid and t5.aktif=1
	where t1.aktif=1 and t1.konum=1 and t1.uid=0  
	order by t1.sira asc,t1. id asc,t2.sira asc,t2. id asc,t3.sira asc,t3. id asc,t4.sira asc,t4. id asc,t5.sira asc,t5. id asc
	", array($istekSayfa_Dil, $istekSayfa_Dil, $istekSayfa_Dil, $istekSayfa_Dil, $istekSayfa_Dil));
	
$i = 1;
$u1 = "";
$u2 = "";
$u3 = "";
?>

<ul class="nav nav-pills">
	

	<?php
	$i = 0;
	foreach ($sonuc as $row) { ?>
		<?php if (empty($row['t2_adi'])) { ?>
			<?php if ($u2 !== "" && $u2 != null) {
				$u2 == "";
			?>
</ul>
<?php }  ?>
<?php if ($u1 !== "") {
				$u1 == "";
?>

	
<?php } ?>

<li class="dropdown" >
	
	<a class="dropdown-item" href="<?php if (empty($row['t1_url'])) {
											echo "/" . $row['t1_purl'];
										} else {
											echo $row['t1_url'];
										} ?>"><?= $row['t1_adi'] ?></a>
</li>
<?php
			$u1 = "";
			$u2 = "";
?>
<?php } elseif (empty($row['t3_adi'])) { ?>
	<?php if ($u2 !== "" && $u2 !== $row['t2_adi']) {
				$u2 = ""; ?>

		</ul>
		</li>
	<?php } ?>
	<?php if ($u1 !== "" && $u1 !== $row['t1_adi']) { ?>

		</ol>
		</li>
	<?php } ?>

	<?php if ($u1 !== $row['t1_adi']) {
				$u1 = "";
	?>

		<li class="dropdown">
		
			<a class="dropdown-item" data-target="menu-<?= $row['t1_id']; ?>"><?= $row['t1_adi'] ?></a>
			<ol id=menu-<?= $row['t1_id']; ?> class="menus-list dropdown-content">
			<?php } ?>

			<li>
				<a href="<?php if (empty($row['t2_url'])) {
								echo $row['t2_purl'];
							} else {
								echo $row['t2_url'];
							} ?>"><?= $row['t2_adi'] ?></a>
			</li>
			<?php
			$u1 = $row['t1_adi'];
			?>
		<?php } else { ?>
			<?php if ($u1 !== "" && $u1 !== $row['t1_adi']) {
				$u1 = ""; ?>

				</ul>
		</li>
	<?php } ?>

	<?php if ($u1 !== $row['t1_adi']) { ?>

		<li class="dropdown <?php if ($row['t1_sayfa_turu'] == "hizmetlerimiz") { ?>dropdown-mega<?php } ?>"><a class="dropdown-item dropdown-toggle"><?= $row['t1_adi'] ?></a>
			<ul class="nav nav-pills">
			<?php } ?>
			<?php if ($u2 !== $row['t2_adi']) { ?>


				<li lass="dropdown"> <a class="dropdown-item" href="<?= $row['t3_purl'] ?>"><?= $row['t3_adi'] ?></a>
					<ul class="dropdown-menu">
					<?php } ?>

					<li><a href="/<?= $row['t3_purl'] ?>"><?= $row['t3_adi'] ?></a></li>
					<?php
					$u1 = $row['t1_adi'];
					$u2 = $row['t2_adi'];
					?>
				<?php } ?>

			<?php $i++;
		} ?>
					</ul>