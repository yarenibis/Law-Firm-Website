<?php

//////////////////////////////////////////////////////////////////////////////// 
// FİRMA BİLGİLERİNİ ÇEK

  if ($stmt = $mysqli->prepare("SELECT firma FROM iletisim_bilgileri LIMIT 1")) {
          
          $stmt->execute();    // Execute the prepared query.
          $stmt->store_result();
          // get variables from result.
          $stmt->bind_result($firmaadi);
          $stmt->fetch();
      //echo $ad . $soyad;
  }




// HEADER SAYFASINI ÇAĞIR 
include_once("cerceveler/header.php");

// SİDEBAR SAYFASINI ÇAĞIR 
include_once("cerceveler/sidebar.php");




//////////////////////////////////////////////////////////////////////////////////


?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="default.php">Anasayfa</a></li>
             
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->





    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
      
<!-- DASHBOARD---------------------->



 <!--M CARDI BAŞ  -->
<div class="col-sm-3">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">
Mesajlar

              </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body"> <!-- MENÜLERİN LİSTELENDİĞİ SUTUN -->


              </div> <!-- MENÜLERİN LİSTELENDİĞİ SUTUN  BİTİŞ-->
                <div class="card-footer">
                 
                </div>
              <!-- /.card-body -->
            </div>
        <!--MENÜLER CARDI BİTİŞ  -->
</div>

<!------------------------------------------------------------->

 <!--M CARDI BAŞ  -->
<div class="col-sm-3">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">
DEMO

              </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body"> <!-- MENÜLERİN LİSTELENDİĞİ SUTUN -->


              </div> <!-- MENÜLERİN LİSTELENDİĞİ SUTUN  BİTİŞ-->
                <div class="card-footer">
                 
                </div>
              <!-- /.card-body -->
            </div>
        <!--MENÜLER CARDI BİTİŞ  -->
</div>

<!------------------------------------------------------------->

 <!--M CARDI BAŞ  -->
<div class="col-sm-3">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">
DEMO

              </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body"> <!-- MENÜLERİN LİSTELENDİĞİ SUTUN -->


              </div> <!-- MENÜLERİN LİSTELENDİĞİ SUTUN  BİTİŞ-->
                <div class="card-footer">
                 
                </div>
              <!-- /.card-body -->
            </div>
        <!--MENÜLER CARDI BİTİŞ  -->
</div>

<!------------------------------------------------------------->

 <!--M CARDI BAŞ  -->
<div class="col-sm-3">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">
DEMO

              </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body"> <!-- MENÜLERİN LİSTELENDİĞİ SUTUN -->


              </div> <!-- MENÜLERİN LİSTELENDİĞİ SUTUN  BİTİŞ-->
                <div class="card-footer">
                 
                </div>
              <!-- /.card-body -->
            </div>
        <!--MENÜLER CARDI BİTİŞ  -->
</div>

<!------------------------------------------------------------->




<!-- DASHBOARD---------------------->
        </div>
        <!-- /.row -->
        <!-- Main row -->
      
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
  // FOOTER SAYFASINI ÇAĞIR 
    include_once("cerceveler/footer.php");
?>