<?php
define("KORUMA", null);
// GEREKLİLERİ ÇEK
include_once('gerekli/ayarlar.php');
include_once ('gerekli/db_baglan.php');


header('Content-type: application/xml');

echo "<?xml version='1.0' encoding='UTF-8'?>"."\n";
echo "<urlset \n xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'"."\n";
echo "xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'"."\n";
echo "xsi:schemaLocation='http://www.sitemaps.org/schemas/sitemap/0.9"."\n";
echo "http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd'>"."\n";
?>
<url>
  <loc><?php echo BASE; ?></loc>
  <changefreq>always</changefreq>
  <priority>1.00</priority>
</url>
<?php

$sql_alt="SELECT id, adi, purl FROM sayfalar WHERE aktif = 1  ORDER BY  sira ASC";             

 if ($result_alt = $mysqli -> query($sql_alt)) {

  while ($row_alt= $result_alt -> fetch_row()) {
    // VERİLERİ ÇEK
    $sayfa_altid= $row_alt[0];
    $sayfa_altadi= $row_alt[1];
    $sayfa_altpurl= $row_alt[2];

echo "
<url>
  <loc>". BASE . $sayfa_altpurl  ."</loc>
  <changefreq>always</changefreq>
  <priority>0.80</priority>
</url>
";
}

}
echo "</urlset>";

?>