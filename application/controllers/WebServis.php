<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WebServis extends CI_Controller {

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
		// $this->Log('Akses Menu WebServis');
		$Query = "SELECT * FROM ".'"WebServis"'.' ORDER BY '.'"WaktuRegistrasi" DESC';
		$Data['DataWebServis'] = $this->db->query($Query)->result_array();
		$Data['title'] = "WebServis";
		$Data['submenu'] = "";
		$this->load->view('Header',$Data);
		$this->load->view('WebServis');
	}

	public function GantiStatus(){
		$this->db->where('NPWPD', $_POST['NPWPD']);
		$this->db->update('WebServis', array('StatusWebServis' => $_POST['WSstatus']));
		// $this->Log($_POST['WSstatus'].' Web Servis Wajib Pajak Dengan NPWPD = '.$_POST['NPWPD']);
	}
}