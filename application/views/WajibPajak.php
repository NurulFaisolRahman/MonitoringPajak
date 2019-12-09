<script>var BaseURL = '<?=base_url()?>';</script>
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
                      <a href="<?=base_url('WajibPajak/PDF')?>" class="btn btn-danger"><i class="fas fa-file-pdf"></i>
                      <b>PDF</b></a>
                    </td>
                    <td>&emsp;
                      <a href="<?=base_url('WajibPajak/Excel')?>" class="btn btn-success"><i class="fas fa-file-excel"></i>
                      <b>Excel</b></a>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
            <!-- <?php echo "Today is " . date("Y/m/d") . " " . date("h:i:s") ?> -->
            <table id="example1" class="table table-bordered table-striped">
              <thead class="bg-primary">
              <tr>
                <th style="width: 10px;">No</th>
                <th style="width: 70px;">NPWPD</th>
                <th>Alamat</th>
                <th style="width: 120px;">Nomor Rekening</th>
                <th style="width: 80px;">Jenis Pajak</th>
                <th style="width: 120px;">Jam Operasional</th>
                <?php if($this->session->userdata('Admin')){ ?>
                  <th style="width: 10px;">Status</th>
                  <th style="width: 10px;">Action</th>
                <?php }; ?>
              </tr>
              </thead>
              <tbody>
                <?php $Nomor = 1; foreach ($DataWajibPajak as $key){ ?>
                  <tr>
                    <td><?=$Nomor?></td>
                    <td><?=$key['NPWPD']?></td>
                    <td><?=$key['AlamatWP']?></td>
                    <td><?="4.1.1.".$key['NomorRekening']?></td>
                    <td><?=$key['JenisPajak']?></td>
                    <td><?=$key['JamOperasional']?></td>
                    <?php if($this->session->userdata('Admin')){ ?>
                      <td>
                        <a href="#" StatusWP="<?=$key['Status']."|".$key['Riwayat']?>" class="btn btn-primary StatusWP"><i class="fas fa-smile"></i></a>
                      </td>
                      <td class="align-middle">
                        <div class="btn-group btn-group-sm">
                          <a href="#" EditWP="<?=$key['NPWPD']."|".$key['NamaWP']."|".$key['AlamatWP']."|".($Nomor--)."|".$key['JamOperasional'];?>" class="btn btn-warning EditWP"><i class="fas fa-edit"></i></a>
                          <a href="#" HapusWP="<?=$key['NPWPD'];?>" class="btn btn-danger HapusWP"><i class="fas fa-trash"></i></a>
                        </div>
                      </td>
                    <?php }; ?>
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
<form action="<?=base_url('WajibPajak/Tambah')?>" method="post">
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
            <input type="text" name="NPWPD" class="form-control" data-inputmask='"mask": "9999.999.999"' data-mask required>
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Nama Wajib Pajak</b></span>
            </div>
            <input class="form-control" type="text" name="NamaWP" required>
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Alamat</b></span>
            </div>
            <input class="form-control" type="text" name="AlamatWP" required>
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Nomor Rekening</b></span>
            </div>
            <select class="form-control btn btn-light" name="DataRekening">
              <?php foreach ($DataRekening as $key): ?>
                <option value="<?=$key['NomorRekening']."|".$key['JenisPajak']."|".$key['SubJenisPajak']?>"><b><?="4.1.1.".$key['NomorRekening']?></b></option>
              <?php endforeach; ?>
            </select>
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Jam Operasional</b></span>
            </div>
            <input type="text" name="JamOperasional" class="form-control" data-inputmask='"mask": "99.99-99.99"' data-mask required>
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
<form action="<?=base_url('WajibPajak/Edit')?>" method="post">
<div class="modal fade" id="ModalEditWP">
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
            <input type="text" name="EditNPWPD" id="EditNPWPD" class="form-control" data-inputmask='"mask": "9999.999.999"' data-mask readonly>
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Nama Wajib Pajak</b></span>
            </div>
            <input class="form-control" type="text" name="EditNamaWP" id="EditNamaWP" required>
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Alamat</b></span>
            </div>
            <input class="form-control" type="text" name="EditAlamatWP" id="EditAlamatWP" required>
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Nomor Rekening</b></span>
            </div>
            <select class="form-control btn btn-outline-warning" name="EditDataRekening" id="EditDataRekening">
              <?php foreach ($DataRekening as $key): ?>
                <option value="<?=$key['NomorRekening']."|".$key['JenisPajak']."|".$key['SubJenisPajak']?>"><b><?="4.1.1.".$key['NomorRekening']?></b></option>
              <?php endforeach; ?>
            </select>
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Jam Operasional</b></span>
            </div>
            <input type="text" name="EditJamOperasional" id="EditJamOperasional" class="form-control" data-inputmask='"mask": "99.99-99.99"' data-mask required>
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
<div class="modal fade" id="StatusWP">
  <div class="modal-dialog">
    <div class="modal-content bg-warning">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold text-danger">Status Wajib Pajak</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <div class="row">
            <div class="col-12 d-flex justify-content-center">
              <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-success font-weight-bold text-primary" id="Status"></span>
                </div>
                <input type="text" class="form-control text-center font-weight-bold" id="Riwayat" readonly>
                <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="primary">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
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

      $(document).on("click",".EditWP",function(){
        var Data = $(this).attr('EditWP');
        var Pisah = Data.split("|");
        document.getElementById('EditNPWPD').value = Pisah[0];
        document.getElementById('EditNamaWP').value = Pisah[1];
        document.getElementById('EditAlamatWP').value = Pisah[2];
        document.getElementById('EditDataRekening').selectedIndex = Pisah[3];
        document.getElementById('EditJamOperasional').value = Pisah[4];
        $('#ModalEditWP').modal("show");
      });

      $(document).on("click",".HapusWP",function(){
        var HapusWP = { NPWPD : $(this).attr('HapusWP')};
        var Konfirmasi = confirm("Yakin Ingin Menghapus Data?");
        if (Konfirmasi == true) {
          $.post(BaseURL+"/WajibPajak/Hapus", HapusWP).done(function(Respon) {
            if (Respon == 'ok') {
              window.location = BaseURL + '/WajibPajak';
            }
          });
        }
      });

      $(document).on("click",".StatusWP",function(){
        var Data = $(this).attr('StatusWP');
        var Pisah = Data.split("|");
        document.getElementById('Status').innerHTML = Pisah[0];
        document.getElementById('Riwayat').value = Pisah[1];
        $('#StatusWP').modal("show");
      });
    })
  });
</script>
</body>
</html>
