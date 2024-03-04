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
else $action="";

//////////////  DİLLERİ ÇEK///////////////////////////

$sqldil="SELECT ID, DilKodu FROM diller";             
 if ($resultdil = $mysqli -> query($sqldil)) {
  while ($rowdil = $resultdil -> fetch_row()) {
      
      $dil[$rowdil[0]] = $rowdil[1];
     
  }
}

//////////////////   SABİTLERİ KAYDET   ////////////////////////////

if(isset($_POST['sabitekle'])){

 $ysabitsayfa= $_POST['ysabitsayfa']; 
 $ysabitadi= $_POST['ysabitadi'];
 $ysabitveri= $_POST['ysabitveri'];
 $ysabitlink= $_POST['ysabitlink'];
 $ysabitdil= $_POST['ysabitdil'];

 $sabiteklesql = "INSERT INTO sayfa_sabitleri (SAYFA_ADI, SABIT_ADI, SABIT_VERI, SABIT_LINK, DIL) VALUES 
 ('$ysabitsayfa', '$ysabitadi', '$ysabitveri', '$ysabitlink', '$ysabitdil') ";
 echo $sabiteklesql;
          if ($mysqli->query($sabiteklesql) === TRUE) {
                    $toaster['info'] = " Kayıt Eklendi...";
                  } else {
                    echo "Error: " . $sql . "<br>" . $mysqli->error;
                  }
}

//////////////////////////////////////////////////

if(isset($_POST['sabitkaydet'])){

 $editsabitid= $_POST['sabitid'];
 $editsabitsayfa= $_POST['sabitsayfa'];
 $editsabitadi= $_POST['sabitadi'];
 $editsabitveri= $_POST['sabitveri'];
 $editsabitlink= $_POST['sabitlink'];

 $sabiteditsql = "UPDATE sayfa_sabitleri SET
  SAYFA_ADI='$editsabitsayfa', SABIT_ADI='$editsabitadi', SABIT_VERI='$editsabitveri', SABIT_LINK= '$editsabitlink' WHERE ID = '$editsabitid'";
          if ($mysqli->query($sabiteditsql) === TRUE) {
                    $toaster['info'] = " Kayıt Güncellendi...";
                  } else {
                    echo "Error: " . $sql . "<br>" . $mysqli->error;
                  }
}

/////////////////////////////////////////////////////////////




?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">SAYFA SABİTLERİ</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Anasayfa</a></li>
              <li class="breadcrumb-item active">Sayfa Sabitleri</li>
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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>

                <div class="card-tools">
                  <a class="btn btn-secondary" href="a_sayfasabitleri.php?" role="button">Tümü</a>
                  <a class="btn btn-secondary" href="a_sayfasabitleri.php?Lang=1" role="button">Türkçe</a>
                  <a class="btn btn-secondary" href="a_sayfasabitleri.php?Lang=2" role="button">English</a>
                  <a class="btn btn-secondary" href="a_sayfasabitleri.php?Lang=3" role="button">русский</a>
                  <a class="btn btn-secondary" href="a_sayfasabitleri.php?Lang=4" role="button"> العربية  </a>



                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">






                <table class="table table-bordered text-nowrap">
                  <thead>
                    <tr>
                      <th>Sayfa Adı</th>
                      <th>Sabit Adı</th>
                      <th>Sabit Veri</th>
                      <th>Sabit Link</th>
                      <th>Dil</th>
                      <th>Kaydet</th>
                  
                    </tr>
                  </thead>
                  <tbody>


<form action="a_sayfasabitleri.php" method="POST" id="YENISABIT">
  
                    <tr style="background-color:  #e6f7ff !important;">
                      <td> <input type="text" class="form-control" placeholder="Sayfa Adı" name="ysabitsayfa"></td>
                      <td> <input type="text" class="form-control" placeholder="Sabit Adı" name="ysabitadi"></td>
                      <td> <input type="text" class="form-control" placeholder="Sabit Veri" name="ysabitveri"></td>
                      <td> <input type="text" class="form-control" placeholder="Sabit Link" name="ysabitlink"></td>
                      <td> 

<select name="ysabitdil">
  <?php 
    $sqldil="SELECT ID, DilKodu,Adi FROM diller";             
    if ($resultdil = $mysqli -> query($sqldil)) {
      while ($rowdil = $resultdil -> fetch_row()) {
      ?>
       <option value="<?php echo $rowdil[0];?>"><?php echo $rowdil[2]; ?> </option>
      <?php
    }
   }
 ?>
</select>


                      </td>
                      <td> <input class="btn btn-primary" type="submit" value="Yeni Sabit Ekle" name="sabitekle"></td>
                    </tr>
</form>











<?php
$wheredil=" ";
if(isset($_GET['Lang']))
{
 $wheredil=" WHERE DIL=".$_GET['Lang']. " ";
}


$sabitsql="SELECT ID, SAYFA_ADI, SABIT_ADI, SABIT_VERI, SABIT_LINK, DIL FROM sayfa_sabitleri".$wheredil ."ORDER BY id DESC ";             
 if ($sabitresult = $mysqli -> query($sabitsql)) {
  while ($sabitrow = $sabitresult -> fetch_row()) {
    // VERİLERİ ÇEK
    $sabitid= $sabitrow[0];
    $sabitsayfa= $sabitrow [1];
    $sabitadi= $sabitrow [2];
    $sabitveri=$sabitrow [3];
    $sabitlink=$sabitrow [4];
    $sabitdil=$sabitrow[5];   



?>

<form action="a_sayfasabitleri.php" method="POST" id="sabitform_<?php echo $sabitid; ?>">
  <input type="hidden" name="sabitid" value="<?php echo $sabitid; ?>">
                    <tr>
                      <td> <input type="text" class="form-control" value="<?php echo$sabitsayfa; ?>" name="sabitsayfa"></td>
                      <td> <input type="text" class="form-control" value="<?php echo $sabitadi; ?>" name="sabitadi"></td>
                      <td> <input type="text" class="form-control" value="<?php echo $sabitveri; ?>" name="sabitveri"></td>
                      <td> <input type="text" class="form-control" value="<?php echo $sabitlink; ?>" name="sabitlink"></td>
                      <td> <img src="img/flags/<?php echo  $dil[$sabitdil];  ?>.png"></td>
                      <td> <input class="btn btn-primary" type="submit" value="Kaydet" name="sabitkaydet"></td>
                    </tr>
</form>

<?php
  }  // while kapat

} // if kapat


 ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
























      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
  // FOOTER SAYFASINI ÇAĞIR 
    include_once("cerceveler/footer.php");
?>