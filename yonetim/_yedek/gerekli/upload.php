<?php 
if (!defined("KORUMA")) {
  header("Location: ../404.html");
  exit();
}


// GELEN PARAMETRELER

//1) UPLOAD DİZİNİ
// UPLOAD DİR  $target_dir. 
//$target_dir = UPLOADDIR;
//UPLOADDIR ."/galeri"

// 2)  DOSYA ADI
// $dosyaad parametre gelecek
 //$dosyaad

// 3)  DOSYA UZANTILARI
//$allowfiletypes[ = array('jpg', 'png', 'jpeg', 'gif', 'webp','svg');
// 

// 4) MAX DOSYA BÜYÜKLÜĞÜ
// $maxfilesize

$uploadMesaj="";

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); // yüklendiği yer
$uploadOk = 1;
$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); // uzantısı
$target_file = $target_dir . $dosyaad . ".".$FileType;  // hedef dosya
$dosyatamad= $dosyaad . ".".$FileType;   // kaydedildiği yer


/* RESİM DOSYASI OLUP OLMADIĞI CHECK
// Check if image file is a actual image or fake image
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $uploadMesaj=  "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    $uploadMesaj= "Dosya Resim Dosyası Değil";
    $uploadOk = 0;
  }
*/
// Check if file already exists
if (file_exists($target_file)) {
  $uploadMesaj.=  "Dosya zaten mevcut.";
  $uploadOk = 0;
}
 
 
// Check file size
if ($_FILES["fileToUpload"]["size"] > $maxfilesize) {
  $uploadMesaj.= "Dosya Boyutu Çok Büyük.";
  $uploadOk = 0;
}


// dosya türü kontrol
if (in_array($FileType, $allowfiletypes))
  {
 // echo "Match found";
  }
else
  {
    $uploadMesaj.= "Dosya türüne izin verilmiyor. Lütfen uygun dosya türü seçiniz.";
    $uploadOk = 0;
  }


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  $uploadMesaj.= "Dosya yüklenemedi.";
// if everything is ok, try to upload file

} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $uploadMesaj.= htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " dosyası  " . $dosyatamad ." olarak yüklendi.";
    $uploaddurum= "ok" ;
  } else {
    $uploadMesaj.= "Dosya yüklemede hata oluştu.";
    $uploaddurum= "error"; ;
  }
}

// ÇIKTILARI 
// $uploadMesaj
// $uploaddurum= ok / error
// $dosyatamad

?>

