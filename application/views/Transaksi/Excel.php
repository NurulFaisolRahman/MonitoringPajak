<?php
  $DataTransaksiHarian = $this->session->userdata('Transaksi');
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=DataTransaksiHarian.xls");
  function Rupiah($Angka){
    $hasil_rupiah = "Rp " . number_format($Angka,2,',','.');
    return $hasil_rupiah;
  }
 ?>
    <table>
    <thead>
      <tr>
        <td align="center" colspan="7"><?=$this->session->userdata('Judul')?></td>
      </tr>
      <tr>
        <td align="center" colspan="7">JENIS PAJAK : <?=$this->session->userdata('Bidang')?></td>
      </tr>
      <tr>
        <td align="center" colspan="7">PERIODE <?=$this->session->userdata('Periode')?></td>
      </tr>
      <tr>
        <th>No</th>
        <th>Wajib Pajak</th>
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
            foreach ($DataTransaksiHarian as $key){ ?>
        <tr>
          <td><?=$Nomor?></td>
          <td><?=$key['NamaWP']?></td>
          <td><?=$key['Receipt']?></td>
          <td><?=$key['SubNominal']?></td>
          <td><?=$key['Service']?></td>
          <td><?=$key['Pajak']?></td>
          <td><?=$key['Transaksi']?></td>
        </tr>
        <?php 
          $TotalSubNominal += $key['SubNominal'];
          $TotalService += $key['Service'];
          $TotalPajak += $key['Pajak'];
          $Total += $key['Transaksi'];
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
