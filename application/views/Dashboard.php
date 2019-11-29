<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
	<link rel="icon" href="Favicon.ico" type="image/x-icon">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
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
        <a class="nav-link text-primary"><b><h5>KOTA MALANG</h5></b></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-lock"><span class="text-primary"> SIGN OUT</span></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
		<a href="" class="brand-link bg-success">
      <img src="Logo.png"
           alt="LogoBP2D"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><b>DASHBOARD</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                <b>Dashboard</b>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../index.html" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="../widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p><b>Widgets</b></p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
						<i class="fas fa-home mr-1"></i>
            DASHBOARD
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-8">
            <table>
              <tr>
                <td class="font-weight-bold text-primary">Tahun :&nbsp;</td>
                <td>
                  <select class="form-control btn btn-outline-primary" name="tahun">
                    <option>2019</option>
                  </select>
                </td>
                <td class="font-weight-bold text-primary">&emsp;Bulan :&nbsp;</td>
                <td>
                  <select class="form-control btn btn-outline-primary" name="tahun">
                    <option>Desember</option>
                  </select>
                </td>
                <td class="font-weight-bold text-primary">&emsp;Bidang Pajak :&nbsp;</td>
                <td>
                  <select class="form-control btn btn-outline-primary" name="tahun">
                    <option>Semua Bidang</option>
                  </select>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box bg-primary">
              <div class="info-box-content">
                <span class="info-box-text text-white font-weight-bold">TOTAL TRANSAKSI BULAN</span>
                <span class="info-box-number font-weight-bold">
                  Rp 15
                </span>
              </div>
            </div>
          </div>
					<div class="col-12 col-sm-6 col-md-3">
            <div class="info-box bg-warning">
              <div class="info-box-content">
                <span class="info-box-text text-white font-weight-bold">TOTAL PAJAK BULAN</span>
                <span class="info-box-number text-white font-weight-bold">
                  Rp 15
                </span>
              </div>
            </div>
          </div>
					<div class="col-12 col-sm-6 col-md-3">
            <div class="info-box bg-success">
              <div class="info-box-content">
                <span class="info-box-text text-white font-weight-bold">TOTAL TRANSAKSI TAHUN</span>
                <span class="info-box-number font-weight-bold">
                  Rp 15
                </span>
              </div>
            </div>
          </div>
					<div class="col-12 col-sm-6 col-md-3">
            <div class="info-box bg-danger">
              <div class="info-box-content">
                <span class="info-box-text text-white font-weight-bold">TOTAL PAJAK TAHUN</span>
                <span class="info-box-number font-weight-bold">
                  Rp 15
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-7">
						<div class="card">
              <div class="card-header border-0 bg-warning">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title text-white font-weight-bold">GRAFIK WAJIB PAJAK</h3>
                </div>
              </div>
              <div class="card-body">
                <div class="position-relative">
                  <canvas id="visitors-chart"></canvas>
                </div>
              </div>
            </div>
          </div>
					<div class="col-5">
						<div class="card">
              <div class="card-header border-0 bg-danger">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title text-white font-weight-bold">TOP 5 WAJIB PAJAKA</h3>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
								<table class="table table-bordered">
                  <thead class="bg-success">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Transaksi</th>
                      <th>Wajib Pajak</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1.</td>
                      <td>Transaksi : <br>Pajak :</td>
                      <td>Nama WP</td>
                    </tr>
                    <tr>
                      <td>2.</td>
                      <td>Transaksi : <br>Pajak :</td>
                      <td>Nama WP</td>
                    </tr>
                    <tr>
                      <td>3.</td>
                      <td>Transaksi : <br>Pajak :</td>
                      <td>Nama WP</td>
                    </tr>
                    <tr>
                      <td>4.</td>
                      <td>Transaksi : <br>Pajak :</td>
                      <td>Nama WP</td>
                    </tr>
                    <tr>
                      <td>5.</td>
                      <td>Transaksi : <br>Pajak :</td>
                      <td>Nama WP</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<script type="text/javascript">
$(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode      = 'index'
  var intersect = true
  var tanggal = []
  var DataTransaksi = []
  var DataPajak = []
  for (var i = 0; i < 31; i++) {
    tanggal[i] = i.toString();
    DataTransaksi[i] = Math.floor(Math.random() * 1000);
    DataPajak[i] = Math.floor(Math.random() * 1000);
  }
  var grafik = document.getElementById("visitors-chart").getContext('2d');
  var myLineChart = new Chart(grafik, {
  type: 'line',
  data: {
      labels: tanggal,
      datasets: [{
              label: "Total Transaksi",
              data: DataTransaksi,
              backgroundColor: [
                  'rgba(0, 0, 255, .3)',
              ],
              borderColor: [
                  'rgba(0, 0, 255, .7)',
              ],
              borderWidth: 2
          },
          {
              label: "Total Pajak",
              data: DataPajak,
              backgroundColor: [
                  'rgba(255, 255, 0, .3)',
              ],
              borderColor: [
                  'rgba(255, 255, 0, .7)',
              ],
              borderWidth: 2
          }
      ]
  },
  options: {
      responsive: true
  }
  });
  })
</script>
</body>
</html>
