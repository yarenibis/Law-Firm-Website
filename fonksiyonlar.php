<?php 
function dbSorgu($sql,$veriler = null){
	global $db;// vt.php icinde tanimlanmis $db degiskenini fonksiyon icine cagirdik
	if(is_null($veriler)){
		$query = $db->prepare($sql);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}else{
		$query = $db->prepare($sql);
		$query->execute($veriler);
		return $query->fetchAll(PDO::FETCH_ASSOC);		
	}
}//----------------------------------------------------------------------------------------
function dbEkle($sql,$veriler = null){
	global $db;// vt.php icinde tanimlanmis $db degiskenini fonksiyon icine cagirdik
	try {
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if(is_null($veriler)){
			$query = $db->prepare($sql);
			$query->execute();
		}else{
			$query = $db->prepare($sql);
			$query->execute($veriler);		
		}
		$id = $db->lastInsertId();
		return $id;
	}
	catch(PDOException $e)
	{
			//echo $sql . "<br>" . $e->getMessage();
		return 0;
	}
}//----------------------------------------------------------------------------------------
function dbTekSonucGetir($sql,$veriler = null){//gönderilen sql i çalıştırarak sonucu cikti olarak verir.Donen sonucun tek satir ve tek sutun olarak tek veri olmasi gerekir. Aksi halde ilk satir ve ilk sütunu cıktı olarak verir.
	global $db;// vt.php icinde tanimlanmis $db degiskenini fonksiyon icine cagirdik
	if(is_null($veriler)){
		$query = $db->prepare($sql);
		$query->execute();
		return $query->fetch(PDO::FETCH_NUM)[0];
	}else{
		$query = $db->prepare($sql);
		$query->execute($veriler);
		return $query->fetch(PDO::FETCH_NUM)[0];
	}
}//---------------------------------------------------------------------------------------
function dilSec(){
	global $Sayfa;// Sabitlerde tanimlanmis $Sayfa degiskenini fonksiyon icine cagirdik
	if (!isset($_SESSION['SayfaDilID'])){
		$sonuc=dbSorgu("select ID,Adi,DilKodu from diller where aktif=1 limit 1");
		if(count($sonuc)>0){
			$_SESSION['SayfaDilID']=$sonuc[0]['ID'];
			$_SESSION['SayfaDilKodu']=$sonuc[0]['DilKodu'];
			$_SESSION['SayfaDilAdi']=$sonuc[0]['Adi'];
		}else{
			$_SESSION['SayfaDilID']="1";
			$_SESSION['SayfaDilKodu']="tr";
			$_SESSION['SayfaDilAdi']="Türkçe";
		}
	}
	$Sayfa->DilID = $_SESSION['SayfaDilID'];
}//----------------------------------------------------------------------------------------
function tr_strtoLower($text){
	$search=array("Ç","İ","I","Ğ","Ö","Ş","Ü");
	$replace=array("ç","i","ı","ğ","ö","ş","ü");
	$text=str_replace($search,$replace,$text);
	$text=mb_strtolower($text,"UTF-8");
	return $text;	
}//----------------------------------------------------------------------------------------
function tr_strtoUpper($text){
	$search=array("ç","i","ı","ğ","ö","ş","ü");
	$replace=array("Ç","İ","I","Ğ","Ö","Ş","Ü");
	$text=str_replace($search,$replace,$text);
	$text=mb_strtoupper($text,"UTF-8");
	return $text;
}//----------------------------------------------------------------------------------------
function linkYap($text){
	$text=tr_strtolower($text);
	$search=array(" ","ç","ı","ğ","ö","ş","ü","'",'"',"`","?","&",":");
	$replace=array("-","c","i","g","o","s","u","","","","","","-");
	$text=str_replace($search,$replace,$text);
	return $text;
}//----------------------------------------------------------------------------------------
function kirp($text){
	$search=array("'","<",">");
	$replace=array("&apos;","&lt;","&gt;");
	$text=str_replace($search,$replace,$text);
	return $text;
}//----------------------------------------------------------------------------------------
function tarihDuzelt($trh){
	#Bu fonksiyon "$trh" verisinin formatını ve doluluğunu kontrol eder. Boş ise veritabanı hatası oluşmaması için NULL değerine çevirir, dolu ise girilen tarih formatını mysql e uygun hale getirir.
	if(empty($trh)){
		return NULL;
	}else{
		return date('Y-m-d H:i:s',strtotime ($trh));
	}
}//----------------------------------------------------------------------------------------
function mailKontrol($mailadr){
	$atpos=strpos($mailadr,"@");
	$dotpos=strripos($mailadr,".");

	if (($atpos === false) || ($dotpos === false)){
		return false;
	}else{
		if ( $atpos<1 || $dotpos<$atpos+2 || $dotpos+3>=strlen($mailadr) )
		{
			return false;
		}else{
			return true;
		}		
	}
}//----------------------------------------------------------------------------------------
function mailGonder($baslik,$icerik){
	include 'PHPmail/mail_gonder.php';
	
	if(!$mail->Send()){
		return "Mailer Error: ".$mail->ErrorInfo;
	} else {
		return "Message has been sent";
	}
}//----------------------------------------------------------------------------------------
function istekURLduzenle($gelenURL){
	$gelenURL=rtrim($gelenURL,"/");
	$gelenURL=str_replace(array(".html",".xml"),array("",""),$gelenURL);
	if(trim($gelenURL)==""){$gelenURL="anasayfa";}
	return $gelenURL;
}//---------------------------------------------------------------------------------------- 
function istekSayfaGetir($istekURLarray){
	global $Sayfa;// Sabitlerde tanimlanmis $Sayfa degiskenini fonksiyon icine cagirdik	
	$sonuc=dbSorgu("select * from sayfalar where sayfalar.purl='".$istekURLarray[0]."' and aktif=1 and dil=".$Sayfa->DilID);
	if(count($sonuc)>0){
		foreach($sonuc as $row) {
			$Sayfa->ID = $sonuc[0]['id'];
			$Sayfa->UID = $sonuc[0]['uid'];
			$Sayfa->Adi = $sonuc[0]['adi'];
			$Sayfa->Url = $sonuc[0]['url'];
			$Sayfa->Title = $sonuc[0]['title'];
			$Sayfa->Purl = $sonuc[0]['purl'];
			$Sayfa->Description = $sonuc[0]['descr'];
			$Sayfa->Icerik = $sonuc[0]['icerik'];
			$Sayfa->SayfaTuru = $sonuc[0]['sayfa_turu'];
			$Sayfa->Vitrin = $sonuc[0]['vitrin'];
			$Sayfa->UrunTuru = $sonuc[0]['urun_turu'];
			$Sayfa->Marka = $sonuc[0]['marka'];
			$Sayfa->Fiyat = $sonuc[0]['fiyat'];
			$Sayfa->SayfaRes = $sonuc[0]['res'];
			$Sayfa->BannerImg = $sonuc[0]['id'].".".$sonuc[0]['res'];
			$Sayfa->Keywords = $sonuc[0]['keywords'];
			$Sayfa->EklenmeTrh = $sonuc[0]['eklenme_tarihi'];
		}
	}
	$sonuc="";
	return $Sayfa->SayfaTuru;
}//----------------------------------------------------------------------------------------
function sayfaSabitleriGetir($sayfaAdi){//belirtilen sayfaya ait sabitleri array olarak getirir.Herbir array keyi SABIT_ADI olup, o keye ait array itemi de SABIT_VERI ve SABIT_LINK ten oluşan bir arraydir.

}//----------------------------------------------------------------------------------------
?>