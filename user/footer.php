      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>PPDB Online</b> MI Ulul Albaab &quot;Madani&quot;</div>
        <strong>Copyright &copy; 2016 </strong>All rights reserved. </footer>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
    </div><!-- ./wrapper -->
	
	

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- date-range-picker -->
    <script src="../plugins/moment/moment.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="../plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="../plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
	<!-- CK Editor -->
    <script src="../plugins/ckeditor/ckeditor.js"></script>
    <!-- page script -->
	<script>
		$("#checkAll").click(function () {
			$(".minimal").prop('checked', $(this).prop('checked'));
		});
	
      $(function () {
        $("#users").DataTable();
        $('#halamanstatis').DataTable();
        $('#pendaftarandata').DataTable();
        $('#sidebar').DataTable();
		
		//Date range picker with time picker
        $('#pendaftaran').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'DD/MM/YYYY h:mm A'});
        $('#pengumuman').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'DD/MM/YYYY h:mm A'});
		
		// Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('isi_halaman');
		
		//iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
      });
    </script>
  </body>
</html>