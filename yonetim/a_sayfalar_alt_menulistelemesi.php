 <?php 
if (!defined("KORUMA")) {
  header("Location: ../404.html");
  exit();
}
?>







 <!--MENÜLER CARDI BAŞ  -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">
<?php  if ($k==2){echo "Blog Listesi";}  elseif($k==100) {echo "Video Listesi";} elseif($k==20) {echo "Yazar Listesi";} elseif($k==209) {echo "Hizmetlerimiz Listeleme";} elseif($k==205) {echo "SSS Listesi";}  elseif($k==2000) {echo "Otel Oda Listesi";}   else {echo "Üst Menü Öğeleri"; }  ?>


              </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body darpad"> <!-- MENÜLERİN LİSTELENDİĞİ SUTUN -->



<ul class="list-group"> 

                 
<?php // ÜST MENÜ  ÇEK 

$sql="SELECT id, aktif, adi, dil, konum FROM sayfalar WHERE konum = $k and uid = 0 ORDER BY dil, sira ASC ";             

 if ($result = $mysqli -> query($sql)) {
  while ($row = $result -> fetch_row()) {
    // VERİLERİ ÇEK
    $sayfaid= $row[0];
    $sayfaaktif= $row[1];
    $sayfaadi= $row[2];
    $sayfadil=$row[3];
    $sayfakonum= $row[4];
    $sayfaadi= substr($sayfaadi, 0, 30);

//$sayfaaktif  imajı
    if($sayfaaktif == 1 ) {
      $aktifsimge="<i class=\"fas fa-check-circle\"></i>";
    }
    else { $aktifsimge="<i class=\"fas fa-times-circle\"></i>";
    }
//$sayfadil  imajı
  $dilsimge="<img src=\"img/flags/".$dil[$sayfadil].".png\">";


// BİRİNCİ SEVİYE GÖSTER
  $aktiflik="";
  if(isset($_GET['id']))
  {
     if($_GET['id']== $sayfaid){
       $aktiflik = "active";
     }
  }
  
  $show1="";
  if(isset($_GET['top1id']))
  {
     if($_GET['top1id']== $sayfaid){
        $show1 = "show";
     }
  }



   // ALTINDA MENÜ VAR MI BAK?
?>

<li class="list-group-item <?php echo $aktiflik; ?> nopadmenu">
 <?php echo $aktifsimge. $dilsimge.  " "; ?>
<a href="a_sayfalar.php?k=<?php echo $k; ?>&action=edit&id=<?php echo $sayfaid; ?>" class="menulerli"><b><?php echo $sayfaadi; ?></b></a>


<a class="btn btn-tool btn-link menukucuk" data-toggle="modal" data-target="#confirm-delete" 
data-delurl="a_sayfalar.php?k=<?php echo $k; ?>&action=deletepage&id=<?php echo $sayfaid; ?>">
<i class="fas fa-trash"></i></a>

<a href="a_sayfalar.php?k=<?php echo $k; ?>&action=edit&id=<?php echo $sayfaid; ?>" class="btn btn-tool btn-link menukucuk"><i class="fas fa-pen"></i></a>

<?php

  $resultsay = $mysqli->query("SELECT COUNT(*) FROM sayfalar WHERE uid = $sayfaid");
  $altvarmi1 = $resultsay ->fetch_row();
  if ( $altvarmi1[0] > 0)
  { 
   ?>
   <a data-toggle="collapse" href="#collap<?php echo $sayfaid; ?>" role="button" aria-expanded="false" aria-controls="collap<?php echo $sayfaid; ?>" class="btn btn-tool btn-link menukucuk"><i class="fas fa-chevron-down"></i></a>
   <?php 
  }

?>
</li>


<div class="collapse <?php echo $show1; ?>" id="collap<?php echo $sayfaid; ?>">
 
 
<?php

 /// İÇ MENÜLER

 // İKİNCİSİ //
$sql_alt="SELECT id, aktif, adi, dil , konum FROM sayfalar WHERE konum = $k and uid = $sayfaid ORDER BY dil, sira ASC";             

 if ($result_alt = $mysqli -> query($sql_alt)) {

  while ($row_alt= $result_alt -> fetch_row()) {
    // VERİLERİ ÇEK
    $sayfa_altid= $row_alt[0];
    $sayfaaktif=$row_alt[1];
    $sayfa_altadi= $row_alt[2];
    $sayfa_altdil= $row_alt[3];
    $sayfa_altkonum= $row_alt[4];  
    $sayfa_altadi= substr($sayfa_altadi, 0, 30);


// ikinci SEVİYE GÖSTER

//$sayfaaktif  imajı
    if($sayfaaktif == 1 ) {
      $aktifsimge="<i class=\"fas fa-check-circle\"></i>";
    }
    else { $aktifsimge="<i class=\"fas fa-times-circle\"></i>";
    }
//$sayfadil  imajı
  $dilsimge="<img src=\"img/flags/".$dil[$sayfa_altdil].".png\">";



  $aktiflik2="";
  if(isset($_GET['id']))
  {
     if($_GET['id']== $sayfa_altid){
       $aktiflik2 = "active";
     }
  }

  $show2="";
  if(isset($_GET['top2id']))
  {
     if($_GET['top2id']== $sayfa_altid){
        $show2 = "show";
     }
  }


  
   // ALTINDA MENÜ VAR MI BAK?
?>
<li class="list-group-item <?php echo $aktiflik2; ?> nopadmenu">
   <?php echo $aktifsimge. $dilsimge.  " "; ?>
<a href="a_sayfalar.php?k=<?php echo $k; ?>&action=edit&id=<?php echo $sayfa_altid; ?>&top1id=<?php echo $sayfaid; ?>" class="menulerli"> <i class="fas fa-chevron-right"></i> <?php echo $sayfa_altadi; ?></a>


<a class="btn btn-tool btn-link menukucuk" data-toggle="modal" data-target="#confirm-delete" 
data-delurl="a_sayfalar.php?k=<?php echo $k; ?>&action=deletepage&id=<?php echo $sayfa_altid; ?>">
<i class="fas fa-trash"></i></a>

<a href="a_sayfalar.php?k=<?php echo $k; ?>&action=edit&id=<?php echo $sayfa_altid; ?>" class="btn btn-tool btn-link menukucuk"><i class="fas fa-pen"></i></a>

<?php

  $resultsay = $mysqli->query("SELECT COUNT(*) FROM sayfalar WHERE uid =  $sayfa_altid");
  $altvarmi1 = $resultsay ->fetch_row();
  if ( $altvarmi1[0] > 0)
  { 
   ?>
   <a data-toggle="collapse" href="#collap<?php echo $sayfa_altid; ?>" role="button" aria-expanded="false" aria-controls="collap<?php echo $sayfa_altid; ?>" class="btn btn-tool btn-link menukucuk"><i class="fas fa-chevron-down"></i></a>
   <?php 
  }


// ÜCÜNCÜ ALT SEVİYE
?>
</li>

<div class="collapse <?php echo $show2; ?>" id="collap<?php echo $sayfa_altid; ?>">
  
<?php

 /// İÇ MENÜLER 2

 // ÜÇÜNCÜSÜ //
$sql_alt2="SELECT id, aktif, adi, dil , konum FROM sayfalar WHERE konum = $k and uid = $sayfa_altid ORDER BY dil, sira ASC";             

 if ($result_alt2 = $mysqli -> query($sql_alt2)) {

  while ($row_alt2= $result_alt2 -> fetch_row()) {
    // VERİLERİ ÇEK
    $sayfa_altid2= $row_alt2[0];
    $sayfaaktif2= $row_alt2[1];
    $sayfa_altadi2= $row_alt2[2];
    $sayfa_altdil2= $row_alt2[3];
    $sayfa_altkonum2= $row_alt2[4]; 
    $sayfa_altadi2= mb_substr($sayfa_altadi2, 0, 40,'UTF-8');

// ÜCÜNCÜ SEVİYE GÖSTER


//$sayfaaktif  imajı
    if($sayfaaktif2 == 1 ) {
      $aktifsimge="<i class=\"fas fa-check-circle\"></i>";
    }
    else { $aktifsimge="<i class=\"fas fa-times-circle\"></i>";
    }
//$sayfadil  imajı
  $dilsimge="<img src=\"img/flags/".$dil[$sayfa_altdil2].".png\">";



  $aktiflik3="";
  if(isset($_GET['id']))
  {
     if($_GET['id']== $sayfa_altid2){
       $aktiflik3 = "active";
     }
  }
  
   // ALTINDA MENÜ VAR MI BAK?
?>

<li class="list-group-item <?php echo $aktiflik3; ?> nopadmenu">
   <?php echo $aktifsimge. $dilsimge.  " "; ?>
<a href="a_sayfalar.php?k=<?php echo $k; ?>&action=edit&id=<?php echo $sayfa_altid2; ?>&top1id=<?php echo $sayfaid; ?>&top2id=<?php echo $sayfa_altid; ?>" class="menulerli"> 
  <i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i> <span style="font-size:smaller;">
  <?php echo $sayfa_altadi2; ?></span>
</a>


<a class="btn btn-tool btn-link menukucuk" data-toggle="modal" data-target="#confirm-delete" 
data-delurl="a_sayfalar.php?k=<?php echo $k; ?>&action=deletepage&id=<?php echo $sayfa_altid2; ?>">
<i class="fas fa-trash"></i></a>

<a href="a_sayfalar.php?k=<?php echo $k; ?>&action=edit&id=<?php echo $sayfa_altid2; ?>" class="btn btn-tool btn-link menukucuk"><i class="fas fa-pen"></i></a>

</li>
<?php

} // 3. seviye while kapanma
} // 3. seviye if kapanma

?>



 </div>
<?php

///////////////////////
  }  // SEVİYE 2in WHİLE KAPANIŞ 
   $result_alt -> free_result();
} // SEVİYE 2 in İF KAPANIŞ


?>
 
</div>




<?php
// BİRİNCİ SEVİYE GÖSTER BİTİŞ




  } // SEVİYE 1 in WHİLE KAPANIŞ
  $result -> free_result();
}// SEVİYE 1 in İF KAPANIŞ


?>


</ul>

              </div> <!-- MENÜLERİN LİSTELENDİĞİ SUTUN  BİTİŞ-->
                <div class="card-footer">
                 
                </div>
              <!-- /.card-body -->
            </div>
        <!--MENÜLER CARDI BİTİŞ  -->
