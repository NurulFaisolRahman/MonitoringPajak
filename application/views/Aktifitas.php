<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <i class="fas fa-history mr-1"></i>
          <b>AKTIFITAS</b>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Konten -->
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <!-- /.card-header -->
          <div class="card-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead class="bg-primary">
              <tr>
                <th style="width:10px;">No</th>
                <th>Nama User</th>
                <th>Aktifitas</th>
                <th>IP Address</th>
                <th>TanggalAkses</th>
              </tr>
              </thead>
              <tbody>
                <?php $Nomor = 1; foreach ($DataAktifitas as $key){ ?>
                  <tr valign="middle">
                    <td align="center"><?=$Nomor?></td>
                    <td><?=$key['NamaUser']?></td>
                    <td><?=$key['Aktifitas']?></td>
                    <td><?=$key['IP']?></td>
                    <td><?=$key['TanggalAkses']?></td>
                  </tr>
              <?php $Nomor++; } ?>
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
<script src="<?=base_url('plugins/jquery/jquery.min.js')?>"></script>
<script src="<?=base_url('plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<script src="<?=base_url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')?>"></script>
<script src="<?=base_url('plugins/datatables/jquery.dataTables.js')?>"></script>
<script src="<?=base_url('plugins/datatables-bs4/js/dataTables.bootstrap4.js')?>"></script>
<script src="<?=base_url('dist/js/adminlte.min.js')?>"></script>
<script>
  $(document).ready(function() {
    $('#example1').DataTable( {
        "scrollY": "50vh",
        "scrollCollapse": true,
        "paging": true,
        "ordering": true,
        "autoWidth": true,
    });
  });
</script>
</body>
</html>
