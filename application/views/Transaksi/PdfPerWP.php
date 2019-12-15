<?php 
  function Rupiah($Angka){
    $hasil_rupiah = number_format($Angka,2,',','.');
    return $hasil_rupiah;
  }
  $DetailPerWP = $this->session->userdata('DetailPerWP');
  $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetFont('times', 12);
            $pdf->setPrintHeader(false);         
            $pdf->SetTopMargin(15);
            $pdf->setFooterMargin(20);
            $pdf->SetAutoPageBreak(true,30);
            $pdf->SetAuthor('nurulfaisolrahman@gmail.com');
            $pdf->SetDisplayMode('real', 'default');
            $pdf->AddPage('L', 'A4');
            $i=0;
            $TotalSubNominal = $TotalService = $TotalPajak = $Total = 0;
            $html='
              <table cellpadding="2">
                <tr>
                  <td align="center" colspan="7"><h4>'.$this->session->userdata("JudulPerWP").'</h4></td>
                </tr>
                <tr>
                  <td align="center" colspan="7"><h4>'.$this->session->userdata("NamaWP").'</h4></td>
                </tr>
                <tr>
                  <td align="center" colspan="7"><h5>'.$this->session->userdata("PeriodeWP").'</h5></td>
                </tr>
              </table>
              <br><br>
              <table border="1" cellpadding="4">
                  <tr>
                    <td align="center" width="30px">No</td>
                    <td width="150px">Waktu Transaksi</td>
                    <td width="100px">Receipt</td>
                    <td width="130px">SubNominal (Rp)</td>
                    <td width="100px">Service (Rp)</td>
                    <td width="130px">Pajak (Rp)</td>
                    <td width="130px">Total Transaksi (Rp)</td>
                  </tr>';
            foreach ($DetailPerWP as $key){
              $i++;
              $html.='<tr>
                <td align="center">'.$i.'</td>
                <td>'.$key["WaktuTransaksi"].'</td>
                <td>'.$key["NomorTransaksi"].'</td>
                <td>'.$key["SubNominal"].'</td>
                <td>'.$key["Service"].'</td>
                <td>'.$key["Pajak"].'</td>
                <td>'.$key["TotalTransaksi"].'</td>
              </tr>';
                $TotalSubNominal += $key['SubNominal'];
                $TotalService += $key['Service'];
                $TotalPajak += $key['Pajak'];
                $Total += $key['TotalTransaksi'];
            } 
            $html.='<tr>
                      <td colspan="3" align="right">Total</td>
                      <td>'.Rupiah($TotalSubNominal).'</td>
                      <td>'.Rupiah($TotalService).'</td>
                      <td>'.Rupiah($TotalPajak).'</td>
                      <td>'.Rupiah($Total).'</td>
                    </tr>
                    </table>';
            $pdf->writeHTML($html, true, false, true, false, '');
            $NamaFile = $this->session->userdata('NamaFilePerWP');
            $pdf->Output($NamaFile.'.pdf', 'D');
 ?>