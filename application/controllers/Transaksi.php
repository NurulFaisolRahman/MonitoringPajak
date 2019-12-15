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
			$JumlahSubTotal = $JumlahService = $JumlahTransaksi = $JumlahPajak = 0;
			foreach ($DataTransaksi as $Key) {
				$JumlahSubTotal += $Key['SubNominal'];
				$JumlahService += $Key["Service"];
				$JumlahTransaksi += $Key['TotalTransaksi'];
				$JumlahPajak += $Key["Pajak"];
			}
			$TransaksiPerWP = array();
			$TransaksiPerWP['SubNominal'] = $JumlahSubTotal;
			$TransaksiPerWP['Service'] = $JumlahService;
			$TransaksiPerWP['Transaksi'] = $JumlahTransaksi;
			$TransaksiPerWP['Pajak'] = $JumlahPajak;
			if (count($periode) == 1) {
				$TransaksiPerWP['Receipt'] = substr($NPWPD,-3)."-".$periode;
			} else {
				$TransaksiPerWP['Receipt'] = substr($NPWPD,-3)."-".$periode[0]."-".$periode[1];
			}
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

	public function DetailPerWP(){ 
		$npwpd = $_POST['NPWPD'];
		$filter = $_POST['Periode'];
		$QUERY = "";
		if ($_POST['Judul'] != "HARIAN") {
			$QUERY = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"NPWPD" = '."'$npwpd' AND ".'"WaktuTransaksi"::text like '."'%$filter%'";
		} else {
			$Rentang = explode("-", $filter);
			$awal = explode("-",substr(str_replace("/","-",$Rentang[0]),0,10));
			$akhir = explode("-",substr(str_replace("/","-",$Rentang[1]),1,11));
			$Awal = $awal[1]."-".$awal[0]."-".$awal[2];
			$Akhir = (int) ($akhir[1])."-".$akhir[0]."-".$akhir[2];
			$QUERY = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"NPWPD" = '."'$npwpd' AND ".'"WaktuTransaksi"::date >= '."'$Awal'"." AND ".'"WaktuTransaksi"::date <= '."'$Akhir'";
		}
		$DetailData = $this->db->query($QUERY)->result_array();
		$kueri = "SELECT ".'"NamaWP"'." FROM ".'"WajibPajak"'." WHERE ".'"NPWPD" = '."'$npwpd'";
		$NamaWP = $this->db->query($kueri)->result_array();
		$this->session->set_userdata(array('JudulPerWP' => 'LAPORAN TRANSAKSI '.$_POST['Judul']));
		$this->session->set_userdata(array('NamaWP' => 'WAJIB PAJAK : '.$NamaWP[0]['NamaWP']));
		$this->session->set_userdata(array('PeriodeWP' => 'PERIODE : '.$_POST['Periode']));
		$this->session->set_userdata(array('DetailPerWP' => $DetailData));
		$this->session->set_userdata(array('NamaFilePerWP' => $NamaWP[0]['NamaWP']));
		echo "ok";
	}
}
