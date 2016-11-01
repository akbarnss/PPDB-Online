<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = 'index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
	$aksi = "modul/mod_user/aksi_user.php";
	
	// mengatasi variabel yang belum di definisikan (notice undefined index)
	$act = isset($_GET['act']) ? $_GET['act'] : ''; 
?>
	<section class="content-header">
		<div class="row">
			<div class="col-xs-6">
				<span style="font-size:24px;">DATA USER</span>
			</div>
			<?php if($act=="" and $_SESSION['leveluser']=='admin') { ?>
				<div class="col-xs-2 pull-right"><a href="main.php?module=user&act=tambahdata" class="btn btn-block btn-primary"><i class="fa fa-plus"></i>  TAMBAH DATA</a></div>
			<?php } ?>
		</div>
	</section>
		
	<!-- Main content -->
	<section class="content">
		<div class="row">
<?php
	switch($act){
		// Tampil Data User
		default:
?>
		<div class="col-xs-12">
			<!-- menampilkan data user -->
			<div class="box">
				<div class="box-body">
					<table id="users" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>NO</th>
								<th>USERNAME</th>
								<th>NAMA LENGKAP</th>
								<th>EMAIL</th>
								<th>LEVEL</th>
								<th>BLOKIR</th>
								<th>AKSI</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($_SESSION['leveluser']=='admin'){
								$mySql 	= "SELECT * FROM users ORDER BY username ASC";
							}	
							else{
								$mySql 	= "SELECT * FROM users WHERE username='$_SESSION[namauser]'";
							}
							$myQry 	= mysqli_query($colok, $mySql);
							$nomor  = 0;
							while($myData = mysqli_fetch_array($myQry)) {
								$nomor++;
							?>
								<tr>
									<td><?php echo $nomor; ?></td>
									<td><?php echo $myData['username']; ?></td>
									<td><?php echo $myData['nama_lengkap']; ?></td>
									<td><?php echo $myData['email']; ?></td>
									<td><?php echo $myData['level']; ?></td>
									<td class="text-center"><?php echo $myData['blokir']; ?></td>
									<td class="text-center"><a href="main.php?module=user&act=edit&id=<?php echo $myData['id_session']; ?>" alt="Edit Data" title="Edit Data"><i class="fa fa-pencil"></i></a></td>
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
	
		case "tambahdata":	//-- TAMBAH DATA user --->
?>
			<div class="col-md-6">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">TAMBAH DATA USER</h3>
					</div><!-- /.box-header -->
					<!-- form start -->
					<form class="form-horizontal" method="post" action="<?php echo $aksi; ?>?module=user&act=tambah">
						<div class="box-body">
							<div class="form-group">
								<label for="username" class="col-sm-3 control-label">Username</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="username" name="username" required />
								</div>
							</div> <!-- .form-group -->
							<div class="form-group">
								<label for="password" class="col-sm-3 control-label">Password</label>
								<div class="col-sm-9">
									<input type="password" class="form-control" id="password" name="password" required />
									<small>*) Password di<b>KOSONG</b>i jika tidak diganti</small>
								</div>
							</div> <!-- .form-group -->
							<div class="form-group">
								<label for="nama" class="col-sm-3 control-label">Nama Lengkap</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="nama" name="nama" required />
								</div>
							</div> <!-- .form-group -->
							<div class="form-group">
								<label for="email" class="col-sm-3 control-label">Email</label>
								<div class="col-sm-9">
									<input type="email" class="form-control" id="email" name="email" required />
								</div>
							</div> <!-- .form-group -->
							<div class="form-group">
								<label for="telp" class="col-sm-3 control-label">No Telp/HP</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="telp" name="telp" />
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
			$sql = "SELECT * from users WHERE id_session='$_GET[id]'";
			$q = mysqli_query($colok, $sql);
			$r = mysqli_fetch_array($q);
?>
			<div class="col-md-6">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">EDIT DATA USER</h3>
					</div><!-- /.box-header -->
					<!-- form start -->
				<?php
				if($_SESSION['leveluser']=='admin'){
				?>
					<form class="form-horizontal" method="post" action="<?php echo $aksi; ?>?module=user&act=edit">
						<input type="hidden" name="id" value="<?php echo $r['id_session']; ?>" />
						<div class="box-body">
							<div class="form-group">
								<label for="username" class="col-sm-3 control-label">Username</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="username" name="username" value="<?php echo $r['username']; ?>" disabled>
								</div>
							</div> <!-- .form-group -->
							<div class="form-group">
								<label for="password" class="col-sm-3 control-label">Password</label>
								<div class="col-sm-9">
									<input type="password" class="form-control" id="password" name="password">
									<small>*) Password di<b>KOSONG</b>i jika tidak diganti</small>
								</div>
							</div> <!-- .form-group -->
							<div class="form-group">
								<label for="nama" class="col-sm-3 control-label">Nama Lengkap</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $r['nama_lengkap']; ?>" required>
								</div>
							</div> <!-- .form-group -->
							<div class="form-group">
								<label for="email" class="col-sm-3 control-label">Email</label>
								<div class="col-sm-9">
									<input type="email" class="form-control" id="email" name="email" value="<?php echo $r['email']; ?>" required />
								</div>
							</div> <!-- .form-group -->
							<div class="form-group">
								<label for="telp" class="col-sm-3 control-label">No Telp/HP</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="telp" name="telp" value="<?php echo $r['no_telp']; ?>" />
								</div>
							</div> <!-- .form-group -->
							<div class="form-group">
								<label for="password" class="col-sm-3 control-label">Level</label>
								<div class="col-sm-9">
									<?php
									if($r['level']=="admin") {
									?>
										<div class="radio">
											<label>
												<input type="radio" id="level" name="level" value="admin" checked> admin 
											</label>
										</div>
										<div class="radio">
											<label>
												<input type="radio" id="level" name="level" value="user"> user
											</label>
										</div>
									<?php
									}
									elseif($r['level']=="user") {
									?>
										<div class="radio">
											<label>
												<input type="radio" id="level" name="level" value="admin"> admin 
											</label>
										</div>
										<div class="radio">
											<label>
												<input type="radio" id="level" name="level" value="user" checked> user
											</label>
										</div>
									<?php
									}
									?>
								</div>
							</div> <!-- .form-group -->
							<div class="form-group">
								<label for="password" class="col-sm-3 control-label">Blokir</label>
								<div class="col-sm-9">
									<?php
									if($r['blokir']=="Y") {
									?>
										<div class="radio">
											<label>
												<input type="radio" id="blokir" name="blokir" value="Y" checked> Y 
											</label>
										</div>
										<div class="radio">
											<label>
												<input type="radio" id="blokir" name="blokir" value="N"> N
											</label>
										</div>
									<?php
									}
									elseif($r['blokir']=="N") {
									?>
										<div class="radio">
											<label>
												<input type="radio" id="blokir" name="blokir" value="Y"> Y 
											</label>
										</div>
										<div class="radio">
											<label>
												<input type="radio" id="blokir" name="blokir" value="N" checked> N
											</label>
										</div>
									<?php
									}
									?>
								</div>
							</div> <!-- .form-group -->
						</div> <!-- .box-body -->
						<div class="box-footer">
							<button type="button" class="btn btn-default" onclick="self.history.back()">Cancel</button>
							<button type="submit" class="btn btn-primary pull-right">SIMPAN</button>
						</div><!-- /.box-footer -->
					</form>
				<?php
				}
				
				else {
				?>
					<form class="form-horizontal" method="post" action="<?php echo $aksi; ?>?module=user&act=edit">
						<input type="hidden" name="id" value="<?php echo $r['id_session']; ?>" />
						<input type="hidden" name="blokir" value="<?php echo $r['blokir']; ?>" />
						<input type="hidden" name="level" value="<?php echo $r['level']; ?>" />
						<div class="box-body">
							<div class="form-group">
								<label for="username" class="col-sm-3 control-label">Username</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="username" name="username" value="<?php echo $r['username']; ?>" disabled>
								</div>
							</div> <!-- .form-group -->
							<div class="form-group">
								<label for="password" class="col-sm-3 control-label">Password</label>
								<div class="col-sm-9">
									<input type="password" class="form-control" id="password" name="password">
									<small>*) Password di<b>KOSONG</b>i jika tidak diganti</small>
								</div>
							</div> <!-- .form-group -->
							<div class="form-group">
								<label for="nama" class="col-sm-3 control-label">Nama Lengkap</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $r['nama_lengkap']; ?>" required>
								</div>
							</div> <!-- .form-group -->
							<div class="form-group">
								<label for="email" class="col-sm-3 control-label">Email</label>
								<div class="col-sm-9">
									<input type="email" class="form-control" id="email" name="email" value="<?php echo $r['email']; ?>" required />
								</div>
							</div> <!-- .form-group -->
							<div class="form-group">
								<label for="telp" class="col-sm-3 control-label">No Telp/HP</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="telp" name="telp" value="<?php echo $r['no_telp']; ?>" />
								</div>
							</div> <!-- .form-group -->
						</div> <!-- .box-body -->
						<div class="box-footer">
							<button type="button" class="btn btn-default" onclick="self.history.back()">Cancel</button>
							<button type="submit" class="btn btn-primary pull-right">SIMPAN</button>
						</div><!-- /.box-footer -->
					</form>
				<?php
				}
				?>
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