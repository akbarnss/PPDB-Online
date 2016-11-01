<?php

$module = isset($_GET['module']) ? $_GET['module'] : ''; 
if($module=="home") {
	$qberanda = mysqli_query($colok, "SELECT judul, isi_halaman FROM halamanstatis WHERE id_halaman=1");
	$b = mysqli_fetch_array($qberanda);
	echo "<h2 class=\"page-header\">$b[judul]</h2>";
	echo "$b[isi_halaman]";
}elseif($module=="carinopes"){
$nopes= $_POST['nopes'];
$ada = mysqli_query($colok,"SELECT * from siswa,nilai_siswa where nilai_siswa.nopes='$nopes' and siswa.nopes='$nopes'");
$adaengga = mysqli_num_rows($ada);
if($adaengga == 0) echo "<script type='text/javascript'>alert('Nomor Peserta Salah atau Belum Mengikuti Test');</script>';<meta http-equiv='refresh' content='0; url=pengumuman'>";
else 
echo "<div align='center'><h4>Hasil Pencarian</h4></div>";
echo "<table width='400' class='table table-striped table-hover'>";
while ($datanya = mysqli_fetch_array($ada)) { 
$status=$datanya['status'];
echo "
 <tr class='active'>
    <td width='180'>No Peserta </td>
    <td colspan='3'><strong>".$datanya['nopes']."</strong></td>
  </tr>
  <tr>
    <td>Nama Lengkap</td>
    <td colspan='3'><font style='text-transform: capitalize;'><strong>".$datanya['nm_siswa']."</strong></font></td>
  </tr>
  <tr>
    <td>Nilai Afektif</td>
    <td colspan='3'><font style='text-transform: capitalize;'><strong>".$datanya['nilai_afektif']."</strong></font></td>
  </tr>
  <tr>
    <td>Nilai Psikomotorik</td>
    <td colspan='3'><font style='text-transform: capitalize;'><strong>".$datanya['nilai_psikomotorik']."</strong></font></td>
  </tr>
  <tr class='active'>
  <tr>
    <td>Keterangan</td>
    <td colspan='3'><font color='#0066FF' size='5' style='text-transform: uppercase;'>".$status."</td>
  </tr>";
echo "</table>";

if($status="SIAP")
echo "<div align='center'><a href='printsk.php?nopes=".$datanya['nopes']."' target='_blank' class='btn btn-success'>Cetak Surat Pengumuman Hasil Test</a></div> <br> <div align='center'><a href='daftarulang'  target='_blank' class='btn btn-danger'>Lihat Prosedur Daftar Ulang</a></div>";

elseif($status="DAFTAR")
echo "-";
else
echo "<div align='center'><a href='printsk.php?nopes=".$datanya['nopes']."' class='btn btn-success'>Cetak Surat Keterangan Kelulusan</a></div>";
}	
	
	}

