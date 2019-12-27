<?php 
  function Rupiah($Angka){
    $hasil_rupiah = number_format($Angka,0,',','.');
    return $hasil_rupiah;
  }
 ?>
 <script>var BaseURL = '<?=base_url()?>';</script>
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
  						<i class="fas fa-edit mr-1"></i>
              <b>TRANSAKSI</b>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Konten -->
      <section class="content">
        <div class="container-fluid">
          <div class="row align-items-center">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <table>
                    <tr>
                      <td class="font-weight-bold text-primary">Tahun :&nbsp;</td>
                      <form action="<?=base_url('Transaksi/Tahunan')?>" method="post">
                        <td>
                          <input class="form-control btn btn-outline-primary" type="date" id="Tahun" name="Tahun" value="<?php if(!empty($tahun)) echo $tahun ?>" required>
                        </td>
                        <?php if($this->session->userdata('Admin') == '3'){ ?>
                          <td class="font-weight-bold text-primary">&emsp;Wajib Pajak :&nbsp;</td>
                          <td>
                            <select class="form-control btn btn-outline-primary" name="IdWP">
                              <?php foreach ($this->session->userdata('WP') as $key){ ?>
                                <option value="<?=$key['NPWPD']?>" <?php if ($bidangpajak == $key['NPWPD']) {
                                echo "selected";
                              } ?>><?=$key['NamaWP']?></option>
                            <?php } ?>
                            </select>
                          </td>
                        <?php }; ?>
                        <?php if($this->session->userdata('Admin') != '3'){ ?>
                        <td class="font-weight-bold text-primary">&emsp;Bidang Pajak :&nbsp;</td>
                        <td>
                          <select class="form-control btn btn-outline-primary" name="BidangPajak">
                          <option value="All" <?php if ($bidangpajak == 'All') {
                            echo "selected";
                          } ?>><?="All"?></option>
                          <?php foreach ($DataRekening as $key){ ?>
                            <option value="<?=$key['JenisPajak']?>" <?php if ($bidangpajak == $key['JenisPajak']) {
                            echo "selected";
                          } ?>><?=$key['JenisPajak']?></option>
                          <?php } ?>
                          </select>
                        </td>
                        <?php }; ?>
                        <td>&emsp;
                          <button type="submit" class="btn btn-primary" id="Filter"><b>FILTER</b></button>
                        </td>
                      </form>
                      <?php if($this->session->userdata('Admin') != '3'){ ?>
                      <td>&emsp;
                        <a href="<?=base_url('Transaksi/Pdf')?>" class="btn btn-danger"><i class="fas fa-file-pdf"></i>
                        <b>PDF</b></button>
                      </td>
                      <td>&emsp;
                        <a href="<?=base_url('Transaksi/Excel')?>" class="btn btn-success"><i class="fas fa-file-excel"></i>
                        <b>Excel</b></button>
                      </td>
                      <?php } ?>
                    </tr>
                  </table>
                </div>
                <div class="card-body table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead class="bg-primary">
                    <tr>
                      <th>No</th>
                      <th>Wajib Pajak</th>
                      <th>Receipt</th>
                      <th>Subtotal (Rp)</th>
                      <th>Service (Rp)</th>
                      <th>Diskon (Rp)</th>
                      <th>Tax (Rp)</th>
                      <th>Total (Rp)</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php 
                          $TotalSubNominal = $TotalService = $TotalPajak = $Total = $NReceipt = $Diskon = 0;
                       ?>
                      <?php $Nomor = 1; foreach ($Transaksi as $key){ ?>
                        <tr>
                          <td class="text-center" width="20px"><?=$Nomor?></td>
                          <td class="text-left"><?=$key['NamaWP']?></td>
                          <td class="text-right"><?=$key['Receipt']?></td>
                          <td class="text-right"><?=$key['SubNominal']?></td>
                          <td class="text-right"><?=$key['Service']?></td>
                          <td class="text-right"><?=$key['Diskon']?></td>
                          <td class="text-right"><?=$key['Pajak']?></td>
                          <td class="text-right"><?=$key['Transaksi']?></td>
                          <td class="text-center">
                            <div class="btn-group btn-group-sm">
                              <button PdfPerWP="<?=$key['NPWPD']?>" class="btn btn-danger PdfPerWP"><i class="fas fa-file-pdf"></i></button>
                              <button href="#" ExcelPerWP="<?=$key['NPWPD']?>" class="btn btn-success ExcelPerWP"><i class="fas fa-file-excel"></i></button>
                            </div>
                          </td>
                        </tr>
                        <?php 
                          $TotalSubNominal += $key['SubNominal'];
                          $TotalService += $key['Service'];
                          $TotalPajak += $key['Pajak'];
                          $Total += $key['Transaksi'];
                          $Diskon += $key['Diskon'];
                          $NReceipt += $key['Receipt'];
                         ?>
                      <?php $Nomor++; } ?>
                    </tbody>
                    <tfoot class="bg-success">
                    <tr class="text-right">
                      <th></th>
                      <th>Total</th>
                      <th><?=$NReceipt?></th>
                      <th><?=Rupiah($TotalSubNominal)?></th>
                      <th><?=Rupiah($TotalService)?></th>
                      <th><?=Rupiah($Diskon)?></th>
                      <th><?=Rupiah($TotalPajak)?></th>
                      <th><?=Rupiah($Total)?></th>
                      <th></th>
                    </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
  </div>
  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- DataTables -->
  <script src="../plugins/datatables/jquery.dataTables.js"></script>
  <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <script>
    $(document).ready(function() {
      
      var d = new Date();
      var tahun = d.getFullYear()+'-'+(d.getMonth()+1)+'-'+d.getDate();
      if ($("#Tahun").val() == "") {
        document.getElementById('Tahun').value = tahun;
      }

      $('#example1').DataTable( {
          "scrollY": "50vh",
          "scrollCollapse": true,
          "paging": false,
          "ordering": true,
          "autoWidth": true
      });

      $(document).on("click",".PdfPerWP",function(){
        var Data = { NPWPD : $(this).attr('PdfPerWP'),
                     Periode : $("#Tahun").val().substr(0,7),
                     Judul : 'TAHUNAN' };
        $.post(BaseURL+"/Transaksi/DetailPerWP", Data).done(function(Respon) {
          if (Respon == 'ok') {
            window.location = BaseURL + '/Transaksi/PdfPerWP';
          }
          else {
            alert(Respon)
          }
        });
      });
        
      $(document).on("click",".ExcelPerWP",function(){
        var Data = { NPWPD : $(this).attr('ExcelPerWP'),
                     Periode : $("#Tahun").val().substr(0,4),
                     Judul : 'TAHUNAN' };
        $.post(BaseURL+"/Transaksi/DetailPerWP", Data).done(function(Respon) {
          if (Respon == 'ok') {
            window.location = BaseURL + '/Transaksi/ExcelPerWP';
          }
        });
      });
    });
  </script>
</body>
</html>
