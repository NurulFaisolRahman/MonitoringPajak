<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('Status') != "Login"){
			redirect(base_url());
		}
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
			foreach ($DataPerWP as $key) {
				$NPWPD = $key['NPWPD'];
				$queri = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"NPWPD" = '."'$NPWPD' AND ".'"WaktuTransaksi"::text like '."'%$Tahun%'";
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
				$TransaksiPerWP['Receipt'] = substr($NPWPD,-3)."-".$Tahun;
				$kueri = "SELECT ".'"NamaWP"'." FROM ".'"WajibPajak"'." WHERE ".'"NPWPD" = '."'$NPWPD'";
				$NamaWP = $this->db->query($kueri)->result_array();
				$TransaksiPerWP['NamaWP'] = $NamaWP[0]['NamaWP'];
				array_push($DataTransaksiPerWP, $TransaksiPerWP);
			}
		}
		$Data['Transaksi']  = $DataTransaksiPerWP;
		$Data['DataRekening'] = $this->db->get('Rekening')->result_array();
		$Data['title'] = "Transaksi";
		$Data['submenu'] = "Tahunan";
		$this->load->view('Header',$Data);
		$this->load->view('Transaksi/Tahunan');
		$this->session->set_userdata(array('Transaksi' => $DataTransaksiPerWP));
		$this->session->set_userdata(array('Judul' => 'LAPORAN DATA TRANSAKSI TAHUNAN'));
		$this->session->set_userdata(array('Bidang' => strtoupper($Bidang)));
		$this->session->set_userdata(array('Periode' => $Tahun));
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
			foreach ($DataPerWP as $key) {
				$NPWPD = $key['NPWPD'];
				$queri = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"NPWPD" = '."'$NPWPD' AND ".'"WaktuTransaksi"::text like '."'%$Bulan%'";
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
				$TransaksiPerWP['Receipt'] = substr($NPWPD,-3)."-".$Bulan;
				$kueri = "SELECT ".'"NamaWP"'." FROM ".'"WajibPajak"'." WHERE ".'"NPWPD" = '."'$NPWPD'";
				$NamaWP = $this->db->query($kueri)->result_array();
				$TransaksiPerWP['NamaWP'] = $NamaWP[0]['NamaWP'];
				array_push($DataTransaksiPerWP, $TransaksiPerWP);
			}
		}
		$Data['Transaksi']  = $DataTransaksiPerWP;
		$Data['DataRekening'] = $this->db->get('Rekening')->result_array();
		$Data['title'] = "Transaksi";
		$Data['submenu'] = "Bulanan";
		$this->load->view('Header',$Data);
		$this->load->view('Transaksi/Bulanan');
		$this->session->set_userdata(array('Transaksi' => $DataTransaksiPerWP));
		$this->session->set_userdata(array('Judul' => 'LAPORAN DATA TRANSAKSI BULANAN'));
		$this->session->set_userdata(array('Bidang' => strtoupper($Bidang)));
		$NamaBulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$this->session->set_userdata(array('Periode' => strtoupper($NamaBulan[(int) substr($Bulan, -2)-1])." ".substr($Bulan, 0, 4)));
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
			foreach ($DataPerWP as $key) {
				$NPWPD = $key['NPWPD'];
				$queri = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"NPWPD" = '."'$NPWPD' AND ".'"WaktuTransaksi"::date >= '."'$Awal'"." AND ".'"WaktuTransaksi"::date <= '."'$Akhir'";
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
				$TransaksiPerWP['Receipt'] = substr($NPWPD,-3)."-".substr($Awal,0,5)."-".substr($Akhir,0,5);
				$kueri = "SELECT ".'"NamaWP"'." FROM ".'"WajibPajak"'." WHERE ".'"NPWPD" = '."'$NPWPD'";
				$NamaWP = $this->db->query($kueri)->result_array();
				$TransaksiPerWP['NamaWP'] = $NamaWP[0]['NamaWP'];
				array_push($DataTransaksiPerWP, $TransaksiPerWP);
			}
		}
		$Data['Transaksi']  = $DataTransaksiPerWP;
		$Data['DataRekening'] = $this->db->get('Rekening')->result_array();
		$Data['title'] = "Transaksi";
		$Data['submenu'] = "Harian";
		$this->load->view('Header',$Data);
		$this->load->view('Transaksi/Harian');
		$this->session->set_userdata(array('Transaksi' => $DataTransaksiPerWP));
		$this->session->set_userdata(array('Judul' => 'LAPORAN DATA TRANSAKSI HARIAN'));
		$this->session->set_userdata(array('Bidang' => strtoupper($Bidang)));
		$this->session->set_userdata(array('Periode' => $Awal." - ".$Akhir));
	}

	public function Excel(){ 
		$this->load->view('Transaksi/Excel');
	}

	public function Pdf(){ 
		$this->load->library('Pdf');
		$this->load->view('Transaksi/Pdf');
	}
}
