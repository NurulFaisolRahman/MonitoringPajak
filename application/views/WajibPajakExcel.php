<?php
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=DataWajibPajak.xls");
 ?>
 <!-- Theme style -->
 <link rel="stylesheet" href="<?=base_url('dist/css/adminlte.min.css')?>">
    <h4 class="text-center mb-3">DATA WAJIB PAJAK</h4>
    <table class="table table-bordered">
    <thead>
      <tr>
        <th class="align-middle" scope="col" style="width: 10px;">No</th>
        <th class="align-middle" scope="col" style="width: 70px;">NPWPD</th>
        <th class="align-middle" scope="col">Wajib Pajak</th>
        <th class="align-middle" scope="col">Alamat</th>
        <th class="align-middle" scope="col" style="width: 120px;">Nomor Rekening</th>
        <th class="align-middle" scope="col" style="width: 80px;">Jenis Pajak</th>
        <th class="align-middle" scope="col">Sub Jenis Pajak</th>
        <th class="align-middle" scope="col" style="width: 120px;">Jam Operasional</th>
        <!-- <th scope="col">Riwayat</th>
        <th scope="col">Status</th> -->
      </tr>
    </thead>
    <tbody>
      <?php $Nomor = 1; foreach ($DataWajibPajak as $key){ ?>
        <tr>
          <td><?=$Nomor?></td>
          <td><?=$key['NPWPD']?></td>
          <td><?=$key['NamaWP']?></td>
          <td><?=$key['AlamatWP']?></td>
          <td><?=$key['NomorRekening']?></td>
          <td><?=$key['JenisPajak']?></td>
          <td><?=$key['SubJenisPajak']?></td>
          <td><?=$key['JamOperasional']?></td>
          <!-- <td><?=$key['Riwayat']?></td>
          <td><?=$key['Status']?></td> -->
        </tr>
      <?php $Nomor++; }; ?>
    </tbody>
   </table>
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
