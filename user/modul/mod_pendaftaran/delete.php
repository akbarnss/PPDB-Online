<?php
 include "../../../config/colokan.php";
 
 $nopes=$_GET['nopes'];
 
 $results = $colok->query("DELETE FROM nilai_siswa WHERE nopes='$nopes'");

if($results){
	$sql=mysqli_query($colok,"UPDATE siswa SET status='KONFIRMASI', statusgbr='KONFIRMASI' WHERE nopes='$nopes'");
    header("location:../../main.php?module=pendaftaran");
}else{
    print 'Error : ('. $mysqli->errno .') '. $mysqli->error;
}
 

//$hapus=mysqli_query($colok,"DELETE FROM nilai_siswa WHERE nilai_siswa='$nopes'");
//$r     = mysqli_fetch_array($hapus);

?>