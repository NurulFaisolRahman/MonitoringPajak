<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('Status') != "Login"){
			redirect(base_url());
		}
	}

	public function index(){
		$Tahun = $Bulan = $Query = $Queri = $Bidang = $Data['bidangpajak'] = "";
		if (!empty($_POST)) {
			$Bulan = substr($_POST['Bulan'],0,7);
			$Tahun = substr($_POST['Bulan'],0,4);
			$Data['bulan'] = $_POST['Bulan'];
			$Bidang = $_POST['BidangPajak'];
			$Data['bidangpajak'] = $_POST['BidangPajak'];
			if ($_POST['BidangPajak'] == 'All') {
				$Query = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"WaktuTransaksi"::text like '."'%$Bulan%'";
				$Queri = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"WaktuTransaksi"::text like '."'%$Tahun%'";
			} else {
				$Query = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"JenisPajak" = '."'$Bidang'".' AND "WaktuTransaksi"::text like '."'%$Bulan%'";
				$Queri = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"JenisPajak" = '."'$Bidang'".' AND "WaktuTransaksi"::text like '."'%$Tahun%'";
			}
		} else {
			$Bulan = date("Y-m");
			$Tahun = date("Y");
			$Query = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"WaktuTransaksi"::text like '."'%$Bulan%'";
			$Queri = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"WaktuTransaksi"::text like '."'%$Tahun%'";
		}
		$Transaksi  = $this->db->query($Query)->result_array();
		$TransaksiPerTahun = $this->db->query($Queri)->result_array();
		$TotalPajakBulan = $TotalTransaksiBulan = 0;
		$GrafikPajak = array();
		$GrafikTransaksi = array();
		foreach ($Transaksi as $key) {
			$GrafikPajak[(int) substr($key['WaktuTransaksi'],8,2)] = (int) $key['Pajak'];
			$GrafikTransaksi[(int) substr($key['WaktuTransaksi'],8,2)] = (int) $key['TotalTransaksi'];
			$TotalPajakBulan += $key['Pajak'];
			$TotalTransaksiBulan += $key['TotalTransaksi'];
		}
		$TotalPajakTahun = $TotalTransaksiTahun = 0;
		foreach ($TransaksiPerTahun as $key) {
			$TotalPajakTahun += $key['Pajak'];
			$TotalTransaksiTahun += $key['TotalTransaksi'];
		}
		$JumlahHari = cal_days_in_month(CAL_GREGORIAN,substr($Bulan, -2),$Tahun);
		$Tanggal = 1;
		for ($i=1; $i <= $JumlahHari; $i++) { 
			if (empty($GrafikPajak[$i])) {
				$GrafikPajak[$i] = 0;
				$GrafikTransaksi[$i] = 0;
			}
		}
		ksort($GrafikTransaksi);
		ksort($GrafikPajak);
		$Data['JumlahTanggal'] = $JumlahHari;
		$Data['GrafikPajak'] = $GrafikPajak;
		$Data['GrafikTransaksi'] = $GrafikTransaksi;
		$Data['TotalPajakBulan'] = $this->Rupiah($TotalPajakBulan);
		$Data['TotalTransaksiBulan'] = $this->Rupiah($TotalTransaksiBulan);
		$Data['TotalPajakTahun'] = $this->Rupiah($TotalPajakTahun);
		$Data['TotalTransaksiTahun'] = $this->Rupiah($TotalTransaksiTahun);
		$Data['DataRekening'] = $this->db->get('Rekening')->result_array();
		$Data['title'] = "Dashboard";
		$Data['submenu'] = "";
		$this->load->view('Header',$Data);
		$this->load->view('Dashboard');
	}

	function Rupiah($Angka){
	   $hasil_rupiah = "Rp " . number_format($Angka,2,',','.');
	   return $hasil_rupiah;
	}
}
