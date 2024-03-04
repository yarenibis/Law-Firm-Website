<?php
// BAŞLATICI ÇAĞIR 
include_once("_baslatici.php");

// HEADER SAYFASINI ÇAĞIR 
include_once("cerceveler/header.php");

// SİDEBAR SAYFASINI ÇAĞIR 
include_once("cerceveler/sidebar.php");

//////////////////////////////////////////////////////////////////////////////////

// ACTION AL
 $action="";
 if(isset($_GET['action'])) {
    $action= $_GET['action'];
  }

/// DİL SİL ////////////////////////////////////////////
if($action=='DeleteLang')
{
 $silinecekdil= $_GET['id'];
 $sildilsql = "DELETE FROM diller WHERE id=$silinecekdil";
  if ($mysqli->query($sildilsql) === TRUE) {
  //echo "Record deleted successfully";
   $toaster['success'] = " Kayıt Silinmiştir...";
  } else {
  echo "Error deleting record: " . $mysqli->error;
 }
}
//////////////////////////////////////////////////////////////////////
/////// DİL KAYDET ////////
if(isset($_POST['dilkaydet'])) {
  $editdilid= $_GET['id'];
  $editdiladi= $_POST['diladi'];
  $editdilkodu= $_POST['dilkodu'];
  $editdilyon= $_POST['dilyon'];  
  $editdilaktif= $_POST['dilaktif']; 

  $dileditsql = "UPDATE diller  SET Adi ='$editdiladi', DilKodu ='$editdilkodu', Yon ='$editdilyon',  Aktif ='$editdilaktif',
                  WHERE ID = '$editdilid'";
                  if ($mysqli->query($dileditsql) === TRUE) {
                    $toaster['info'] = " Kayıt Güncellendi...";
                    //
                  } else {
                    echo "Error: " . $sql . "<br>" . $mysqli->error;
                  }
}

////////////////////////////////////////////////////////////////////////////
?>

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Sayaç
                    </header>
                    <div class="panel-body">
<?
    $sayfasorgu = $mysqli->prepare("SELECT * FROM sayac");
    $sayfasorgu->execute();

    $sayfaicerik = $sayfasorgu->fetch(PDO::FETCH_ASSOC);
   
	if(count($sayfaicerik)>0){
			echo "sonuç boşşşşşşşş değiiillll...";
	}else{
			echo "sonuç boşşşşşşşş...";

	};
?>
						<div class="col-lg-6">
							<form role="form" method="post" action="?">
								<input type="hidden" name="kaydet" value="<%=kontrol("id")%>">
								<div class="form-group">
									<%=kontrol("dil_adi")%>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="s1" value="<%=kontrol("s1")%>">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="s2" value="<%=kontrol("s2")%>">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="s3" value="<%=kontrol("s3")%>">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="s4" value="<%=kontrol("s4")%>">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="s5" value="<%=kontrol("s5")%>">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="s6" value="<%=kontrol("s6")%>">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="s7" value="<%=kontrol("s7")%>">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="s8" value="<%=kontrol("s8")%>">
								</div>
								<div class="form-group">
																<select name="dil" class="form-control m-bot15">
																	<option value="0">- Dil -</option>
										    	                    <%
																	set kontrola = Server.CreateObject("Adodb.Recordset")
																	sqla = "select id, adi, url from diller where aktif = 1"
																	kontrola.open sqla,vt_baglanti,1,3
																	if kontrola.eof then
																	else
																		do while not kontrola.eof
										    	                    %>
																	<option <%if kontrola("url")=kontrol("dil") then response.write "Selected"%> value="<%=kontrola("url")%>"><%=kontrola("adi")%></option>
											                        <%
											                        	kontrola.movenext:loop
																	end if
																	kontrola.close
																	set kontrola=nothing
											                        %>
																</select>

								</div>
								<div class="form-group">
																<select name="aktif" class="form-control m-bot15">
																	<option value="0">Pasif</option>
																	<option value="1" <%if kontrol("aktif") = "1" then response.write "Selected"%>>Aktif</option>
																</select>

								</div>

								<button type="submit" class="btn btn-success">Kaydet</button>
							</form>
						</div>
							<%
							kontrol.movenext:loop
						end if
						kontrol.close
						set kontrol=nothing
						%>


					</div>
                </section>

            </div>
        </div>
  <?php
  // FOOTER SAYFASINI ÇAĞIR 
    include_once("cerceveler/footer.php");
?>