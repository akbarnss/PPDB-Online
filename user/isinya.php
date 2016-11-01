
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
