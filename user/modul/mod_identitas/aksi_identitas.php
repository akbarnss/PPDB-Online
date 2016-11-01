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
	if ($module=='identitas' AND $act=='update'){
		$alamat_website = $_POST['alamatwebsite']; 
		$nama = $_POST['nama']; 
		$alamat = $_POST['alamat']; 
		$kabupaten = $_POST['kabupaten'];
		$ta = $_POST['ta'];
		$kepsek = $_POST['kepsek'];
		$id   = $_POST['id'];
		$idf   = $_POST['idf'];
		
		$lokasi_file    = $_FILES['fupload']['tmp_name'];
		$nama_file      = $_FILES['fupload']['name'];
  
		if (empty($lokasi_file)){
			$sql=mysqli_query($colok, "UPDATE sekolah SET alamat_website = '$alamat_website',
                                  nama_sekolah         = '$nama',
                                  alamat         = '$alamat',
                                  kabupaten      = '$kabupaten',
                                  tahun_ajaran   = '$ta',
                                  kepsek         = '$kepsek'
                           WHERE  id_sekolah     = '$id'");
			$update=($sql);
		} 
		
		else {
			// hapus file logo yang lama
			unlink("../../../images/$idf");
			
			// folder untuk logo di folder images
			$folder = "../../../images/";
			$file_upload = $folder . $nama_file;
			// upload gambar favicon
			move_uploaded_file($_FILES["fupload"]["tmp_name"], $file_upload);
			
			$sql=mysqli_query($colok, "UPDATE sekolah SET alamat_website = '$alamat_website',
                                  nama_sekolah         = '$nama',
                                  alamat         = '$alamat',
                                  kabupaten      = '$kabupaten',
                                  tahun_ajaran   = '$ta',
                                  logo   		 = '$nama_file',
                                  kepsek         = '$kepsek'
                           WHERE  id_sekolah     = '$id'");
			$update=($sql);
		}
		
		if($update) 
			header('location:../../main.php?module='.$module.'&r=sukses');
		else 
			header('location:../../main.php?module='.$module.'&r=gagal');
	}
}
?>