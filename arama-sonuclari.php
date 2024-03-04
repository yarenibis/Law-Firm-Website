
<?php include_once 'vt.php'; ?>
<?php include_once 'fonksiyonlar.php'; ?>
<?php include_once 'sabitler.php'; ?>
<?php include_once 'header.php'; ?>

    <div class="row">
        <div class="col-md-8">                                  
            <?php

            if (isset($_POST['submit'])) {
                $search = $_POST['search'];


                $sonuc = dbSorgu("SELECT s.adi adi, s.title baslik, s.descr descr, s.icerik icerik, s.sayfa_turu sayfa_turu FROM sayfalar s WHERE s.descr LIKE '%$search%' ");
               



                if (count($sonuc) == 0) {
                    echo "<h4>'$search' terimiyle eşleşen herhangi bir terim yok,</h4>";

                } else {
                        
                       
                     $x = "'$search' terimiyle eşleşen bazı sonuçlar bulundu.";
                      
                        // $baslik = $row['s.title'];                   
                        // $adi =  $row['s.adi'];     
                        // $descr = $row['s.descr'];                    
                        // $icerik = $row['s.icerik'];
                        // $tarih =  $row['s.date'];
                        // $sayfa_turu =  $row['s.sayfa_turu'];
                    
                        ?>
                
                <div class="container py-5 mt-3">

<div class="row">
    <div class="col">
        <h2 class="font-weight-normal text-7 mb-0"><?php echo $x; ?> <strong class="font-weight-extra-bold"></strong></h2>
        <p class="lead mb-0"><?php $y = count($sonuc); echo $y; ?> sonuç bulundu.</p>
    </div>
</div>
<div class="row">
    <div class="col pt-2 mt-1">
        <hr class="my-4">
    </div>
</div>
<div class="row">
    <div class="col">

        <ul class="simple-post-list m-0">
       <?php  foreach($sonuc as $row){ ?>
            <li>
                <div class="post-info">
                    <a href="blog-post.html"><?=$row["adi"]?></a>
                    <div class="post-meta">
                         <span class="text-dark text-uppercase font-weight-semibold"><?=$row["sayfa_turu"]?></span> | <?=$row["descr"]?>
                    </div> 
                </div>
            </li>
            <?php } ?>
            
        </ul>

        <!-- <ul class="pagination float-end">
            <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-left"></i></a></li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-right"></i></a></li>
        </ul> -->

    </div>
</div>
</div>
                
                
                   <?php 
                            }                
                           }

                ?>
        
                            </div>                                                                       

                        </div>
                       
                        <hr>
                        
<?php include_once 'footer.php';  ?>
                
                   
                
              