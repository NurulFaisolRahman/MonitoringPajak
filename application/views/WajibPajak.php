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
                <th style="width: 90px;">Alamat</th>
                <th style="width: 130px;">Nomor Rekening</th>
                <th style="width: 80px;">Jenis Pajak</th>
                <th style="width: 120px;">Jam Operasional</th>
                <?php if($this->session->userdata('Admin')){ ?>
                  <th style="width: 100px;">Status</th>
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
                        <?php if (empty($key['Status'])) {?>
                          <?="Belum Aktivasi"?>
                        <?php } else if ($key['Status'] != "Disable") {?>
                          <a href="#" StatusWP="<?=$key['NPWPD']?>" class="btn btn-primary StatusWP"><i class="fas fa-smile"></i></a>
                          <input type="checkbox" StatusWP="<?=$key['NPWPD']?>" id="WPStatus" data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" data-width="70" checked>
                        <?php } else {?>
                          <a href="#" StatusWP="<?=$key['NPWPD']?>" class="btn btn-primary StatusWP"><i class="fas fa-smile"></i></a>
                          <input type="checkbox" StatusWP="<?=$key['NPWPD']?>" id="WPStatus" data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" data-width="70">
                        <?php } ?>
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
            <div class="col-12">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-primary font-weight-bold text-white" id="Status"></span>
                </div>
                <input type="text" class="form-control text-center font-weight-bold" id="Riwayat" readonly>
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
<!-- Bootstrap Toggle -->
<script src="plugins/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
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
        var Status = { NPWPD: $(this).attr('StatusWP') };
        $.post(BaseURL+"/WajibPajak/Status", Status).done(function(Respon) {
          var Data = JSON.parse(Respon);
          var WPstatus
          if (Data.Status == "Disable") {
            WPstatus = "Offline"
          } else if (Data.Status == "Enable"){
            WPstatus = "Online"
          } else if (Data.Status == "Offline"){
            WPstatus = "Offline"
          } else if (Data.Status == "Online"){
            WPstatus = "Online"
          }
          document.getElementById('Status').innerHTML = WPstatus;
          document.getElementById('Riwayat').value = Data.Riwayat;
          if (Data.Riwayat == '') {
            document.getElementById('Riwayat').value = 'Belum Ada Data';
          }
          $('#StatusWP').modal("show");
        });
      });

      $('input[type="checkbox"]').on('change', function(e){
        var StatusWP
        if ($('#WPStatus').is(":checked")) {
          StatusWP = "Enable"
        } else {
          StatusWP = "Disable"
        }
        var GantiStatus = { NPWPD: $(this).attr('StatusWP'), WPStatus: StatusWP };
        $.post(BaseURL+"/WajibPajak/GantiStatus", GantiStatus)
      });
    })
  });
</script>
</body>
</html>
