<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aktifitas extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('Admin') != '1'){
			redirect(base_url());
		}
	}

	public function Log($Aktifitas){
		$this->db->insert('Aktifitas',
							array('NamaUser' => $this->session->userdata('NamaAdmin'),
								 'Aktifitas' => $Aktifitas,
								 'IP' => $_SERVER['REMOTE_ADDR']));
	}

	public function index(){
		$this->Log('Akses Menu Aktifitas');
		$Query = "SELECT * FROM ".'"Aktifitas"'.' ORDER BY '.'"TanggalAkses" DESC';
		$Data['DataAktifitas'] = $this->db->query($Query)->result_array();
		$Data['title'] = "Aktifitas";
		$Data['submenu'] = "";
		$this->load->view('Header',$Data);
		$this->load->view('Aktifitas');
	}
}