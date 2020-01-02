<script>
  var BaseURL = '<?=base_url()?>';
</script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-1">
          <div class="col-sm-6">
						<i class="fas fa-globe mr-1"></i>
            <b>Web Servis</b>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
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
                      <a href="" data-toggle="modal" data-target="#ModalWS" class="btn btn-primary font-weight-bold"><li class="fa fa-plus"></li> WEB SERVIS</a>
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
                <th style="width:10px;">No</th>
                <th>NPWPD</th>
                <th>URL</th>
                <th>WaktuRegistrasi</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                <?php $Nomor = 1; foreach ($DataWebServis as $key){ ?>
                  <tr valign="middle">
                    <td align="center"><?=$Nomor?></td>
                    <td><?=$key['NPWPD']?></td>
                    <td><?=$key['URL']?></td>
                    <td><?=$key['WaktuRegistrasi']?></td>
                    <td>
                      <?php if ($key['StatusWebServis'] == "Enable") {?>
                          <input type="checkbox" data-size="mini" StatusWS="<?=$key['NPWPD']?>" id="WSstatus" data-toggle="toggle" data-on="Enable" data-off="Disable" data-onstyle="success" data-offstyle="danger" data-width="70" checked>
                        <?php } else {?>
                          <input type="checkbox" data-size="mini" StatusWS="<?=$key['NPWPD']?>" id="WSstatus" data-toggle="toggle" data-on="Enable" data-off="Disable" data-onstyle="success" data-offstyle="danger" data-width="70">
                        <?php } ?>
                    </td>
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
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->
<form onsubmit="event.preventDefault();">
<div class="modal fade" id="ModalWS">
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
              <input type="text" id="NPWPD" class="form-control" data-inputmask='"mask": "9999.99.999"' data-mask>
            </div>
            <br>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text bg-primary"><b>URL</b></i></span>
              </div>
              <input id="UrlApi" class="form-control" type="text">
            </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal"><b>Tutup</b></button>
        <button type="submit" class="btn btn-outline-light" id="SimpanWS"><b>Simpan</b></button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</form>
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- DataTables -->
  <script src="plugins/datatables/jquery.dataTables.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <!-- Bootstrap Toggle -->
  <script src="plugins/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
  <!-- InputMask -->
  <script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#example1').DataTable( {
        "scrollY": "50vh",
        "scrollCollapse": true,
        "paging": false,
        "ordering": true,
        "autoWidth": true,
      });

      $('[data-mask]').inputmask()

      $('input[type="checkbox"]').on('change', function(e){
        var StatusWS
        if ($('#WSstatus').is(":checked")) {
          StatusWS = "Enable"
          var schedule = require('node-schedule');
        } else {
          StatusWS = "Disable"
        }
        var GantiStatus = { NPWPD: $(this).attr('StatusWS'), WSstatus: StatusWS };
        $.post(BaseURL+"WebServis/GantiStatus", GantiStatus)
      });

      $(document).on("click","#SimpanWS",function(){
        // if ($('#PasswordLama').val() === '') {
        //   alert('Mohon Input Password Lama')
        // } else if ($('#PasswordBaru').val() === '') {
        //   alert('Mohon Input Password Baru')
        // } else if ($('#CekPasswordBaru').val() === '') {
        //   alert('Mohon Input Verifikasi Password Baru')
        // } else if($('#PasswordBaru').val().length > 15) {
        //   alert('Password Baru Maksimal 15 Karakter')
        // } else if ($('#PasswordBaru').val() != $('#CekPasswordBaru').val()) {
        //   alert('Password Baru Tidak Sama Dengan Verifikasi Password Baru')
        // } else {
        //   var Data = {Username : Username, 
        //               PasswordLama: $('#PasswordLama').val(),
        //               PasswordBaru: $('#PasswordBaru').val() };
        //   $.post(BaseURL+"Transaksi/WPGantiPassword", Data).done(function(Respon) {
        //     if (Respon == 'ok') {
        //       $(':input').val('');
        //       alert('Password Berhasil Di Ganti')
        //     } else {
        //       alert(Respon)
        //     }
        //   });
        // }
      });
    })
  </script>
</body>
</html>
