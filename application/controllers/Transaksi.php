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
		$Tahun = $Query = $Bidang = $Data['bidangpajak'] = "";
		if (!empty($_POST)) {
			$Tahun = substr($_POST['Tahun'],0,4);
			$Data['tahun'] = $_POST['Tahun'];
			$Bidang = $_POST['BidangPajak'];
			$Data['bidangpajak'] = $_POST['BidangPajak'];
			if ($_POST['BidangPajak'] == 'All') {
				$Query = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"WaktuTransaksi"::text like '."'%$Tahun%'";
			} else {
				$Query = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"JenisPajak" = '."'$Bidang'".' AND "WaktuTransaksi"::text like '."'%$Tahun%'";
			}
		} else {
			$Tahun = date("Y");
			$Query = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"WaktuTransaksi"::text like '."'%$Tahun%'";
		}
		$Data['Transaksi']  = $this->db->query($Query)->result_array();
		$Data['DataRekening'] = $this->db->get('Rekening')->result_array();
		$Data['title'] = "Transaksi";
		$Data['submenu'] = "Tahunan";
		$this->load->view('Header',$Data);
		$this->load->view('Transaksi/Tahunan');
	}

	public function Bulanan(){
		$Bulan = $Query = $Bidang = $Data['bidangpajak'] = "";
		if (!empty($_POST)) {
			$Bulan = substr($_POST['Bulan'],0,7);
			$Data['bulan'] = $_POST['Bulan'];
			$Bidang = $_POST['BidangPajak'];
			$Data['bidangpajak'] = $_POST['BidangPajak'];
			if ($_POST['BidangPajak'] == 'All') {
				$Query = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"WaktuTransaksi"::text like '."'%$Bulan%'";
			} else {
				$Query = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"JenisPajak" = '."'$Bidang'".' AND "WaktuTransaksi"::text like '."'%$Bulan%'";
			}
		} else {
			$Bulan = date("Y-m");
			$Query = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"WaktuTransaksi"::text like '."'%$Bulan%'";
		}
		$Data['Transaksi']  = $this->db->query($Query)->result_array();
		$Data['DataRekening'] = $this->db->get('Rekening')->result_array();
		$Data['title'] = "Transaksi";
		$Data['submenu'] = "Bulanan";
		$this->load->view('Header',$Data);
		$this->load->view('Transaksi/Bulanan');
	}

	public function Harian(){ 
		$awal = $akhir = $Awal = $Akhir = $Query = $Bidang = $Data['bidangpajak'] = "";
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
				$Query = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"WaktuTransaksi" >= '."'$Awal'"." AND ".'"WaktuTransaksi" <= '."'$Akhir'";
			} else {
				$Query = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"JenisPajak" = '."'$Bidang'".' AND "WaktuTransaksi" >= '."'$Awal'"." AND ".'"WaktuTransaksi" <= '."'$Akhir'";
			}
		} else {
			$Awal = date("d-m-Y");
			$Query = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"WaktuTransaksi"::date >= '."'$Awal'"." AND ".'"WaktuTransaksi"::date <= '."'$Awal'";
		}
		$Data['Transaksi']  = $this->db->query($Query)->result_array();
		$Data['DataRekening'] = $this->db->get('Rekening')->result_array();
		$Data['title'] = "Transaksi";
		$Data['submenu'] = "Harian";
		$this->load->view('Header',$Data);
		$this->load->view('Transaksi/Harian');
	}

	public function ExcelHarian(){ 

	}
}
