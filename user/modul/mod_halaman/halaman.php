<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = 'index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
	$aksi = "modul/mod_halaman/aksi_halaman.php";
	
	// mengatasi variabel yang belum di definisikan (notice undefined index)
	$act = isset($_GET['act']) ? $_GET['act'] : ''; 
?>
	<section class="content-header">
		<div class="row">
			<div class="col-xs-6">
				<span style="font-size:24px;">HALAMAN</span>
			</div>
			<?php if($act=="" and $_SESSION['leveluser']=='admin') { ?>
				<div class="col-xs-2 pull-right"><a href="main.php?module=halaman&act=tambahdata" class="btn btn-block btn-primary"><i class="fa fa-plus"></i>  TAMBAH DATA</a></div>
			<?php } ?>
		</div>
	</section>
		
	<!-- Main content -->
	<section class="content">
		<div class="row">
<?php
	switch($act){
		// Tampil Data HALAMAN STATIS
		default:
?>
		<div class="col-xs-12">
			<!-- menampilkan data halaman statis -->
			<div class="box">
				<div class="box-body">
					<table id="halamanstatis" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>NO</th>
								<th>JUDUL</th>
								<th>LINK</th>
								<th>AKSI</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$mySql 	= "SELECT * FROM halamanstatis ORDER BY id_halaman DESC";
							$myQry 	= mysqli_query($colok, $mySql);
							$nomor  = 0;
							while($myData = mysqli_fetch_array($myQry)) {
								$nomor++;
							?>
								<tr>
									<td><?php echo $nomor; ?></td>
									<td><?php echo $myData['judul']; ?></td>
									<td>page/<?php echo $myData['id_halaman']."/".$myData['judul_seo']; ?>.html</td>
									<td class="text-center"><a href="main.php?module=halaman&act=edit&id=<?php echo $myData['id_halaman']; ?>" alt="Edit Data" title="Edit Data"><i class="fa fa-pencil"></i></a></td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div> <!-- .box-body -->
			</div> <!-- .box -->
		</div> <!-- col-xs-12 -->
<?php
		break;
	
		case "tambahdata":	//-- TAMBAH DATA HALAMAN STATIS --->
?>
			<div class="col-xs-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">TAMBAH HALAMAN STATIS</h3>
					</div><!-- /.box-header -->
					<!-- form start -->
					<form class="form-horizontal" method="post" action="<?php echo $aksi; ?>?module=halaman&act=tambah">
						<div class="box-body">
							<div class="form-group">
								<label for="judul" class="col-sm-2 control-label">Judul</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="judul" name="judul" required />
								</div>
							</div> <!-- .form-group -->
							<div class="form-group">
								<label for="isi_halaman" class="col-sm-2 control-label">Isi Halaman</label>
								<div class="col-sm-10">
									<textarea class="form-control" id="isi_halaman" name="isi_halaman"></textarea>
								</div>
							</div> <!-- .form-group -->
						</div> <!-- .box-body -->
						<div class="box-footer">
							<button type="button" class="btn btn-default" onclick="self.history.back()">Cancel</button>
							<button type="submit" class="btn btn-primary pull-right">SIMPAN</button>
						</div><!-- /.box-footer -->
					</form>
				</div> <!-- .box box-warning -->
			</div> <!-- .col-md-6 -->
<?php
		break;
		
		case "edit":	//-- EDIT DATA USER --->
			$sql = "SELECT * from halamanstatis WHERE id_halaman='$_GET[id]'";
			$q = mysqli_query($colok, $sql);
			$r = mysqli_fetch_array($q);
?>
			<div class="col-xs-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">EDIT HALAMAN STATIS</h3>
					</div><!-- /.box-header -->
					<!-- form start -->
					<form class="form-horizontal" method="post" action="<?php echo $aksi; ?>?module=halaman&act=edit">
						<input type="hidden" name="id" value="<?php echo $r['id_halaman']; ?>" />
						<div class="box-body">
							<div class="form-group">
								<label for="judul" class="col-sm-2 control-label">Judul</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="judul" name="judul" value="<?php echo $r['judul']; ?>" required />
								</div>
							</div> <!-- .form-group -->
							<div class="form-group">
								<label for="isi_halaman" class="col-sm-2 control-label">Isi Halaman</label>
								<div class="col-sm-10">
									<textarea class="form-control" id="isi_halaman" name="isi_halaman"><?php echo $r['isi_halaman']; ?></textarea>
								</div>
							</div> <!-- .form-group -->
						</div> <!-- .box-body -->
						<div class="box-footer">
							<button type="button" class="btn btn-default" onclick="self.history.back()">Cancel</button>
							<button type="submit" class="btn btn-primary pull-right">SIMPAN</button>
						</div><!-- /.box-footer -->
					</form>
				</div> <!-- .box box-warning -->
			</div> <!-- .col-md-6 -->
<?php
		break;
	}
?>
			
		</div> <!-- row -->
	</section> <!-- content -->
<?php
}
?>