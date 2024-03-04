<?php 
ob_start();
session_start();
define("KORUMA", null);
// GEREKLİLERİ ÇEK
include_once('gerekli/ayarlar.php');
include_once ('gerekli/db_baglan.php');
include_once ('gerekli/fonksiyonlar.php');
include_once"baglanti.php";

/// LOGIN CHECK////////////////////
// LOGIN OLDUYSA
if (login_kontrol($mysqli) == true) {
  $logged = 1;
 // SIKINTI YOK
 $adminname= $_SESSION['adminname'];
 $adminid= $_SESSION['adminid'];

	 
} else {
    $logged = 0;
    header("Location: default.php"); 
}
//////////////////////////////////////////////////////////////////////////////// 
// FİRMA BİLGİLERİNİ ÇEK

	if ($stmt = $mysqli->prepare("SELECT firma FROM iletisim_bilgileri LIMIT 1")) {
       		
      	 	$stmt->execute();    // Execute the prepared query.
        	$stmt->store_result();
        	// get variables from result.
       		$stmt->bind_result($firmaadi);
        	$stmt->fetch();
			//echo $ad . $soyad;
	}


?>

