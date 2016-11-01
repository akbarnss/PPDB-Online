<?php 
define('FPDF_FONTPATH', 'fpdf/font/');
require('fpdf/fpdf.php');

include "config/colokan.php";
include "config/library.php";


$qsekolah = mysqli_query($colok,"SELECT * FROM sekolah where id_sekolah=1");
$qsiswa = mysqli_query($colok,"SELECT * FROM siswa, agama WHERE siswa.id_agama=agama.id_agama and siswa.file='$_GET[id].pdf'");

$s=mysqli_fetch_array($qsekolah);
$r=mysqli_fetch_array($qsiswa);

$lahir   = tgl_indo($r['tgl_lahir']);
$tgl_lahir_ayah   = tgl_indo($r['tgl_lahir_ayah']);
$tgl_lahir_ibu    = tgl_indo($r['tgl_lahir_ibu']);
$tgl_lahir_wali   = tgl_indo($r['tgl_lahir_wali']);

$pdf=new FPDF('P','mm','A5');
$pdf->AddPage();
//ambil Gambar logo dan judul
$pdf->Image("images/$s[logo]", 10, 12, 15);
//Judul Laporan PDF
$pdf->SetFont('Arial','B','12');
$pdf->Cell(20,6,'',0,0,'L');
$pdf->Cell(145,6,'FORMULIR PENDAFTARAN',0,1,'L');
$pdf->Cell(20,6,'',0,0,'L');
$pdf->Cell(145,6,'PENERIMAAN PESERTA DIDIK BARU TAHUN '.$s['tahun_ajaran'],0,1,'L');
$pdf->Cell(20,6,'',0,0,'L');
$pdf->Cell(145,6,$s['nama_sekolah'],0,1,'L');

$pdf->Ln(8);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,8,'No Pendaftaran',1,0,'L');
$pdf->Cell(50,8,$r['nopes'],1,0,'L'); 


