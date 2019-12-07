<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('Status') != "Login"){
			redirect(base_url());
		}
		$this->load->database();
	}

	public function index(){
		$Data['DataRekening'] = $this->db->get('Rekening')->result_array();
		$Data['title'] = "Rekening";
		$Data['submenu'] = "";
		$this->load->view('Header',$Data);
		$this->load->view('Rekening');
	}

	public function Tambah(){
		$this->db->insert('Rekening',
									array('NomorRekening' => $_POST['NomorRekening'],
												'JenisPajak' => $_POST['JenisPajak'],
												'SubJenisPajak' => $_POST['SubJenisPajak']));
		redirect(base_url('Rekening'));
	}

	public function Edit(){
		$this->db->where('NomorRekening', $_POST['EditNomorRekening']);
		$this->db->update('Rekening',
									array('JenisPajak' => $_POST['EditJenisPajak'],
												'SubJenisPajak' => $_POST['EditSubJenisPajak']));
		redirect(base_url('Rekening'));
	}

	public function Hapus(){
		$this->db->delete('Rekening', array('NomorRekening' => $_POST['NomorRekening']));
		echo "ok";
	}
}
