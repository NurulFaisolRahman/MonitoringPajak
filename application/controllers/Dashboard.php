<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('Status') != "Login"){
			redirect(base_url());
		}
	}

	public function Log($Aktifitas){
		$this->db->insert('Aktifitas',
							array('NamaUser' => $this->session->userdata('NamaAdmin'),
								 'Aktifitas' => $Aktifitas,
								 'TanggalAkses' => date("d-m-Y H:i:s")));
	}

	public function index(){
		$Tahun = $Bulan = $Query = $Queri = $query = $Bidang = $Data['bidangpajak'] = "";
		$NamaBulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		if (!empty($_POST)) {
			$Bulan = substr($_POST['Bulan'],0,7);
			$Tahun = substr($_POST['Bulan'],0,4);
			$Data['bulan'] = $_POST['Bulan'];
			$Bidang = $_POST['BidangPajak'];
			$Data['bidangpajak'] = $_POST['BidangPajak'];
			if ($_POST['BidangPajak'] == 'All') {
				$this->Log('Filter Bulan Pada Menu Dashboard');
				$Query = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"WaktuTransaksi"::text like '."'%$Bulan%'";
				$Queri = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"WaktuTransaksi"::text like '."'%$Tahun%'";
				$query = "SELECT DISTINCT ".'"NPWPD"'." FROM ".'"Transaksi"'." WHERE ".'"WaktuTransaksi"::text like '."'%$Bulan%'";
			} else {
				$this->Log('Filter Bulan Dan Bidang Pajak Pada Menu Dashboard');
				$Query = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"JenisPajak" = '."'$Bidang'".' AND "WaktuTransaksi"::text like '."'%$Bulan%'";
				$Queri = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"JenisPajak" = '."'$Bidang'".' AND "WaktuTransaksi"::text like '."'%$Tahun%'";
				$query = "SELECT DISTINCT ".'"NPWPD"'." FROM ".'"Transaksi"'." WHERE ".'"JenisPajak" = '."'$Bidang'".' AND "WaktuTransaksi"::text like '."'%$Bulan%'";
			}
		} else {
			$this->Log('Akses Menu Dashboard');
			$this->db->insert('Aktifitas',
							array('NamaUser' => $this->session->userdata('NamaAdmin'),
								 'Aktifitas' => 'Akses Menu Dashboard',
								 'TanggalAkses' => date("d-m-Y H:i:s")));
			$Bulan = date("Y-m");
			$Tahun = date("Y");
			$Query = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"WaktuTransaksi"::text like '."'%$Bulan%'";
			$Queri = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"WaktuTransaksi"::text like '."'%$Tahun%'";
			$query = "SELECT DISTINCT ".'"NPWPD"'." FROM ".'"Transaksi"'." WHERE ".'"WaktuTransaksi"::text like '."'%$Bulan%'";
		}
		$Transaksi  = $this->db->query($Query)->result_array();
		$TransaksiPerTahun = $this->db->query($Queri)->result_array();
		$DataPerWP = $this->db->query($query)->result_array();
		$Top5 = array();
		if (!empty($DataPerWP)) {
			foreach ($DataPerWP as $key) {
				$NPWPD = $key['NPWPD'];
				$queri = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"NPWPD" = '."'$NPWPD'".' AND "WaktuTransaksi"::text like '."'%$Bulan%'";
				$DataTransaksi = $this->db->query($queri)->result_array();
				$JumlahTransaksi = $JumlahPajak = 0;
				foreach ($DataTransaksi as $Key) {
					$JumlahTransaksi += $Key['TotalTransaksi'];
					$JumlahPajak += $Key["Pajak"];
				}
				$DataTop5 = array();
				$DataTop5['Transaksi'] = $JumlahTransaksi;
				$DataTop5['Pajak'] = $JumlahPajak;
				$kueri = "SELECT ".'"NamaWP"'." FROM ".'"WajibPajak"'." WHERE ".'"NPWPD" = '."'$NPWPD'";
				$NamaWP = $this->db->query($kueri)->result_array();
				$DataTop5['NamaWP'] = $NamaWP[0]['NamaWP'];
				array_push($Top5, $DataTop5);
			}
		}
		usort($Top5, array($this,"Urutkan"));
		$TotalPajakBulan = $TotalTransaksiBulan = 0;
		$GrafikPajak = array();
		$GrafikTransaksi = array();
		foreach ($Transaksi as $key) {
			if (!empty($GrafikPajak[(int) substr($key['WaktuTransaksi'],8,2)])) {
				$GrafikPajak[(int) substr($key['WaktuTransaksi'],8,2)] += (int) $key['Pajak'];
				
			} else {
				$GrafikPajak[(int) substr($key['WaktuTransaksi'],8,2)] = (int) $key['Pajak'];
			}
			if (!empty($GrafikTransaksi[(int) substr($key['WaktuTransaksi'],8,2)])) {
				$GrafikTransaksi[(int) substr($key['WaktuTransaksi'],8,2)] += (int) $key['TotalTransaksi'];
				
			} else {
				$GrafikTransaksi[(int) substr($key['WaktuTransaksi'],8,2)] = (int) $key['TotalTransaksi'];
			}
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
		$Data['Bulan'] = $NamaBulan[(int) substr($Bulan, -2)-1];
		$Data['Tahun'] = $Tahun;
		$Data['JumlahTanggal'] = $JumlahHari;
		$Data['GrafikPajak'] = $GrafikPajak;
		$Data['GrafikTransaksi'] = $GrafikTransaksi;
		$Data['TotalPajakBulan'] = $this->Rupiah($TotalPajakBulan);
		$Data['TotalTransaksiBulan'] = $this->Rupiah($TotalTransaksiBulan);
		$Data['TotalPajakTahun'] = $this->Rupiah($TotalPajakTahun);
		$Data['TotalTransaksiTahun'] = $this->Rupiah($TotalTransaksiTahun);
		$Data['Top5'] = $Top5;
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

	function Urutkan($a,$b){
	  if ($a==$b) return 0;
	    return ($a>$b)?-1:1;
	}
}
