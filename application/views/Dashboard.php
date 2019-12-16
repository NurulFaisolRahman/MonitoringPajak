  <?php 
  function Rupiah($Angka){
    $hasil_rupiah = "Rp " . number_format($Angka,2,',','.');
    return $hasil_rupiah;
  }
 ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-1">
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
        <div class="row align-items-center">
          <div class="card ml-2">
              <div class="card-header">
                <table>
                  <tr>
                    <td class="font-weight-bold text-primary">Bulan :&nbsp;</td>
                      <form action="<?=base_url('Dashboard')?>" method="post">
                        <td>
                          <input class="form-control btn btn-outline-primary" type="date" id="Bulan" name="Bulan" value="<?php if(!empty($bulan)) echo $bulan ?>" required>
                        </td>
                        <td class="font-weight-bold text-primary">&emsp;Bidang Pajak :&nbsp;</td>
                        <td>
                          <select class="form-control btn btn-outline-primary" name="BidangPajak">
                          <option value="All" <?php if ($bidangpajak == 'All') {
                            echo "selected";
                          } ?>><?="All"?></option>
                          <?php foreach ($DataRekening as $key){ ?>
                            <option value="<?=$key['JenisPajak']?>" <?php if ($bidangpajak == $key['JenisPajak']) {
                            echo "selected";
                          } ?>><?=$key['JenisPajak']?></option>
                          <?php } ?>
                          </select>
                        </td>
                        <td>&emsp;
                          <button type="submit" class="btn btn-primary" id="Filter"><b>FILTER</b></button>
                        </td>
                      </form>
                  </tr>
                </table>
              </div>
            </div>
        </div>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box bg-primary">
              <div class="info-box-content">
                <span style="font-size: 14px;" class="info-box-text text-white font-weight-bold">TOTAL TRANSAKSI <?=strtoupper($Bulan)." ".$Tahun?></span>
                <span class="info-box-number font-weight-bold">
                  <?=$TotalTransaksiBulan?>
                </span>
              </div>
            </div>
          </div>
					<div class="col-12 col-sm-6 col-md-3">
            <div class="info-box bg-warning">
              <div class="info-box-content">
                <span style="font-size: 14px;" class="info-box-text text-white font-weight-bold">TOTAL PAJAK <?=strtoupper($Bulan)." ".$Tahun?></span>
                <span class="info-box-number text-white font-weight-bold">
                  <?=$TotalPajakBulan?>
                </span>
              </div>
            </div>
          </div>
					<div class="col-12 col-sm-6 col-md-3">
            <div class="info-box bg-success">
              <div class="info-box-content">
                <span style="font-size: 14px;" class="info-box-text text-white font-weight-bold">TOTAL TRANSAKSI TAHUN <?=$Tahun?></span>
                <span class="info-box-number font-weight-bold">
                  <?=$TotalTransaksiTahun?>
                </span>
              </div>
            </div>
          </div>
					<div class="col-12 col-sm-6 col-md-3">
            <div class="info-box bg-danger">
              <div class="info-box-content">
                <span style="font-size: 14px;" class="info-box-text text-white font-weight-bold">TOTAL PAJAK TAHUN <?=$Tahun?></span>
                <span class="info-box-number font-weight-bold">
                  <?=$TotalPajakTahun?>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-7 col-sm-12">
						<div class="card">
              <div class="card-header border-0 bg-warning">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title text-white font-weight-bold">GRAFIK WAJIB PAJAK BULAN <?=strtoupper($Bulan)." ".$Tahun?></h3>
                </div>
              </div>
              <div class="card-body">
                <div class="position-relative">
                  <canvas id="visitors-chart"></canvas>
                </div>
              </div>
            </div>
          </div>
					<div class="col-lg-5 col-sm-12">
						<div class="card">
              <div class="card-header border-0 bg-danger">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title text-white font-weight-bold">TOP 5 WAJIB PAJAK BULAN <?=strtoupper($Bulan)." ".$Tahun?></h3>
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
                    <?php $Nomor = 1; foreach ($Top5 as $key) { ?>
                      <?php 
                        if ($Nomor < 6) {?>
                          <tr>
                            <td><?=$Nomor?></td>
                            <td>Trx : <?=Rupiah($key['Transaksi'])?><br>Tax : <?=Rupiah($key['Pajak'])?></td>
                            <td><?=$key['NamaWP']?></td>
                          </tr>
                       <?php } ?>
                    <?php $Nomor++; } ?>
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

  var d = new Date();
  var bulan = d.getFullYear()+'-'+(d.getMonth()+1)+'-'+d.getDate();
  if ($("#Bulan").val() == "") {
    document.getElementById('Bulan').value = bulan;
  }

  var tanggal = []
  var JumlahTanggal = "<?=$JumlahTanggal?>"
  var Transaksi = <?= json_encode($GrafikTransaksi)?>;
  var Pajak = <?= json_encode($GrafikPajak)?>;
  var DataTransaksi = [];
  var DataPajak = [];
  Object.keys(Transaksi).forEach(function(key) {
    DataTransaksi[Number(key)] = Number(Transaksi[key])
  });
  Object.keys(Pajak).forEach(function(key) {
    DataPajak[Number(key)] = Number(Pajak[key])
  });
  for (var i = 1; i <= JumlahTanggal; i++) {
    tanggal[i] = i.toString();
  }
  tanggal[0] = 'Tanggal';
  var grafik = document.getElementById("visitors-chart").getContext('2d');
  var myLineChart = new Chart(grafik, {
  type: 'line',
  data: {
      labels: tanggal,
      datasets: [{
              label: "Total Transaksi",
              data: DataTransaksi,
              borderColor         : '#0000ff',
              pointBorderColor    : '#0000ff',
              pointBackgroundColor: '#0000ff',
              fill                : false,
              borderWidth: 2
          },
          {
              label: "Total Pajak",
              data: DataPajak,
              borderColor         : '#ffff00',
              pointBorderColor    : '#ffff00',
              pointBackgroundColor: '#ffff00',
              fill                : false,
              borderWidth: 2
          }
      ]
  },
  options: {
      responsive: true,
      tooltips: {
        mode: 'index',
        intersect: true
      },
      legend: {
        display: false
      }
    }
  });
  })
</script>
</body>
</html>
