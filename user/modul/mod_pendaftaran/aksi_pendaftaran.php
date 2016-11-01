<?php
session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	header('location:access-denied.php');
}
else{
	include "../../../config/colokan.php";
	include "../../../config/library.php";
	$module = $_GET['module'];
	$act = $_GET['act'];
	
	if ($module=='belumkonfirmasi' AND $act=='ubahstatus'){
		$cek = $_POST['cek'];
		$jumlah = count($cek);
		for($i=0; $i<$jumlah; $i++) {	//--- dokumen legalisir sudah jadi -----
			mysqli_query($colok, "UPDATE siswa SET status='$_POST[statuspendaftaran]',statusgbr='$_POST[statuspendaftaran]' WHERE nopes='$cek[$i]'");
		} 
		header('location:../../main.php?module='.$module);
	}
	
	elseif ($module=='pendaftaran' AND $act=='export-excel'){
		$tgl =date('d-m-Y-His');
		// Fungsi header dengan mengirimkan raw data excel
		header("Content-type: application/vnd-ms-excel");
		// Mendefinisikan nama file ekspor "JurnalGuru-bulan-tahun.xls"
		header("Content-Disposition: attachment; filename=DataPendaftar-SudahTest".$tgl.".xls");
?>
<table border="1">
  <thead>
    <tr style="background: #cccccc;">
      <td align="center" valign="middle" rowspan="2"><b>NO</b></td>
      <td align="center" colspan="19"><b>DATA SISWA</b></td>
      <td align="center" colspan="12"><b>DATA AYAH</b></td>
      <td align="center" colspan="12"><b>DATA IBU</b></td>
    </tr>
    <tr style="background: #cccccc;"><b>
      <td align="center"><b>NOPES</b></td>
      <td align="center"><b>TGL DAFTAR</b></td>
      <td align="center" valign="middle"><b>NAMA LENGKAP</b></td>
      <td align="center"><b>NAMA PANGGILAN</b></td>
            <td align="center"><b>NILAI AFEKTIF</b></td>
      <td align="center"><b>NILAI PSIKOMOTORIK</b></td>
      <td align="center"><b>STATUS</b></td>
      <td align="center"><b>JENIS KELAMIN</b></td>
      <td align="center"><b>TEMPAT</b></td>
      <td align="center"><b>TANGGAL LAHIR</b></td>
      <td align="center"><b>AGAMA</b></td>
      <td align="center"><b>ANAK KE</b></td>
      <td align="center"><b>JML SDR</b></td>
      <td align="center"><b>ALAMAT</b></td>
      <td align="center"><b>RT</b></td>
      <td align="center"><b>RW</b></td>
      <td align="center"><b>KELURAHAN</b></td>
      <td align="center"><b>KECAMATAN</b></td>
      <td align="center"><b>KABUPATEN</b></td>
      <td align="center"><b>KODEPOS</b></td>
      <td align="center"><b>NISN</b></td>
      <td align="center"><b>NAMA</b></td>
      <td align="center"><b>TEMPAT</b></td>
      <td align="center"><b>TANGGAL LAHIR</b></td>
      <td align="center"><b>ALAMAT</b></td>
      <td align="center"><b>PEKERJAAN</b></td>
      <td align="center"><b>INSTANSI</b></td>
      <td align="center"><b>PENGHASILAN</b></td>
      <td align="center"><b>PENDIDIKAN</b></td>
      <td align="center"><b>ORGANISASI</b></td>
      <td align="center"><b>JABATAN</b></td>
      <td align="center"><b>NO HP</b></td>
      <td align="center"><b>EMAIL</b></td>
      <td align="center"><b>NAMA</b></td>
      <td align="center"><b>TEMPAT</b></td>
      <td align="center"><b>TANGGAL LAHIR</b></td>
      <td align="center"><b>ALAMAT</b></td>
      <td align="center"><b>PEKERJAAN</b></td>
      <td align="center"><b>INSTANSI</b></td>
      <td align="center"><b>PENGHASILAN</b></td>
      <td align="center"><b>PENDIDIKAN</b></td>
      <td align="center"><b>ORGANISASI</b></td>
      <td align="center"><b>JABATAN</b></td>
      <td align="center"><b>NO HP</b></td>
      <td align="center"><b>EMAIL</b></td>
    </b></tr>
  </thead>
  <tbody>
    <?php
				$no=1;
				$qsiswa = mysqli_query($colok, "SELECT * FROM siswa,nilai_siswa , agama WHERE siswa.id_agama=agama.id_agama AND siswa.nopes=nilai_siswa.nopes AND siswa.status='SIAP' OR siswa.id_agama=agama.id_agama AND siswa.nopes=nilai_siswa.nopes  AND siswa.status='BELUM SIAP' ORDER BY siswa.nopes ASC");
				while($a = mysqli_fetch_array($qsiswa)) {
?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $a['nopes']; ?></td>
      <td><?php echo tgl_indo($a['tgl_daftar']); ?></td>
      <td><?php echo $a['nm_siswa']; ?></td>
      <td><?php echo $a['nm_p_siswa']; ?></td>
      <td><?php echo $a['nilai_afektif']; ?></td>
      <td><?php echo $a['nilai_psikomotorik']; ?></td>
      <td><?php echo $a['status']; ?></td>
      <td><?php echo $a['jk']; ?></td>
      <td><?php echo $a['tmp_lahir']; ?></td>
      <td><?php echo tgl_indo($a['tgl_lahir']); ?></td>
      <td><?php echo $a['nm_agama']; ?></td>
      <td><?php echo $a['anak_ke']; ?></td>
      <td><?php echo $a['jml_sdr']; ?></td>
      <td><?php echo $a['alamat']; ?></td>
      <td><?php echo $a['rt']; ?></td>
      <td><?php echo $a['rw']; ?></td>
      <td><?php echo $a['kelurahan']; ?></td>
      <td><?php echo $a['kecamatan']; ?></td>
      <td><?php echo $a['kabupaten']; ?></td>
      <td><?php echo $a['kodepos']; ?></td>
      
      <td><?php echo $a['tmp_tinggal']; ?></td>
      <td><?php echo $a['nm_ayah']; ?></td>
      <td><?php echo $a['tmp_lahir_ayah']; ?></td>
      <td><?php echo $a['tgl_lahir_ayah']; ?></td>
      <td><?php echo $a['alamat_ayah']; ?></td>
      <td><?php
							$qpka = mysqli_query($colok, "SELECT nm_pekerjaan FROM pekerjaan WHERE id_pekerjaan='".$a['pekerjaan_ayah']."'");
							$pka = mysqli_fetch_array($qpka);
							echo $pka['nm_pekerjaan']; 
							?></td>
      <td><?php echo $a['instansi_ayah']; ?></td>
      <td><?php echo $a['penghasilan_ayah']; ?></td>
      <td><?php
						$qpa = mysqli_query($colok, "SELECT nm_pendidikan FROM pendidikan WHERE id_pendidikan='".$a['pendidikan_ayah']."'");
						$pa = mysqli_fetch_array($qpa);
						echo $pa['nm_pendidikan'];
						?></td>
      <td><?php echo $a['org_ayah']; ?></td>
      <td><?php echo $a['jbt_ayah']; ?></td>
      <td><?php echo $a['hp_ayah']; ?></td>
      <td><?php echo $a['email_ayah']; ?></td>
      <td><?php echo $a['nm_ibu']; ?></td>
      <td><?php echo $a['tmp_lahir_ibu']; ?></td>
      <td><?php echo $a['tgl_lahir_ibu']; ?></td>
      <td><?php echo $a['alamat_ibu']; ?></td>
      <td><?php
							$qpkibu = mysqli_query($colok, "SELECT nm_pekerjaan FROM pekerjaan WHERE id_pekerjaan='".$a['pekerjaan_ibu']."'");
							$pkibu = mysqli_fetch_array($qpkibu);
							echo $pkibu['nm_pekerjaan']; 
							?></td>
      <td><?php echo $a['instansi_ibu']; ?></td>
      <td><?php echo $a['penghasilan_ibu']; ?></td>
      <td><?php
						$qpi = mysqli_query($colok, "SELECT nm_pendidikan FROM pendidikan WHERE id_pendidikan='".$a['pendidikan_ibu']."'");
						$pi = mysqli_fetch_array($qpi);
						echo $pi['nm_pendidikan'];
						?></td>
      <td><?php echo $a['org_ibu']; ?></td>
      <td><?php echo $a['jbt_ibu']; ?></td>
      <td><?php echo $a['hp_ibu']; ?></td>
      <td><?php echo $a['email_ibu']; ?></td>
    </tr>
    <?php
					$no++;
				}
				?>
  </tbody>
</table>
<?php	
	}
	elseif ($module=='belumkonfirmasi' AND $act=='export-excel'){
		$tgl =date('d-m-Y-His');
		// Fungsi header dengan mengirimkan raw data excel
		header("Content-type: application/vnd-ms-excel");
		// Mendefinisikan nama file ekspor "JurnalGuru-bulan-tahun.xls"
		header("Content-Disposition: attachment; filename=DataPendaftar-BelumKonfirmasi".$tgl.".xls");
?>
<table border="1">
  <thead>
    <tr style="background: #cccccc;">
      <td align="center" valign="middle" rowspan="2"><b>NO</b></td>
      <td align="center" colspan="19"><b>DATA SISWA</b></td>
      <td align="center" colspan="12"><b>DATA AYAH</b></td>
      <td align="center" colspan="12"><b>DATA IBU</b></td>
    </tr>
    <tr style="background: #cccccc;"><b>
      <td align="center"><b>NOPES</b></td>
      <td align="center"><b>TGL DAFTAR</b></td>
      <td align="center" valign="middle"><b>NAMA LENGKAP</b></td>
      <td align="center"><b>NAMA PANGGILAN</b></td>
      <td align="center"><b>JENIS KELAMIN</b></td>
      <td align="center"><b>TEMPAT</b></td>
      <td align="center"><b>TANGGAL LAHIR</b></td>
      <td align="center"><b>AGAMA</b></td>
      <td align="center"><b>ANAK KE</b></td>
      <td align="center"><b>JML SDR</b></td>
      <td align="center"><b>ALAMAT</b></td>
      <td align="center"><b>RT</b></td>
      <td align="center"><b>RW</b></td>
      <td align="center"><b>KELURAHAN</b></td>
      <td align="center"><b>KECAMATAN</b></td>
      <td align="center"><b>KABUPATEN</b></td>
      <td align="center"><b>KODEPOS</b></td>
      <td align="center"><b>NISN</b></td>
      <td align="center"><b>NAMA</b></td>
      <td align="center"><b>TEMPAT</b></td>
      <td align="center"><b>TANGGAL LAHIR</b></td>
      <td align="center"><b>ALAMAT</b></td>
      <td align="center"><b>PEKERJAAN</b></td>
      <td align="center"><b>INSTANSI</b></td>
      <td align="center"><b>PENGHASILAN</b></td>
      <td align="center"><b>PENDIDIKAN</b></td>
      <td align="center"><b>ORGANISASI</b></td>
      <td align="center"><b>JABATAN</b></td>
      <td align="center"><b>NO HP</b></td>
      <td align="center"><b>EMAIL</b></td>
      <td align="center"><b>NAMA</b></td>
      <td align="center"><b>TEMPAT</b></td>
      <td align="center"><b>TANGGAL LAHIR</b></td>
      <td align="center"><b>ALAMAT</b></td>
      <td align="center"><b>PEKERJAAN</b></td>
      <td align="center"><b>INSTANSI</b></td>
      <td align="center"><b>PENGHASILAN</b></td>
      <td align="center"><b>PENDIDIKAN</b></td>
      <td align="center"><b>ORGANISASI</b></td>
      <td align="center"><b>JABATAN</b></td>
      <td align="center"><b>NO HP</b></td>
      <td align="center"><b>EMAIL</b></td>
    </b></tr>
  </thead>
  <tbody>
    <?php
				$no=1;
				$qsiswa = mysqli_query($colok, "SELECT * from siswa,agama WHERE siswa.id_agama=agama.id_agama AND status='DAFTAR'");
				while($a = mysqli_fetch_array($qsiswa)) {
?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $a['nopes']; ?></td>
      <td><?php echo tgl_indo($a['tgl_daftar']); ?></td>
      <td><?php echo $a['nm_siswa']; ?></td>
      <td><?php echo $a['nm_p_siswa']; ?></td>
      <td><?php echo $a['jk']; ?></td>
      <td><?php echo $a['tmp_lahir']; ?></td>
      <td><?php echo tgl_indo($a['tgl_lahir']); ?></td>
      <td><?php echo $a['nm_agama']; ?></td>
      <td><?php echo $a['anak_ke']; ?></td>
      <td><?php echo $a['jml_sdr']; ?></td>
      <td><?php echo $a['alamat']; ?></td>
      <td><?php echo $a['rt']; ?></td>
      <td><?php echo $a['rw']; ?></td>
      <td><?php echo $a['kelurahan']; ?></td>
      <td><?php echo $a['kecamatan']; ?></td>
      <td><?php echo $a['kabupaten']; ?></td>
      <td><?php echo $a['kodepos']; ?></td>
      
      <td><?php echo $a['tmp_tinggal']; ?></td>
      <td><?php echo $a['nm_ayah']; ?></td>
      <td><?php echo $a['tmp_lahir_ayah']; ?></td>
      <td><?php echo $a['tgl_lahir_ayah']; ?></td>
      <td><?php echo $a['alamat_ayah']; ?></td>
      <td><?php
							$qpka = mysqli_query($colok, "SELECT nm_pekerjaan FROM pekerjaan WHERE id_pekerjaan='".$a['pekerjaan_ayah']."'");
							$pka = mysqli_fetch_array($qpka);
							echo $pka['nm_pekerjaan']; 
							?></td>
      <td><?php echo $a['instansi_ayah']; ?></td>
      <td><?php echo $a['penghasilan_ayah']; ?></td>
      <td><?php
						$qpa = mysqli_query($colok, "SELECT nm_pendidikan FROM pendidikan WHERE id_pendidikan='".$a['pendidikan_ayah']."'");
						$pa = mysqli_fetch_array($qpa);
						echo $pa['nm_pendidikan'];
						?></td>
      <td><?php echo $a['org_ayah']; ?></td>
      <td><?php echo $a['jbt_ayah']; ?></td>
      <td><?php echo $a['hp_ayah']; ?></td>
      <td><?php echo $a['email_ayah']; ?></td>
      <td><?php echo $a['nm_ibu']; ?></td>
      <td><?php echo $a['tmp_lahir_ibu']; ?></td>
      <td><?php echo $a['tgl_lahir_ibu']; ?></td>
      <td><?php echo $a['alamat_ibu']; ?></td>
      <td><?php
							$qpkibu = mysqli_query($colok, "SELECT nm_pekerjaan FROM pekerjaan WHERE id_pekerjaan='".$a['pekerjaan_ibu']."'");
							$pkibu = mysqli_fetch_array($qpkibu);
							echo $pkibu['nm_pekerjaan']; 
							?></td>
      <td><?php echo $a['instansi_ibu']; ?></td>
      <td><?php echo $a['penghasilan_ibu']; ?></td>
      <td><?php
						$qpi = mysqli_query($colok, "SELECT nm_pendidikan FROM pendidikan WHERE id_pendidikan='".$a['pendidikan_ibu']."'");
						$pi = mysqli_fetch_array($qpi);
						echo $pi['nm_pendidikan'];
						?></td>
      <td><?php echo $a['org_ibu']; ?></td>
      <td><?php echo $a['jbt_ibu']; ?></td>
      <td><?php echo $a['hp_ibu']; ?></td>
      <td><?php echo $a['email_ibu']; ?></td>
    </tr>
    <?php
					$no++;
				}
				?>
  </tbody>
</table>
<?php	
	}elseif ($module=='konfirmasi' AND $act=='export-excel'){
		$tgl =date('d-m-Y-His');
		// Fungsi header dengan mengirimkan raw data excel
		header("Content-type: application/vnd-ms-excel");
		// Mendefinisikan nama file ekspor "JurnalGuru-bulan-tahun.xls"
		header("Content-Disposition: attachment; filename=DataPendaftar-SudahKonfirmasi".$tgl.".xls");
?>
<table border="1">
  <thead>
    <tr style="background: #cccccc;">
      <td align="center" valign="middle" rowspan="2"><b>NO</b></td>
      <td align="center" colspan="19"><b>DATA SISWA</b></td>
      <td align="center" colspan="12"><b>DATA AYAH</b></td>
      <td align="center" colspan="12"><b>DATA IBU</b></td>
    </tr>
    <tr style="background: #cccccc;"><b>
      <td align="center"><b>NOPES</b></td>
      <td align="center"><b>TGL DAFTAR</b></td>
      <td align="center" valign="middle"><b>NAMA LENGKAP</b></td>
      <td align="center"><b>NAMA PANGGILAN</b></td>
      <td align="center"><b>JENIS KELAMIN</b></td>
      <td align="center"><b>TEMPAT</b></td>
      <td align="center"><b>TANGGAL LAHIR</b></td>
      <td align="center"><b>AGAMA</b></td>
      <td align="center"><b>ANAK KE</b></td>
      <td align="center"><b>JML SDR</b></td>
      <td align="center"><b>ALAMAT</b></td>
      <td align="center"><b>RT</b></td>
      <td align="center"><b>RW</b></td>
      <td align="center"><b>KELURAHAN</b></td>
      <td align="center"><b>KECAMATAN</b></td>
      <td align="center"><b>KABUPATEN</b></td>
      <td align="center"><b>KODEPOS</b></td>
      <td align="center"><b>NISN</b></td>
      <td align="center"><b>NAMA</b></td>
      <td align="center"><b>TEMPAT</b></td>
      <td align="center"><b>TANGGAL LAHIR</b></td>
      <td align="center"><b>ALAMAT</b></td>
      <td align="center"><b>PEKERJAAN</b></td>
      <td align="center"><b>INSTANSI</b></td>
      <td align="center"><b>PENGHASILAN</b></td>
      <td align="center"><b>PENDIDIKAN</b></td>
      <td align="center"><b>ORGANISASI</b></td>
      <td align="center"><b>JABATAN</b></td>
      <td align="center"><b>NO HP</b></td>
      <td align="center"><b>EMAIL</b></td>
      <td align="center"><b>NAMA</b></td>
      <td align="center"><b>TEMPAT</b></td>
      <td align="center"><b>TANGGAL LAHIR</b></td>
      <td align="center"><b>ALAMAT</b></td>
      <td align="center"><b>PEKERJAAN</b></td>
      <td align="center"><b>INSTANSI</b></td>
      <td align="center"><b>PENGHASILAN</b></td>
      <td align="center"><b>PENDIDIKAN</b></td>
      <td align="center"><b>ORGANISASI</b></td>
      <td align="center"><b>JABATAN</b></td>
      <td align="center"><b>NO HP</b></td>
      <td align="center"><b>EMAIL</b></td>
    </b></tr>
  </thead>
  <tbody>
    <?php
				$no=1;
				$qsiswa = mysqli_query($colok, "SELECT * from siswa,agama WHERE siswa.id_agama=agama.id_agama AND status='KONFIRMASI'");
				while($a = mysqli_fetch_array($qsiswa)) {
?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $a['nopes']; ?></td>
      <td><?php echo tgl_indo($a['tgl_daftar']); ?></td>
      <td><?php echo $a['nm_siswa']; ?></td>
      <td><?php echo $a['nm_p_siswa']; ?></td>
      <td><?php echo $a['jk']; ?></td>
      <td><?php echo $a['tmp_lahir']; ?></td>
      <td><?php echo tgl_indo($a['tgl_lahir']); ?></td>
      <td><?php echo $a['nm_agama']; ?></td>
      <td><?php echo $a['anak_ke']; ?></td>
      <td><?php echo $a['jml_sdr']; ?></td>
      <td><?php echo $a['alamat']; ?></td>
      <td><?php echo $a['rt']; ?></td>
      <td><?php echo $a['rw']; ?></td>
      <td><?php echo $a['kelurahan']; ?></td>
      <td><?php echo $a['kecamatan']; ?></td>
      <td><?php echo $a['kabupaten']; ?></td>
      <td><?php echo $a['kodepos']; ?></td>
      
      <td><?php echo $a['tmp_tinggal']; ?></td>
      <td><?php echo $a['nm_ayah']; ?></td>
      <td><?php echo $a['tmp_lahir_ayah']; ?></td>
      <td><?php echo $a['tgl_lahir_ayah']; ?></td>
      <td><?php echo $a['alamat_ayah']; ?></td>
      <td><?php
							$qpka = mysqli_query($colok, "SELECT nm_pekerjaan FROM pekerjaan WHERE id_pekerjaan='".$a['pekerjaan_ayah']."'");
							$pka = mysqli_fetch_array($qpka);
							echo $pka['nm_pekerjaan']; 
							?></td>
      <td><?php echo $a['instansi_ayah']; ?></td>
      <td><?php echo $a['penghasilan_ayah']; ?></td>
      <td><?php
						$qpa = mysqli_query($colok, "SELECT nm_pendidikan FROM pendidikan WHERE id_pendidikan='".$a['pendidikan_ayah']."'");
						$pa = mysqli_fetch_array($qpa);
						echo $pa['nm_pendidikan'];
						?></td>
      <td><?php echo $a['org_ayah']; ?></td>
      <td><?php echo $a['jbt_ayah']; ?></td>
      <td><?php echo $a['hp_ayah']; ?></td>
      <td><?php echo $a['email_ayah']; ?></td>
      <td><?php echo $a['nm_ibu']; ?></td>
      <td><?php echo $a['tmp_lahir_ibu']; ?></td>
      <td><?php echo $a['tgl_lahir_ibu']; ?></td>
      <td><?php echo $a['alamat_ibu']; ?></td>
      <td><?php
							$qpkibu = mysqli_query($colok, "SELECT nm_pekerjaan FROM pekerjaan WHERE id_pekerjaan='".$a['pekerjaan_ibu']."'");
							$pkibu = mysqli_fetch_array($qpkibu);
							echo $pkibu['nm_pekerjaan']; 
							?></td>
      <td><?php echo $a['instansi_ibu']; ?></td>
      <td><?php echo $a['penghasilan_ibu']; ?></td>
      <td><?php
						$qpi = mysqli_query($colok, "SELECT nm_pendidikan FROM pendidikan WHERE id_pendidikan='".$a['pendidikan_ibu']."'");
						$pi = mysqli_fetch_array($qpi);
						echo $pi['nm_pendidikan'];
						?></td>
      <td><?php echo $a['org_ibu']; ?></td>
      <td><?php echo $a['jbt_ibu']; ?></td>
      <td><?php echo $a['hp_ibu']; ?></td>
      <td><?php echo $a['email_ibu']; ?></td>
    </tr>
    <?php
					$no++;
				}
				?>
  </tbody>
</table>





<?php	
	}
	elseif ($module=='pendaftaran' AND $act=='export-pdf'){
		include "../../../config/colokan.php";
require('../../../fpdf/fpdf.php');


$result=mysqli_query($colok,"SELECT * FROM siswa,  nilai_siswa WHERE siswa.nopes=nilai_siswa.nopes");

//Inisiasi untuk membuat header kolom
$column_nopes = "";
$column_nm_siswa = "";
$column_tmp_lahir = "";
$column_tgl_lahir = "";
$column_alamat = "";
$column_nilai_afektif = "";
$column_nilai_psikomotorik = "";
$column_status ="";


//For each row, add the field to the corresponding column
while($row = mysqli_fetch_array($result))
{
    $nopes = $row["nopes"];
    $nm_siswa = $row["nm_siswa"];
    $tmp_lahir = $row["tmp_lahir"];
    $tgl_lahir = $row["tgl_lahir"];
    $alamat = $row["alamat"];
    $nilai_afektif = $row["nilai_afektif"];
    $nilai_psikomotorik = $row["nilai_psikomotorik"];
    $status = $row["status"];
 
    

    $column_nopes = $column_nopes.$nopes."\n";
    $column_nm_siswa = $column_nm_siswa.$nm_siswa."\n";
    $column_tmp_lahir = $column_tmp_lahir.$tmp_lahir."\n";
    $column_tgl_lahir = $column_tgl_lahir.$tgl_lahir."\n";
    $column_alamat = $column_alamat.$alamat."\n";
    $column_nilai_afektif = $column_nilai_afektif.$nilai_afektif."\n";
    $column_nilai_psikomotorik = $column_nilai_psikomotorik.$nilai_psikomotorik."\n";
    $column_status = $column_status.$status."\n";
    

//Create a new PDF file
$pdf = new FPDF('L','mm',array(297,210)); //L For Landscape / P For Portrait
$pdf->AddPage();

//Menambahkan Gambar
//$pdf->Image('../foto/logo.png',10,10,-175);
$pdf->Image('../../../images/logo.png',27,12,29);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(125);
$pdf->Cell(30,10,'DATA PESERTA DIDIK BARU YANG TELAH MENGIKUTI TEST',0,0,'C');
$pdf->Ln();
$pdf->SetFont('Arial','B',23);
$pdf->Cell(125);
$pdf->Cell(30,10,'MI ULUL ALBAAB MADANI',0,0,'C');
$pdf->Ln();
$pdf->Cell(125);
$pdf->SetFont('Times','B',10);
$pdf->Cell(30,5,'Kav. Islamic Village Blok P9 No 11, Kelapa Dua Kab. Tangerang',0,0,'C');
$pdf->Ln();
$pdf->Cell(125);
$pdf->SetFont('Times','B',10);
$pdf->Cell(30,5,'Telp/Fax = 021-54213737 | Email : misululalbaab@gmail.com',0,0,'C');
$pdf->Ln();

}
//Fields Name position
$Y_Fields_Name_position = 45;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(0,153,51);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);
$pdf->Cell(25,8,'No Peserta',1,0,'C',1);
$pdf->SetX(30);
$pdf->Cell(60,8,'Nama',1,0,'C',1);
$pdf->SetX(90);
$pdf->Cell(25,8,'Tempat Lahir',1,0,'C',1);
$pdf->SetX(115);
$pdf->Cell(25,8,'Tanggal Lahir',1,0,'C',1);
$pdf->SetX(140);
$pdf->Cell(60,8,'Alamat',1,0,'C',1);
$pdf->SetX(200);
$pdf->Cell(30,8,'  Nilai Afektif',1,0,'L',1);
$pdf->SetX(225);
$pdf->Cell(35,8,'Nilai Psikomotorik',1,0,'C',1);
$pdf->SetX(260);
$pdf->Cell(32,8,'Status',1,0,'C',1);
$pdf->Ln();

//Table position, under Fields Name
$Y_Table_Position = 53;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(25,6,$column_nopes,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(30);
$pdf->MultiCell(60,6,$column_nm_siswa,1,'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(90);
$pdf->MultiCell(25,6,$column_tmp_lahir,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(115);
$pdf->MultiCell(25,6,$column_tgl_lahir,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(140);
$pdf->MultiCell(60,6,$column_alamat,1,'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(200);
$pdf->MultiCell(25,6,$column_nilai_afektif,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(225);
$pdf->MultiCell(35,6,$column_nilai_psikomotorik,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(260);
$pdf->MultiCell(32,6,$column_status,1,'C');

$pdf->Ln(15);
//Move to the right
$pdf->Cell(200.4);
$pdf->MultiCell(0,5,"Tangerang, ".tgl_indo($tgl_saiki),0,'J');

$pdf->SetFont('Times','B',12);
$pdf->Cell(200.4);
$pdf->MultiCell(0,5,"Panitia PPDB MIS Ulul Albaab Madani",0,'J');
$pdf->Ln(20);
$pdf->Cell(200.4);
$pdf->MultiCell(0,5,$_SESSION['namalengkap'],0,'J');
//Line break

$pdf->Output();
		
	
	}
}
?>
