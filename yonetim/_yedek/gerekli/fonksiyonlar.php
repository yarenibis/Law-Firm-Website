<?php 

///////////// LOGIN FONKSİYONU/////////////////////////////////	
function login($username, $passwd, $mysqli, $table) {
    // SQL Sorgusu hazırla
    if ($stmt = $mysqli->prepare("SELECT id,username, passwd 
        FROM ".$table." 
        WHERE username = ?
        LIMIT 1")) {
        $stmt->bind_param('s', $username);  // username i ekle
        $stmt->execute();    // çalıştır
        $stmt->store_result();
        // veritabanı sorgusu sonuçtan değerleri çek
        $stmt->bind_result($user_id, $username, $db_password);
        $stmt->fetch();
        // EĞER KULLANICI VARSA
        if ($stmt->num_rows == 1) {
                // EĞER ŞİFRE DOĞRUYSA
                if ($db_password == $passwd) {
                    // SESSION OLUŞTUR
                    $_SESSION['adminid'] = $user_id;
                    $_SESSION['adminname'] = $username;
                    // GİRİŞ BAŞARILI
                    return true;
                    } else {
                     // ŞİFRE YANLIŞ
                    return false;
                }
        } else {
            // BÖYLE BİR KULLANICI YOK!.
            return false;
        }
    }
}


// OTURUM AÇILMIŞ MI AÇILMAMIŞ MI KONTROL
function login_kontrol($mysqli) {
    // ÖNCE SESSION var mı yok mu kontrol
    if (isset($_SESSION['adminid'],  $_SESSION['adminname'])) {
        // SESSION dan verileri çek
        $adminid = $_SESSION['adminid'];
        $adminname = $_SESSION['adminname'];
        // çektiğin verileri veritabanındakiler ile karşılaştır
        if ($stmt = $mysqli->prepare("SELECT username 
                                      FROM yonetim
                                      WHERE id = ? LIMIT 1")) {
            // Sorguya adminname ekle
            $stmt->bind_param('i', $adminid); // veritabanındaki id
            $stmt->execute();   // çalıştır
            $stmt->store_result();
                   
            // EĞER veritabanında böyle id li bir kullanıcı varsa . satır sayısı en az 1 se
            if ($stmt->num_rows == 1) {
                // O zaman veritabanında varsa session verileri ile karşılaştır
                $stmt->bind_result($adminname_db); // veritabanındaki admin username 'i buna at : $adminname_db
                $stmt->fetch();

                if ($adminname == $adminname_db) {   // veritabanındaki admin name ile SESSIONDaki admin name aynı kontorl
                    // OTURUM AÇMIŞ 
                    return true;
                } else {
                    //  OTURUM AÇAMAMIŞ  çünkü veritabanındaki admin name ile SESSIONDaki admin name aynı değil!
                    return false;
                }
            } else {
                // OTURUM AÇAMAMIŞ  çünkü veritabanındaki böyle bir idli  admin yok!
                return false;
            }

        } else {
            // $stmt = $mysqli- sorgusu çalışmadı
            return false;
        }
    } else {
        // OTURUM AÇMA SESSION ı yok!
        return false;
    }
}  // fonksiyonu kapat
///////////////////////////////////////////////////////////////////////////

// TEMİZLE FONKSYONU
function temizle($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
 }



//////////////////////////// FORMLAR ////////////////////////////

class formlar
{



public function  form_kontrol($array)
    {
	  $hatalar = NULL;
	  foreach ($array as $eleman=>$deger)
	  {
	 	if(empty($deger))
		{
		 $hatalar[$eleman]= "Alani bos birakmayiniz";
		}
	  }
	  return $hatalar;
    }


}



//////////////////////////////////////////////////////////////
///  SAYFA A�MA ///////////////////////////////////////////////

class modlar
{

 public function modac($mod)
   {
	 if(empty($mod))
	 {
	   $sayfa="pages/home.php";
	 }
	 elseif(file_exists ("pages/".$mod.".php"))
	 {
	   $sayfa= "pages/".$mod.".php";
	 }
	 else
	 {
	   $sayfa= "404.html";
     }
	 return  $sayfa;
   }


}


/////////////////////////////////////////////////////////
//////////// SEO FRIENDLY URLS ///////////////

function PrettyURLyap ( $fonktmp ) {
    $returnstr = "";
    $turkcefrom = array("/Ğ/","/Ü/","/Ş/","/İ/","/Ö/","/Ç/","/ğ/","/ü/","/ş/","/ı/","/ö/","/ç/");
    $turkceto   = array("G","U","S","I","O","C","g","u","s","i","o","c");
    $fonktmp = preg_replace("/[^0-9a-zA-ZÄzÜŞİÖÇğüşıöç]/"," ",$fonktmp);
    // Türkçe harfleri ingilizceye çevir
    $fonktmp = preg_replace($turkcefrom,$turkceto,$fonktmp);
    // Birden fazla olan boşlukları tek boşluk yap
    $fonktmp = preg_replace("/ +/"," ",$fonktmp);
    // Boşukları - işaretine çevir
    $fonktmp = preg_replace("/ /","-",$fonktmp);
    // Tüm beyaz karekterleri sil
    $fonktmp = preg_replace("/\s/","",$fonktmp);
    // Karekterleri küçült
    $fonktmp = strtolower($fonktmp);
    // Başta ve sonda - işareti kaldıysa yoket
    $fonktmp = preg_replace("/^-/","",$fonktmp);
    $fonktmp = preg_replace("/-$/","",$fonktmp);
    $returnstr = $fonktmp;
    return $returnstr;
}//sef url için fonksiyon

/////////////////////////////////
////////// FORM CLEAN ///////////////////
function clean($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}



////////////////////////////////////////////////////////////////////////////

// THUMB OLUŞTUR 

function make_thumb($src, $dest, $thumbnail_width)
{

    $ext = pathinfo($src, PATHINFO_EXTENSION);
    $gecerliler= array("jpg", "JPG", "jpeg", "JPEG", "png", "PNG", "gif", "GIF");
  
    if (in_array($ext, $gecerliler))
      {
       
////////// RESMI THUMBLA /////////////
    $arr_image_details = getimagesize($src); // pass id to thumb name
    $original_width = $arr_image_details[0];
    $original_height = $arr_image_details[1];
    $thumbnail_height = floor($original_height * ($thumbnail_width / $original_width));

    if ($original_width > $original_height) {
        $new_width = $thumbnail_width;
        $new_height = intval($original_height * $new_width / $original_width);
    } else {
        $new_height = $thumbnail_height;
        $new_width = intval($original_width * $new_height / $original_height);
    }
    $dest_x = intval(($thumbnail_width - $new_width) / 2);
    $dest_y = intval(($thumbnail_height - $new_height) / 2);
    if ($arr_image_details[2] == IMAGETYPE_GIF) {
        $imgt = "ImageGIF";
        $imgcreatefrom = "ImageCreateFromGIF";
    }
    if ($arr_image_details[2] == IMAGETYPE_JPEG) {
        $imgt = "ImageJPEG";
        $imgcreatefrom = "ImageCreateFromJPEG";
    }
    if ($arr_image_details[2] == IMAGETYPE_PNG) {
        $imgt = "ImagePNG";
        $imgcreatefrom = "ImageCreateFromPNG";
    }
    if ($imgt) {
        //$old_image = $imgcreatefrom("$updir" . $id . '_' . "$img");
        $old_image = $imgcreatefrom($src);
        $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
        imagecopyresized($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
        $imgt($new_image, $dest);
        return TRUE;
    }
////////// RESMI THUMBLA BİTİŞ /////////////

      }
    else
      {
        return FALSE; // AYnı resmi dönecek
      }

}


// make_thumb("uploads/2.jpeg","uploads/thumb2.jpeg",100);
/////////////////////////////////////////////////////////





