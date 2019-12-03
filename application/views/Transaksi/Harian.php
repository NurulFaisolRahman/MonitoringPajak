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
                      <td>
                        <button type="button" class="btn btn-outline-primary float-right" id="reservation">
                          <i class="far fa-calendar-alt"></i> &nbsp;Rentang Hari
                          <i class="fas fa-caret-down"></i>
                        </button>
                      </td>
                      <td class="font-weight-bold text-primary">&emsp;Bidang Pajak :&nbsp;</td>
                      <td>
                        <select class="form-control btn btn-outline-primary" name="tahun">
                          <option>Semua Bidang</option>
                        </select>
                      </td>
                      <td>&emsp;
                        <a href="" class="btn btn-danger"><i class="fas fa-file-pdf"></i>
                        <b>PDF</b></a>
                      </td>
                      <td>&emsp;
                        <a href="" class="btn btn-success"><i class="fas fa-file-excel"></i>
                        <b>Excel</b></a>
                      </td>
                    </tr>
                  </table>
                </div>
                <div class="card-body table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead class="bg-primary">
                    <tr>
                      <th style="width:10px;">No</th>
                      <th style="width:25%;">Tempat</th>
                      <th>(n)Receipt (Rp)</th>
                      <th>Subtotal (Rp)</th>
                      <th>Service (Rp)</th>
                      <th>Tax (Rp)</th>
                      <th>Total (Rp)</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php for ($i=1; $i < 21; $i++) {?>
                        <tr>
                          <td><?=$i?></td>
                          <td>Nama WP</td>
                          <td><?=rand(15,1000)?></td>
                          <td><?=rand(15,1000)?></td>
                          <td><?=rand(15,1000)?></td>
                          <td><?=rand(15,1000)?></td>
                          <td><?=rand(15,1000)?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                    <tfoot class="bg-success">
                    <tr>
                      <th colspan="2" class="text-right">Total</th>
                      <th>Rp 123</th>
                      <th>Rp 123</th>
                      <th>Rp 123</th>
                      <th>Rp 123</th>
                      <th>Rp 123</th>
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
      })
    });
  </script>
</body>
</html>
