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

  // Hapus halaman statis
  if ($module=='halaman' AND $act=='hapus'){
    $query = "SELECT gambar FROM halamanstatis WHERE id_halaman='$_GET[id]'";
    $hapus = mysqli_query($colok, $query);
    $r     = mysqli_fetch_array($hapus);
    
    header("location:../../main.php?module=".$module);
  }

 // Input halaman statis
elseif ($module=='halaman' AND $act=='tambah'){    
    $judul       = $_POST['judul'];
    $judul_seo   = seo_title($_POST['judul']);
    $isi_halaman = $_POST['isi_halaman'];

    $input = "INSERT INTO halamanstatis(judul, 
                                          judul_seo,
                                          tgl_posting,  
                                          isi_halaman) 
                                VALUES('$judul', 
                                          '$judul_seo',
                                          '$tgl_sekarang',  
                                          '$isi_halaman')";
    mysqli_query($colok, $input);

    header("location:../../main.php?module=".$module);
}


  // Update halaman statis
  elseif ($module=='halaman' AND $act=='edit'){
    $id          = $_POST['id'];    
    $judul       = $_POST['judul'];
    $judul_seo   = seo_title($_POST['judul']);
    $isi_halaman = $_POST['isi_halaman'];
	
    $update = "UPDATE halamanstatis SET judul       = '$judul',
                                          judul_seo   = '$judul_seo', 
                                          isi_halaman = '$isi_halaman'
                                    WHERE id_halaman  = '$id'";
    mysqli_query($colok, $update);
      
    header("location:../../main.php?module=".$module);
  }
}
?>
