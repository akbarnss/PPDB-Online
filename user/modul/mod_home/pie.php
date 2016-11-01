<?php
session_start();

include "../../../config/colokan.php";

?>

   
      <script src="js/jquery-1.9.1.min.js"></script>
<script src="js/highcharts.js"></script>

   
   <script type="text/javascript">
		$(function () {

			$(document).ready(function () {

				// Build the chart
				$('#container').highcharts({
					chart: {
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false
					},
					title: {
						text: 'JUMLAH PENDAFTAR PPDB MIS ULUL ALBAAB MADANI'
					},
					tooltip: {
						pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: false
							},
							showInLegend: true
						}
					},
					series: [{
						type: 'pie',
						name: 'Data Check List',
						data: [
						['SIAP',   <?php
										$result = mysqli_query($colok,"SELECT * FROM siswa WHERE status= 'SIAP' ");
										$num_rows = mysqli_num_rows($result);
										echo $num_rows; ?>.0],
						['BELUM SIAP',   <?php
										$result = mysqli_query($colok,"SELECT * FROM siswa WHERE status= 'BELUM SIAP'");
										$num_rows = mysqli_num_rows($result);
										echo $num_rows; ?>.0],
						['KONFIRMASI',   <?php
										$result = mysqli_query($colok,"SELECT * FROM siswa WHERE status= 'KONFIRMASI'");
										$num_rows = mysqli_num_rows($result);
										echo $num_rows; ?>.0],
						['DAFTAR',   <?php
										$result = mysqli_query($colok,"SELECT *  FROM siswa WHERE status='DAFTAR'");
										$num_rows = mysqli_num_rows($result);
										echo $num_rows; ?>.0],
						]
					}]
				});
			});

		});
				</script>
	



<div id="container" style="min-width: 310px; height: 400px; max-width: 900px; margin: 0 auto"></div>

            <!-- end of main -->
      
        <div id="tooplate_footer">
        
            

