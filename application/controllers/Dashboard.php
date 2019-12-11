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
		$Bulan = date("Y-m");
		$Query = "SELECT * FROM ".'"Transaksi"'." WHERE ".'"WaktuTransaksi"::text like '."'%$Bulan%'";
		$Transaksi  = $this->db->query($Query)->result_array();
		$TotalPajakBulan = $TotalTransaksiBulan = 0;
		foreach ($Transaksi as $key) {
			$TotalPajakBulan += $key['Pajak'];
			$TotalTransaksiBulan += $key['TotalTransaksi'];
		}
		$Data['TotalPajakBulan'] = $this->Rupiah($TotalPajakBulan);
		$Data['TotalTransaksiBulan'] = $this->Rupiah($TotalTransaksiBulan);
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
