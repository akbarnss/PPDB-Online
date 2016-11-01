<?php
session_start();
error_reporting(0);


// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = 'index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
	include "../config/colokan.php";
	
	include "header.php";
?>
      <!-- =============================================== -->

<?php
include "menu.php";
?>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
		<?php include "content.php"; ?>
      </div><!-- /.content-wrapper -->
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
<?php
include "footer.php";
}
?>