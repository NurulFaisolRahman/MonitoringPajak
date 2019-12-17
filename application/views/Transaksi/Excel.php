<?php
  $DataTransaksiHarian = $this->session->userdata('Transaksi');
  $NamaFile = $this->session->userdata('NamaFile').".xls";
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=".$NamaFile);
  function Rupiah($Angka){
    $hasil_rupiah = "Rp " . number_format($Angka,2,',','.');
    return $hasil_rupiah;
  }
 ?>
    <table>
      <tr>
        <td align="center" colspan="8"><?=$this->session->userdata('Judul')?></td>
      </tr>
      <tr>
        <td align="center" colspan="8">JENIS PAJAK : <?=$this->session->userdata('Bidang')?></td>
      </tr>
      <tr>
        <td align="center" colspan="8">PERIODE <?=$this->session->userdata('Periode')?></td>
      </tr>
      <tr>
        <td align="left" colspan="8"><?=$this->session->userdata("NamaAdmin")." : ".date("d-m-Y H:i:s")?></td>
      </tr>
    </table>
    <table border="1">
    <thead>
      <tr>
        <th>No</th>
        <th>Wajib Pajak</th>
        <th>Receipt</th>
        <th>SubNominal</th>
        <th>Service</th>
        <th>Diskon</th>
        <th>Pajak</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <?php $TotalSubNominal = $TotalService = $TotalPajak = $Total = $NReceipt = $Diskon = 0; ?>
      <?php $Nomor = 1; 
            foreach ($DataTransaksiHarian as $key){ ?>
        <tr>
          <td align="center"><?=$Nomor?></td>
          <td><?=$key['NamaWP']?></td>
          <td align="right"><?=$key['Receipt']?></td>
          <td align="right"><?=$key['SubNominal']?></td>
          <td align="right"><?=$key['Service']?></td>
          <td align="right"><?=$key['Diskon']?></td>
          <td align="right"><?=$key['Pajak']?></td>
          <td align="right"><?=$key['Transaksi']?></td>
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
    <tfoot>
      <tr align="right">
        <td colspan="2"><b>Total</b></td>
        <td><b><?=$NReceipt ?></b></td>
        <td><b><?=Rupiah($TotalSubNominal)?></b></td>
        <td><b><?=Rupiah($TotalService)?></b></td>
        <td><b><?=Rupiah($Diskon)?></b></td>
        <td><b><?=Rupiah($TotalPajak)?></b></td>
        <td><b><?=Rupiah($Total)?></b></td>
      </tr>
    </tfoot>
   </table>
