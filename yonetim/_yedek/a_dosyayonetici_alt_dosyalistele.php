 <?php 
if (!defined("KORUMA")) {
  header("Location: ../404.html");
  exit();
}

/////////// DOSYA SİLME ////////////////////

if($action=='DeleteFile'){
    $silinecekfile=$_GET['filename'];
    if(file_exists($silinecekfile))
    {
     $silfile=unlink($silinecekfile);
       if($silfile) {
     $toaster['success'] = "Silinen Dosya: " .  $silinecekfile;
    }
  }
}

/////////////////////////////////////
?>


 <!--MENÜLER CARDI BAŞ  -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">
Dosyalar

              </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body darpad"> 



<ul class="list-group">
                 
<?php

$say=0;

$fileList = glob($secilidizin.'*');

if(count($fileList) > 0 ) {
foreach($fileList as $filename){
    if(is_file($filename)){
?>
<li class="list-group-item">
<i class="fas fa-file"></i>
 <a href="<?php echo $filename; ?>" target="_blank"><small>
  <?php
   echo $filename;
  ?>
  </small>
</a>
    <a class="btn btn-tool btn-link menukucuk" data-toggle="modal" data-target="#confirm-delete" 
    data-delurl="<?php echo "a_dosyayonetici.php?Dir="
.$anadizin."&filename=".$filename. "&action=DeleteFile" ; ?>">
    <i class="fas fa-trash"></i></a>
</li>

<?php
$say++;
    }   
}


} //  içi boş değilse  if(count($fileList) > 0 
else
{
 echo "<b>Bu klasörde Dosya Bulunamadı</b>";
}
?>
</ul>
<?php echo "Toplam " . $say .  " Kayıt" ;?>

              </div> <!-- MENÜLERİN LİSTELENDİĞİ SUTUN  BİTİŞ-->
                <div class="card-footer">
                 
                </div>
              <!-- /.card-body -->
            </div>
        <!--MENÜLER CARDI BİTİŞ  -->