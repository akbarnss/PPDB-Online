<?php
session_start();
error_reporting();
include "config/colokan.php";
include "config/library.php";

// Mengambil data identitas website sekolah
$query = "SELECT * FROM sekolah";
$hasil = mysqli_query($colok, $query);  
$d     = mysqli_fetch_array($hasil);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PPDB ONLINE | <?php echo $d['nama_sekolah']; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo $d['alamat_website']; ?>/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $d['alamat_website']; ?>/bootstrap/css/font-awesome.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo $d['alamat_website']; ?>/plugins/iCheck/all.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo $d['alamat_website']; ?>/plugins/datatables/dataTables.bootstrap.css">
	<!-- daterange picker -->
    <link rel="stylesheet" href="<?php echo $d['alamat_website']; ?>/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $d['alamat_website']; ?>/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo $d['alamat_website']; ?>/dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-green layout-top-nav">
    <div class="wrapper">
      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <a href="<?php echo $d['alamat_website']; ?>" class="navbar-brand"><b>PPDB</b>Online</a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <li><a href="<?php echo $d['alamat_website']; ?>/beranda">BERANDA</a></li>
                <li><a href="<?php echo $d['alamat_website']; ?>/prosedur">PROSEDUR</a></li>
                <li><a href="<?php echo $d['alamat_website']; ?>/agenda">AGENDA</a></li>
                <li><a href="<?php echo $d['alamat_website']; ?>/pendaftaran">PENDAFTARAN</a></li>
                <li><a href="<?php echo $d['alamat_website']; ?>/pengumumanppdb">PENGUMUMAN</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
					<li><a href="#"><b><?php echo $d['nama_sekolah']; ?></b></a></li>
                </ul>
              </div><!-- /.navbar-custom-menu -->
          </div><!-- /.container-fluid -->
        </nav>
      </header>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
			<div class="row">
				<div class="col-md-8">
          			<!-- Main content -->
          			<section class="content">
            			<?php include "isinya.php"; ?>
          			</section><!-- /.content -->
				</div><!-- /.col-md-8 -->
				<div class="col-md-4">
					<section class="content">
						<?php include "sidebar.php"; ?>
					</section>
				</div><!-- /.col-md-4-->
			</div><!-- /.crow -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="container">
          <strong>Pendaftaran Peserta Didik Online <?php echo $d['nama_sekolah']; ?></strong>
        </div><!-- /.container -->
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo $d['alamat_website']; ?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo $d['alamat_website']; ?>/bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo $d['alamat_website']; ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo $d['alamat_website']; ?>/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="<?php echo $d['alamat_website']; ?>/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="<?php echo $d['alamat_website']; ?>/plugins/iCheck/icheck.min.js"></script>
    <!-- date-range-picker -->
    <script src="<?php echo $d['alamat_website']; ?>/plugins/moment/moment.js"></script>
    <script src="<?php echo $d['alamat_website']; ?>/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- FastClick -->
    <script src="<?php echo $d['alamat_website']; ?>/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $d['alamat_website']; ?>/dist/js/app.min.js"></script>
	<!-- Page script -->
    <script>
      $(function () {
		//iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
		
		//Datepicker
		$('#tgllahir').daterangepicker({singleDatePicker: true,format: 'DD-MM-YYYY', "opens": "right"});
		$('#tgllahirayah').daterangepicker({singleDatePicker: true,format: 'DD-MM-YYYY', "opens": "right"});
		$('#tgllahiribu').daterangepicker({singleDatePicker: true,format: 'DD-MM-YYYY', "opens": "right"});
		$('#tgllahirwali').daterangepicker({singleDatePicker: true,format: 'DD-MM-YYYY', "opens": "right"});
		
		$('#pengumumanditerima').DataTable();
		$('#pengumumancadangan').DataTable();
      });
    </script>
  </body>
</html>
