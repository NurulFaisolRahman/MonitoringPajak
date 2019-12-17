<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WajibPajak extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('Status') != "Login"){
			redirect(base_url());
		}
	}

	function NPWPD($Angka){
	   for ($i=strlen($Angka)-1; $i >= 0; $i--) { 
		   	if ($Angka[$i] != '_' && $Angka[$i] != '.') {
		   		return substr($Angka, 0, $i+1);
		   	} 
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
		if ($this->db->get_where('WajibPajak', array('NPWPD' => $this->NPWPD($_POST['NPWPD'])))->num_rows() === 0) {
			$Pisah = explode("|", $_POST['DataRekening']);
			$this->db->insert('WajibPajak',
					    array('NPWPD' => $this->NPWPD($_POST['NPWPD']),
					    	  'Password' => password_hash($_POST['PasswordWP'], PASSWORD_DEFAULT),
							  'NamaWP' => $_POST['NamaWP'],
						      'AlamatWP' => $_POST['AlamatWP'],
						 	  'NomorRekening' => $Pisah[0],
							  'JenisPajak' => $Pisah[1],
							  'SubJenisPajak' => $Pisah[2],
							  'JamOperasional' => $_POST['JamOperasional']));
			echo "ok";
		} else {
			echo "ko";
		}
	}

	public function Edit(){
		$NPWPD = $this->NPWPD($_POST['EditNPWPD']);
		if ($NPWPD != $_POST['EditNPWPDLama']) {
			if ($this->db->get_where('WajibPajak', array('NPWPD' => $NPWPD))->num_rows() === 0) {
				$Pisah = explode("|", $_POST['EditDataRekening']);
				$this->db->where('NPWPD', $_POST['EditNPWPDLama']);
				if (!empty($_POST['EditPasswordWP'])) {
					$this->db->update('WajibPajak',
							array('NPWPD' => $NPWPD,
								  'Password' => password_hash($_POST['EditPasswordWP'], PASSWORD_DEFAULT),
								  'NamaWP' => $_POST['EditNamaWP'],
								  'AlamatWP' => $_POST['EditAlamatWP'],
								  'NomorRekening' => $Pisah[0],
								  'JenisPajak' => $Pisah[1],
								  'SubJenisPajak' => $Pisah[2],
								  'JamOperasional' => $_POST['EditJamOperasional']));
				} else {
					$this->db->update('WajibPajak',
							array('NPWPD' => $NPWPD,
								  'NamaWP' => $_POST['EditNamaWP'],
								  'AlamatWP' => $_POST['EditAlamatWP'],
								  'NomorRekening' => $Pisah[0],
								  'JenisPajak' => $Pisah[1],
								  'SubJenisPajak' => $Pisah[2],
								  'JamOperasional' => $_POST['EditJamOperasional']));
				}
				echo "ok";
			} else {
				echo "ko";
			}
		} else {
			if (!empty($_POST['EditPasswordWP'])) {
				$Pisah = explode("|", $_POST['EditDataRekening']);
				$this->db->where('NPWPD', $_POST['EditNPWPDLama']);
				$this->db->update('WajibPajak',
							array('NPWPD' => $NPWPD,
								  'Password' => password_hash($_POST['EditPasswordWP'], PASSWORD_DEFAULT),
								  'NamaWP' => $_POST['EditNamaWP'],
								  'AlamatWP' => $_POST['EditAlamatWP'],
								  'NomorRekening' => $Pisah[0],
								  'JenisPajak' => $Pisah[1],
								  'SubJenisPajak' => $Pisah[2],
								  'JamOperasional' => $_POST['EditJamOperasional']));
			} else {
				$Pisah = explode("|", $_POST['EditDataRekening']);
				$this->db->where('NPWPD', $_POST['EditNPWPDLama']);
				$this->db->update('WajibPajak',
							array('NPWPD' => $NPWPD,
								  'NamaWP' => $_POST['EditNamaWP'],
								  'AlamatWP' => $_POST['EditAlamatWP'],
								  'NomorRekening' => $Pisah[0],
								  'JenisPajak' => $Pisah[1],
								  'SubJenisPajak' => $Pisah[2],
								  'JamOperasional' => $_POST['EditJamOperasional']));
			}
			echo "ok";
		}
	}

	public function Hapus(){
		if ($this->db->get_where('Transaksi', array('NPWPD' => $_POST['NPWPD']))->num_rows() === 0) {
			$this->db->delete('WajibPajak', array('NPWPD' => $_POST['NPWPD']));
			echo "ok";
		} else {
			echo "ko";
		}
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
		$this->load->library('Pdf');
		$Data['DataWajibPajak'] = $this->db->get('WajibPajak')->result_array();
		$this->load->view('WajibPajakPDF',$Data);
	}

	public function Excel(){
		$Data['DataWajibPajak'] = $this->db->get('WajibPajak')->result_array();
		$this->load->view('WajibPajakExcel',$Data);
	}
}
