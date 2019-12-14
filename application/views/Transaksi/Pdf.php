<?php 
  function Rupiah($Angka){
    $hasil_rupiah = "Rp " . number_format($Angka,2,',','.');
    return $hasil_rupiah;
  }
  $DataTransaksiHarian = $this->session->userdata('Transaksi');
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
                  <td align="center" colspan="7"><h4>'.$this->session->userdata("Judul").'</h4></td>
                </tr>
                <tr>
                  <td align="center" colspan="7"><h4>JENIS PAJAK : '.$this->session->userdata("Bidang").'</h4></td>
                </tr>
                <tr>
                  <td align="center" colspan="7"><h5>PERIODE '.$this->session->userdata("Periode").'</h5></td>
                </tr>
              </table>
              <br><br>
              <table border="1" cellpadding="4">
                  <tr>
                    <td align="center" width="30px">No</td>
                    <td width="150px">Wajib Pajak</td>
                    <td width="100px">Receipt</td>
                    <td width="130px">SubNominal</td>
                    <td width="100px">Service</td>
                    <td width="130px">Pajak</td>
                    <td width="130px">Total</td>
                  </tr>';
            foreach ($DataTransaksiHarian as $key){
              $i++;
              $html.='<tr>
                <td align="center">'.$i.'</td>
                <td>'.$key["NamaWP"].'</td>
                <td>'.$key["Receipt"].'</td>
                <td>'.$key["SubNominal"].'</td>
                <td>'.$key["Service"].'</td>
                <td>'.$key["Pajak"].'</td>
                <td>'.$key["Transaksi"].'</td>
              </tr>';
                $TotalSubNominal += $key['SubNominal'];
                $TotalService += $key['Service'];
                $TotalPajak += $key['Pajak'];
                $Total += $key['Transaksi'];
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
            $pdf->Output('DataTransaksiHarian.pdf', 'D');
 ?>