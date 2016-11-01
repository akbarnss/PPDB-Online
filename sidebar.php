<?php
$qs = mysqli_query($colok, "SELECT judul, isi_sidebar FROM sidebar");
while($s=mysqli_fetch_array($qs)) {
?>
	<div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title"><b><?php echo $s['judul']; ?></b></h3>
		</div>
		<div class="box-body">
			<?php echo $s['isi_sidebar']; ?>
		</div><!-- /.box-body -->
	</div><!-- /.box -->
<?php
}
?>