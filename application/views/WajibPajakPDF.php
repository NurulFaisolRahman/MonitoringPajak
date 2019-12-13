<?php 
  $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetFont('times', 12);
            $pdf->setPrintHeader(false);         
            $pdf->SetTopMargin(15);
            $pdf->setFooterMargin(20);
            $pdf->SetAutoPageBreak(true,25);
            $pdf->SetAuthor('nurulfaisolrahman@gmail.com');
            $pdf->SetDisplayMode('real', 'default');
            $pdf->AddPage('L', 'A4');
            $i=0;
            $html='<h4>DATA WAJIB PAJAK</h4>
              <table border="1" cellpadding="4">
                  <tr>
                      <td width="30px" align="center">No</td>
                      <td width="80px">NPWPD</td>
                      <td width="120px">Wajib Pajak</td>
                      <td width="160px">Alamat</td>
                      <td>Nomor Rekening</td>
                      <td width="65px">Jenis Pajak</td>
                      <td width="140px">Sub Jenis Pajak</td>
                      <td width="95px">Jam Operasional</td>
                  </tr>';
                foreach ($DataWajibPajak as $key){ 
                  $i++;
                  $html.='<tr>
                    <td align="center">'.$i.'</td>
                    <td>'.$key["NPWPD"].'</td>
                    <td>'.$key["NamaWP"].'</td>
                    <td>'.$key["AlamatWP"].'</td>
                    <td>4.1.1.'.$key["NomorRekening"].'</td>
                    <td>'.$key["JenisPajak"].'</td>
                    <td>'.$key["SubJenisPajak"].'</td>
                    <td>'.$key["JamOperasional"].'</td>
                  </tr>';
                  }
            $html.='</table>';
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Output('DaftarWajibPajak.pdf', 'D');
 ?>