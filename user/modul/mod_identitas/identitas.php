<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = 'index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
	$aksi = "modul/mod_identitas/aksi_identitas.php";
	
	// mengatasi variabel yang belum di definisikan (notice undefined index)
	$act = isset($_GET['act']) ? $_GET['act'] : ''; 
?>
	<section class="content-header">
		<div class="row">
			<div class="col-xs-6">
				<span style="font-size:24px;">EDIT IDENTITAS SEKOLAH</span>
			</div>
		</div>
	</section>
		
	<!-- Main content -->
	<section class="content">
		<div class="row">
<?php
	switch($act){
		// Tampil Edit Identitas
		default:			
			//-- EDIT IDENTITAS --->
			$sql = "SELECT * from sekolah WHERE id_sekolah='1'";
			$q = mysqli_query($colok, $sql);
			$r = mysqli_fetch_array($q);
			
			if($_SESSION['leveluser']=='admin'){
					//-- status update ----
?>
				<div class="col-md-10">
<?php			
					if(isset($_GET['r'])) {
						if($_GET['r']=="sukses") {
?>
							<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-check"></i> SUKSES!</h4>
								Data BERHASIL di SIMPAN!
							</div>
<?php
						}
						elseif($_GET['r']=="gagal") {
?>
							<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> GAGAL!</h4>
								Data GAGAL di SIMPAN!
						</div>
<?php
						}
					}
				?>
				<div class="box box-warning">
					<form class="form-horizontal" method="post" action="<?php echo $aksi; ?>?module=identitas&act=update" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo $r['id_sekolah']; ?>" />
						<input type="hidden" name="idf" value="<?php echo $r['logo']; ?>" />
						<div class="box-body">
							<div class="form-group">
								<label for="alamatwebsite" class="col-sm-3 control-label">Alamat Website PPDB</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="alamatwebsite" name="alamatwebsite" value="<?php echo $r['alamat_website']; ?>" required />
								</div>
							</div> <!-- .form-group -->
							<div class="form-group">
								<label for="nama" class="col-sm-3 control-label">Nama Sekolah</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $r['nama_sekolah']; ?>" required />
								</div>
							</div> <!-- .form-group -->
							<div class="form-group">
								<label for="alamat" class="col-sm-3 control-label">Alamat Sekolah</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $r['alamat']; ?>" required />
								</div>
							</div> <!-- .form-group -->
							<div class="form-group">
								<label for="kabupaten" class="col-sm-3 control-label">Kabupaten</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="kabupaten" name="kabupaten" value="<?php echo $r['kabupaten']; ?>" />
								</div>
							</div> <!-- .form-group -->
							<div class="form-group">
								<label for="ta" class="col-sm-3 control-label">Tahun Ajaran</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="ta" name="ta" value="<?php echo $r['tahun_ajaran']; ?>" />
								</div>
							</div> <!-- .form-group -->
							<div class="form-group">
								<label for="kepsek" class="col-sm-3 control-label">Nama Kepala Sekolah</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="kepsek" name="kepsek" value="<?php echo $r['kepsek']; ?>" required />
								</div>
							</div> <!-- .form-group -->
							<div class="form-group">
								<label for="fupload" class="col-sm-3 control-label">Logo Sekolah <br/><small>(File Gambar *.JPG)</small> </label>
								<div class="col-sm-9">
								<?php
								if(!empty($r['logo'])) {
								?>
									<img src="../images/<?php echo $r['logo'];?>" height="150"/><br />*) Untuk mengganti silahkan klik tombol browse dibawah ini.
								<?php
								}
								?>
									<input type="file" name="fupload" id="fupload" />
								</div><!-- /.input group -->
							</div> <!-- .form-group -->
						</div> <!-- .box-body -->
						<div class="box-footer">
							<button type="button" class="btn btn-default" onclick="self.history.back()">Cancel</button>
							<button type="submit" id="simpanidentitas" name="simpanidentitas" class="btn btn-primary pull-right">SIMPAN</button>
						</div><!-- /.box-footer -->
					</form>
				<?php
				}
				
				else {
				?>
					<div class="col-md-10">
						<div class="box box-warning">
							<h4>Anda tidak mempunya hak Akses!</h4>
						</div> <!-- .box box-warning -->
					</div> <!-- .col-md-10 -->
				<?php
				}
				?>
				</div> <!-- .box box-warning -->
			</div> <!-- .col-md-10 -->
<?php
		break;
	}
?>
		</div> <!-- row -->
	</section> <!-- content -->
<?php
}
?>