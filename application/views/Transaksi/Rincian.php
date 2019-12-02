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
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-12">
                    <table>
                      <tr>
                        <td class="font-weight-bold text-primary">Bulan :&nbsp;</td>
                        <td>
                          <select class="form-control btn btn-outline-primary" name="tahun">
                            <option>Juli</option>
                          </select>
                        </td>
                        <td class="font-weight-bold text-primary">&emsp;Tahun :&nbsp;</td>
                        <td>
                          <select class="form-control btn btn-outline-primary" name="tahun">
                            <option>2019</option>
                          </select>
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
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead class="bg-primary">
                  <tr>
                    <th style="width:10px;">No</th>
                    <th style="width:30%;">Tempat</th>
                    <th>(n)Receipt</th>
                    <th>Subtotal</th>
                    <th>Service</th>
                    <th>Tax</th>
                    <th>Total</th>
                    <th style="width:10px;">Action</th>
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
                        <td class="align-middle">
                          <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-danger"><i class="fas fa-file-pdf"></i></a>
                            <a href="#" class="btn btn-success"><i class="fas fa-file-excel"></i></a>
                          </div>
                        </td>
                      </tr>
                  <?php } ?>
                  </tbody>
                  <tfoot class="bg-success">
                  <tr>
                    <th colspan="2" class="text-right">Total</th>
                    <th>123</th>
                    <th>123</th>
                    <th>123</th>
                    <th>123</th>
                    <th>123</th>
                    <th></th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
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
    });
  </script>
</body>
</html>
