<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening extends CI_Controller {

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
		$this->Log('Akses Menu Rekening');
		$Data['DataRekening'] = $this->db->get('Rekening')->result_array();
		$Data['title'] = "Rekening";
		$Data['submenu'] = "";
		$this->load->view('Header',$Data);
		$this->load->view('Rekening');
	}

	public function Tambah(){
		$NomorRekening = $_POST['NomorRekening'];
		if ($NomorRekening[strlen($NomorRekening)-1] == '_') {
			$NomorRekening = substr($NomorRekening, 0, -3);
		}
		if ($this->db->get_where('Rekening', array('NomorRekening' => $_POST['JenisPajak'].'.'.$NomorRekening))->num_rows() === 0) {
			$Simpan = $this->db->insert('Rekening',
							array('NomorRekening' => $_POST['JenisPajak'].'.'.$NomorRekening,
										'JenisPajak' => $_POST['NamaJenisPajak'],
										'SubJenisPajak' => $_POST['SubJenisPajak']));		
			echo "ok";
			$this->Log('Tambah Data Rekening Dengan Nomor = 4.1.1.'.$_POST['JenisPajak'].'.'.$NomorRekening);
		} else {
			echo "ko";
		}
	}

	public function Edit(){
		$NomorRekening = $_POST['EditNomorRekening'];
		if ($NomorRekening[strlen($NomorRekening)-1] == '_') {
			$NomorRekening = substr($NomorRekening, 0, -3);
		}
		if ($_POST['EditJenisPajak'].'.'.$NomorRekening != $_POST['EditNomorRekeningLama']) {
			if ($this->db->get_where('Rekening', array('NomorRekening' => $_POST['EditJenisPajak'].'.'.$NomorRekening))->num_rows() === 0) {
			$this->db->where('NomorRekening', $_POST['EditNomorRekeningLama']);
			$this->db->update('Rekening',
								array('NomorRekening' => $_POST['EditJenisPajak'].'.'.$NomorRekening,
									  'JenisPajak' => $_POST['NamaJenisPajak'],
									  'SubJenisPajak' => $_POST['EditSubJenisPajak']));
				echo "ok";
				$this->Log('Edit Data Rekening Dengan Nomor = 4.1.1.'.$_POST['EditJenisPajak'].'.'.$NomorRekening);
			} else {
				echo "ko";
			}
		} else {
			$this->db->where('NomorRekening', $_POST['EditNomorRekeningLama']);
			$this->db->update('Rekening',array('SubJenisPajak' => $_POST['EditSubJenisPajak']));
			echo "ok";
			$this->Log('Edit Data Rekening Dengan Nomor = 4.1.1.'.$_POST['EditJenisPajak'].'.'.$NomorRekening);
		}
	}

	public function Hapus(){
		if ($this->db->get_where('WajibPajak', array('NomorRekening' => $_POST['NomorRekening']))->num_rows() === 0) {
			$this->db->delete('Rekening', array('NomorRekening' => $_POST['NomorRekening']));
			echo "ok";
			$this->Log('Hapus Data Rekening Dengan Nomor = 4.1.1.'.$_POST['NomorRekening']);
		} else {
			echo "ko";
		}
	}
}
