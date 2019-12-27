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
                    <?php if($this->session->userdata('Admin') == '1'){ ?>
                    <td>
                      <a href="" data-toggle="modal" data-target="#ModalRekening" class="btn btn-primary font-weight-bold"><li class="fa fa-plus"></li> Rekening</a>
                    </td>
                    <?php }; ?>
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
                <th>Jenis Pajak</th>
                <th>Sub Jenis Pajak</th>
                <?php if($this->session->userdata('Admin') == '1'){ ?>
                  <th style="width:10px;">Aksi</th>
                <?php }; ?>
              </tr>
              </thead>
              <tbody>
                <?php $Nomor = 1; foreach ($DataRekening as $key){ ?>
                  <tr valign="middle">
                    <td align="center"><?=$Nomor?></td>
                    <td><?="4.1.1.".$key['NomorRekening']?></td>
                    <td><?=$key['JenisPajak']?></td>
                    <td><?=$key['SubJenisPajak']?></td>
                    <?php if($this->session->userdata('Admin') == '1'){ ?>
                      <td align="center">
                        <div class="btn-group btn-group-sm">
                          <button EditRekening="<?=$key['NomorRekening']."|".$key['SubJenisPajak']?>" class="btn btn-warning EditRekening"><i class="fas fa-edit"></i></button>
                          <button HapusRekening="<?=$key['NomorRekening'];?>" class="btn btn-danger HapusRekening"><i class="fas fa-trash"></i></button>
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
            <select class="form-control btn btn-light" id="JenisPajak">
              <option value="01"><?="Hotel"?></option>
              <option value="02"><?="Restoran"?></option>
              <option value="07"><?="Parkir"?></option>
              <option value="03"><?="Hiburan"?></option>
            </select>
            <input type="text" id="NomorRekening" class="form-control" data-inputmask='"mask": "99.99"' data-mask>
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Sub Jenis Pajak</b></i></span>
            </div>
            <input id="SubJenisPajak" class="form-control" type="text">
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal"><b>Tutup</b></button>
        <button type="submit" class="btn btn-outline-light" id="TambahRekening"><b>Simpan</b></button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</form>
<form onsubmit="event.preventDefault();">
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
            <input type="hidden" id="EditNomorRekeningLama" class="form-control">
            <select class="form-control btn btn-light" id="EditJenisPajak">
              <option value="01"><?="Hotel"?></option>
              <option value="02"><?="Restoran"?></option>
              <option value="07"><?="Parkir"?></option>
              <option value="03"><?="Hiburan"?></option>
            </select>
            <input type="text" id="EditNomorRekening" class="form-control" data-inputmask='"mask": "99.99"' data-mask>
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-primary"><b>Sub Jenis Pajak</b></i></span>
            </div>
            <input id="EditSubJenisPajak" class="form-control" type="text">
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal"><b>Tutup</b></button>
        <button type="submit" class="btn btn-outline-light" id="EditRekening"><b>Simpan</b></button>
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

    $(document).on("click","#TambahRekening",function(){ 
      if ($('#NomorRekening').val() === '') {
        alert('Mohon Input Nomor Rekening')
      } else if ($('#SubJenisPajak').val() === '') {
        alert('Mohon Input Sub Jenis Pajak')
      } else {
        var NamaJenisPajak;
        if ($('#JenisPajak').val() == '01') {
          NamaJenisPajak = 'Hotel'
        } else if ($('#JenisPajak').val() == '02') {
          NamaJenisPajak = 'Restoran'
        } else if ($('#JenisPajak').val() == '07') {
          NamaJenisPajak = 'Parkir'
        } else if ($('#JenisPajak').val() == '03') {
          NamaJenisPajak = 'Hiburan'
        }
        var Data = { NomorRekening: $('#NomorRekening').val(),
                     JenisPajak : $('#JenisPajak').val(),
                     NamaJenisPajak: NamaJenisPajak,
                     SubJenisPajak: $('#SubJenisPajak').val()};
        $.post(BaseURL+"Rekening/Tambah", Data).done(function(Respon) {
          if (Respon == 'ok') {
            window.location = BaseURL + 'Rekening';
          } else {
            alert('Nomor Rekening Sudah Ada')
          }
        });
      }
    });

    var IndexRekening = [];
    IndexRekening['01'] = 0;
    IndexRekening['02'] = 1;
    IndexRekening['07'] = 2;
    IndexRekening['03'] = 3;

    $(document).on("click","#EditRekening",function(){  
      if ($('#EditNomorRekening').val() === '') {
        alert('Mohon Input Nomor Rekening')
      } else if ($('#EditSubJenisPajak').val() === '') {
        alert('Mohon Input Sub Jenis Pajak')
      } else {
        var NamaJenisPajak;
        if ($('#EditJenisPajak').val() == '01') {
          NamaJenisPajak = 'Hotel'
        } else if ($('#EditJenisPajak').val() == '02') {
          NamaJenisPajak = 'Restoran'
        } else if ($('#EditJenisPajak').val() == '07') {
          NamaJenisPajak = 'Parkir'
        } else if ($('#EditJenisPajak').val() == '03') {
          NamaJenisPajak = 'Hiburan'
        }
        var Data = { EditNomorRekeningLama: $('#EditNomorRekeningLama').val(),
                   EditNomorRekening: $('#EditNomorRekening').val(),
                   EditJenisPajak: $('#EditJenisPajak').val(),
                   NamaJenisPajak: NamaJenisPajak,
                   EditSubJenisPajak: $('#EditSubJenisPajak').val()};
        $.post(BaseURL+"Rekening/Edit", Data).done(function(Respon) {
          if (Respon == 'ok') {
            window.location = BaseURL + 'Rekening';
          } else {
            alert('Nomor Rekening Sudah Ada')
          }
        });
      }    
    });

    $(document).on("click",".HapusRekening",function(){
      var HapusRekening = { NomorRekening: $(this).attr('HapusRekening')};
      var Konfirmasi = confirm("Yakin Ingin Menghapus Data?");
      if (Konfirmasi == true) {
        $.post(BaseURL+"Rekening/Hapus", HapusRekening).done(function(Respon) {
          if (Respon == 'ok') {
            window.location = BaseURL + 'Rekening';
          } else {
            alert(Respon)
            // alert('Nomor Rekening Digunakan Pada Tabel Wajib Pajak')
          }
        });
      }
    });

    $(document).on("click",".EditRekening",function(){
      var Data = $(this).attr('EditRekening');
      var Pisah = Data.split("|");
      document.getElementById('EditNomorRekeningLama').value = Pisah[0];
      document.getElementById('EditNomorRekening').value = Pisah[0].substr(3, Pisah[0].length);
      document.getElementById('EditJenisPajak').selectedIndex = IndexRekening[Pisah[0].substr(0,2)];
      document.getElementById('EditSubJenisPajak').value = Pisah[1];
      $('#ModalEditRekening').modal("show");
    });
  });
</script>
</body>
</html>