elseif($module=="pendaftaran") {?> 
<?php
	$tanggal_saiki = date("Y-m-d G:i:s");
	$qset = mysqli_query($colok, "SELECT pendaftaran FROM setting WHERE id_setting=1");
	$st = mysqli_fetch_array($qset);
	$tp = explode(" - ",$st['pendaftaran']);
	//--pendaftaran awal
	$tpb = explode(" ",$tp[0]); // memisahkan menjadi tanggal dan jam
	$ttpb = explode("/",$tpb[0]); // mecah tanggal 
	$jpb = explode(":",$tpb[1]); // mecah jam
	
	//$jamb="";
	if ($tpb[2] == "PM" AND $jpb[0] < 12) {
		$jam = $jpb[0] + 12;
	}
	elseif ($tpb[2] == 'AM') {
		$jam = $jpb[0];
	}
	else {
		$jam = $jpb[0];
	}
	$jamb = $ttpb[2]."-".$ttpb[1]."-".$ttpb[0]." ".$jam.":".$jpb[1].":00";
	
	//--pendaftaran akhir
	$tpe = explode(" ",$tp[1]); // memisahkan menjadi tanggal dan jam
	$ttpe = explode("/",$tpe[0]); // mecah tanggal 
	$jpe = explode(":",$tpe[1]);
	//$jame="";
	if ($tpe[2] == "PM" AND $jpe[0] < 12) {
		$jams = $jpe[0] + 12;
	}
	elseif ($tpe[2] == 'AM') {
		$jams = $jpe[0];
	}
	else {
		$jams = $jpe[0];
	}
	$jame = $ttpe[2]."-".$ttpb[1]."-".$ttpe[0]." ".$jams.":".$jpe[1].":00";
	
	if($tanggal_saiki < $jamb) {
?>
		<div class="callout callout-info">
			<h4>PENDAFTARAN BELUM DIBUKA</h4>
			<p>Pendaftaran Peserta Didik Baru Dibuka mulai tanggal <?php echo $tp[0], $ttpb[2]."-".$ttpb[1]."-".$ttpb[0]." ".$jam.":".$jpb[1].":00", $tanggal_saiki; ?></p>
		</div>
<?php
	}
	elseif($tanggal_saiki>$jame){
?>
		<div class="callout callout-danger">
			<h4>PENDAFTARAN SUDAH TUTUP</h4>
			<p>Pendaftaran Peserta Didik Baru sudah diTUTUP tanggal <?php echo $tp[1]; ?></p>
		</div>
<?php
	}
	elseif(($tanggal_saiki >= $jamb) AND ($tanggal_saiki<=$jame)) {
?>
    FORMULIR PENDAFTARAN SISWA BARU</h2>
	<form method="post" action="<?php echo $d['alamat_website']; ?>/aksipendaftaran.html" class="form-horizontal">
		<div class="nav-tabs-custom">
			<div class="tab-content">
				<div class="tab-pane active" id="tab_1">
					<h3 class="page-header">A. Data Siswa</h3>
					<div class="form-group">
						<label for="namalengkap" class="col-sm-3 control-label">Nama Lengkap</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="namalengkap" name="namalengkap" placeholder="Nama Lengkap" required />
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="namapanggilan" class="col-sm-3 control-label">Nama Panggilan</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="namapanggilan" name="namapanggilan" placeholder="Nama Panggilan" required />
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="jk" class="col-sm-3 control-label">Jenis Kelamin</label>
						<div class="col-sm-9">
							<input type="radio" name="jk" class="minimal" value="L" checked> &nbsp;Laki-laki &nbsp; 
							<input type="radio" name="jk" class="minimal" value="P"> &nbsp;Perempuan
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="ttl" class="col-sm-3 control-label">Tempat, Tanggal Lahir</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="tempatlahir" name="tempatlahir" placeholder="Tempat Lahir" required />
						</div>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="tgllahir" name="tgllahir" placeholder="Tanggal Lahir" required /> Ex: 20-08-2001
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="agama" class="col-sm-3 control-label">Agama</label>
						<div class="col-sm-4">
							<select class="form-control" id="agama" name="agama" placeholder="Agama" required>
								<?php
								$qa = mysqli_query($colok, "SELECT * FROM agama");
								while($a=mysqli_fetch_array($qa)) {
									echo "<option value=\"$a[id_agama]\">$a[nm_agama]</option>";
								}
								?>
							</select>
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="anakke" class="col-sm-3 control-label">Anak Ke</label>
						<label class="col-sm-2">
							<input type="number" class="form-control" id="anakke" name="anakke" required />
						</label>
						<label for="jmlsdr" class="col-sm-1 control-label">Dari</label>
						<label class="col-sm-2">
							<input type="number" class="form-control" id="jmlsdr" name="jmlsdr" required />
						</label>
						<label for="jmlsdr" class="col-sm-2 control-label">Bersaudara</label>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="alamatlengkap" class="col-sm-3 control-label">Alamat Lengkap</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="alamatlengkap" name="alamatlengkap" placeholder="Alamat Lengkap" required />
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="rt" class="col-sm-offset-3 col-sm-1 control-label">RT</label>
						<label class="col-sm-2">
							<input type="text" class="form-control" id="rt" name="rt" required />
						</label>
						<label for="rw" class="col-sm-1 control-label">RW</label>
						<label class="col-sm-2">
							<input type="text" class="form-control" id="rw" name="rw" required />
						</label>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="kelurahan" class="col-sm-3 control-label">Kelurahan</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="kelurahan" name="kelurahan" placeholder="Kelurahan" required />
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="kecamatan" class="col-sm-3 control-label">Kecamatan</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Kecamatan" required />
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="kabupaten" class="col-sm-3 control-label">Kota / Kabupaten</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="kabupaten" name="kabupaten" placeholder="Kota / Kabupaten" required />
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="kodepos" class="col-sm-3 control-label">Kodepos</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" id="kodepos" name="kodepos" placeholder="Kodepos" required />
						</div>
					</div> <!-- /.form-group -->
					 <!-- /.form-group -->
					<div class="form-group">
						<label for="tempattinggal" class="col-sm-3 control-label">Tinggal Bersama</label>
						<div class="col-sm-9">
							<input type="radio" name="tempattinggal" class="minimal" value="Orang Tua" checked> &nbsp;Orang Tua &nbsp; 
							<input type="radio" name="tempattinggal" class="minimal" value="Wali"> &nbsp;Wali / Saudara &nbsp;&nbsp; </div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<a href="#tab_3" data-toggle="tab" class="btn btn-primary" onclick="javascript:return confirm('Apakah Data Sudah Benar?');">SELANJUTNYA</a> <br /><small><i>*Pastikan data diisi semua</i></small>
						</div>
					</div> <!-- /.form-group -->
				</div><!-- /.tab-pane -->
				
				<!-- DATA SEKOLAH --><!-- /.tab-pane -->
				
				<!-- DATA PRIBADI ORTU AYAH -->
				<div class="tab-pane" id="tab_3">
					<h3 class="page-header">B. Data Pribadi Orang Tua ( AYAH )</h3>
					<div class="form-group">
						<label for="namaayah" class="col-sm-3 control-label">Nama Ayah</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="namaayah" name="namaayah" placeholder="Nama Ayah" required />
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="ttlayah" class="col-sm-3 control-label">Tempat, Tanggal Lahir</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="tempatlahirayah" name="tempatlahirayah" placeholder="Tempat Lahir Ayah ..." required />
						</div>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="tgllahirayah" name="tgllahirayah" placeholder="Tanggal Lahir" required /> Ex: 20-08-2001
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="alamatayah" class="col-sm-3 control-label">ALamat Lengkap</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="alamatayah" name="alamatayah" placeholder="ALamat Lengkap.." required />
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="pekerjaanayah" class="col-sm-3 control-label">Pekerjaan</label>
						<div class="col-sm-9">
							<?php
							ambildata("pekerjaan", "pekerjaanayah", "required");
							?>
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="instansiayah" class="col-sm-3 control-label">Instansi</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="instansiayah" name="instansiayah" placeholder="Instansi Tempat Bekerja.." required />
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="penghasilanayah" class="col-sm-3 control-label">Penghasilan / Bulan</label>
						<div class="col-sm-9">
							<input type="number" class="form-control" id="penghasilanayah" name="penghasilanayah" required />
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="pendidikanayah" class="col-sm-3 control-label">Pendidikan Terakhir</label>
						<div class="col-sm-9">
							<select class="form-control" id="pendidikanayah" name="pendidikanayah" required>
								<?php
								$qpend = mysqli_query($colok, "SELECT * FROM pendidikan ORDER BY id_pendidikan DESC");
								while($p=mysqli_fetch_array($qpend)) {
									echo "<option value=\"$p[id_pendidikan]\">$p[nm_pendidikan]</option>";
								}
								?>
							</select>
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="organisasiayah" class="col-sm-3 control-label">Pengalaman Berorganisasi</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="organisasiayah" name="organisasiayah" placeholder="Nama Organisasi.." required />
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="jabatanayah" class="col-sm-3 control-label">Jabatan</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="jabatanayah" name="jabatanayah" placeholder="Jabatan dalam Organisasi.." required />
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="nohpayah" class="col-sm-3 control-label">No HP</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="nohpayah" name="nohpayah" required />
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="emailayah" class="col-sm-3 control-label">Email</label>
						<div class="col-sm-9">
							<input type="email" class="form-control" id="emailayah" name="emailayah" />
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<a href="#tab_1" data-toggle="tab" class="btn btn-success">SEBELUMNYA</a>
							<a href="#tab_4" data-toggle="tab" class="btn btn-primary" onclick="javascript:return confirm('Apakah Data Sudah Benar?');">SELANJUTNYA</a> <br /><small><i>*Pastikan data diisi semua</i></small>
						</div>
					</div> <!-- /.form-group -->
				</div><!-- /.tab-pane -->
				
				<!-- DATA PRIBADI ORTU IBU -->
				<div class="tab-pane" id="tab_4">
					<h3 class="page-header">B. Data Pribadi Orang Tua ( IBU )</h3>
					<div class="form-group">
						<label for="namaibu" class="col-sm-3 control-label">Nama Ibu</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="namaibu" name="namaibu" placeholder="Nama Ibu" required />
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="ttlibu" class="col-sm-3 control-label">Tempat, Tanggal Lahir</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="tempatlahiribu" name="tempatlahiribu" placeholder="Tempat Lahir Ibu ..." required />
						</div>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="tgllahiribu" name="tgllahiribu" placeholder="Tanggal Lahir" required /> Ex: 20-08-2001
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="alamatibu" class="col-sm-3 control-label">ALamat Lengkap</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="alamatibu" name="alamatibu" placeholder="ALamat Lengkap.." required />
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="pekerjaanibu" class="col-sm-3 control-label">Pekerjaan</label>
						<div class="col-sm-9">
							<?php
							ambildata("pekerjaan", "pekerjaanibu", "required");
							?>
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="instansiibu" class="col-sm-3 control-label">Instansi</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="instansiibu" name="instansiibu" placeholder="Instansi Tempat Bekerja.." required />
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="penghasilanibu" class="col-sm-3 control-label">Penghasilan / Bulan</label>
						<div class="col-sm-9">
							<input type="number" class="form-control" id="penghasilanibu" name="penghasilanibu" required />
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="pendidikanibu" class="col-sm-3 control-label">Pendidikan Terakhir</label>
						<div class="col-sm-9">
							<select class="form-control" id="pendidikanibu" name="pendidikanibu" required>
								<?php
								$qpend = mysqli_query($colok, "SELECT * FROM pendidikan ORDER BY id_pendidikan DESC");
								while($p=mysqli_fetch_array($qpend)) {
									echo "<option value=\"$p[id_pendidikan]\">$p[nm_pendidikan]</option>";
								}
								?>
							</select>
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="organisasiibu" class="col-sm-3 control-label">Pengalaman Berorganisasi</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="organisasiibu" name="organisasiibu" placeholder="Nama Organisasi.." required />
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="jabatanibu" class="col-sm-3 control-label">Jabatan</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="jabatanibu" name="jabatanibu" placeholder="Jabatan dalam Organisasi.." required />
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="nohpibu" class="col-sm-3 control-label">No HP</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="nohpibu" name="nohpibu" required />
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label for="emailibu" class="col-sm-3 control-label">Email</label>
						<div class="col-sm-9">
							<input type="email" class="form-control" id="emailibu" name="emailibu" />
						</div>
					</div> <!-- /.form-group -->
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<a href="#tab_3" data-toggle="tab" class="btn btn-success">SEBELUMNYA</a>
							<input type="submit" class="btn btn-warning" id="daftar" onclick="javascript:return confirm('Apakah Data Sudah Benar?');" name="daftar" value="DAFTAR SEKARANG" />
							<br /><small><i>*Pastikan data diisi semua</i></small>
					  </div>
					</div> <!-- /.form-group -->
				</div><!-- /.tab-pane -->
				
				<!-- DATA PRIBADI ORTU WALI --><!-- /.tab-pane -->
			</div><!-- /.tab-content -->
		</div><!-- nav-tabs-custom -->
	</form>
<?php
	}
}

