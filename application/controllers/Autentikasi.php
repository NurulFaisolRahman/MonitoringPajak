<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autentikasi extends CI_Controller {

	// function __construct(){
	// 	parent::__construct();
	// 	if($this->session->userdata('Status') == "Login"){
	// 		redirect(base_url('Dashboard'));
	// 	}
	// }

	public function index(){
		$this->load->view('Autentikasi/SignIn');
	}

	public function SignIn(){
  	$Username = $_POST['Username'];
  	$Password = $_POST['Password'];
	$CekLogin = $this->db->get_where('Akun', array('Username' => $Username,'Password' => $Password));
	if($CekLogin->num_rows() == 0){
		echo "Username / Password Salah";
  	}
  	else{
			foreach ($CekLogin->result_array() as $key) {
				$DataSession = array();
				if ($key['JenisAkun'] == 1) {
					$DataSession = array('Status' => "Login", 'Admin' => true);
					$this->session->set_userdata($DataSession);
		  		echo 'OK';
				} else {
					$DataSession = array('Status' => "Login", 'Admin' => false);
					$this->session->set_userdata($DataSession);
					echo 'OK';
				}
			}
  	}
	}

	public function SignOut(){
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function AutentikasiWajibPajak(){
		$CekLogin = $this->db->select('Status')
                    ->from('WajibPajak')
                    ->where('NPWPD', $_POST['NPWPD'])
                    ->get();
		if($CekLogin->num_rows() == 1){
			if ($CekLogin->result_array()[0]['Status'] != 'Disable') {
				$this->db->where('NPWPD', $_POST['NPWPD']);
				$this->db->update('WajibPajak', array('Status' => 'Online'));
				echo "ok";
			} else {
				echo "Disable";
			}
	  	}
		else{
			echo "ko";
		}
	}

	public function InputTransaksiWajibPajak(){
		$inputJSON = file_get_contents('php://input');
		$Data = json_decode($inputJSON);
		$NPWPD = "";
		foreach ($Data as $key => $value) {
			$Data[$key] = (array) $value;
		}
		$NPWPD = $Data[0]['NPWPD'];
		$this->db->insert_batch("Transaksi", $Data);
		$this->db->where('NPWPD', $NPWPD);
		$this->db->update('WajibPajak', array('Riwayat' => date("d-m-Y h:i:s A")));
		echo "ok";
	}

	public function api(){
		$Data = $this->db->get_where('Transaksi', array('NPWPD' => '1507.199.607'))->result_array();
		echo json_encode($Data);
	}
}
