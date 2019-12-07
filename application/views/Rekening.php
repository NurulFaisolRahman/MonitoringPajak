<script>var BaseURL = '<?=base_url()?>';</script>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <i class="fas fa-book mr-1"></i>
          <b>REKENING</b>
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
                      <a href="#" data-toggle="modal" data-target="#ModalRekening" class="btn btn-primary font-weight-bold"><li class="fa fa-plus"></li> Rekening</a>
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
                <th>Nomor Rekening</th>
                <th style="width:30%;">Jenis Pajak</th>
                <th style="width:30%;">Sub Jenis Pajak</th>
                <th style="width:10px;">Action</th>
              </tr>
              </thead>
              <tbody>
                <?php $Nomor = 1; foreach ($DataRekening as $key){ ?>
                  <tr>
                    <td><?=$Nomor?></td>
                    <td><?="4.1.1.".$key['NomorRekening']?></td>
                    <td><?=$key['JenisPajak']?></td>
                    <td><?=$key['SubJenisPajak']?></td>
                    <td class="align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="#" EditRekening="<?=$key['NomorRekening']."|".$key['JenisPajak']."|".$key['SubJenisPajak']?>" class="btn btn-warning EditRekening"><i class="fas fa-edit"></i></a>
                        <a href="#" HapusRekening="<?=$key['NomorRekening'];?>" class="btn btn-danger HapusRekening"><i class="fas fa-trash"></i></a>
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
<form action="<?=base_url('Rekening/Tambah')?>" method="post">
<div class="modal fade" id="ModalRekening">
  <div class="modal-dialog">
    <div class="modal-content bg-primary">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold">Data Rekening</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Nomor Rekening</b></span>
              <span class="input-group-text"><b>4.1.1</b></span>
            </div>
            <input type="text" name="NomorRekening" class="form-control" data-inputmask='"mask": "99.99"' data-mask required>
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Jenis Pajak</b></i></span>
            </div>
            <input name="JenisPajak" class="form-control" type="text" required>
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Sub Jenis Pajak</b></i></span>
            </div>
            <input name="SubJenisPajak" class="form-control" type="text" required>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal"><b>Tutup</b></button>
        <button type="submit" class="btn btn-outline-light"><b>Simpan</b></button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</form>
<form action="<?=base_url('Rekening/Edit')?>" method="post">
<div class="modal fade" id="ModalEditRekening">
  <div class="modal-dialog">
    <div class="modal-content bg-primary">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold">Data Rekening</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Nomor Rekening</b></span>
              <span class="input-group-text"><b>4.1.1</b></span>
            </div>
            <input disabled type="text" name="EditNomorRekening" id="EditNomorRekening" class="form-control" data-inputmask='"mask": "99.99"' data-mask required>
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Jenis Pajak</b></i></span>
            </div>
            <input name="EditJenisPajak" id="EditJenisPajak" class="form-control" type="text" required>
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Sub Jenis Pajak</b></i></span>
            </div>
            <input name="EditSubJenisPajak" id="EditSubJenisPajak" class="form-control" type="text" required>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal"><b>Tutup</b></button>
        <button type="submit" class="btn btn-outline-light"><b>Simpan</b></button>
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
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
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

    $(function () {
      $('[data-mask]').inputmask()
    })

    $(document).on("click",".EditRekening",function(){
      var Data = $(this).attr('EditRekening');
      var Pisah = Data.split("|");
      document.getElementById('EditNomorRekening').value = Pisah[0];
      document.getElementById('EditJenisPajak').value = Pisah[1];
      document.getElementById('EditSubJenisPajak').value = Pisah[2];
      $('#ModalEditRekening').modal("show");
    });

    $(document).on("click",".HapusRekening",function(){
      var HapusRekening = { NomorRekening: $(this).attr('HapusRekening')};
      var Konfirmasi = confirm("Yakin Ingin Menghapus Data?");
      if (Konfirmasi == true) {
        $.post(BaseURL+"/Rekening/Hapus", HapusRekening).done(function(Respon) {
          if (Respon == 'ok') {
            window.location = BaseURL + '/Rekening';
          }
        });
      }
    });
  });
</script>
</body>
</html>
