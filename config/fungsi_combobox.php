<?php
function satuan($var, $terpilih) {
	echo "<select name=\"$var\" class=\"form-control\" required>
          <option value=\"\">....</option>";
	$pilihan = array("Tabung", "Unit", "Botol", "Kotak", "Box", "Sachet");
	foreach ($pilihan as $nilai) {
		if ($terpilih ==$nilai) {
			$cek=" selected";
		} else { $cek = ""; }
		echo "<option value=\"$nilai\" $cek>$nilai</option>";
	}
    echo "</select>";
}
?>