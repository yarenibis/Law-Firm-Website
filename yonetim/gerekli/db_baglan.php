<?php 

// VERİTABANI BAĞLANTI FONKSİYONU
// DEĞERLERİ ayarlar.php sayfasından ÇEKİYOR
 
 $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
 

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
// Bağlantı oluşturamazsa hata
//echo $mysqli->host_info . "\n";

// veritabanının dil kodlamasını utf-8 yapıyor
$mysqli->set_charset('utf8');


?>