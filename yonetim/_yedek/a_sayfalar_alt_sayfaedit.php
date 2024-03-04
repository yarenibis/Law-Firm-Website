 <?php 
if (!defined("KORUMA")) {
  header("Location: ../404.html");
  exit();
}




if(!isset($ssayfaaktif))
{
 $ssayfaaktif= 0;
}

if(!isset($ssayfaindexle))
{
 $ssayfaindexle= 1;
}


// YENİ SAYFA İSE PRETTY URL OTOMATİK DOLDUR

  if($action == "yenisayfa") {
      $ssayfapurl= PrettyURLyap($ssayfaadi) ; 
      $ssayfatitle =$ssayfaadi;
      $ssayfadescr = $ssayfaadi;
  }
    
/////////////////////SAYFA COLLAPSE////////////////

$sayfaeditcollapse="  "; 

if($section=='Galeri' || $section=='PageImages') {
 $sayfaeditcollapse=" collapsed-card";
}

//////////////////////////////////////

?>
<!-- SAYFA EDIT KISMI -->


            <div class="card card-primary <?php echo $sayfaeditcollapse; ?>">
              <div class="card-header">
                <h3 class="card-title">Sayfa Bilgileri</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">

     <?php 
        if($form == "yenisayfa")
        {
          $formtur= "a_sayfalar.php?k=".$k."&action=yenisayfa";
        }
        else if( $form== "editsayfa") {
          $formtur="a_sayfalar.php?k=".$k."&action=edit&id=".$secilisayfaid;
        }


     ?>
                    
        <form id="sayfaform" action="<?php echo $formtur; ?>" method="POST">
          <?php  if(isset($secilisayfaid))  { ?> 
              <input type="hidden" name="editsayfaid" value="<?php echo $secilisayfaid; ?>"> 
          <?php } ?>
            
            
            <div class="card-body" style="display: block;">
          
              <div class="form-group">
                <label for="adi">Adı</label>
                <input langField="1" name="sayfaadi" id="sayfaadi" class="form-control" type="text" value="<?php if(isset($ssayfaadi))
                {echo $ssayfaadi;} ?>"  required />
              </div>



              <div class="form-group">
                <label for="purl">Pretty Url</label>
                <input langField="1" name="sayfapurl" id="url" class="form-control" type="text" value="<?php if(isset($ssayfapurl))
                {echo $ssayfapurl;} ?>"  />
              </div>
            
             <div class="form-group">
                <label for="url"> Url</label>
                <input langField="1" name="sayfaurl" id="url" class="form-control" type="text" value="<?php if(isset($ssayfaurl))
                {echo $ssayfaurl;} ?>"  />
              </div>

            <div class="form-group">
                <label for="sayfadili">Dili</label>
                <select name="sayfadili" id="sayfadili" class="form-control">
                <?php
                    if(!isset($ssayfadil)) {$ssayfadil=1;}
                    $sql_dilcek="SELECT ID, Adi  FROM diller WHERE  aktif = 1";             
                    if ($result_dilcek = $mysqli -> query($sql_dilcek)) {
                       while ($row_dilcek= $result_dilcek -> fetch_row()) {
                          // VERİLERİ ÇEK
                         $dilcek_id= $row_dilcek[0];
                         $dilcek_adi= $row_dilcek[1];
                        ?>
                         <option <?php echo ($ssayfadil == $dilcek_id ? " selected " : ""); ?>value="<?php echo $dilcek_id; ?>"><?php echo $dilcek_adi; ?></option>
                        <?php
                       }
                      }
                     ?>
              </select>
              </div>


            <div class="form-group">
                <label for="sayfaturu">Sayfa Türü</label>
                <select name="sayfaturu" id="sayfaturu" class="form-control">
                <?php
                    if(!isset($ssayfatur)) {$ssayfatur=1;}
                     $sql_sayfaturcek="SELECT purl, Adi  FROM sayfa_turu";

                   

                    if ($result_sayfaturcek = $mysqli -> query($sql_sayfaturcek)) {
                       while ($row_sayfaturcek= $result_sayfaturcek -> fetch_row()) {
                          // VERİLERİ ÇEK
                         $sayfaturcek_id= $row_sayfaturcek[0];
                         $sayfaturcek_adi= $row_sayfaturcek[1];
                         
                         $sayfaturselected='';

                             if($k =='2'  &&  $sayfaturcek_id == 'blog') {
                              $sayfaturselected= " selected ";
                             }  
                             elseif($ssayfaturu == $sayfaturcek_id)

                             {
                              $sayfaturselected= " selected ";
                             }


                        ?>
                         <option <?php echo $sayfaturselected; ?>value="<?php echo $sayfaturcek_id; ?>"><?php echo $sayfaturcek_adi; ?></option>
                        <?php
                       }
                      }
                     ?>
              </select>
              </div>


          <div class="form-group">
                <label for="yazari">Yazari</label>
                <select name="sayfayazar" id="yazari" class="form-control">

                <?php
                  if(!isset($ssayfayazar)) { $ssayfayazar = 0; }
                  if( empty($ssayfayazar)) {  $ssayfayazar = 0; }
                  ?>
                    <option <?php echo ($ssayfayazar == 0 ? " selected " : ""); ?>value="0">-Yazar Yok- </option>
                  <?php
                  $sql_yazarcek="SELECT id, adi  FROM sayfalar WHERE konum = 20 and aktif = 1";     // KONUMU 20 OLANLAR YAZAR        
                  if ($result_yazarcek = $mysqli -> query($sql_yazarcek)) {
                  while ($row_yazarcek= $result_yazarcek -> fetch_row()) {
                  // VERİLERİ ÇEK
                  $yazarcek_id= $row_yazarcek[0];
                  $yazarcek_adi= $row_yazarcek[1];
                  ?>
                     <option <?php echo ($ssayfayazar == $yazarcek_id ? " selected " : ""); ?>value="<?php echo $yazarcek_id; ?>">
                     <?php echo $yazarcek_adi; ?></option>
                      <?php
                      }
                    }
                 ?>
   
              </select>
              </div>

              <div class="form-group">
               <label for="canonical">Canonical</label>
                <input langField="1" name="sayfacano" id="canonical" class="form-control" type="text" value="<?php if(isset($ssayfacano))
                {echo $ssayfacano;} ?>"  />
              </div>

                  <div class="form-group">
               <label for="sayfaicon">İcon</label>
                <input langField="1" name="sayfaicon" id="sayfaicon" class="form-control" type="text" value="<?php if(isset($ssayfaicon))
                {echo $ssayfaicon;} ?>"  />
              </div>

          <div class="form-group">
               <label for="keywords">Anahtar Kelimeler</label>
                <input langField="1" name="sayfakeywords" id="keywords" class="form-control" type="text" value="<?php if(isset($ssayfakeywords))
                {echo $ssayfakeywords;} ?>"  />
              </div>



              
              <div class="form-group">
                <label for="sayfatitle">Başlık</label>

 <textarea class="form-control count" name="sayfatitle" id="sayfatitle" type="text" langField="1"
         maxlength="130" placeholder="Sayfa Başlığı" rows="5" noresize required><?php if(isset($ssayfatitle))
                {echo $ssayfatitle;}; ?></textarea>
