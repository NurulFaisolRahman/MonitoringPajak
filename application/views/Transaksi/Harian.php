<?php 
  function Rupiah($Angka){
    $hasil_rupiah = "Rp " . number_format($Angka,2,',','.');
    return $hasil_rupiah;
  }
 ?>
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
  						<i class="fas fa-edit mr-1"></i>
              <b>TRANSAKSI</b>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Konten -->
      <section class="content">
        <div class="container-fluid">
          <div class="row align-items-center">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <table>
                    <tr>
                      <form action="<?=base_url('Transaksi/Harian')?>" method="post">
                        <td>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-primary">
                                <i class="far fa-calendar-alt"></i>
                              </span>
                            </div>
                            <input type="text" class="form-control btn btn-outline-primary float-right" name="Hari" id="reservation" value="<?php if(!empty($hari)) echo $hari ?>">
                          </div>
                        </td>
                        <td class="font-weight-bold text-primary">&emsp;Bidang Pajak :&nbsp;</td>
                        <td>
                          <select class="form-control btn btn-outline-primary" name="BidangPajak" id="BidangPajak">
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
                      <td>&emsp;
                        <button id="PDF" class="btn btn-danger"><i class="fas fa-file-pdf"></i>
                        <b>PDF</b></button>
                      </td>
                      <td>&emsp;
                        <button id="Excel" href="#" class="btn btn-success"><i class="fas fa-file-excel"></i>
                        <b>Excel</b></button>
                      </td>
                    </tr>
                  </table>
                </div>
                <div class="card-body table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead class="bg-primary">
                    <tr>
                      <th>No</th>
                      <th>NPWPD</th>
                      <th>(n)Receipt (Rp)</th>
                      <th>Subtotal (Rp)</th>
                      <th>Service (Rp)</th>
                      <th>Tax (Rp)</th>
                      <th>Total (Rp)</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php 
                          $TotalSubNominal = $TotalService = $TotalPajak = $Total = 0;
                       ?>
                      <?php $Nomor = 1; foreach ($Transaksi as $key){ ?>
                        <tr>
                          <td><?=$Nomor?></td>
                          <td><?=$key['NPWPD']?></td>
                          <td><?=$key['NomorTransaksi']?></td>
                          <td><?=$key['SubNominal']?></td>
                          <td><?=$key['Service']?></td>
                          <td><?=$key['Pajak']?></td>
                          <td><?=$key['TotalTransaksi']?></td>
                        </tr>
                        <?php 
                          $TotalSubNominal += $key['SubNominal'];
                          $TotalService += $key['Service'];
                          $TotalPajak += $key['Pajak'];
                          $Total += $key['TotalTransaksi'];
                         ?>
                      <?php $Nomor++; } ?>
                    </tbody>
                    <tfoot class="bg-success">
                    <tr>
                      <th colspan="3" class="text-right">Total</th>
                      <th><?=Rupiah($TotalSubNominal)?></th>
                      <th><?=Rupiah($TotalService)?></th>
                      <th><?=Rupiah($TotalPajak)?></th>
                      <th><?=Rupiah($Total)?></th>
                    </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
  </div>
  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- InputMask -->
  <script src="../plugins/moment/moment.min.js"></script>
  <!-- date-range-picker -->
  <script src="../plugins/daterangepicker/daterangepicker.js"></script>
  <!-- DataTables -->
  <script src="../plugins/datatables/jquery.dataTables.js"></script>
  <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#example1').DataTable( {
          "scrollY": "50vh",
          "scrollCollapse": true,
          "paging": false,
          "ordering": true,
          "autoWidth": true,
      });
      $(function () {
        $('#reservation').daterangepicker()

        $(document).on("click","#PDF",function(){
          
        });
        
        $(document).on("click","#Excel",function(){
          var Hari = $('#reservation').val()
          var BidangPajak = $('#BidangPajak').val()
          if (true) {

          } else {
            
          }
        });
      })
    });
  </script>
</body>
</html>
