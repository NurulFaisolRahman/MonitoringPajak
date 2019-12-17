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
       <tr>
        <td align="center" colspan="8"><?=$this->session->userdata('JudulPerWP')?></td>
      </tr>
      <tr>
        <td align="center" colspan="8"><?=$this->session->userdata('NamaWP')?></td>
      </tr>
      <tr>
        <td align="center" colspan="8">JENIS PAJAK : <?=$this->session->userdata("JenisPajakPerWP")?></td>
      </tr>
      <tr>
        <td align="center" colspan="8"><?=$this->session->userdata('PeriodeWP')?></td>
      </tr>
      <tr>
        <td align="left" colspan="8"><?=$this->session->userdata("NamaAdmin")." : ".date("d-m-Y H:i:s")?></td>
      </tr>
    </table>
    <table border="1">
    <thead>
      <tr>
        <th>No</th>
        <th>Transaksi</th>
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
            foreach ($DetailPerWP as $key){ ?>
        <tr>
          <td><?=$Nomor?></td>
          <td><?=$key['Baris']?></td>
          <td><?=$key['Receipt']?></td>
          <td><?=$key['SubNominal']?></td>
          <td><?=$key['Service']?></td>
          <td><?=$key['Diskon']?></td>
          <td><?=$key['Pajak']?></td>
          <td><?=$key['TotalTransaksi']?></td>
        </tr>
        <?php 
          $TotalSubNominal += $key['SubNominal'];
          $TotalService += $key['Service'];
          $TotalPajak += $key['Pajak'];
          $Total += $key['TotalTransaksi'];
          $Diskon += $key['Diskon'];
          if ($this->session->userdata("JudulPerWP") != 'LAPORAN TRANSAKSI HARIAN') {
            $NReceipt += $key['Receipt'];
          }
         ?>
      <?php $Nomor++; } ?>
    </tbody>
    <?php 
      if ($this->session->userdata("JudulPerWP") == 'LAPORAN TRANSAKSI HARIAN') { ?>
        <tfoot>
            <tr align="right">
              <td colspan="3"><b>Total</b></td>
              <td><b><?=Rupiah($TotalSubNominal)?></b></td>
              <td><b><?=Rupiah($TotalService)?></b></td>
              <td><b><?=Rupiah($Diskon)?></b></td>
              <td><b><?=Rupiah($TotalPajak)?></b></td>
              <td><b><?=Rupiah($Total)?></b></td>
            </tr>
          </tfoot>
       <?php  } else { ?>
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
      <?php  } ?>
   </table>
