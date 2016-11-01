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
	
	// Input data user
	if ($module=='user' AND $act=='tambah'){ 
		$username   = $_POST['username'];
		$nama_lengkap = $_POST['nama'];
		$email = $_POST['email']; 
		$telp = $_POST['telp']; 
		$password   = md5($_POST['password']);
		$idsession  = md5($password);
		
		$input = "INSERT INTO users(username,
									nama_lengkap,
									password,
									email,
									no_telp,
									id_session) 
							VALUES ('$username', 
									'$nama_lengkap',
									'$password',
									'$email',
									'$telp',
									'$idsession')";
		mysqli_query($colok, $input);
		header("location:../../main.php?module=".$module);
	}
	
	// Update data user
	elseif ($module=='user' AND $act=='edit'){
		if (empty($_POST['password'])) {
			mysqli_query($colok, "UPDATE users SET nama_lengkap = '$_POST[nama]',
                                  email         = '$_POST[email]', 
                                  no_telp         = '$_POST[telp]', 
                                  blokir         = '$_POST[blokir]', 
                                  level         = '$_POST[level]'
                           WHERE  id_session     = '$_POST[id]'");
		}
		
		// Apabila password diubah
		else {
			$pass=md5($_POST['password']);
			mysqli_query($colok, "UPDATE users SET nama_lengkap = '$_POST[nama]',
                                  email         = '$_POST[email]',
                                  no_telp         = '$_POST[telp]',
                                  blokir         = '$_POST[blokir]',
                                  level         = '$_POST[level]',
								  password = '$pass'
                           WHERE  id_session     = '$_POST[id]'");
		}
		header('location:../../main.php?module='.$module);
	}
}
?>