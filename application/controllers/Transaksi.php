<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('Status') != "Login"){
			redirect(base_url());
		}
	}

	public function DataPerWP($dataperwp, $periode){ 
		$dataTransaksiPerWP = array();
		foreach ($dataperwp as $key) {
			$NPWPD = $key['NPWPD'];
			if (count($periode) == 1) {
				$queri = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"NPWPD" = '."'$NPWPD' AND ".'"WaktuTransaksi"::text like '."'%$periode%'";
			} else {
				$queri = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"NPWPD" = '."'$NPWPD' AND ".'"WaktuTransaksi"::date >= '."'$periode[0]'"." AND ".'"WaktuTransaksi"::date <= '."'$periode[1]'";
			}
			$DataTransaksi = $this->db->query($queri)->result_array();
			$JumlahSubTotal = $JumlahService = $JumlahTransaksi = $JumlahPajak = $NReceipt = $Diskon = 0;
			foreach ($DataTransaksi as $Key) {
				$JumlahSubTotal += $Key['SubNominal'];
				$JumlahService += $Key["Service"];
				$JumlahTransaksi += $Key['TotalTransaksi'];
				$JumlahPajak += $Key["Pajak"];
				$Diskon += $Key["Diskon"];
				$NReceipt++;
			}
			$TransaksiPerWP = array();
			$TransaksiPerWP['SubNominal'] = $JumlahSubTotal;
			$TransaksiPerWP['Service'] = $JumlahService;
			$TransaksiPerWP['Transaksi'] = $JumlahTransaksi;
			$TransaksiPerWP['Pajak'] = $JumlahPajak;
			$TransaksiPerWP['Diskon'] = $Diskon;
			$TransaksiPerWP['Receipt'] = $NReceipt;
			$kueri = "SELECT ".'"NamaWP"'." FROM ".'"WajibPajak"'." WHERE ".'"NPWPD" = '."'$NPWPD'";
			$NamaWP = $this->db->query($kueri)->result_array();
			$TransaksiPerWP['NamaWP'] = $NamaWP[0]['NamaWP'];
			$TransaksiPerWP['NPWPD'] = $NPWPD;
			array_push($dataTransaksiPerWP, $TransaksiPerWP);
		}
		return $dataTransaksiPerWP;
	}

	
	public function SesiTransaksi($datatransaksi, $judul, $bidang, $periode, $namafile){
		$this->session->set_userdata(array('Transaksi' => $datatransaksi));
		$this->session->set_userdata(array('Judul' => $judul));
		$this->session->set_userdata(array('Bidang' => strtoupper($bidang)));
		$this->session->set_userdata(array('Periode' => $periode));
		$this->session->set_userdata(array('NamaFile' => $namafile));
	}

	public function Tahunan(){
		$Tahun = $query = $Bidang = $Data['bidangpajak'] = "";
		if (!empty($_POST)) {
			$Tahun = substr($_POST['Tahun'],0,4);
			$Data['tahun'] = $_POST['Tahun'];
			$Bidang = $_POST['BidangPajak'];
			$Data['bidangpajak'] = $_POST['BidangPajak'];
			if ($_POST['BidangPajak'] == 'All') {
				$Bidang = 'Semua Jenis Pajak';
				$query = "SELECT DISTINCT ".'"NPWPD"'." FROM ".'"Transaksi"'." WHERE ".'"WaktuTransaksi"::text like '."'%$Tahun%'";
			} else {
				$query = "SELECT DISTINCT ".'"NPWPD"'." FROM ".'"Transaksi"'." WHERE ".'"JenisPajak" = '."'$Bidang'".' AND "WaktuTransaksi"::text like '."'%$Tahun%'";
			}
		} else {
			$Tahun = date("Y");
			$Bidang = 'Semua Jenis Pajak';
			$query = "SELECT DISTINCT ".'"NPWPD"'." FROM ".'"Transaksi"'." WHERE ".'"WaktuTransaksi"::text like '."'%$Tahun%'";
		}
		$DataPerWP  = $this->db->query($query)->result_array();
		$DataTransaksiPerWP = array();
		if (!empty($DataPerWP)) {
			$DataTransaksiPerWP = $this->DataPerWP($DataPerWP, $Tahun);
			$Data['Transaksi']  = $DataTransaksiPerWP;
		} else {
			$Data['Transaksi']  = $DataTransaksiPerWP;
		}
		$Data['DataRekening'] = $this->db->get('Rekening')->result_array();
		$Data['title'] = "Transaksi";
		$Data['submenu'] = "Tahunan";
		$this->load->view('Header',$Data);
		$this->load->view('Transaksi/Tahunan');
		$this->SesiTransaksi($DataTransaksiPerWP, 'LAPORAN DATA TRANSAKSI TAHUNAN', $Bidang, $Tahun, 'TransaksiTahunan'.str_replace(" ", "_", ucwords($Bidang)).$Tahun);
	}

	public function Bulanan(){
		$Bulan = $query = $Bidang = $Data['bidangpajak'] = "";
		if (!empty($_POST)) {
			$Bulan = substr($_POST['Bulan'],0,7);
			$Data['bulan'] = $_POST['Bulan'];
			$Bidang = $_POST['BidangPajak'];
			$Data['bidangpajak'] = $_POST['BidangPajak'];
			if ($_POST['BidangPajak'] == 'All') {
				$Bidang = 'Semua Jenis Pajak';
				$query = "SELECT DISTINCT ".'"NPWPD"'." FROM ".'"Transaksi"'." WHERE ".'"WaktuTransaksi"::text like '."'%$Bulan%'";
			} else {
				$query = "SELECT DISTINCT ".'"NPWPD"'." FROM ".'"Transaksi"'." WHERE ".'"JenisPajak" = '."'$Bidang'".' AND "WaktuTransaksi"::text like '."'%$Bulan%'";
			}
		} else {
			$Bulan = date("Y-m");
			$Bidang = 'Semua Jenis Pajak';
			$query = "SELECT DISTINCT ".'"NPWPD"'." FROM ".'"Transaksi"'." WHERE ".'"WaktuTransaksi"::text like '."'%$Bulan%'";
		}
		$DataPerWP  = $this->db->query($query)->result_array();
		$DataTransaksiPerWP = array();
		if (!empty($DataPerWP)) {
			$DataTransaksiPerWP = $this->DataPerWP($DataPerWP, $Bulan);
			$Data['Transaksi']  = $DataTransaksiPerWP;
		} else {
			$Data['Transaksi']  = $DataTransaksiPerWP;
		}
		$Data['DataRekening'] = $this->db->get('Rekening')->result_array();
		$Data['title'] = "Transaksi";
		$Data['submenu'] = "Bulanan";
		$this->load->view('Header',$Data);
		$this->load->view('Transaksi/Bulanan');
		$NamaBulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$this->SesiTransaksi($DataTransaksiPerWP, 'LAPORAN DATA TRANSAKSI BULANAN', $Bidang, strtoupper($NamaBulan[(int) substr($Bulan, -2)-1])." ".substr($Bulan, 0, 4), 'TransaksiBulanan'.str_replace(" ", "_", ucwords($Bidang)).ucwords($NamaBulan[(int) substr($Bulan, -2)-1]));
	}

	public function Harian(){ 
		$awal = $akhir = $Awal = $Akhir = $query = $Bidang = $Data['bidangpajak'] = "";
		if (!empty($_POST)) {
			$Rentang = explode("-", $_POST['Hari']);
			$awal = explode("-",substr(str_replace("/","-",$Rentang[0]),0,10));
			$akhir = explode("-",substr(str_replace("/","-",$Rentang[1]),1,11));
			$Awal = $awal[1]."-".$awal[0]."-".$awal[2];
			$Akhir = (int) ($akhir[1])."-".$akhir[0]."-".$akhir[2];
			$Data['hari'] = $_POST['Hari'];
			$Bidang = $_POST['BidangPajak'];
			$Data['bidangpajak'] = $_POST['BidangPajak'];
			if ($_POST['BidangPajak'] == 'All') {
				$Bidang = 'Semua Jenis Pajak';
				$query = "SELECT DISTINCT ".'"NPWPD"'." FROM ".'"Transaksi"'." WHERE ".'"WaktuTransaksi"::date >= '."'$Awal'"." AND ".'"WaktuTransaksi"::date <= '."'$Akhir'";
			} else {
				$query = "SELECT DISTINCT ".'"NPWPD"'." FROM ".'"Transaksi"'." WHERE ".'"JenisPajak" = '."'$Bidang'".' AND "WaktuTransaksi"::date >= '."'$Awal'"." AND ".'"WaktuTransaksi"::date <= '."'$Akhir'";
			}
		} else {
			$Awal = date("d-m-Y");
			$Akhir = date("d-m-Y");
			$Bidang = 'Semua Jenis Pajak';
			$query = "SELECT DISTINCT ".'"NPWPD"'." FROM ".'"Transaksi"'." WHERE ".'"WaktuTransaksi"::date >= '."'$Awal'"." AND ".'"WaktuTransaksi"::date <= '."'$Akhir'";
		}
		$DataPerWP  = $this->db->query($query)->result_array();
		$DataTransaksiPerWP = array();
		if (!empty($DataPerWP)) {
			$DataTransaksiPerWP = $this->DataPerWP($DataPerWP, array($Awal,$Akhir));
			$Data['Transaksi']  = $DataTransaksiPerWP;
		} else {
			$Data['Transaksi']  = $DataTransaksiPerWP;
		}
		$Data['DataRekening'] = $this->db->get('Rekening')->result_array();
		$Data['title'] = "Transaksi";
		$Data['submenu'] = "Harian";
		$this->load->view('Header',$Data);
		$this->load->view('Transaksi/Harian');
		$this->SesiTransaksi($DataTransaksiPerWP, 'LAPORAN DATA TRANSAKSI HARIAN', $Bidang, ($Awal." - ".$Akhir), 'TransaksiHarian'.str_replace(" ", "_", ucwords($Bidang)).($Awal."-".$Akhir));
	}

	public function Excel(){ 
		$this->load->view('Transaksi/Excel');
	}

	public function Pdf(){ 
		$this->load->library('Pdf');
		$this->load->view('Transaksi/Pdf');
	}

	public function ExcelPerWP(){ 
		$this->load->view('Transaksi/ExcelPerWP');
	}

	public function PdfPerWP(){ 
		$this->load->library('Pdf');
		$this->load->view('Transaksi/PdfPerWP');
	}

	public function PdfPerWPHarian(){ 
		$this->load->library('Pdf');
		$this->load->view('Transaksi/PdfPerWPHarian');
	}

	public function DetailPerWP(){ 
		$NamaBulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$FormatData = array();
		$npwpd = $_POST['NPWPD'];
		$periode = '';
		if ($_POST['Judul'] == "TAHUNAN") {
			$filter = substr($_POST['Periode'], 0,4);
			$periode = substr($_POST['Periode'], 0,4);
			for ($i=1; $i <= 12; $i++) { 
				if ($i < 10) {
					$Angka = '0'.$i;
				} else {
					$Angka = $i;
				}
				$IndexBulan = (int) $filter.'-'.$Angka;
				$QUERY = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"NPWPD" = '."'$npwpd' AND ".'"WaktuTransaksi"::text like '."'%$IndexBulan%'";
				$DetailData = $this->db->query($QUERY)->result_array();
				$Tampung = array();
				if (empty($DetailData)) {
					$Tampung['Baris'] = $NamaBulan[$i-1];
					$Tampung['Receipt'] = 0;
					$Tampung['SubNominal'] = 0;
					$Tampung['Service'] = 0;
					$Tampung['Diskon'] = 0;
					$Tampung['Pajak'] = 0;
					$Tampung['TotalTransaksi'] = 0;
				} else {
					$Tampung['Baris'] = $NamaBulan[$i-1];
					foreach ($DetailData as $key) {
						if (empty($Tampung['Receipt'])) {
							$Tampung['Receipt'] = 1;
							$Tampung['SubNominal'] = $key['SubNominal'];
							$Tampung['Service'] = $key['Service'];
							$Tampung['Diskon'] = $key['Diskon'];
							$Tampung['Pajak'] = $key['Pajak'];
							$Tampung['TotalTransaksi'] = $key['TotalTransaksi'];
						} else {
							$Tampung['Receipt'] += 1;
							$Tampung['SubNominal'] += $key['SubNominal'];
							$Tampung['Service'] += $key['Service'];
							$Tampung['Diskon'] += $key['Diskon'];
							$Tampung['Pajak'] += $key['Pajak'];
							$Tampung['TotalTransaksi'] += $key['TotalTransaksi'];
						}
					}
				}
				array_push($FormatData, $Tampung);
			}
		} else if ($_POST['Judul'] == "BULANAN") {
			$bulan = substr($_POST['Periode'], -2);
			$tahun = substr($_POST['Periode'], 0, 4);
			$JumlahHari = cal_days_in_month(CAL_GREGORIAN,$bulan,$tahun);
			$periode = strtoupper($NamaBulan[(int) ($bulan)-1])." ".$tahun;
			for ($i=1; $i <= $JumlahHari; $i++) { 
				if ($i < 10) {
					$Angka = '0'.$i;
				} else {
					$Angka = $i;
				}
				$Tanggal = $tahun.'-'.$bulan.'-'.$Angka;
				$QUERY = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"NPWPD" = '."'$npwpd' AND ".'"WaktuTransaksi"::text like '."'%$Tanggal%'";
				$DetailData = $this->db->query($QUERY)->result_array();
				$Tampung = array();
				if (empty($DetailData)) {
					$Tampung['Baris'] = $Angka.'-'.$bulan.'-'.$tahun;
					$Tampung['Receipt'] = 0;
					$Tampung['SubNominal'] = 0;
					$Tampung['Service'] = 0;
					$Tampung['Diskon'] = 0;
					$Tampung['Pajak'] = 0;
					$Tampung['TotalTransaksi'] = 0;
				} else {
					$Tampung['Baris'] = $Angka.'-'.$bulan.'-'.$tahun;
					foreach ($DetailData as $key) {
						if (empty($Tampung['Receipt'])) {
							$Tampung['Receipt'] = 1;
							$Tampung['SubNominal'] = $key['SubNominal'];
							$Tampung['Service'] = $key['Service'];
							$Tampung['Diskon'] = $key['Diskon'];
							$Tampung['Pajak'] = $key['Pajak'];
							$Tampung['TotalTransaksi'] = $key['TotalTransaksi'];
						} else {
							$Tampung['Receipt'] += 1;
							$Tampung['SubNominal'] += $key['SubNominal'];
							$Tampung['Service'] += $key['Service'];
							$Tampung['Diskon'] += $key['Diskon'];
							$Tampung['Pajak'] += $key['Pajak'];
							$Tampung['TotalTransaksi'] += $key['TotalTransaksi'];
						}
					}
				}
				array_push($FormatData, $Tampung);
			}
		} else if ($_POST['Judul'] == "HARIAN") {
			$Rentang = explode("-", $_POST['Periode']);
			$awal = explode("-",substr(str_replace("/","-",$Rentang[0]),0,10));
			$akhir = explode("-",substr(str_replace("/","-",$Rentang[1]),1,11));
			$Awal = $awal[1]."-".$awal[0]."-".$awal[2];
			$Akhir = (int) ($akhir[1])."-".$akhir[0]."-".$akhir[2];
			$periode = $_POST['Periode'];
			$QUERY = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"NPWPD" = '."'$npwpd' AND ".'"WaktuTransaksi"::date >= '."'$Awal'"." AND ".'"WaktuTransaksi"::date <= '."'$Akhir'";
			$DetailData = $this->db->query($QUERY)->result_array();
			foreach ($DetailData as $key) {
				$Tampung = array();
				$Tampung['Baris'] = $key['WaktuTransaksi'];
				$Tampung['Receipt'] = $key['NomorTransaksi'];
				$Tampung['SubNominal'] = $key['SubNominal'];
				$Tampung['Service'] = $key['Service'];
				$Tampung['Diskon'] = $key['Diskon'];
				$Tampung['Pajak'] = $key['Pajak'];
				$Tampung['TotalTransaksi'] = $key['TotalTransaksi'];
				array_push($FormatData, $Tampung);
			}
		}
		$kueri = "SELECT ".'"NamaWP","JenisPajak"'." FROM ".'"WajibPajak"'." WHERE ".'"NPWPD" = '."'$npwpd'";
		$NamaWP = $this->db->query($kueri)->result_array();
		$this->session->set_userdata(array('JudulPerWP' => 'LAPORAN TRANSAKSI '.$_POST['Judul']));
		$this->session->set_userdata(array('NamaWP' => 'WAJIB PAJAK : '.$NamaWP[0]['NamaWP']));
		$this->session->set_userdata(array('PeriodeWP' => 'PERIODE : '.$periode));
		$this->session->set_userdata(array('DetailPerWP' => $FormatData));
		$this->session->set_userdata(array('NamaFilePerWP' => $NamaWP[0]['NamaWP']));
		$this->session->set_userdata(array('JenisPajakPerWP' => $NamaWP[0]['JenisPajak']));
		echo "ok";
	}
}
