<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = 'index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
	include "../../../config/colokan.php";
	include "../../../config/library.php";
	
	$module = $_GET['module'];
	$act    = $_GET['act'];
	
	
	
	
	
	
	
	
	// Update identitas
	if ($module=='nilai' AND $act=='input'){
		$nopes = $_POST['nopes']; 
		$nilai_afektif = $_POST['nilai_afektif']; 
		$nilai_psikomotorik = $_POST['nilai_psikomotorik'];		
		if($nilai_afektif>=70 && $nilai_psikomotorik >=70) {
			$keterangan='SIAP';}
		else {
			$keterangan='BELUM SIAP';}
			
			$ceknopes=mysqli_num_rows(mysqli_query
             ($colok, "SELECT * FROM nilai_siswa 
               WHERE nopes='$nopes'"));
// Kalau username sudah ada yang pakai
if ($ceknopes > 0){
  header('location:../../main.php?module='.$module.'&r=sama');
}
// Kalau username valid, inputkan data ke tabel users
else{

			$sql=mysqli_query($colok, "INSERT INTO nilai_siswa SET nopes = '$_POST[nopes]', nilai_afektif = '$nilai_afektif', nilai_psikomotorik='$nilai_psikomotorik', keterangan='$keterangan', keterangan_gbr='$keterangan'");
			$input=($sql);
					
}
		if($input) {
		$sql2=mysqli_query($colok, "UPDATE siswa SET status ='$keterangan', statusgbr='$keterangan' WHERE nopes='$nopes'");
			header('location:../../main.php?module='.$module.'&r=sukses');}
		else 
			header('location:../../main.php?module='.$module.'&r=gagal');
	}
}
?>