  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
						<i class="fas fa-home mr-1"></i>
            <b>DASHBOARD</b>
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
