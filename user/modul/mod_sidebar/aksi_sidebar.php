<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<link href=\"../../css/style_login.css\" rel=\"stylesheet\" type=\"text/css\" />
        <div id=\"login\"><h1 class=\"fail\">Untuk mengakses modul, Anda harus login dulu.</h1>
        <p class=\"fail\"><a href=\"../../index.php\">LOGIN</a></p></div>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  include "../../../config/colokan.php";
  include "../../../config/library.php";
  include "../../../config/fungsi_seo.php";

  $module = $_GET['module'];
  $act    = $_GET['act'];

  // Hapus sidebar 
  if ($module=='sidebar' AND $act=='hapus'){
    $query = "DELETE FROM sidebar WHERE id_sidebar='$_GET[id]'";
    $hapus = mysqli_query($colok, $query);
    $r     = mysqli_fetch_array($hapus);
    
    header("location:../../main.php?module=".$module);
  }

 // Input sidebar 
elseif ($module=='sidebar' AND $act=='tambah'){    
    $judul       = $_POST['judul'];
    $isi_sidebar = $_POST['isi_sidebar'];

    $input = "INSERT INTO sidebar(judul, 
                                          tgl_posting,  
                                          isi_sidebar) 
                                VALUES('$judul', 
                                          '$tgl_sekarang',  
                                          '$isi_sidebar')";
    mysqli_query($colok, $input);

    header("location:../../main.php?module=".$module);
}


  // Update sidebar 
  elseif ($module=='sidebar' AND $act=='edit'){
    $id          = $_POST['id'];    
    $judul       = $_POST['judul'];
    $isi_sidebar = $_POST['isi_sidebar'];
	
    $update = "UPDATE sidebar SET judul = '$judul', isi_sidebar = '$isi_sidebar' WHERE id_sidebar  = '$id'";
    mysqli_query($colok, $update);
      
    header("location:../../main.php?module=".$module);
  }
}
?>
