<?php
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=DataWajibPajak.xls");
  $NamaAdmin = $this->session->userdata('NamaAdmin');
 ?>
    <table>
      <tr>
        <td colspan="10" align="center"><b style="font-size: 18px;">DATA WAJIB PAJAK</b></td>
      </tr>
    </table>
    <b style="text-align: center;font-size: 12px;"><?=$NamaAdmin.' : '.date("d-m-Y H:i:s")?></b>
    <table border="1">
    <thead>
      <tr>
        <th>No</th>
        <th>Wajib Pajak</th>
        <th>Alamat</th>
        <th>Nomor Rekening</th>
        <th>Jenis Pajak</th>
        <th>Sub Jenis Pajak</th>
        <th>Jam Operasional</th>
        <th>Riwayat</th>
        <th>Status</th>
        <th>Koneksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $Nomor = 1; foreach ($DataWajibPajak as $key){ ?>
        <tr>
          <td align="center"><?=$Nomor?></td>
          <td><?=$key['NPWPD']?><br><?=$key['NamaWP']?></td>
          <td><?=$key['AlamatWP']?></td>
          <td><?='4.1.1.'.$key['NomorRekening']?></td>
          <td><?=$key['JenisPajak']?></td>
          <td><?=$key['SubJenisPajak']?></td>
          <td><?=$key['JamOperasional']?></td>
          <td><?=$key['Riwayat']?></td>
          <td><?=$key['Status']?></td>
          <td><?=$key['Koneksi']?></td>
        </tr>
      <?php $Nomor++; }; ?>
    </tbody>
   </table>
