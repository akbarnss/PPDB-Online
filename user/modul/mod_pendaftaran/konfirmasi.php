<?php
session_start();
$host = "localhost";
$dbuser = "root";
$dbpasswd = "";
$database = "ppdb_miululalbaab";

$colok = mysqli_connect($host, $dbuser, $dbpasswd, $database);
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = 'index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
	$aksi = "modul/mod_pendaftaran/aksi_pendaftaran.php";
?>
	<section class="content-header">
		<div class="row">
			<div class="col-xs-6">
				<span style="font-size:24px;">DATA PENDAFTARAN PPDB</span>
		      <br />
		      YANG SUDAH MELAKUKAN KONFIRMASI &amp; BELUM MENGIKUTI TEST
			</div>
			<div class="col-xs-2 pull-right"><a href="<?php echo $aksi; ?>?module=konfirmasi&act=export-excel" class="btn btn-block btn-primary"><i class="fa fa-file-excel-o"></i> &nbsp; EXPORT</a></div>
		</div>
	</section>
		
	<!-- Main content -->
	<section class="content">
		<div class="row">
		<div class="col-xs-12">
			<!-- menampilkan data pendaftaran statis -->
			<div class="box">
				<div class="box-body">
				  <form method="post" action="<?php echo $aksi; ?>?module=pendaftaran&act=ubahstatus">
					<table id="pendaftarandata" class="table table-bordered table-striped">
						<thead>
							<tr>
								
								<th width="24">NO</th>
								<th width="92">NO REGISTER</th>
								<th width="66">NAMA</th>
								<th width="30">TTL</th>
								
								<th width="119">TANGGAL DAFTAR</th>
								<th width="57">STATUS</th>
								<th width="39">AKSI</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$mySql 	= "SELECT * FROM siswa, agama WHERE siswa.id_agama=agama.id_agama AND status='KONFIRMASI' ORDER BY nopes DESC";
							$myQry 	= mysqli_query($colok, $mySql);
							$nomor  = 0;
							while($myData = mysqli_fetch_array($myQry)) {
								$nomor++;
								
								
							?>
								<tr>
									
									<td><?php echo $nomor; ?></td>
									<td><?php echo $myData['nopes']; ?></td>
									<td><?php echo $myData['nm_siswa']; ?></td>
									<td><?php echo $myData['tmp_lahir'].", ".tgl_indo($myData['tgl_lahir']); ?></td>
									
									<td><?php echo tgl_indo($myData['tgl_daftar']); ?></td>
									<td><?php echo $myData['status']; ?></td>
									<td class="text-center">
										<a class="btn btn-warning btn-xs" alt="Lihat Data" title="Lihat Data" data-toggle="modal" data-target="#myModal<?php echo $myData['nopes']; ?>"><i class="fa fa-search"></i></a> &nbsp; 
										<a href="../bukti-pendaftaran/<?php echo $myData['file']; ?>" class="btn btn-success btn-xs" target="_blank" alt="PDF File" title="PDF File"><i class="fa fa-file-pdf-o"></i></a> &nbsp;
                                       <?php 
									   $nopes= $myData['nopes'];
$ada = mysqli_query($colok,"SELECT * from nilai_siswa where nopes='$nopes'");
$adaengga = mysqli_num_rows($ada);
if($adaengga == 0) echo "<a href='main.php?module=nilai&nopes=$myData[nopes]' class='btn btn-info btn-xs' target='_blank' alt='INPUT NILAI' title='INPUT NILAI'><i class='fa fa-arrow-circle-o-up'></i>";
else 
echo "";?>							
									</td>
								</tr>									
<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $myData['nopes']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $myData['nopes']; ?>" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel<?php echo $myData['nopes']; ?>">Detail Data</h4>
			</div> <!-- /.modal-header -->
			<div class="modal-body">
				<h3 class="page-header">A. DATA SISWA</h3>
				<dl class="dl-horizontal">
					<dt>No Pendaftaran</dt> <dd><?php echo $myData['nopes']; ?></dd>
					<dt>Nama Lengkap</dt> <dd><?php echo $myData['nm_siswa']; ?></dd>
					<dt>Nama Panggilan</dt> <dd><?php echo $myData['nm_p_siswa']; ?></dd>
					<dt>Jenis Kelamin</dt> <dd><?php if($myData['jk']=="L") echo "Laki-laki"; else echo "Perempuan"; ?></dd>
					<dt>Tempat, Tanggal Lahir</dt> <dd><?php echo $myData['tmp_lahir'].", ".tgl_indo($myData['tgl_lahir']); ?></dd>
					<dt>Agama</dt> <dd><?php echo $myData['nm_agama']; ?></dd>
					<dt>Anak ke</dt> <dd><?php echo $myData['anak_ke']."  dari  ".$myData['jml_sdr']."  Bersaudara"; ?></dd>
					<dt>Alamat</dt> <dd><?php echo $myData['alamat']." RT: ".$myData['rt']." RW: ".$myData['rw'].", ".$myData['kelurahan'].", ".$myData['kecamatan'].", ".$myData['kabupaten'].". <br />Kodepos ".$myData['kodepos']; ?></dd>
					
					<dt>Tinggal Bersama</dt> <dd><?php echo $myData['tmp_tinggal']; ?></dd>
				</dl>
				

				
				<h3 class="page-header">B. DATA AYAH</h3>
				<dl class="dl-horizontal">
					<dt>Nama Lengkap</dt> <dd><?php echo $myData['nm_ayah']; ?></dd>
					<dt>Tempat, Tanggal Lahir</dt> <dd><?php echo $myData['tmp_lahir_ayah'].", ".tgl_indo($myData['tgl_lahir_ayah']); ?></dd>
					<dt>Alamat</dt> <dd><?php echo $myData['alamat_ayah']; ?></dd>
					<?php
					$qpka = mysqli_query($colok, "SELECT nm_pekerjaan FROM pekerjaan WHERE id_pekerjaan='".$myData['pekerjaan_ayah']."'");
					$pka = mysqli_fetch_array($qpka);
					?>
					<dt>Pekerjaan</dt> <dd><?php echo $pka['nm_pekerjaan']; ?></dd>
					<dt>Instansi</dt> <dd><?php echo $myData['instansi_ayah']; ?></dd>
					<dt>Penghasilan/bulan</dt> <dd><?php echo "Rp. ".rupiah($myData['penghasilan_ayah']).",-"; ?></dd>
					<?php
					$qpa = mysqli_query($colok, "SELECT nm_pendidikan FROM pendidikan WHERE id_pendidikan='".$myData['pendidikan_ayah']."'");
					$pa = mysqli_fetch_array($qpa);
					?>
					<dt>Pendidikan Terakhir</dt> <dd><?php echo $pa['nm_pendidikan']; ?></dd>
					<dt>Organisasi</dt> <dd><?php echo $myData['org_ayah']; ?></dd>
					<dt>No. Telp/HP</dt> <dd><?php echo $myData['hp_ayah']; ?></dd>
					<dt>Email</dt> <dd><?php echo $myData['email_ayah']; ?></dd>
				</dl>
				
				<h3 class="page-header">C. DATA IBU</h3>
				<dl class="dl-horizontal">
					<dt>Nama Lengkap</dt> <dd><?php echo $myData['nm_ibu']; ?></dd>
					<dt>Tempat, Tanggal Lahir</dt> <dd><?php echo $myData['tmp_lahir_ibu'].", ".tgl_indo($myData['tgl_lahir_ibu']); ?></dd>
					<dt>Alamat</dt> <dd><?php echo $myData['alamat_ibu']; ?></dd>
					<?php
					$qpkibu = mysqli_query($colok, "SELECT nm_pekerjaan FROM pekerjaan WHERE id_pekerjaan='".$myData['pekerjaan_ibu']."'");
					$pkibu = mysqli_fetch_array($qpkibu);
					?>
					<dt>Pekerjaan</dt> <dd><?php echo $pkibu['nm_pekerjaan']; ?></dd>
					<dt>Instansi</dt> <dd><?php echo $myData['instansi_ibu']; ?></dd>
					<dt>Penghasilan/bulan</dt> <dd><?php echo "Rp. ".rupiah($myData['penghasilan_ibu']).",-"; ?></dd>
					<?php
					$qpi = mysqli_query($colok, "SELECT nm_pendidikan FROM pendidikan WHERE id_pendidikan='".$myData['pendidikan_ibu']."'");
					$pi = mysqli_fetch_array($qpi);
					?>
					<dt>Pendidikan Terakhir</dt> <dd><?php echo $pi['nm_pendidikan']; ?></dd>
					<dt>Organisasi</dt> <dd><?php echo $myData['org_ibu']; ?></dd>
					<dt>No. Telp/HP</dt> <dd><?php echo $myData['hp_ibu']; ?></dd>
					<dt>Email</dt> <dd><?php echo $myData['email_ibu']; ?></dd>
				</dl>
				
				
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div> <!-- /.modal-footer -->
		</div> <!-- /.modal-content -->
	</div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->
							<?php
							}
							?>
						</tbody>
					</table>
				 <!-- .box-body -->
				<div class="box-footer">
					<div class="col-sm-3"></div> <!-- /.col-sm-3 -->
					<div class="col-sm-1"></div> <!-- /.col-sm-1 -->
				</div> <!-- /.box-footer -->
			  </form>
			</div> <!-- .box -->
		</div> <!-- col-xs-12 -->			
		</div> <!-- row -->
	</section> <!-- content -->
<?php
}
?>