<?php
ob_start();
session_start();
define("KORUMA", null);
// GEREKLİLERİ ÇEK
include_once('gerekli/ayarlar.php');
include_once ('gerekli/db_baglan.php');
include_once ('gerekli/fonksiyonlar.php');

/// LOGIN CHECK////////////////////
// LOGIN OLDUYSA
if (login_kontrol($mysqli) == true) {
  $logged = 1;
 // SIKINTI YOK
 $adminname= $_SESSION['adminname'];
 $adminid= $_SESSION['adminid'];
  
} 
else {
    $logged = 0;
}


////////////LOGOUT KODU///////////////////
  if(isset($_GET['logout'])) {
    // Unset all session values 
    // Destroy session 
   session_unset();
   session_destroy();
   header("Location: ./"); 
   exit();

 }   
 ///////////////////////////////////



// Oturum açtıysa anasayfa
if( $logged == 1) {
include_once("homepage.php") ;
} else 
// oturum açmadıysa login göster
{
include_once("login.php") ;
}