$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(70,6,'DATA SISWA',0,1,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(60,6,'1.   Nama Lengkap',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['nm_siswa'],0,1,'L');

$pdf->Cell(60,6,'2.   Nama Panggilan',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['nm_p_siswa'],0,1,'L');

$pdf->Cell(60,6,'3.   Jenis Kelamin',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
if($r['jk']=="L") $jk="Laki-laki"; elseif($r['jk']=="P") $jk="Perempuan";
$pdf->Cell(100,6,$jk,0,1,'L');

$pdf->Cell(60,6,'4.   Tempat, Tanggal Lahir',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['tmp_lahir'].', '.$lahir ,0,1,'L');

$pdf->Cell(60,6,'5.   Agama',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['nm_agama'],0,1,'L');

$pdf->Cell(60,6,'6.   Anak ke',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['anak_ke'].'  dari  '.$r['jml_sdr'].'  Bersaudara',0,1,'L');

$pdf->Cell(60,6,'7.   Alamat',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['alamat'].'  RT : '.$r['rt'].'  /  RW : '.$r['rw'],0,1,'L');

$pdf->Cell(60,6,'     a.   Kelurahan',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['kelurahan'],0,1,'L');

$pdf->Cell(60,6,'     b.   Kecamatan',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['kecamatan'],0,1,'L');

$pdf->Cell(60,6,'     c.   Kabupaten / Kota',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['kabupaten'],0,1,'L');

$pdf->Cell(60,6,'     d.   Kode POS',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['kodepos'],0,1,'L');


$pdf->Cell(60,6,'     f.   Bertempat tinggal dengan',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['tmp_tinggal'],0,1,'L');



$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(70,6,'DATA PRIBADI ORANG TUA SISWA',0,1,'L');
$pdf->Cell(70,6,'A.   AYAH',0,1,'L');

$pdf->SetFont('Arial','',10);
$pdf->Cell(60,6,'1.   Nama',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['nm_ayah'],0,1,'L');

$pdf->Cell(60,6,'2.   Tempat, Tanggal Lahir',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['tmp_lahir_ayah'].', '.$tgl_lahir_ayah,0,1,'L');

$pdf->Cell(60,6,'3.   Alamat',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['alamat_ayah'],0,1,'L');

$pdf->Cell(60,6,'4.   Pekerjaan',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$qp_ayah = mysqli_query($colok, "SELECT nm_pekerjaan FROM pekerjaan WHERE id_pekerjaan=$r[pekerjaan_ayah]");
$qpa = mysqli_fetch_array($qp_ayah);
$pdf->Cell(100,6,$qpa['nm_pekerjaan'],0,1,'L');

$pdf->Cell(60,6,'5.   Instansi',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['instansi_ayah'],0,1,'L');

$pdf->Cell(60,6,'6.   Penghasilan/bulan',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,'Rp. '.rupiah($r['penghasilan_ayah']).',-',0,1,'L');

$pdf->Cell(60,6,'7.   Pendidikan Terakhir',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$qpd_ayah = mysqli_query($colok, "SELECT nm_pendidikan FROM pendidikan WHERE id_pendidikan=$r[pendidikan_ayah]");
$qpda = mysqli_fetch_array($qpd_ayah);
$pdf->Cell(100,6,$qpda['nm_pendidikan'],0,1,'L');

$pdf->Cell(60,6,'8.   Pengalaman Berorganisasi',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
if($r['org_ayah']=="" or $r['org_ayah']=="-") {
	$org = $r['org_ayah'];
} else {
	$org = $r['org_ayah']."       Jabatan : ".$r['jbt_ayah'];
}
$pdf->Cell(100,6,$org,0,1,'L');

$pdf->Cell(60,6,'9.   No. Telp/HP',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['hp_ayah'],0,1,'L');

$pdf->Cell(60,6,'10. Email',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['email_ayah'],0,1,'L');

$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(70,6,'B.   IBU',0,1,'L');

$pdf->SetFont('Arial','',10);
$pdf->Cell(60,6,'1.   Nama',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['nm_ibu'],0,1,'L');

$pdf->Cell(60,6,'2.   Tempat, Tanggal Lahir',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['tmp_lahir_ibu'].', '.$tgl_lahir_ibu,0,1,'L');

$pdf->Cell(60,6,'3.   Alamat',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['alamat_ibu'],0,1,'L');

$pdf->Cell(60,6,'4.   Pekerjaan',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$qp_ibu = mysqli_query($colok, "SELECT nm_pekerjaan FROM pekerjaan WHERE id_pekerjaan=$r[pekerjaan_ibu]");
$qpi = mysqli_fetch_array($qp_ibu);
$pdf->Cell(100,6,$qpi['nm_pekerjaan'],0,1,'L');

$pdf->Cell(60,6,'5.   Instansi',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['instansi_ibu'],0,1,'L');

$pdf->Cell(60,6,'6.   Penghasilan/bulan',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,'Rp. '.rupiah($r['penghasilan_ibu']).',-',0,1,'L');

$pdf->Cell(60,6,'7.   Pendidikan Terakhir',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$qpd_ibu = mysqli_query($colok, "SELECT nm_pendidikan FROM pendidikan WHERE id_pendidikan=$r[pendidikan_ibu]");
$qpdi = mysqli_fetch_array($qpd_ibu);
$pdf->Cell(100,6,$qpdi['nm_pendidikan'],0,1,'L');

$pdf->Cell(60,6,'8.   Pengalaman Berorganisasi',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
if($r['org_ibu']=="" or $r['org_ibu']=="-") {
	$org = $r['org_ibu'];
} else {
	$org = $r['org_ibu']."       Jabatan : ".$r['jbt_ibu'];
}
$pdf->Cell(100,6,$org,0,1,'L');

$pdf->Cell(60,6,'9.   No. Telp/HP',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['hp_ibu'],0,1,'L');

$pdf->Cell(60,6,'10. Email',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['email_ibu'],0,1,'L');

//--- DATA WALI -------
$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(70,6,'C.   WALI',0,1,'L');

$pdf->SetFont('Arial','',10);
$pdf->Cell(60,6,'1.   Nama',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['nm_wali'],0,1,'L');

$pdf->Cell(60,6,'2.   Tempat, Tanggal Lahir',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['tmp_lahir_wali'].', '.$tgl_lahir_wali,0,1,'L');

$pdf->Cell(60,6,'3.   Alamat',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['alamat_wali'],0,1,'L');

$pdf->Cell(60,6,'4.   Pekerjaan',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$qp_wali = mysqli_query($colok, "SELECT nm_pekerjaan FROM pekerjaan WHERE id_pekerjaan=$r[pekerjaan_wali]");
$qpa = mysqli_fetch_array($qp_wali);
$pdf->Cell(100,6,$qpa['nm_pekerjaan'],0,1,'L');

$pdf->Cell(60,6,'5.   Instansi',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['instansi_wali'],0,1,'L');

$pdf->Cell(60,6,'6.   Penghasilan/bulan',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,'Rp. '.rupiah($r['penghasilan_wali']).',-',0,1,'L');

$pdf->Cell(60,6,'7.   Pendidikan Terakhir',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$qpd_wali = mysqli_query($colok, "SELECT nm_pendidikan FROM pendidikan WHERE id_pendidikan=$r[pendidikan_wali]");
$qpda = mysqli_fetch_array($qpd_wali);
$pdf->Cell(100,6,$qpda['nm_pendidikan'],0,1,'L');

$pdf->Cell(60,6,'8.   Pengalaman Berorganisasi',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
if($r['org_wali']=="" or $r['org_wali']=="-") {
	$org = $r['org_wali'];
} else {
	$org = $r['org_wali']."       Jabatan : ".$r['jbt_wali'];
}
$pdf->Cell(100,6,$org,0,1,'L');

$pdf->Cell(60,6,'9.   No. Telp/HP',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['hp_wali'],0,1,'L');

$pdf->Cell(60,6,'10. Email',0,0,'L');
$pdf->Cell(4,6,':',0,0,'L');
$pdf->Cell(100,6,$r['email_wali'],0,1,'L');

$tgl_daftar = tgl_indo($r['tgl_daftar']);
$pdf->Ln();
$pdf->Cell(130);
$pdf->Cell(60,6,$s['kabupaten'].', '.$tgl_daftar,0,1,'C');
$pdf->Cell(130);
$pdf->Cell(60,6,'Orang Tua/Wali',0,1,'C');
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(130);
$pdf->Cell(60,6,'(.....................................)',0,1,'C');

$pdf->Output('bukti-pendaftaran/'.$_GET['id'].'.pdf','F');

?>