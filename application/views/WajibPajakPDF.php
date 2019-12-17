<?php 
  $NamaAdmin = $this->session->userdata('NamaAdmin');
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
            $html='<h4 style="text-align:center;">DATA WAJIB PAJAK</h4><h5>'.$NamaAdmin.' : '.date("d-m-Y H:i:s").'</h5>
              <table border="1" cellpadding="4">
                  <tr>
                      <td width="30px" align="center">No</td>
                      <td width="100px">Wajib Pajak</td>
                      <td width="120px">Alamat</td>
                      <td width="100px">Nomor Rekening</td>
                      <td width="65px">Jenis Pajak</td>
                      <td width="120px">Sub Jenis Pajak</td>
                      <td width="70px">Jam Kerja</td>
                      <td width="70px">Riwayat</td>
                      <td width="50px">Status</td>
                      <td width="50px">Koneksi</td>
                  </tr>';
                foreach ($DataWajibPajak as $key){ 
                  $i++;
                  $html.='<tr>
                    <td align="center">'.$i.'</td>
                    <td>'.$key["NPWPD"].'<br>'.$key["NamaWP"].'</td>
                    <td>'.$key["AlamatWP"].'</td>
                    <td>4.1.1.'.$key["NomorRekening"].'</td>
                    <td>'.$key["JenisPajak"].'</td>
                    <td>'.$key["SubJenisPajak"].'</td>
                    <td>'.$key["JamOperasional"].'</td>
                    <td>'.$key["Riwayat"].'</td>
                    <td>'.$key["Status"].'</td>
                    <td>'.$key["Koneksi"].'</td>
                  </tr>';
                  }
            $html.='</table>';
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Output('DaftarWajibPajak.pdf', 'D');
 ?>