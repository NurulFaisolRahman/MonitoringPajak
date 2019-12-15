<?php
  $DetailPerWP = $this->session->userdata('DetailPerWP');
  $NamaFile = $this->session->userdata('NamaFilePerWP').".xls";
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=".$NamaFile);
  function Rupiah($Angka){
    $hasil_rupiah = "Rp " . number_format($Angka,2,',','.');
    return $hasil_rupiah;
  }
 ?>
    <table>
    <thead>
      <tr>
        <td align="center" colspan="7"><?=$this->session->userdata('JudulPerWP')?></td>
      </tr>
      <tr>
        <td align="center" colspan="7"><?=$this->session->userdata('NamaWP')?></td>
      </tr>
      <tr>
        <td align="center" colspan="7"><?=$this->session->userdata('PeriodeWP')?></td>
      </tr>
      <tr>
        <th>No</th>
        <th>Waktu Transaksi</th>
        <th>Receipt</th>
        <th>SubNominal</th>
        <th>Service</th>
        <th>Pajak</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <?php $TotalSubNominal = $TotalService = $TotalPajak = $Total = 0; ?>
      <?php $Nomor = 1; 
            foreach ($DetailPerWP as $key){ ?>
        <tr>
          <td><?=$Nomor?></td>
          <td><?=$key['WaktuTransaksi']?></td>
          <td><?=$key['NomorTransaksi']?></td>
          <td><?=$key['SubNominal']?></td>
          <td><?=$key['Service']?></td>
          <td><?=$key['Pajak']?></td>
          <td><?=$key['TotalTransaksi']?></td>
        </tr>
        <?php 
          $TotalSubNominal += $key['SubNominal'];
          $TotalService += $key['Service'];
          $TotalPajak += $key['Pajak'];
          $Total += $key['TotalTransaksi'];
         ?>
      <?php $Nomor++; } ?>
    </tbody>
    <tfoot>
      <tr>
        <th colspan="3" align="right">Total</th>
        <th><?=Rupiah($TotalSubNominal)?></th>
        <th><?=Rupiah($TotalService)?></th>
        <th><?=Rupiah($TotalPajak)?></th>
        <th><?=Rupiah($Total)?></th>
      </tr>
    </tfoot>
   </table>
