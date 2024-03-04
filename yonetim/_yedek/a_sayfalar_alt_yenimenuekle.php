 <?php 
if (!defined("KORUMA")) {
  header("Location: ../404.html");
  exit();
}
?>




 <!--YENİ EKLE CARDI  -->


        <div class="card collapsed-card card-success">
              
              <div class="card-header">
                <h3 class="card-title">Yeni Ekle</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                 <form action="a_sayfalar.php?k=<?php echo $k; ?>&action=yenisayfa" method="POST">


<div class="input-group mb-3">
 <input type="text" class="form-control" name="yenisayfaad" >
  <div class="input-group-append">
    <button type="submit" class="btn btn-primary">EKLE</button>
  </div>
</div>
        
                    
                </form>
              </div>

            </div>

        <!--YENİ EKLE CARDI BİTİŞ  -->