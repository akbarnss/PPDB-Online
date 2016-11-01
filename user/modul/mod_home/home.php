
<section class="content-header">
	<h1>
		<i class="fa fa-laptop text-green"></i> Dashboard
		<small>Control panel</small>
	</h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-aqua">
				<div class="inner">
                
					<h3>
					<?php

					$q = mysqli_query($colok, "SELECT COUNT(*) AS jml_pendaftar FROM siswa");
					$r = mysqli_fetch_array($q);
					echo $r['jml_pendaftar'];
					?>
					</h3>
					<p>JUMLAH PENDAFTAR</p>
				</div>
				<div class="icon">
					<i class="fa fa-users"></i>
				</div>
				<a href="main.php?module=pendaftaran" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div><!-- ./col -->
		
		<div class="col-md-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-green">
				<div class="inner">
					<h3>
					<?php
					$qt = mysqli_query($colok, "SELECT COUNT(*) AS jml_diterima FROM siswa WHERE status='SIAP'");
					$rt = mysqli_fetch_array($qt);
					echo $rt['jml_diterima'];
					?>
					</h3>
					<p>DITERIMA</p>
				</div>
				<div class="icon">
					<i class="fa fa-user-plus"></i>
				</div>
				<a href="main.php?module=pendaftaran" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div><!-- ./col -->
		
		<div class="col-md-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-yellow">
				<div class="inner">
					<h3>
					<?php
					$qc = mysqli_query($colok, "SELECT COUNT(*) AS jml_cadangan FROM siswa WHERE status='DAFTAR'");
					$rc = mysqli_fetch_array($qc);
					echo $rc['jml_cadangan'];
					?>
					</h3>
					<p>PENDAFTAR BELUM KONFIRMASI</p>
				</div>
				<div class="icon">
					<i class="fa fa-user-secret"></i>
				</div>
				<a href="main.php?module=pendaftaran" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div><!-- ./col -->
		
		<div class="col-md-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-red">
				<div class="inner">
					<h3>
					<?php
					$qtd = mysqli_query($colok, "SELECT COUNT(*) AS jml_tolak FROM siswa WHERE status='BELUM SIAP'");
					$rtd = mysqli_fetch_array($qtd);
					echo $rtd['jml_tolak'];
					?>
					</h3>
					<p>TIDAK DITERIMA</p>
				</div>
				<div class="icon">
					<i class="fa fa-user-times"></i>
				</div>
				<a href="main.php?module=pendaftaran" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                
                
                
			</div>
            
		</div><!-- ./col -->
		
	</div><!-- ./row -->
</section><!-- ./content -->

    