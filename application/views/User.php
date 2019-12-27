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
                      <a href="" data-toggle="modal" data-target="#ModalUser" class="btn btn-warning text-white font-weight-bold"><li class="fa fa-plus"></li> USER</a>
                    </td>
                    <td>&emsp;
                      <a href="" data-toggle="modal" data-target="#ModalTambahWP" class="btn btn-success font-weight-bold"><li class="fa fa-plus"></li> WAJIB PAJAK</a>
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
                        <button EditUser="<?=$key['Username']."|".$key['JenisAkun'];?>" class="btn btn-warning EditUser"><i class="fas fa-edit"></i></button>
                        <button HapusUser="<?=$key['Username'];?>" class="btn btn-danger HapusUser"><i class="fas fa-trash"></i></button>
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
<form onsubmit="event.preventDefault();">
<div class="modal fade" id="ModalTambahWP">
  <div class="modal-dialog">
    <div class="modal-content bg-primary">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold">Data User WP</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Username</b></i></span>
            </div>
            <input class="form-control" type="text" id="UsernameWP">
          </div>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Password</b></i></span>
            </div>
            <input class="form-control" type="password" id="PasswordWP">
          </div>
          <div class="container-fluid">
            <div class="row mb-2">
              <?php 
                $WP = $this->db->get_where('WajibPajak', array('Pemilik' => NULL))->result_array();
                foreach ($WP as $key) { ?>
                  <div class="col-6">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="DaftarWP" value="<?=$key['NPWPD'];?>">
                      <label class="form-check-label"><?=$key['NamaWP'];?></label>
                    </div>
                  </div>
               <?php } ?> 
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal"><b>Tutup</b></button>
        <button type="submit" class="btn btn-outline-light" id="TambahWP"><b>Simpan</b></button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</form>
<form onsubmit="event.preventDefault();">
<div class="modal fade" id="ModalEditWP">
  <div class="modal-dialog">
    <div class="modal-content bg-primary">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold">Data User WP</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Username</b></i></span>
            </div>
            <input class="form-control" type="hidden" id="EditUsernameWPLama">
            <input class="form-control" type="text" id="EditUsernameWP">
          </div>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Password</b></i></span>
            </div>
            <input class="form-control" type="password" id="EditPasswordWP">
          </div>
          <div class="container-fluid">
            <div class="row mb-2">
              <?php 
                $WP = $this->db->get('WajibPajak')->result_array();
                foreach ($WP as $key) { ?>
                  <div class="col-6">
                    <div class="form-check">
                      <input class="form-check-input <?=$key['Pemilik'];?>" type="checkbox" name="EditDaftarWP" value="<?=$key['NPWPD'];?>">
                      <label class="form-check-label"><?=$key['NamaWP'];?></label>
                    </div>
                  </div>
               <?php } ?> 
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal"><b>Tutup</b></button>
        <button type="submit" class="btn btn-outline-light" id="EditWP"><b>Simpan</b></button>
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
        alert('Mohon Input Username & Tanpa Spasi')
      } else if($('#Password').val() === '') {
        alert('Mohon Input Password')
      } else {
        var Data = { Username: $('#Username').val(),
                    Password: $('#Password').val() };
        $.post(BaseURL+"User/Tambah", Data).done(function(Respon) {
          if (Respon == 'ok') {
            window.location = BaseURL + 'User';
          } else {
            alert(Respon)
          }
        });
      }
    });

    $("#TambahWP").click(function(){
      var DaftarWP = []
      $.each($("input[name='DaftarWP']:checked"), function(){
          DaftarWP.push($(this).val())
      })
      if ($('#UsernameWP').val() === '' || $('#Username').val().indexOf(' ') >= 0) {
        alert('Mohon Input Username & Tanpa Spasi')
      } else if($('#PasswordWP').val() === '') {
        alert('Mohon Input Password')
      } else if (DaftarWP.length == 0) {
        alert('Mohon Input Checkbox WajibPajak!')
      } else {
        var Data = { UsernameWP: $('#UsernameWP').val(),
                    PasswordWP: $('#PasswordWP').val(),
                    DataWP : DaftarWP };
        $.post(BaseURL+"User/TambahWP", Data).done(function(Respon) {
          if (Respon == 'ok') {
            window.location = BaseURL + 'User';
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
                   EditPassword: $('#EditPassword').val() };
        $.post(BaseURL+"User/Edit", Data).done(function(Respon) {
          if (Respon == 'ok') {
            window.location = BaseURL + 'User';
          } else {
            alert(Respon)
          }
        });
      }
    });

    $(document).on("click","#EditWP",function(){
      var EditDaftarWP = []
      $.each($("input[name='EditDaftarWP']:checked"), function(){
          EditDaftarWP.push($(this).val())
      })
      if ($('#EditUsernameWP').val() === '' || $('#EditUsernameWP').val().indexOf(' ') >= 0) {
        alert('Mohon Input Username Tanpa Spasi')
      } else if (EditDaftarWP.length == 0) {
        alert('Mohon Input Checkbox WajibPajak!')
      }else {
        var Data = { EditUsernameWPLama: $('#EditUsernameWPLama').val(),
                   EditUsernameWP: $('#EditUsernameWP').val(),
                   EditPasswordWP: $('#EditPasswordWP').val(),
                   EditDataWP : EditDaftarWP }
        $.post(BaseURL+"User/EditWP", Data).done(function(Respon) {
          if (Respon == 'ok') {
            window.location = BaseURL + 'User';
          } else {
            alert(Respon)
          }
        });
      }
    });

    $(document).on("click",".EditUser",function(){
      var Data = $(this).attr('EditUser');
      var Pisah = Data.split("|");
      if (Pisah[1] == '2') {
        document.getElementById('EditUsernameLama').value = Pisah[0];
        document.getElementById('EditUsername').value = Pisah[0];
        $('#ModalEditUser').modal("show");
      } else if (Pisah[1] == '3') {
        document.getElementById('EditUsernameWPLama').value = Pisah[0];
        document.getElementById('EditUsernameWP').value = Pisah[0];
        $('.'+Pisah[0]).prop('checked', true);
        $('.'+Pisah[0]).attr("disabled", false);
        $.post(BaseURL+"User/DaftarWP").done(function(Respon) {
          for (var key in JSON.parse(Respon)) {
            if (JSON.parse(Respon)[key].Pemilik != Pisah[0]) {
              $('.'+JSON.parse(Respon)[key].Pemilik).prop('checked', false);
              $('.'+JSON.parse(Respon)[key].Pemilik).attr("disabled", true);
            }
          }
        })
        $('#ModalEditWP').modal("show");
      }
    });

    $(document).on("click",".HapusUser",function(){
      var HapusUser = { Username: $(this).attr('HapusUser')};
      var Konfirmasi = confirm("Yakin Ingin Menghapus Data?");
      if (Konfirmasi == true) {
        $.post(BaseURL+"User/Hapus", HapusUser).done(function(Respon) {
          if (Respon == 'ok') {
            window.location = BaseURL + 'User';
          } else {
            alert(Respon)
          }
        });
      }
    });
  });
</script>
</body>
</html>
