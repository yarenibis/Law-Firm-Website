
<?php

try {
    $baglanti = new PDO('mysql:host=localhost;dbname=t01seodb', "t01seodbu", "Bdxm93_2");
  


} catch (PDOException $e) {
    print "Hata!: " . $e->getMessage() . "<br/>";
    die();
}
?>
