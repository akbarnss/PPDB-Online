<?php      
date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.

// konversi menjadi nama hari bahasa indonesia
$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
$hari     = date("w");
$hari_ini = $seminggu[$hari]; // konversi menjadi hari bahasa indonesia

$tgl_sekarang = date("d/m/Y");
$thn_sekarang = date("Y");
$jam_sekarang = date("H:i:s");
$tgl_saiki = date("Y-m-d");

// format penanggalan di database MySQL
$tanggal=date("Y-m-d"); 

// fungsi untuk mengubah tanggal menjadi format bahasa indonesia, contoh: 14 Maret 2014 
function tgl_indo($tgl){
	$tanggal = substr($tgl,8,2);
	$bulan   = ambilbulan(substr($tgl,5,2)); // konversi menjadi nama bulan bahasa indonesia
	$tahun   = substr($tgl,0,4);
	return $tanggal.' '.$bulan.' '.$tahun;		 
}	

// fungsi untuk mengubah angka bulan menjadi nama bulan
function ambilbulan($bln){
  if ($bln=="01") return "Januari";
  elseif ($bln=="02") return "Februari";
  elseif ($bln=="03") return "Maret";
  elseif ($bln=="04") return "April";
  elseif ($bln=="05") return "Mei";
  elseif ($bln=="06") return "Juni";
  elseif ($bln=="07") return "Juli";
  elseif ($bln=="08") return "Agustus";
  elseif ($bln=="09") return "September";
  elseif ($bln=="10") return "Oktober";
  elseif ($bln=="11") return "November";
  elseif ($bln=="12") return "Desember";
} 

// fungsi untuk mengubah susunan format tanggal
function ubah_tgl($tanggal) { 
   $pisah   = explode('/',$tanggal);
   $larik   = array($pisah[2],$pisah[1],$pisah[0]);
   $satukan = implode('-',$larik);
   return $satukan;
}

function ubah_tgl2($tanggal) { 
   $pisah   = explode('-',$tanggal);
   $larik   = array($pisah[2],$pisah[1],$pisah[0]);
   $satukan = implode('/',$larik);
   return $satukan;
}

// fungsi untuk merubah format tanggal indonesia ke inggris
function tgl_inggris($tanggal) {
	$pisah   = explode('-',$tanggal);
	$larik   = array($pisah[2],$pisah[1],$pisah[0]);
	$satukan = implode('-',$larik);
	return $satukan;
}

// fungsi untuk merubah format tanggal inggris ke indonesia
function tgl_indonesia($tanggal) {
	$pisah   = explode('-',$tanggal);
	$larik   = array($pisah[2],$pisah[1],$pisah[0]);
	$satukan = implode('-',$larik);
	return $satukan;
}

function ubah_jam($jam) {
	$pisah   = explode(':',$jam);
	if($pisah[0] >= 12) {
		$jams = $pisah[0]-12;
		$detik = "PM";
	} 
	else {
		$jams = $pisah[0];
		$detik = "AM";
	}
   $satukan = $jams.":".$pisah[1]." ".$detik;
   return $satukan;
}

function ubah_jam2($waktu) {
	$pisah   = explode(' ',$waktu);
	$jam = substr($pisah[0],0,2);
	$menit = substr($pisah[0],3,2);
	if($pisah[1] == "AM") {
		$jam = $jam;
	} 
	else {
		$jam = $jam + 12;
	}
   $satukan = $jam.":".$menit.":00";
   return $satukan;
}


function rupiah($angka) {
	$hasil =  number_format($angka,0, ",",".");
	return $hasil;
}

function ambildata($tabel, $var, $req) {
	include "config/colokan.php";
	$qpkj = mysqli_query($colok, "SELECT * FROM $tabel");
	echo "<select id=\"$var\" name=\"$var\" class=\"form-control\" $req>";
	while($pkj=mysqli_fetch_array($qpkj)) {
		$idp = "id_".$tabel;
		$nmp = "nm_".$tabel;
		echo "<option value=\"$pkj[$idp]\">$pkj[$nmp]</option>";
	}
	echo "</select>";
}

# fungsi untuk menampilkan combobox nama bulan
function namabulan($awal, $akhir, $var, $terpilih){
  $nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei", 
                      "Juni", "Juli", "Agustus", "September", 
                      "Oktober", "November", "Desember");
  echo "<select name='$var' id='$var' class='form-control' required>";
  for ($bln=$awal; $bln<=$akhir; $bln++){
      if ($bln==$terpilih)
         echo "<option value='$bln' selected>$nama_bln[$bln]</option>";
      else
        echo "<option value='$bln'>$nama_bln[$bln]</option>";
  }
  echo "</select> ";
}
?>
