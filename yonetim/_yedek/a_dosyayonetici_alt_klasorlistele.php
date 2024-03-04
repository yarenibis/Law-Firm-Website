 <?php 
if (!defined("KORUMA")) {
  header("Location: ../404.html");
  exit();
}

/////////////////////// KLASOR SİLME /////////////////////


 function rrmdir($dir) { 
   if (is_dir($dir)) { 
     $objects = scandir($dir);
     foreach ($objects as $object) { 
       if ($object != "." && $object != "..") { 
         if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
           rrmdir($dir. DIRECTORY_SEPARATOR .$object);
         else
           unlink($dir. DIRECTORY_SEPARATOR .$object); 
       } 
     }
     rmdir($dir); 
   } 
 }


if($action=='DeleteDir') {
  $silinecekklasor = $_GET['Dir'];
  
  rrmdir(UPLOADDIR.'/'.$silinecekklasor);
}


////////////////////////////////////////////////

?>

 <!--MENÜLER CARDI BAŞ  -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">
Klasörler

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


<li class="list-group-item <?php echo $aktiflik; ?> nopadmenu">

   <i class="far fa-folder"></i>

 <a href="a_dosyayonetici.php?Dir=uploads" class="menulerli"><b>uploads/</b></a>

</li>
                 
<?php

$dir    = UPLOADDIR."/";
$klasorlist = scandir($dir);
unset($klasorlist [0]); // .  sil
unset($klasorlist [1]); // .. sil

foreach ($klasorlist as $key => $klasoradi) {
  // SECİLİ GÖSTER
  $aktiflik="";
  if(isset($_GET['Dir']))
  {
     if($_GET['Dir']== $klasoradi){
       $aktiflik = "active";
     }
  }
  
  # code...
?>
 
 

<li class="list-group-item <?php echo $aktiflik; ?> nopadmenu">

   <i class="far fa-folder"></i>
   <a href="a_dosyayonetici.php?Dir=<?php echo $klasoradi; ?>" class="menulerli">uploads/<?php echo $klasoradi; ?></a>



<?php if( $klasoradi=='galeri' || $klasoradi=='logos' || $klasoradi=='sayfa-resimleri'   || $klasoradi=='slider' || $klasoradi=='banner')  {echo ""; } else { ?>

    <a class="btn btn-tool btn-link menukucuk" data-toggle="modal" data-target="#confirm-delete" 
    data-delurl="a_dosyayonetici.php?Dir=<?php echo $klasoradi; ?>&action=DeleteDir">
    <i class="fas fa-trash"></i></a>

  <?php } ?>
</li>

<?php
}

?>

</ul>


              </div> <!-- MENÜLERİN LİSTELENDİĞİ SUTUN  BİTİŞ-->
                <div class="card-footer">
                 
                </div>
              <!-- /.card-body -->
            </div>
        <!--MENÜLER CARDI BİTİŞ  -->
