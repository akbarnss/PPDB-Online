
<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = 'index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
	$aksi = "modul/mod_setting/aksi_setting.php";
	
	// mengatasi variabel yang belum di definisikan (notice undefined index)
	$act = isset($_GET['act']) ? $_GET['act'] : ''; 
?>
	<section class="content-header">
		<div class="row">
			<div class="col-xs-6">
				<span style="font-size:24px;">SETTING</span>
			</div>
		</div>
	</section>
		
	<!-- Main content -->
	<section class="content">
		<div class="row">
<?php
	switch($act){
		default:			
			//-- EDIT SETTING --->
			$sql = "SELECT * from setting WHERE id_setting='1'";
			$q = mysqli_query($colok, $sql);
			$r = mysqli_fetch_array($q);
			
			if($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='kepsek'){
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
					<form class="form-horizontal" method="post" action="<?php echo $aksi; ?>?module=setting&act=update">
						<input type="hidden" name="id" value="<?php echo $r['id_setting']; ?>" />
						<div class="box-body">
							<div class="form-group">
								<label for="pendaftaran" class="col-sm-3 control-label">Form pendaftaran di buka</label>
								<div class="col-sm-6">
								  <input type="text" class="form-control" id="pendaftaran" name="pendaftaran" value="<?php echo $r['pendaftaran']; ?>" required />
								</div>
							</div> <!-- .form-group -->
							<div class="form-group">
								<label for="pengumuman" class="col-sm-3 control-label">Pengumuman di buka</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="pengumuman" name="pengumuman" value="<?php echo $r['pengumuman']; ?>" required />
								</div>
							</div> <!-- .form-group -->
                            
						</div> <!-- .box-body -->
						<div class="box-footer">
							<button type="button" class="btn btn-default" onClick="self.history.back()">Cancel</button>
							<button type="submit" id="simpansetting" name="simpansetting" class="btn btn-primary pull-right">SIMPAN</button>
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