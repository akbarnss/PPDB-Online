<?php
$module=$_GET['module'];
?>
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
		<!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="<?php if($module=="home") echo "active"; ?>"><a href="main.php?module=home" title="Halaman Utama"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
			<li class="<?php if($module=="identitas") echo "active"; ?>"><a href="main.php?module=identitas" title="Identitas"><i class="fa fa-bank"></i> <span>Identitas</span></a></li>
			<li class="<?php if($module=="halaman") echo "active"; ?>"><a href="main.php?module=halaman" title="Halaman Statis"><i class="fa fa-clone"></i> <span>Halaman Statis</span></a></li>
			<li class="<?php if($module=="sidebar") echo "active"; ?>"><a href="main.php?module=sidebar" title="Sidebar"><i class="fa fa-bookmark"></i> <span>Sidebar</span></a></li>
			<li class="<?php if($module=="pendaftaran") echo "active"; ?>"><a href="#" title="Pendaftaran"><i class="fa fa-book"></i> <span>Pendaftaran</span></a><ul>
				<li><a href="main.php?module=belumkonfirmasi">Belum Konfirmasi</a></li>
				<li><a href="main.php?module=konfirmasi">Sudah Konfirmasi</a></li>
                <li><a href="main.php?module=pendaftaran">Sudah Mengikuti Test</a></li>
			</ul></li>
			<li class="<?php if($module=="setting") echo "active"; ?>"><a href="main.php?module=setting" title="setting"><i class="fa fa-gear"></i> <span>Setting</span></a></li><li class="<?php if($module=="user") echo "active"; ?>"><a href="main.php?module=user" title="User"><i class="fa fa-user"></i> <span>User</span></a></li>
			<li><a href="logout.php" title="Log Out"><i class="fa fa-sign-out"></i> <span>Log Out</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>