elseif($module=="pendaftaran-sukses") {
?>
				<h2 class="page-header">FORMULIR PENDAFTARAN SISWA BARU</h2>
				<div class="callout callout-info">
					<h4>PENDAFTARAN ONLINE TELAH BERHASIL</h4>
					<p>SILAHKAN DOWNLOAD DAN CETAK FORMULIR PENDAFTARAN INI. <br />FORMULIR DITUNJUKAN KETIKA VERIFIKASI KE SEKOLAH BERSAMAAN DENGAN SYARAT-SYARAT LAINNYA.</p>
					<p><a href="#" class="btn btn-success" target="_blank">Download Formulir Pendaftaran</a></p>
				</div>
<?php
}

//input data pendaftaran 
elseif($module=="input-pendaftaran") {
	if(isset($_POST['daftar'])) {
		$file = $_POST['namapanggilan']."-".date("YmdHis");
		$files = $file.".pdf";
		$tgl_daftar = date("Y-m-d H:i:s");
		$ip = $_SERVER['REMOTE_ADDR'];
		$tgllahir = tgl_inggris($_POST['tgllahir']);
		$tgllahirayah = tgl_inggris($_POST['tgllahirayah']);
		$tgllahiribu = tgl_inggris($_POST['tgllahiribu']);

	$sqlyo=mysqli_query($colok,"select nopes from siswa order by nopes desc limit 1");
	$dul=mysqli_fetch_array($sqlyo);
	$nomor=$dul['nopes'];
	$nourut=(int)substr($nomor,4,3);
	$nourut++;
	$thnajar1=date('y') + 1;
	$char=date('y').$thnajar1;
	$kode=$char.$nourut;

		$query = "INSERT INTO siswa SET nopes = '$kode',
		nm_siswa = '$_POST[namalengkap]', 
										nm_p_siswa = '$_POST[namapanggilan]', 
										jk = '$_POST[jk]', 
										tmp_lahir = '$_POST[tempatlahir]', 
										tgl_lahir = '$tgllahir', 
										id_agama = '$_POST[agama]', 
										anak_ke = '$_POST[anakke]', 
										jml_sdr = '$_POST[jmlsdr]', 
										alamat = '$_POST[alamatlengkap]', 
										rt = '$_POST[rt]', 
										rw = '$_POST[rw]', 
										kelurahan = '$_POST[kelurahan]', 
										kecamatan = '$_POST[kecamatan]', 
										kabupaten = '$_POST[kabupaten]', 
										kodepos = '$_POST[kodepos]',
										tmp_tinggal = '$_POST[tempattinggal]',  
										nm_ayah = '$_POST[namaayah]', 
										tmp_lahir_ayah = '$_POST[tempatlahirayah]', 
										tgl_lahir_ayah = '$tgllahirayah', 
										alamat_ayah = '$_POST[alamatayah]', 
										pekerjaan_ayah = '$_POST[pekerjaanayah]', 
										instansi_ayah = '$_POST[instansiayah]', 
										penghasilan_ayah = '$_POST[penghasilanayah]', 
										pendidikan_ayah = '$_POST[pendidikanayah]', 
										org_ayah = '$_POST[organisasiayah]', 
										jbt_ayah = '$_POST[jabatanayah]', 
										hp_ayah = '$_POST[nohpayah]', 
										email_ayah = '$_POST[emailayah]', 
										nm_ibu = '$_POST[namaibu]', 
										tmp_lahir_ibu = '$_POST[tempatlahiribu]', 
										tgl_lahir_ibu = '$tgllahiribu', 
										alamat_ibu = '$_POST[alamatibu]', 
										pekerjaan_ibu = '$_POST[pekerjaanibu]', 
										instansi_ibu = '$_POST[instansiibu]', 
										penghasilan_ibu = '$_POST[penghasilanibu]', 
										pendidikan_ibu = '$_POST[pendidikanibu]', 
										org_ibu = '$_POST[organisasiibu]', 
										jbt_ibu = '$_POST[jabatanibu]', 
										hp_ibu = '$_POST[nohpibu]', 
										email_ibu = '$_POST[emailibu]',
								
										status = 'DAFTAR',
										tgl_daftar = '$tgl_daftar', 
										ip = '$ip', 
										file = '$files'";
		$input = mysqli_query($colok, $query);
		if($input) {
		
define('FPDF_FONTPATH', 'fpdf/font/');
require('fpdf/fpdf.php');

$qsekolah = mysqli_query($colok,"SELECT * FROM sekolah where id_sekolah=1");
$qsiswa = mysqli_query($colok,"SELECT * FROM siswa, agama WHERE siswa.id_agama=agama.id_agama and siswa.file='$files'");

$s=mysqli_fetch_array($qsekolah);
$r=mysqli_fetch_array($qsiswa);

$lahir   = tgl_indo($r['tgl_lahir']);
$tgl_lahir_ayah   = tgl_indo($r['tgl_lahir_ayah']);
$tgl_lahir_ibu    = tgl_indo($r['tgl_lahir_ibu']);

$pdf=new FPDF('P','mm',array(330,230));
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
$pdf->SetFont('Arial','',10);

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


//--- DATA AYAH -------
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

//--- DATA IBU -------
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

$tgl_daftar = tgl_indo($r['tgl_daftar']);
$pdf->Ln();
$pdf->Cell(130);
$pdf->Cell(60,6,$s['kabupaten'].', '.$tgl_daftar,0,1,'C');
$pdf->Cell(130);
$pdf->Cell(60,6,'Orang Tua/Wali',0,1,'C');
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(130);
$pdf->Cell(60,6,'(.....................................)',0,1,'C');

$pdf->Output('bukti-pendaftaran/'.$files,'F');

?>
			<h2 class="page-header">FORMULIR PENDAFTARAN SISWA BARU</h2>
			<div class="callout callout-info">
				<h4>PENDAFTARAN ONLINE TELAH BERHASIL</h4>
				<p>SILAHKAN DOWNLOAD DAN CETAK FORMULIR PENDAFTARAN INI. <br />FORMULIR DITUNJUKAN KETIKA VERIFIKASI KE SEKOLAH BERSAMAAN DENGAN SYARAT-SYARAT LAINNYA.</p>
				<p><a href="<?php echo $d['alamat_website']; ?>/bukti-pendaftaran/<?php echo $files; ?>" class="btn btn-success" target="_blank">DOWNLOAD FORMULIR PENDAFTARAN</a></p>
			</div>
<?php
		}
		else {
?>
			<h2 class="page-header">FORMULIR PENDAFTARAN SISWA BARU</h2>
			<div class="callout callout-danger">
				<h4>GAGAL..... <a href="<?php echo $d['alamat_website']; ?>/pendaftaran.html">Silahkan coba lagi</a></h4>
			</div>
<?php
		}
	} 
	else {
?>
			<h2 class="page-header">FORMULIR PENDAFTARAN SISWA BARU</h2>
			<div class="callout callout-danger">
				<h4>Anda Tidak Berhak Mengakses Halaman Ini</h4>
			</div>
<?php
	}
}

