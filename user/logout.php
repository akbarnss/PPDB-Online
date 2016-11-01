<?php
  session_start();
  session_destroy();
  echo "<script>alert('Anda telah keluar dari halaman Admin PPDB Online!!'); window.location = 'index.php'</script>";
?>
