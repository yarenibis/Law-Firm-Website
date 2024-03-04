 <?php 
if (!defined("KORUMA")) {
  header("Location: ../404.html");
  exit();
}
?>




 <!--YENİ EKLE CARDI  -->


        <div class="card collapsed-card card-success">
              
              <div class="card-header">
                <h3 class="card-title">Yeni Klasör Ekle</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                 <form action="a_dosyayonetici.php?action=NewDirectory" method="POST">



<div class="input-group mb-3">
 <input type="text" class="form-control" name="yeniklasorad" >
  <div class="input-group-append">
    <button type="submit" class="btn btn-primary" name="createdir">EKLE</button>
  </div>
</div>

     
                </form>
              </div>

            </div>

        <!--YENİ EKLE CARDI BİTİŞ  -->
  <?php
 if($action=='NewDirectory')
 {

  $yeniklasorad= trim($_POST['yeniklasorad']);

  if(!empty($yeniklasorad))
  {
    $yeniklasorad= PrettyURLyap($yeniklasorad);

      if (!file_exists(UPLOADDIR.'/'.$yeniklasorad)) {
         $klasoryap=  mkdir(UPLOADDIR.'/'.$yeniklasorad, 0777, true);
          if($klasoryap){
            $toaster['success'] = $yeniklasorad. " Klasörü Oluşturuldu";
          }
       }
       else { 
        $toaster['warning'] = $yeniklasorad. " adıyla bir klasör var.";
      }

  }
 }
  ?>