<?php
include "../../../config/colokan.php";
require('fpdf17/fpdf.php');


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

$pdf->SetFont('Arial','B',13);
$pdf->Cell(125);
$pdf->Cell(30,10,'DATA PESERTA DIDIK BARU DENGAN STATUS $status',0,0,'C');
$pdf->Ln();
$pdf->Cell(125);
$pdf->Cell(30,10,'MI ULUL ALBAAB MADANI',0,0,'C');
$pdf->Ln();

}
//Fields Name position
$Y_Fields_Name_position = 30;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(110,180,230);
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
$pdf->Cell(30,8,'Nilai Afektif',1,0,'C',1);
$pdf->SetX(230);
$pdf->Cell(30,8,'Nilai Psikomotorik',1,0,'C',1);
$pdf->SetX(260);
$pdf->Cell(32,8,'Status',1,0,'C',1);
$pdf->Ln();

//Table position, under Fields Name
$Y_Table_Position = 38;

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
$pdf->MultiCell(30,6,$column_nilai_afektif,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(230);
$pdf->MultiCell(30,6,$column_nilai_psikomotorik,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(260);
$pdf->MultiCell(32,6,$column_status,1,'C');

$pdf->Output();
?>