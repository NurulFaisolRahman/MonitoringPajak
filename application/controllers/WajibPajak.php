<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WajibPajak extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('Status') != "Login"){
			redirect(base_url());
		}
	}

	public function index(){
		$Data['DataWajibPajak'] = $this->db->get('WajibPajak')->result_array();
		$Data['DataRekening'] = $this->db->get('Rekening')->result_array();
		$Data['title'] = "Daftar WP";
		$Data['submenu'] = "";
		$this->load->view('Header',$Data);
		$this->load->view('WajibPajak');
	}

	public function Tambah(){
		$Pisah = explode("|", $_POST['DataRekening']);
		$this->db->insert('WajibPajak',
				    array('NPWPD' => $_POST['NPWPD'],
						  'NamaWP' => $_POST['NamaWP'],
					      'AlamatWP' => $_POST['AlamatWP'],
					 	  'NomorRekening' => $Pisah[0],
						  'JenisPajak' => $Pisah[1],
						  'SubJenisPajak' => $Pisah[2],
						  'JamOperasional' => $_POST['JamOperasional']));
		redirect(base_url('WajibPajak'));
	}

	public function Edit(){
		$Pisah = explode("|", $_POST['EditDataRekening']);
		$this->db->where('NPWPD', $_POST['EditNPWPD']);
		$this->db->update('WajibPajak',
					array('NPWPD' => $_POST['EditNPWPD'],
						  'NamaWP' => $_POST['EditNamaWP'],
						  'AlamatWP' => $_POST['EditAlamatWP'],
						  'NomorRekening' => $Pisah[0],
						  'JenisPajak' => $Pisah[1],
						  'SubJenisPajak' => $Pisah[2],
						  'JamOperasional' => $_POST['EditJamOperasional']));
		redirect(base_url('WajibPajak'));
	}

	public function Hapus(){
		$tes = $this->db->delete('WajibPajak', array('NPWPD' => $_POST['NPWPD']));
		echo "ok";
	}

	public function IndexRekening(){
		$Data = $this->db->get('Rekening')->result_array();
		echo json_encode($Data);
	}

	public function Status(){
		$Status = $this->db->select('Status,Riwayat')    
                    ->from('WajibPajak')
                    ->where('NPWPD', $_POST['NPWPD'])
                    ->get()->result_array();
		echo json_encode($Status[0]);
	}

	public function GantiStatus(){
		$this->db->where('NPWPD', $_POST['NPWPD']);
		$this->db->update('WajibPajak', array('Status' => $_POST['WPStatus']));
	}

	public function PDF(){
		$Data['DataWajibPajak'] = $this->db->get('WajibPajak')->result_array();
		$this->load->view('WajibPajakPDF',$Data);
	}

	public function Excel(){
		$Data['DataWajibPajak'] = $this->db->get('WajibPajak')->result_array();
		$this->load->view('WajibPajakExcel',$Data);
	}
}
