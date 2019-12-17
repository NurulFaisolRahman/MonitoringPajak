<?php 
  function Rupiah($Angka){
    $hasil_rupiah = number_format($Angka,2,',','.');
    return $hasil_rupiah;
  }
  $DetailPerWP = $this->session->userdata('DetailPerWP');
  $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetFont('times', 12);
            $pdf->setPrintHeader(false);         
            $pdf->SetTopMargin(10);
            $pdf->setFooterMargin(20);
            $pdf->SetAutoPageBreak(true,30);
            $pdf->SetAuthor('nurulfaisolrahman@gmail.com');
            $pdf->SetDisplayMode('real', 'default');
            $pdf->AddPage('L', 'A4');
            $i=0;
            $TotalSubNominal = $TotalService = $TotalPajak = $Total = $NReceipt = $Diskon = 0;
            $html='
              <table cellpadding="2">
                <tr>
                  <td align="center" colspan="7"><h4>'.$this->session->userdata("JudulPerWP").'</h4></td>
                </tr>
                <tr>
                  <td align="center" colspan="7"><h4>'.$this->session->userdata("NamaWP").'</h4></td>
                </tr>
                <tr>
                  <td align="center" colspan="7"><h4>JENIS PAJAK : '.$this->session->userdata("JenisPajakPerWP").'</h4></td>
                </tr>
                <tr>
                  <td align="center" colspan="7"><h5>'.$this->session->userdata("PeriodeWP").'</h5></td>
                </tr>
                <tr>
                  <td align="left" colspan="7"><h5>'.$this->session->userdata("NamaAdmin")." : ".date("d-m-Y H:i:s").'</h5></td>
                </tr>
              </table>
              <br><br>
              <table border="1" cellpadding="4">
                  <tr>
                    <td align="center" width="30px">No</td>
                    <td width="90px">Transaksi</td>
                    <td width="60px">Receipt</td>
                    <td width="110px">SubNominal (Rp)</td>
                    <td width="100px">Service (Rp)</td>
                    <td width="100px">Diskon (Rp)</td>
                    <td width="140px">Pajak (Rp)</td>
                    <td width="140px">Total Transaksi (Rp)</td>
                  </tr>';
            foreach ($DetailPerWP as $key){
              $i++;
              $html.='<tr>
                <td align="center">'.$i.'</td>
                <td align="center">'.$key["Baris"].'</td>
                <td align="center">'.$key["Receipt"].'</td>
                <td align="right">'.$key["SubNominal"].'</td>
                <td align="right">'.$key["Service"].'</td>
                <td align="right">'.$key["Diskon"].'</td>
                <td align="right">'.$key["Pajak"].'</td>
                <td align="right">'.$key["TotalTransaksi"].'</td>
              </tr>';
                $TotalSubNominal += $key['SubNominal'];
                $TotalService += $key['Service'];
                $TotalPajak += $key['Pajak'];
                $Total += $key['TotalTransaksi'];
                $Diskon += $key['Diskon'];
                if ($this->session->userdata("JudulPerWP") != 'LAPORAN TRANSAKSI HARIAN') {
                  $NReceipt += $key['Receipt'];
                }
            }
            if ($this->session->userdata("JudulPerWP") == 'LAPORAN TRANSAKSI HARIAN') {
               $html.='<tr align="right">
                      <td colspan="3">Total</td>
                      <td>'.Rupiah($TotalSubNominal).'</td>
                      <td>'.Rupiah($TotalService).'</td>
                      <td>'.Rupiah($Diskon).'</td>
                      <td>'.Rupiah($TotalPajak).'</td>
                      <td>'.Rupiah($Total).'</td>
                    </tr>
                    </table>';
             } else {
               $html.='<tr align="right">
                      <td colspan="2">Total</td>
                      <td align="center">'.$NReceipt.'</td>
                      <td>'.Rupiah($TotalSubNominal).'</td>
                      <td>'.Rupiah($TotalService).'</td>
                      <td>'.Rupiah($Diskon).'</td>
                      <td>'.Rupiah($TotalPajak).'</td>
                      <td>'.Rupiah($Total).'</td>
                    </tr>
                    </table>';
             }
            $pdf->writeHTML($html, true, false, true, false, '');
            $NamaFile = $this->session->userdata('NamaFilePerWP');
            $pdf->Output($NamaFile.'.pdf', 'D');
 ?>