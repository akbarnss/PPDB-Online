<head>
<title>Kode Otomatis</title>
</head>
<?php
 /* Koneksi ke Database */
 mysql_connect("localhost","root");
 mysql_select_db("db_test");
 /*-------------------------------*/
 $sql=mysql_query("select * from tb_kode order by KodeOtomatis DESC LIMIT 0,1");
 $data=mysql_fetch_array($sql);
 $thnajar1=date('y') + 1;
 $kodeawal=substr($data['nopes'],3,4)+1;
 if($kodeawal<10){
  $kode=date('y').$thnajar1.$kodeawal;
 }elseif($kodeawal > 9 && $kodeawal <=99){
  $kode=date('y').$thnajar1.$kodeawal;
 }else{
  $kode=date('y').$thnajar1.$kodeawal;
 }
?>
<body>
<form name="form1" method="post" action="">
 <div>
  Kode Otomatis :  <input type="text" name="tkode" id="tkode" value="<?php echo $kode;?>">
 </div>
</form>
</body>
</html>