<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = 'index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
	include "../../../config/colokan.php";
	
	$module = $_GET['module'];
	$act    = $_GET['act'];
	
	// Update identitas
	if ($module=='setting' AND $act=='update'){
		$sql=mysqli_query($colok, "UPDATE setting SET pendaftaran = '$_POST[pendaftaran]',
                                  pengumuman         = '$_POST[pengumuman]' 
                           WHERE  id_setting     = '$_POST[id]'");
		$update=($sql);
		
		if($update) 
			header('location:../../main.php?module='.$module.'&r=sukses');
			
		else 
			header('location:../../main.php?module='.$module.'&r=gagal');

	}
}
?>