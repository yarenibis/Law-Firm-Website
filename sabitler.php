<?php

if(!isset($_SESSION)){ session_start();} 

	$Sayfa=new stdClass; // Sayfaya ait tanimlamalarin yapilacagi degisken. Bu degiskene daha sonra fonksiyonlar kisminda gelen sayfaya gore title,description,icerik gibi child degiskenler atanacak.
	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$Site=new stdClass;  // Siteye ait telefon,email,sosyal hesaplar gibi tanimlamalarin yapilacagi degisken.
	
	$sonuc=dbSorgu("select * from iletisim_bilgileri limit 1"); // tek satir olmali. Birden fazla satir varsa diger satirlari dikkate almamak icin limit verildi.
	if(count($sonuc)>0){
		foreach($sonuc as $row) {
			$Site->Yetkili = $row['yetkili'];
			$Site->Firma = $row['firma'];
			$Site->Konum = $row['konum'];
			$Site->Sabit = $row['sabit'];
			$Site->Cep = $row['cep'];
			$Site->Fax = $row['fax'];
			$Site->Adres = $row['adres'];
			$Site->Eposta = $row['eposta'];
			$Site->Facebook = $row['facebook'];
			$Site->Twitter = $row['twitter'];
			$Site->Instagram = $row['instagram'];
			$Site->Linkedin = $row['linkedin'];
			$Site->Youtube = $row['youtube'];
			$Site->Google = $row['google'];
			$Site->Maps = $row['maps'];
			$Site->CalismaSaatleri = $row['calisma_saatleri'];
		}
	}
	$sonuc="";
	
	$SayfaSabitleri=new stdClass;
	$sonuc=dbSorgu("select etiket, $istekSayfa_DilKodu from sabitler"); 
	foreach($sonuc as $row) {
		$etiket = $row['etiket'];
		$SayfaSabitleri->$etiket  = $row[$istekSayfa_DilKodu];
	}
	$sonuc="";
	// Siteye ait degiskenler tanimlandi ///////////////////////////////////////////////////////////////////////////////////
	?>