// Modul halaman statis
elseif ($module=='halamanstatis'){
	$detail=mysqli_query($colok, "SELECT * FROM halamanstatis WHERE id_halaman='$_GET[id]'");
	$dt   = mysqli_fetch_array($detail);
	$tgl_posting   = tgl_indo($dt['tgl_posting']);
?>
	<h2 class="page-header"><?php echo $dt['judul']; ?></h2>
<?php
	echo "$dt[isi_halaman] <br />";
}



elseif($module=="pengumuman"){
	
	$tgl_saiki = date("Y-m-d G:i:s");
	$pset = mysqli_query($colok, "SELECT pengumuman FROM setting WHERE id_setting=1");
	$stp = mysqli_fetch_array($pset);
	$ptp = explode(" - ",$stp['pengumuman']);
	//--pendaftaran awal
	$ptpb = explode(" ",$ptp[0]); // memisahkan menjadi tanggal dan jam
	$ttpp = explode("/",$ptpb[0]); // mecah tanggal 
	$jpbp = explode(":",$ptpb[1]); // mecah jam
	
	//$jamb="";
	if ($ptpb[2] == "PM" AND $jpbp[0] < 12) {
		$jamp = $jpbp[0] + 12;
	}
	elseif ($ptpb[2] == 'AM') {
		$jamp = $jpbp[0];
	}
	else {
		$jamp = $jpbp[0];
	}
	$jambelum = $ttpp[2]."-".$ttpp[1]."-".$ttpp[0]." ".$jamp.":".$jpbp[1].":00";
	
	//--pendaftaran akhir
	$tpep = explode(" ",$ptp[1]); // memisahkan menjadi tanggal dan jam
	$ttpep = explode("/",$tpep[0]); // mecah tanggal 
	$jpep = explode(":",$tpep[1]);
	//$jame="";
	if ($tpep[2] == "PM" AND $jpep[0] < 12) {
		$jamsp = $jpep[0] + 12;
	}
	elseif ($tpep[2] == 'AM') {
		$jamsp = $jpep[0];
	}
	else {
		$jamsp = $jpep[0];
	}
	$jamsudah = $ttpep[2]."-".$ttpep[1]."-".$ttpep[0]." ".$jamsp.":".$jpep[1].":00";
	
	if($tgl_saiki < $jambelum) {
?>
		<div class="callout callout-info">
			<h4>PENGUMUMAN BELUM DIBUKA</h4>
			<p>Pengumuman Hasil Seleksi Peserta Didik Baru Dibuka mulai tanggal <?php echo $ptp[0]?></p>
		</div>
<?php
	}
	elseif($tgl_saiki>$jamsudah){
?>
		<div class="callout callout-danger">
			<h4>PENGUMUMAN SUDAH TUTUP</h4>
			<p>Pengumuman Hasil Seleksi Peserta Didik Baru sudah diTUTUP tanggal <?php echo $ptp[1]; ?></p>
		</div>
<?php
	}
	elseif(($tgl_saiki >= $jambelum) AND ($tgl_saiki<=$jamsudah)) {
?>


<script>
function cekNo() {
   var cek = document.forms['formcarino']['nopes'].value;
     if(cek==null || cek=="")
     {
       alert("Nomor Peserta harus di isi dahulu!");
       return false;
     }
}
</script>

<form name="formcarino" method="post" action="carinopes" onSubmit="return cekNo()">

  <div align="center">
    <legend> Cari Berdasarkan Nomor Peserta</legend>
  </div>
  <div class="form-group">
      <label for="noujian" class="col-lg-2 control-label">No Peserta</label>
      <div class="col-lg-10">
        <p>
          <input type="text" class="form-control" name="nopes" placeholder="Contoh : 16171" size="30">
        </p>
       
      </div>
  </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <input type="SUBMIT" name="SUBMIT" id="SUBMIT" value="Cari" class="btn btn-primary">
      </div>
    </div>

</form><?php }
	
	
	
	} 

else {
	//header('location: main.php?module=home');
}
?>