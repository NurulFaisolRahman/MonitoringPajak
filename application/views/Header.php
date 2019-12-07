<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=strtoupper($title)?></title>
	<link rel="icon" href="<?=base_url('Favicon.ico')?>" type="image/x-icon">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('plugins/fontawesome-free/css/all.min.css')?>">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?=base_url('plugins/daterangepicker/daterangepicker.css')?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?=base_url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('dist/css/adminlte.min.css')?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
			<li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link text-primary font-weight-bold"><h5><b>KOTA MALANG</b></h5></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <a class="nav-link" href="<?=base_url('Autentikasi/SignOut')?>">
        <i class="fas fa-user-lock"><span class="text-primary"> SIGN OUT</span></i>
      </a>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
		<a href="" class="brand-link bg-success">
      <img src="<?=base_url('Logo.png')?>"
           alt="LogoBP2D"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-bold"><?=strtoupper($title)?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?=base_url("Dashboard")?>" class="nav-link <?php if ($title == "Dashboard") {
              echo "active";
            } ?>">
              <i class="nav-icon fas fa-home"></i>
              <p><b>Dashboard</b></p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php if ($title == "Transaksi") {
            echo "menu-open";
          } ?>">
            <a href="#" class="nav-link <?php if ($title == "Transaksi") {
              echo "active";
            } ?>">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                <b>Transaksi</b>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <?php
              $DataTransaksi = array("Tahunan","Bulanan","Harian");
              $Icon = array("calendar","calendar-check","calendar-alt","calendar-minus");
            ?>
            <?php for ($i=0; $i < count($DataTransaksi); $i++) {?>
              <ul class="nav nav-treeview <ml-1></ml-3>">
                <li class="nav-item">
                  <a href="<?=base_url("Transaksi/").$DataTransaksi[$i]?>" class="nav-link <?php if ($submenu == $DataTransaksi[$i]) {
                    echo "active";
                  } ?>">
                    <i class="fas fa-<?=$Icon[$i]?> nav-icon"></i>
                    <p class="font-weight-bold"><?=$DataTransaksi[$i]?></p>
                  </a>
                </li>
              </ul>
            <?php } ?>
          </li>
          <li class="nav-item">
            <a href="<?=base_url("Rekening")?>" class="nav-link <?php if ($title == "Rekening") {
              echo "active";
            } ?>">
              <i class="nav-icon fas fa-book"></i>
              <p><b>Rekening</b></p>
            </a>
          </li>
          <?php if($this->session->userdata('Admin')){ ?>
            <li class="nav-item">
              <a href="<?=base_url("User")?>" class="nav-link <?php if ($title == "User") {
                echo "active";
              } ?>">
                <i class="nav-icon fas fa-user"></i>
                <p><b>User</b></p>
              </a>
            </li>
          <?php }; ?>
          <li class="nav-item">
            <a href="<?=base_url("WajibPajak")?>" class="nav-link <?php if ($title == "Daftar WP") {
              echo "active";
            } ?>">
              <i class="nav-icon fas fa-users"></i>
              <p><b>Daftar WP</b></p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
