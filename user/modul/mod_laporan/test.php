<?php 
include "../../../config/colokan.php";
$result=("SELECT nopes,nm_siswa,tmp_lahir,tgl_lahir,alamat, nilai_afektif,nilai_psikomotorik,status FROM siswa INNER JOIN nilai_siswa ON nilai.nopes=nilai_siswa.nopes");

$row = mysqli_fetch_array($result);

echo $result['nilai'];

?>