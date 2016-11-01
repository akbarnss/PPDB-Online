<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = 'index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
	$aksi = "modul/mod_nilai/aksi_nilai.php";
	
	// mengatasi variabel yang belum di definisikan (notice undefined index)
	$act = isset($_GET['act']) ? $_GET['act'] : ''; 
?>
	<section class="content-header">
		<div class="row">
			<div class="col-xs-6">
				<span style="font-size:24px;">INPUT NILAI TEST</span>
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
			$nopes=$_GET['nopes'];
			$sql = "SELECT * from siswa WHERE nopes='$nopes'";
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
						elseif($_GET['r']=="sama"){
?>
<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> GAGAL!</h4>
								Nomor Peserta Tersebut Sudah Di Input!
						</div>

<?php							
							
							}
					}
				?>
				<div class="box box-warning">
					<form class="form-horizontal" method="post" action="<?php echo $aksi; ?>?module=nilai&act=input" enctype="multipart/form-data">
						<div class="box-body">
							<div class="form-group">
								<label for="nopes" class="col-sm-3 control-label">Nomor Peserta</label>
								<div class="col-sm-9">
                                
								  <input type="hidden" class="form-control" id="nopes" name="nopes" value="<?php echo $r['nopes']; ?>" /> <label for="nopes" class="col-sm-3 control-label"><?php echo $r['nopes'] ?></label>
								</div>
							</div> <!-- .form-group -->
                            <div class="form-group">
							  <label for="nama" class="col-sm-3 control-label">Nama Calon Peserta Didik</label>
								<div class="col-sm-9">
								  <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $r['nm_siswa']; ?>" disabled />
								</div>
							</div>
                            
							<div class="form-group">
								<label for="nilai" class="col-sm-3 control-label">Nilai Afektif</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="nilai_afektif" name="nilai_afektif" maxlength="2" required />
								</div>
							</div> <!-- .form-group -->
							<div class="form-group">
								<label for="nilai" class="col-sm-3 control-label">Nilai Psikomotorik</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="nilai_psikomotorik" maxlength="2" name="nilai_psikomotorik" required />
								</div>
							</div> <!-- .form-group --><!-- .form-group --><!-- .form-group --><!-- .form-group -->
							<div class="form-group"><!-- /.input group -->
							</div> <!-- .form-group -->
						</div> <!-- .box-body -->
						<div class="box-footer">
							<button type="button" class="btn btn-default" onclick="self.history.back()">Cancel</button>
							<button type="submit" id="simpanidentitas" name="simpanidentitas" onclick="javascript:return confirm();" class="btn btn-primary pull-right">SIMPAN</button>
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