<span class="pull-right label label-default" id="count_message2"></span>
<script type="text/javascript">
            var text_max2 = 130;
$('#count_message2').html('0 / ' + text_max2 );
$('#sayfatitle').keyup(function() {
  var text_length2 = $('#sayfatitle').val().length;
  var text_remaining2 = text_max2 - text_length2;
  $('#count_message2').html(text_length2 + ' / ' + text_max2);
});
          </script>

              </div>






              <div class="form-group">
                <label for="descr">Tanımlama </label>
                 <textarea class="form-control count" id="descr" langField="1" name="sayfadescr" type="text"
         maxlength="130" placeholder="Tanımlama" rows="5" noresize><?php if(isset($ssayfadescr))
                {echo $ssayfadescr;}  ?></textarea>
        <span class="pull-right label label-default" id="count_message"></span>
        <br>     
          <script type="text/javascript">
            var text_max = 130;
$('#count_message').html('0 / ' + text_max );
$('#descr').keyup(function() {
  var text_length = $('#descr').val().length;
  var text_remaining = text_max - text_length;
  $('#count_message').html(text_length + ' / ' + text_max);
});
          </script>
              </div>








      <?php 

         if(!isset($ssayfauid)) { $ssayfauid = 0; }
      ?>

              <div class="form-group">
                <label for="sayfaustmenu">Üst Menüsü</label>
                 <select name="sayfaustmenu" id="aktif" class="form-control">
                   <option <?php echo ( $ssayfauid == '0' ? " selected " : ""); ?> value="0">Kendisi Üst Menü Olsun</option>
                    <option disabled>──────────</option>
              <?php

            // yeni sayfa uid
            if(!isset($ssayfauid)) {
              $ssayfauid =0;
            }


                $sql_menu_cek="SELECT id, adi, dil, uid  FROM sayfalar WHERE konum = $k and aktif = 1 and uid = 0 ORDER BY sira ASC";             
                if ($result_menu_cek = $mysqli -> query($sql_menu_cek)) {

                   while ($row_menu_cek= $result_menu_cek -> fetch_row()) {
                      // VERİLERİ ÇEK
                      $menucek_id= $row_menu_cek[0];
                      $menucek_adi= $row_menu_cek[1];
                      $menucek_dil= $row_menu_cek[2];
                ?>
                <option <?php echo ( $ssayfauid == $menucek_id ? " selected " : ""); ?> value="<?php echo $menucek_id; ?>"><?php echo $menucek_adi; ?></option>
                <?php
                  $sql_menu_cek2="SELECT id, adi, dil, uid  FROM sayfalar WHERE konum = $k and aktif = 1 and uid = $menucek_id ORDER BY sira ASC";             
                   if ($result_menu_cek2 = $mysqli -> query($sql_menu_cek2)) {
                     while ($row_menu_cek2= $result_menu_cek2 -> fetch_row()) {
                      // VERİLERİ ÇEK
                      $menucek_id2= $row_menu_cek2[0];
                      $menucek_adi2= $row_menu_cek2[1];
                      $menucek_dil2= $row_menu_cek2[2];
                      $menucek_uid2= $row_menu_cek2[3];
                ?>
                <option <?php echo  ($ssayfauid == $menucek_id2 ? " selected " : ""); ?> value="<?php echo $menucek_id2; ?>"> 
                  > <?php echo  $menucek_adi2; ?></option>
                <?php
                     } // iç while
                    }  // iç if
                  }  // dış while
                } // dış if

                ?>
              </select>
              </div>


            <div class="form-group">
                <label for="sayfasira">Sayfa Sira</label>
                <select name="sayfasira" id="sira" class="form-control">
                <?php
                    if(!isset($ssayfasira)) {$ssayfasira=1;}
                    for($i=1; $i < 100 ;$i ++)
                    {
                    ?>
  <option <?php echo ($ssayfasira == $i ? " selected " : ""); ?>value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php
                    }
                  ?>
                     
              </select>
              </div>


              <div class="form-group">
                <label for="icerik">İçerik</label>
                
                 <textarea class="ckeditor" cols="80" id="editor1" name="sayfaicerik" rows="10" style="width:600px"><?php if(isset($ssayfaicerik))
                 {echo $ssayfaicerik;} ?></textarea>
              </div>

        

              <div class="form-group">
                <label for="aktif">Aktif</label>
                <select name="sayfaaktif" id="aktif" class="form-control">
              <option <?php echo($ssayfaaktif == 0 ? " selected " : ""); ?>value="0">Passive</option>
              <option <?php echo($ssayfaaktif == 1 ? " selected " : ""); ?> value="1">Active</option>
              </select>
              </div>

 
              <div class="form-group">
                <label for="head_custom">Custom Head Data</label>
                 <textarea class="form-control" cols="80" id="head_custom" name="sayfakodhead" rows="3"><?php if(isset($ssayfakodhead))
                 {echo $ssayfakodhead;} ?></textarea>
              </div>

              <div class="form-group">
                <label for="foot_custom">Custom Foot Data</label>
                <textarea class="form-control" cols="80" id="foot_custom" name="sayfakodfoot" rows="3"><?php if(isset($ssayfakodfoot))
                 {echo $ssayfakodfoot;} ?></textarea>
              </div>



              <div class="form-group">
                <label for="indexle">Arama Motoru Indeksle</label>
              <select name="sayfaindexle" id="indexle" class="form-control" >
              <option <?php echo($ssayfaindexle == 0 ? " selected" : ""); ?> value="0">No</option>
              <option <?php echo($ssayfaindexle == 1 ? " selected" : ""); ?> value="1">Yes</option>
              </select>
              </div>



            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary btn-block" name="sayfakaydet">Kaydet</button>
            </div>


        </form>



                  
              
            </div>
            <!-- /.card-body -->
       </div><!-- /.card-->

<!-- SAYFA EDIT KISMI BİTİŞ --->