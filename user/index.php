<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>.: PPDB Online MI Ulul Albaab Madani :.</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../bootstrap/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <p>Admin <b>PPDB Online</b></p>
        <p> MI Ulul Albaab &quot;Madani&quot;</p>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Silahkan login dengan Username dan Password Anda!</p>
        <form action="ceklogin.php" method="post">
          <div class="form-group has-feedback">
            <input type="username" name="username" class="form-control" placeholder="Username" autofocus="autofocus" required />
            <span class="fa fa-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password" required />
            <span class="fa fa-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-offset-8 col-xs-4">
              <button type="submit" name="submitlog" class="btn btn-primary btn-block btn-flat">LOGIN</button>
            </div><!-- /.col -->
          </div>
        </form>
      </div><!-- /.login-box-body -->
	  <p>&nbsp;</p>
	  <p class="text-center">&copy; 2016</p>
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<?php
}

// Apabila user sudah login dengan benar, maka terbentuklah session
else{ 
	header('location:main.php?module=home');
}
?>