<?php
@require_once 'fpdf/fpdf.php';
@require_once 'config/colokan.php';
include "config/library.php";


class PDF extends FPDF
{
//Page header
function Header()
{

	//Logo
	$this->Image('images/logo.png',27,8,29);
	//Times bold 18
	$this->SetFont('Times','',18);
	//Move to the right
	$this->Cell(92);
	//Title
	$this->Cell(30,6,'YAYASAN ULUL ALBAAB',0,1,'C');
	//Times bold 12
	$this->SetFont('Times','',12);
	//Move to the right
	$this->Cell(92);
	$this->Cell(30,4,'MIS ULUL ALBAAB MADANI',0,1,'C');
	//Times bold 14
	$this->SetFont('Times','',12);
	//Move to the right
	$this->Cell(92);
	$this->Cell(30,6,'Kav. Islamic Village Blok P9 No. 11',0,1,'C');
	//Times bold 12
	$this->SetFont('Times','',12);
	//Move to the right
	$this->Cell(92);
	$this->Cell(30,4,'www.ulul-albaab.com   e-mail : misululalbaab@gmail.com',0,1,'C');
	//Set Line
    $this->SetLineWidth(0.5);
    //Line
	$this->Line(15,38,195,38);
	//Line break
	$this->Ln(10);
    
}

}
//$NoUjian = "$_POST[kd1]-$_POST[kd2]-$_POST[kd3]-$_POST[kd4]";

$nopes = $_REQUEST['nopes'];
$sql    = "SELECT * FROM siswa, nilai_siswa, sekolah WHERE siswa.nopes='$nopes' AND nilai_siswa.nopes='$nopes'";
$query  = mysqli_query($colok,$sql);
$data   = mysqli_fetch_array($query);
$statusgbr   = $data['statusgbr'];;
$nm_siswa        = $data['nm_siswa'];
$tgl_lahir        = $data['tgl_lahir'];
$tempat        = $data['tmp_lahir'];
$nilai_afektif	= $data['nilai_afektif'];
$nilai_psikomotorik	= $data['nilai_psikomotorik'];
$tahun_ajaran   = $data['tahun_ajaran'];;
$kepsek        = $data['kepsek'];
$logo=$data['logo'];

$text = "Berdasarkan keputusan Ketua Panitia Penerimaan Peserta Didik Baru Tahun Pelajaran $tahun_ajaran, maka dengan ini menyatakan bahwa :";
//Instanciation of inherited class
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetMargins(25.4, 25.4, 25.4);
$pdf->SetFont('Times','U',12);
//Move to the right
$pdf->Cell(15.4);
$pdf->MultiCell(0,5,"SURAT PENGUMUMAN",0,'C');
$pdf->SetFont('Times','',11);
$pdf->MultiCell(0,5,"Nomor :     /MIS-UAM/PPDB/VI/2016",0,'C');
//Line break
$pdf->Ln(5);
$pdf->SetFont('Times','',12);
$pdf->MultiCell(0,5,$text,0,'J');
//Line break
$pdf->Ln(5);
//Move to the right
$pdf->Cell(15.4);
$pdf->MultiCell(0,5,"Nomor Peserta                 : ".$nopes,0,'J');
//Move to the right
$pdf->Cell(15.4);
$pdf->MultiCell(0,5,"Nama Lengkap                : ".$nm_siswa,0,'J');
//Move to the right
$pdf->Cell(15.4);
$pdf->MultiCell(0,5,"Tempat/Tanggal Lahir     : ".$tempat.", ".tgl_indo($tgl_lahir),0,'J');
//Move to the right
$pdf->Cell(15.4);
$pdf->MultiCell(0,5,"Nilai Afektif                     : ".$nilai_afektif,0,'J');
$pdf->Cell(15.4);
$pdf->MultiCell(0,5,"Nilai Psikomotorik           : ".$nilai_psikomotorik,0,'J');
//Line break
$pdf->Ln(20);
$pdf->Image("images/".$statusgbr.".jpg",80,100,60);
$pdf->Ln(5);
$pdf->MultiCell(0,5,"Sebagai Peserta Didik Baru MI Ulul Albaab Madani Tahun Pelajaran $tahun_ajaran",0,'C');
//Line break
$pdf->Ln(5);
$pdf->MultiCell(0,5,"Demikian pemberitahuan ini kami sampaikan agar diketahui dan dimaklumi.",0,'J');
//Line break
$pdf->Ln(15);
//Move to the right
$pdf->Cell(105.4);
$pdf->MultiCell(0,5,"Tangerang, ".tgl_indo($tgl_saiki),0,'J');
$pdf->Cell(105.4);
$pdf->MultiCell(0,5,"Kepala Sekolah,",0,'J');
//Line break
$pdf->Ln(5);
//Move to the right
$pdf->Cell(105,1);
$pdf->MultiCell(0,5,$kepsek,0,'J');

//Line break
$pdf->Ln(5);
$pdf->MultiCell(0,5,"",0,'J');
$pdf->MultiCell(0,5,"",0,'J');
$pdf->MultiCell(0,5,"",0,'J');

$pdf->Output();

?>
