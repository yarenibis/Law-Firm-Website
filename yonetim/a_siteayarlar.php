<?php
// BAŞLATICI ÇAĞIR 
include_once("_baslatici.php");

// HEADER SAYFASINI ÇAĞIR 
include_once("cerceveler/header.php");

// SİDEBAR SAYFASINI ÇAĞIR 
include_once("cerceveler/sidebar.php");

//////////////////////////////////////////////////////////////////////////////////


if(isset($_GET['action'])) {
    $action=$_GET['action'] ;
}
else $action="GenelAyarlar";

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Site Genel Ayarları</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Anasayfa</a></li>
              <li class="breadcrumb-item active">.</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
 

        <div class="row">
          <div class="col-12 col-sm-8">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

              


                  <li class="nav-item">
                    <a class="nav-link <?php echo ($action == 'SiteLogo') ? "active" : ""; ?>" id="custom-tabs-one-sitelogo-tab" data-toggle="pill" href="#custom-tabs-one-sitelogo" role="tab" aria-controls="custom-tabs-one-sitelogo" aria-selected="<?php echo ($action == 'Sitelogo') ? "true" : "false"; ?>">Site Logosu</a>
                  </li>

                 


                  <li class="nav-item">
                    <a class="nav-link <?php echo ($action == 'GaleriAyar') ? "active" : ''; ?>" id="custom-tabs-one-galeri-tab" data-toggle="pill" href="#custom-tabs-one-galeri" role="tab" aria-controls="custom-tabs-one-galeri" aria-selected="<?php echo ($action == 'GaleriAyar') ? "true" : "false"; ?>">Galeri Ayarları</a>
                  </li>


                </ul>
              </div>




              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">

                

                 <div class="tab-pane fade <?php echo ($action == 'SiteLogo') ? "show active" : ""; ?>" id="custom-tabs-one-sitelogo" role="tabpanel" aria-labelledby="custom-tabs-one-sitelogo-tab">
                  <?php // include("a_siteayarlar_alt_logo.php"); ?>
1
                  </div>

                  <div class="tab-pane fade <?php echo ($action == 'GaleriAyar') ? "show active" : ""; ?>" id="custom-tabs-one-galeri" role="tabpanel" aria-labelledby="custom-tabs-one-galeri-tab">
                  <?php //include("a_siteayarlar_alt_galeriayar.php"); ?>
                  2
                  </div>
                  
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
       
        </div>
       





      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
  // FOOTER SAYFASINI ÇAĞIR 
    include_once("cerceveler/footer.php");
?>