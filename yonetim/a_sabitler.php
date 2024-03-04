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
  if(!empty($_POST['etiket']) && !empty($_POST['deger']) ){

       $ysabitetiket= $_POST['etiket']; 
       $ysabitdeger= $_POST['deger'];
     //  $ytr=  $yen =  $yde = $yru  = $yfr =  $yar =  $yfa =  $yzh = "";

       $ytr=$_POST['dildeger']['tr'];
       $yen=$_POST['dildeger']['en'];     
       $yde=$_POST['dildeger']['de'];    
       $yru=$_POST['dildeger']['ru'];  
       $yfr=$_POST['dildeger']['fr'];  
       $yar=$_POST['dildeger']['ar'];  
       $yfa=$_POST['dildeger']['fa'];  
       $yzh=$_POST['dildeger']['zh'];  

      $sabiteklesql = "INSERT INTO sabitler (etiket,  deger, tr,  en,  de,  ru,  fr,  ar,  fa,  zh ) VALUES 
      ('$ysabitetiket', '$ysabitdeger', '$ytr', '$yen', '$yde', '$yru', '$yfr', '$yar', '$yfa', '$yzh' )";
      // echo $sabiteklesql;
       
                if ($mysqli->query($sabiteklesql) === TRUE) {
                          $toaster['info'] = " Kayıt Eklendi...";
                        } else {
                          echo "Error: " . $sql . "<br>" . $mysqli->error;
                        }
                      
    }
    else {
     $toaster['warning'] = "Alanları boş bırakmayınız...";
    }
}

//////////////////////////////////////////////////

if(isset($_POST['sabitkaydet'])){
  if(!empty($_POST['etiket']) && !empty($_POST['deger']) ){

       $editsabitid= $_POST['sabitid'];
       $editsabitetiket= $_POST['etiket'];
       $editsabitdeger= $_POST['deger'];
       $edittr=$_POST['tr'];
       $editen=$_POST['en'];
       $editde=$_POST['de'];
       $editru=$_POST['ru'];
       $editfr=$_POST['fr'];
       $editar=$_POST['ar'];
       $editfa=$_POST['fa'];
       $editzh=$_POST['zh'];

       $sabiteditsql = "UPDATE sabitler SET
        etiket='$editsabitetiket', deger='$editsabitdeger', tr='$edittr', en= '$editen',  de= '$editde',  ru= '$editru', 
        fr= '$editfr',  ar= '$editar',  fa= '$editfa'
         WHERE ID = '$editsabitid'";
         // echo $sabiteditsql;
                if ($mysqli->query($sabiteditsql) === TRUE) {
                          $toaster['info'] = " Kayıt Güncellendi...";
                        } else {
                          echo "Error: " . $sql . "<br>" . $mysqli->error;
                        }

    }
    else {
     $toaster['warning'] = "Alanları boş bırakmayınız...";
    }

}

/////////////////////////////////////////////////////////////


///////////////////////   SABİT SİL   /////////////////////////

 if($action=='Delete') {
  $silinecekid=$_GET['id'] ;
  $silsql = "DELETE FROM sabitler WHERE id=$silinecekid";

  if ($mysqli->query($silsql) === TRUE) {
   $toaster['success'] = " Kayıt Silinmiştir...";
  } else {
  echo "Error deleting record: " . $mysqli->error;
}
 }

////////////////////////////////////////////////////////




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
                  

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">



                <table class="table table-bordered text-nowrap">
                  <thead>
                    <tr>
                      <th>Etiket</th>
                       <th>Değer</th>

  <?php 
    $sqldil="SELECT ID, DilKodu,Adi FROM diller WHERE Aktif=1";             
    if ($resultdil = $mysqli -> query($sqldil)) {
      while ($rowdil = $resultdil -> fetch_row()) {
      ?>
                      <th><?php echo $rowdil[2]; ?></th>
      <?php
    }
   }
 ?>
                      <th>Kaydet</th>
                  
                    </tr>
                  </thead>
                  <tbody>


<form action="a_sabitler.php" method="POST" id="YENISABIT">
  
                    <tr style="background-color:  #e6f7ff !important;">
                      <td> <input type="text" class="form-control" placeholder="Etiket" name="etiket"></td>
                      <td> <input type="text" class="form-control" placeholder="Değer" name="deger"></td>
 <?php 
    $sqldil="SELECT ID, DilKodu,Adi FROM diller WHERE Aktif=1";             
    if ($resultdil = $mysqli -> query($sqldil)) {
      while ($rowdil = $resultdil -> fetch_row()) {
      ?>
      <td> <input type="text" class="form-control" placeholder="<?php echo $rowdil[2]; ?>" name="dildeger[<?php echo $rowdil[1]; ?>]"></td>
      <?php
    }
   }
 ?>

                      <td> <button type="submit" class="btn btn-success" name="sabitekle">
    <i class="fa fa-plus" aria-hidden="true"></i> 
</button> <!--<input class="btn btn-primary" type="submit" value="Ekle" name="sabitekle">--></td>
                    </tr>
</form>


<?php
$wheredil=" ";
if(isset($_GET['Lang']))
{
 $wheredil=" WHERE DIL=".$_GET['Lang']. " ";
}

$sabitsql="SELECT id,  etiket,  deger, tr,  en,  de,  ru,  fr,  ar,  fa,  zh  
 FROM sabitler ORDER BY id DESC ";            
 if ($sabitresult = $mysqli -> query($sabitsql)) {
  while ($sabitrow = $sabitresult -> fetch_assoc()) {
    // VERİLERİ ÇEK
?>

<form action="a_sabitler.php" method="POST" id="sabitform_<?php echo $sabitid; ?>">
  <input type="hidden" name="sabitid" value="<?php echo $sabitrow['id']; ?>">
                    <tr>
                      <td> <input type="text" class="form-control" value="<?php echo $sabitrow['etiket']; ?>" name="etiket"></td>
                      <td> <input type="text" class="form-control" value="<?php echo $sabitrow['deger']; ?>" name="deger"></td>
                      <td> <input type="text" class="form-control" value="<?php echo $sabitrow['tr']; ?>" name="tr"></td>
                      <td> <input type="text" class="form-control" value="<?php echo $sabitrow['en']; ?>" name="en"></td>                   
                      <td> <input type="text" class="form-control" value="<?php echo $sabitrow['ru']; ?>" name="ru"></td>
					  <td> <input type="text" class="form-control" value="<?php echo $sabitrow['ar']; ?>" name="ar"></td>
					   <td> <input type="text" class="form-control" value="<?php echo$sabitrow['fa']; ?>" name="fa"></td>                                                          
                      <td> <input type="text" class="form-control" value="<?php echo $sabitrow['zh']; ?>" name="zh"></td>
					    <td> <input type="text" class="form-control" value="<?php echo $sabitrow['de']; ?>" name="de"></td>
						<td> <input type="text" class="form-control" value="<?php echo $sabitrow['fr']; ?>" name="fr"></td>
                      <td> 

<button type="submit" class="btn btn-success" name="sabitkaydet">
    <i class="fa fa-save" aria-hidden="true"></i> 
</button> 


<a href="a_sabitler.php?action=Delete&id=<?php echo $sabitrow['id']; ?>" class="btn btn-secondary  active" role="button" aria-pressed="true">
  <i class="fa fa-trash-alt"></i>

</a>

                     <!--   <input class="btn btn-primary" type="submit" value="Kaydet" name="sabitkaydet"> -->



                      </td>
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