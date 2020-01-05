<script>
  var BaseURL = '<?=base_url()?>';
  var Username = '<?=$this->session->userdata('NamaAdmin') ?>'
</script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-1">
          <div class="col-sm-6">
						<i class="fas fa-lock mr-1"></i>
            <b>Ganti Password</b>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="card ml-2">
              <div class="card-body">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-primary"><b>Password Lama</b></span>
                  </div>
                  <input id="PasswordLama" class="form-control" type="password">
                </div>
                <br>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-primary"><b>Password Baru</b></i></span>
                  </div>
                  <input id="PasswordBaru" class="form-control" type="password">
                </div>
                <br>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-primary"><b>Verifikasi Password Baru</b></i></span>
                  </div>
                  <input id="CekPasswordBaru" class="form-control" type="password">
                </div>
                <br>
                <button class="btn btn-success" id="GantiPassword"><b>Simpan</b></button>
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
  <script src="<?=base_url('plugins/jquery/jquery.min.js')?>"></script>
  <!-- Bootstrap 4 -->
  <script src="<?=base_url('plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
  <!-- AdminLTE App -->
  <script src="<?=base_url('dist/js/adminlte.min.js')?>"></script>
  <script>
    $(document).ready(function() {
      $(document).on("click","#GantiPassword",function(){
        if ($('#PasswordLama').val() === '') {
          alert('Mohon Input Password Lama')
        } else if ($('#PasswordBaru').val() === '') {
          alert('Mohon Input Password Baru')
        } else if ($('#CekPasswordBaru').val() === '') {
          alert('Mohon Input Verifikasi Password Baru')
        } else if($('#PasswordBaru').val().length > 15) {
          alert('Password Baru Maksimal 15 Karakter')
        } else if ($('#PasswordBaru').val() != $('#CekPasswordBaru').val()) {
          alert('Password Baru Tidak Sama Dengan Verifikasi Password Baru')
        } else {
          var Data = {Username : Username, 
                      PasswordLama: $('#PasswordLama').val(),
                      PasswordBaru: $('#PasswordBaru').val() };
          $.post(BaseURL+"Transaksi/WPGantiPassword", Data).done(function(Respon) {
            if (Respon == 'ok') {
              $(':input').val('');
              alert('Password Berhasil Di Ganti')
            } else {
              alert(Respon)
            }
          });
        }
      });
    })
  </script>
</body>
</html>
