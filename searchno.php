
<?php
$nopes= $_POST['nopes'];
$ada = mysqli_query($colok,"SELECT * from siswa,nilai_siswa where nilai_siswa.nopes='$nopes' and siswa.nopes='$nopes'");
$adaengga = mysqli_num_rows($ada);
if($adaengga == 0) echo "<script type='text/javascript'>alert('Nomor Peserta Salah atau Belum Terdaftar');</script>';<meta http-equiv='refresh' content='0; url=pengumuman'>";
else 
echo "<div align='center'><h4>Hasil Pencarian</h4></div>";
echo "<table width='400' class='table table-striped table-hover'>";
while ($datanya = mysqli_fetch_array($ada)) {  //fetch the result from query into an array
echo "
 <tr class='active'>
    <td width='180'>No Peserta </td>
    <td colspan='3'><strong>".$datanya['id_siswa']."</strong></td>
  </tr>
  <tr>
    <td>Nama Lengkap</td>
    <td colspan='3'><font style='text-transform: capitalize;'><strong>".$datanya['nm_siswa']."</strong></font></td>
  </tr>
  <tr>
    <td>Nilai Afektif</td>
    <td colspan='3'><font style='text-transform: capitalize;'><strong>".$datanya['nilai_afektif']."</strong></font></td>
  </tr>
  <tr class='active'>
  <tr>
    <td>Keterangan</td>
    <td colspan='3'><font color='#0066FF' size='5' style='text-transform: uppercase;'>".$datanya['status']."</td>
  </tr>";
echo "</table>";


echo "<div align='center'><a href='printsk.php?noUjian=".$datanya['nopes']."' class='btn btn-success'>Cetak Surat Keterangan Kelulusan</a></div> <br> ";

echo "<div align='center'><a href='/daftarulang' class='btn btn-danger'>Lihat Prosedur Pendaftaran</a></div>";
}
?>