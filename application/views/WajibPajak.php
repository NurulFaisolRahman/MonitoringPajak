<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <i class="fas fa-users mr-1"></i>
          <b>WAJIB PAJAK</b>
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
              <div class="col-8">
                <table>
                  <tr>
                    <td>
                      <a href="#" data-toggle="modal" data-target="#ModalWP" class="btn btn-primary font-weight-bold"><li class="fa fa-plus"></li> WAJIB PAJAK</a>
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
          <div class="card-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead class="bg-primary">
              <tr>
                <th style="width: 10px;">No</th>
                <th>NPWPD</th>
                <th>Nomor Rekening</th>
                <th>Tempat</th>
                <th>Jenis Pajak</th>
                <th style="width: 120px;">Jam Operasional</th>
                <th style="width: 125px;">Status</th>
                <th style="width: 10px;">Action</th>
              </tr>
              </thead>
              <tbody>
                <?php for ($i=1; $i < 7; $i++) {?>
                  <tr>
                    <td><?=$i?></td>
                    <td><?="1507.".rand(100,999).".".rand(100,999)?></td>
                    <td><?="4.1.1 ".rand(100,999).".".rand(100,999)?></td>
                    <td>Alamat WP</td>
                    <td>Jenis Usaha</td>
                    <td>07.00 - 21.00</td>
                    <td>
                      <a href="#" class="btn btn-primary"><i class="fas fa-smile"></i></a>
                      <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                    </td>
                    <td>
                      <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
              <?php } ?>
              </tbody>
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
<div class="modal fade" id="ModalWP">
  <div class="modal-dialog">
    <div class="modal-content bg-primary">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold">Data Wajib Pajak</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>NPWPD</b></span>
            </div>
            <input type="text" class="form-control" data-inputmask='"mask": "9999.999.999999"' data-mask>
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Nama WP</b></span>
            </div>
            <input class="form-control" type="text">
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Alamat</b></span>
            </div>
            <input class="form-control" type="text">
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Nomor Rekening</b></span>
            </div>
            <input class="form-control" type="text">
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Jam Operasional</b></span>
            </div>
            <input type="text" class="form-control" data-inputmask='"mask": "99.99-99.99"' data-mask>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal"><b>Tutup</b></button>
        <button type="button" class="btn btn-outline-light"><b>Simpan</b></button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
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
      $('[data-mask]').inputmask()
      // Switch ON OFF
      $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      });
    })
  });
</script>
</body>
</html>
