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
                    <?php if($this->session->userdata('Admin') == '1'){ ?>
                    <td>
                      <a href="#" data-toggle="modal" data-target="#ModalWP" class="btn btn-primary font-weight-bold"><li class="fa fa-plus"></li> WAJIB PAJAK</a>
                    </td>
                    <?php }; ?>
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
            <table id="example1" class="table table-bordered table-striped">
              <thead class="bg-primary">
              <tr>
                <th style="width: 10px;">No</th>
                <th style="width: 170px;">Wajib   Pajak</th>
                <th>Alamat</th>
                <th style="width: 50px;">Nomor Rekening</th>
                <th style="width: 50px;">Jenis Pajak</th>
                <th style="width: 70px;">Sub Jenis Pajak</th>
                <th style="width: 50px;">Jam Kerja</th>
                <?php if($this->session->userdata('Admin') == '1'){ ?>
                  <th style="width: 40px;">Status</th>
                  <th style="width: 10px;">Aksi</th>
                <?php }; ?>
              </tr>
              </thead>
              <tbody>
                <?php $Nomor = 1; foreach ($DataWajibPajak as $key){ ?>
                  <tr>
                    <td align="center"><?=$Nomor?></td>
                    <td><?=$key['NPWPD']?><br><?=$key['NamaWP']?></td>
                    <td><?=$key['AlamatWP']?></td>
                    <td><?="4.1.1.".$key['NomorRekening']?></td>
                    <td><?=$JenisPajak[$key['NomorRekening']]?></td>
                    <td><?=$SubJenisPajak[$key['NomorRekening']]?></td>
                    <td><?=$key['JamOperasional'].'<br>'.$key['Sinyal']?></td>
                    <?php if($this->session->userdata('Admin') == '1'){ ?>
                      <td>
                        <?php if (empty($key['Status'])) {?>
                          <?="Belum Aktivasi"?>
                        <?php } else if ($key['Status'] != "Disable") {?>
                          <a href="#" StatusWP="<?=$key['NPWPD']?>" class="btn btn-sm btn-primary StatusWP"><i class="fas fa-smile"></i></a><br>
                          <input type="checkbox" data-size="mini" StatusWP="<?=$key['NPWPD']?>" id="WPStatus" data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" data-width="70" checked>
                        <?php } else {?>
                          <a href="#" StatusWP="<?=$key['NPWPD']?>" class="btn btn-sm btn-primary StatusWP"><i class="fas fa-smile"></i></a><br>
                          <input type="checkbox" data-size="mini" StatusWP="<?=$key['NPWPD']?>" id="WPStatus" data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" data-width="70">
                        <?php } ?>
                      </td>
                      <td align="center">
                        <div class="btn-group btn-group-sm">
                          <a href="#" EditWP="<?=$key['NPWPD']."|".$key['NamaWP']."|".$key['AlamatWP']."|".$key['NomorRekening']."|".$key['JamOperasional'];?>" class="btn btn-warning EditWP"><i class="fas fa-edit"></i></a>
                          <a href="#" HapusWP="<?=$key['NPWPD'];?>" class="btn btn-danger HapusWP"><i class="fas fa-trash"></i></a>
                        </div>
                      </td>
                    <?php }; ?>
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
          <input type="text" id="NPWPD" class="form-control" data-inputmask='"mask": "9999.999.999"' data-mask>
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Password</b></span>
            </div>
            <input class="form-control" type="password" id="PasswordWP">
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Nama Wajib Pajak</b></span>
            </div>
            <input class="form-control" type="text" id="NamaWP">
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Alamat</b></span>
            </div>
            <input class="form-control" type="text" id="AlamatWP">
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Sub Jenis Pajak</b></span>
            </div>
            <select class="form-control btn btn-light" id="DataRekening">
              <?php foreach ($DataRekening as $key): ?>
                <option value="<?=$key['NomorRekening']?>"><b><?=$key['SubJenisPajak']?></b></option>
              <?php endforeach; ?>
            </select>
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Jam Operasional</b></span>
            </div>
            <input type="text" id="JamOperasional" class="form-control" data-inputmask='"mask": "99.99-99.99"' data-mask>
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
            <input type="hidden" id="EditNPWPDLama" class="form-control">
            <input type="text" id="EditNPWPD" class="form-control" data-inputmask='"mask": "9999.999.999"' data-mask>
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Password</b></span>
            </div>
            <input class="form-control" type="password" id="EditPasswordWP">
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Nama Wajib Pajak</b></span>
            </div>
            <input class="form-control" type="text" id="EditNamaWP">
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Alamat</b></span>
            </div>
            <input class="form-control" type="text" id="EditAlamatWP">
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Nomor Rekening</b></span>
            </div>
            <select class="form-control btn btn-light" id="EditDataRekening">
              <?php foreach ($DataRekening as $key): ?>
                <option value="<?=$key['NomorRekening']?>"><b><?=$key['SubJenisPajak']?></b></option>
              <?php endforeach; ?>
            </select>
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Jam Operasional</b></span>
            </div>
            <input type="text" id="EditJamOperasional" class="form-control" data-inputmask='"mask": "99.99-99.99"' data-mask>
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
              <div class="input-group mb-1">
                <div class="input-group-prepend">
                  <span class="input-group-text font-weight-bold text-white" id="Status"></span>
                </div>
                <input type="text" class="form-control text-center font-weight-bold" id="Riwayat" readonly>
              </div>
              <div class="input-group mb-1">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-success font-weight-bold text-white">Data Pertama</span>
                </div>
                <input type="text" class="form-control text-center font-weight-bold" id="RiwayatPertama" readonly>
              </div>
              <div class="input-group mb-1">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-danger font-weight-bold text-white">Data Terakhir</span>
                </div>
                <input type="text" class="form-control text-center font-weight-bold" id="RiwayatTerakhir" readonly>
              </div>
              <div class="input-group mb-1">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-info font-weight-bold text-white">Jenis Data</span>
                </div>
                <input type="text" class="form-control text-center font-weight-bold" id="JenisData" readonly>
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
        "autoWidth": true
        // "columnDefs": [{ "targets": [0,3,4,5,6,7,8], "searchable": false }]
    });
    $(function () {
      $('[data-mask]').inputmask()

      $(document).on("click","#TambahWP",function(){
        if ($('#NPWPD').val() === '') {
          alert('Mohon Input NPWPD')
        } else if ($('#PasswordWP').val() === '') {
          alert('Mohon Input Password Wajib Pajak')
        } else if ($('#NamaWP').val() === '') {
          alert('Mohon Input Nama Wajib Pajak')
        } else if ($('#AlamatWP').val() === '') {
          alert('Mohon Input Alamat Wajib Pajak')
        } else if ($('#JamOperasional').val() === '') {
          alert('Mohon Input Jam Operasional')
        } else {
          var Data = { NPWPD: $('#NPWPD').val(),
                     PasswordWP: $('#PasswordWP').val(),
                     NamaWP: $('#NamaWP').val(),
                     AlamatWP: $('#AlamatWP').val(),
                     DataRekening: $('#DataRekening').val(),
                     JamOperasional: $('#JamOperasional').val()};
          $.post(BaseURL+"/WajibPajak/Tambah", Data).done(function(Respon) {
            if (Respon == 'ok') {
              window.location = BaseURL + '/WajibPajak';
            } else {
              alert('NPWPD Sudah Ada')
            }
          });
        }
      });

      $(document).on("click","#EditWP",function(){
        if ($('#EditNPWPD').val() === '') {
          alert('Mohon Input NPWPD')
        } else if ($('#EditNamaWP').val() === '') {
          alert('Mohon Input Nama Wajib Pajak')
        } else if ($('#EditAlamatWP').val() === '') {
          alert('Mohon Input Alamat Wajib Pajak')
        } else if ($('#EditJamOperasional').val() === '') {
          alert('Mohon Input Jam Operasional')
        } else {
          var Data = { EditNPWPDLama: $('#EditNPWPDLama').val(),
                     EditNPWPD: $('#EditNPWPD').val(),
                     EditPasswordWP: $('#EditPasswordWP').val(),
                     EditNamaWP: $('#EditNamaWP').val(),
                     EditAlamatWP: $('#EditAlamatWP').val(),
                     EditDataRekening: $('#EditDataRekening').val(),
                     EditJamOperasional: $('#EditJamOperasional').val()};
          $.post(BaseURL+"/WajibPajak/Edit", Data).done(function(Respon) {
            if (Respon == 'ok') {
              window.location = BaseURL + '/WajibPajak';
            } else {
              alert('NPWPD Sudah Ada')
            }
          });
        }
      });

      var IndexRekening = [];
      $.post(BaseURL+"/WajibPajak/IndexRekening").done(function(Respon) {
        var ParseData = JSON.parse(Respon);
        for (var i = 0; i < ParseData.length; i++){
            var key = ParseData[i].NomorRekening.toString();
            IndexRekening[key] = i;
        }
      });

      $(document).on("click",".EditWP",function(){
        var Data = $(this).attr('EditWP');
        var Pisah = Data.split("|");
        document.getElementById('EditNPWPDLama').value = Pisah[0];
        document.getElementById('EditNPWPD').value = Pisah[0];
        document.getElementById('EditNamaWP').value = Pisah[1];
        document.getElementById('EditAlamatWP').value = Pisah[2];
        document.getElementById('EditDataRekening').selectedIndex = IndexRekening[Pisah[3]];
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
            } else {
              alert('NPWPD Digunakan Pada Tabel Transaksi')
            }
          });
        }
      });

      $(document).on("click",".StatusWP",function(){
        var Status = { NPWPD: $(this).attr('StatusWP') };
        $.post(BaseURL+"/WajibPajak/Status", Status).done(function(Respon) {
          var Data = JSON.parse(Respon);
          document.getElementById('Status').innerHTML = Data.Status;
          if (Data.Status == 'Online') {
            $("#Status").removeClass("bg-danger")
            $("#Status").addClass("bg-success")
          } else {
            $("#Status").removeClass("bg-success")
            $("#Status").addClass("bg-danger")
          }
          document.getElementById('Riwayat').value = Data.Sinyal;
          document.getElementById('RiwayatPertama').value = Data.PengirimanPertama;
          document.getElementById('RiwayatTerakhir').value = Data.Riwayat;
          document.getElementById('JenisData').value = Data.Koneksi;
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
