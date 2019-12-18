<script>var BaseURL = '<?=base_url()?>';</script>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <i class="fas fa-user mr-1"></i>
          <b>USER</b>
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
                      <a href="#" data-toggle="modal" data-target="#ModalUser" class="btn btn-primary font-weight-bold"><li class="fa fa-plus"></li> USER</a>
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
                <th>Username</th>
                <th>Jenis Akun</th>
                <th>Pembuat</th>
                <th>Waktu Registrasi</th>
                <?php if($this->session->userdata('Admin')){ ?>
                  <th style="width:10px;">Action</th>
                <?php }; ?>
              </tr>
              </thead>
              <tbody>
                <?php $Nomor = 1; foreach ($DataUser as $key){ ?>
                  <tr valign="middle">
                    <td align="center"><?=$Nomor?></td>
                    <td><?=$key['Username']?></td>
                    <td><?php if ($key['JenisAkun'] == '2') {
                        echo "Read Only";
                      } else {
                        echo "Wajib Pajak";
                      }
                     ?></td>
                    <td><?=$key['Pembuat']?></td>
                    <td><?=$key['WaktuRegistrasi']?></td>
                    <td align="center">
                      <div class="btn-group btn-group-sm">
                        <a href="#" EditUser="<?=$key['Username']."|".$key['JenisAkun'];?>" class="btn btn-warning EditUser"><i class="fas fa-edit"></i></a>
                        <a href="#" HapusUser="<?=$key['Username'];?>" class="btn btn-danger HapusUser"><i class="fas fa-trash"></i></a>
                      </div>
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
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
</div>
<form onsubmit="event.preventDefault();">
<div class="modal fade" id="ModalUser">
  <div class="modal-dialog">
    <div class="modal-content bg-primary">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold">Data User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Jenis Akun</b></i></span>
            </div>
            <select class="form-control btn btn-light" id="JenisAkun">
              <option value="2"><?="Read Only"?></option>
              <option value="3"><?="Wajib Pajak"?></option>
            </select>
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Username</b></i></span>
            </div>
            <input class="form-control" type="text" id="Username">
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Password</b></i></span>
            </div>
            <input class="form-control" type="password" id="Password">
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal"><b>Tutup</b></button>
        <button type="submit" class="btn btn-outline-light" id="TambahUser"><b>Simpan</b></button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</form>
<form onsubmit="event.preventDefault();">
<div class="modal fade" id="ModalEditUser">
  <div class="modal-dialog">
    <div class="modal-content bg-primary">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold">Data User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Username</b></i></span>
            </div>
            <input class="form-control" type="hidden" id="EditJenisAkun">
            <input class="form-control" type="hidden" id="EditUsernameLama">
            <input class="form-control" type="text" id="EditUsername">
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Password</b></i></span>
            </div>
            <input class="form-control" type="password" id="EditPassword">
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal"><b>Tutup</b></button>
        <button type="submit" class="btn btn-outline-light" id="EditUser"><b>Simpan</b></button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</form>
<!-- /.modal -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
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

    $(document).on("click","#TambahUser",function(){
      if ($('#Username').val() === '' || $('#Username').val().indexOf(' ') >= 0) {
        alert('Mohon Input Username Tanpa Spasi')
      } else if($('#Password').val() === '') {
        alert('Mohon Input Password')
      } else {
        var Data = { Username: $('#Username').val(),
                    Password: $('#Password').val(),
                    JenisAkun: $('#JenisAkun').val()};
        $.post(BaseURL+"/User/Tambah", Data).done(function(Respon) {
          if (Respon == 'ok') {
            window.location = BaseURL + '/User';
          } else {
            alert(Respon)
          }
        });
      }
    });

    $(document).on("click","#EditUser",function(){
      if ($('#EditUsername').val() === '' || $('#EditUsername').val().indexOf(' ') >= 0) {
        alert('Mohon Input Username Tanpa Spasi')
      } else {
        var Data = { EditUsernameLama: $('#EditUsernameLama').val(),
                   EditUsername: $('#EditUsername').val(),
                   EditPassword: $('#EditPassword').val(),
                   EditJenisAkun: $('#EditJenisAkun').val()};
        $.post(BaseURL+"/User/Edit", Data).done(function(Respon) {
          if (Respon == 'ok') {
            window.location = BaseURL + '/User';
          } else {
            alert(Respon)
          }
        });
      }
    });

    $(document).on("click",".EditUser",function(){
      var Data = $(this).attr('EditUser');
      var Pisah = Data.split("|");
      document.getElementById('EditUsernameLama').value = Pisah[0];
      document.getElementById('EditUsername').value = Pisah[0];
      document.getElementById('EditJenisAkun').value = Pisah[1];
      $('#ModalEditUser').modal("show");
    });

    $(document).on("click",".HapusUser",function(){
      var HapusUser = { Username: $(this).attr('HapusUser')};
      var Konfirmasi = confirm("Yakin Ingin Menghapus Data?");
      if (Konfirmasi == true) {
        $.post(BaseURL+"/User/Hapus", HapusUser).done(function(Respon) {
          if (Respon == 'ok') {
            window.location = BaseURL + '/User';
          }
        });
      }
    });
  });
</script>
</body>
</html>
